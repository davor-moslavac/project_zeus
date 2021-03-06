<?php
namespace MediaRatings\Controllers;

use MediaRatings\Forms\LoginForm;
use MediaRatings\Forms\SignUpForm;
use MediaRatings\Forms\ForgotPasswordForm;
use MediaRatings\Auth\Exception as AuthException;
use MediaRatings\Models\Users;
use MediaRatings\Models\ResetPasswords;

/**
 * Controller used handle non-authenticated session actions like login/logout, user signup, and forgotten passwords
 */
class SessionController extends ControllerBase
{

    function onConstruct(){
        $config   = dirname(__DIR__) . '/config/hybridAuth.php';
        require_once(dirname(__DIR__) . "/library/HybridAuth/Hybrid/Auth.php");
        require_once( dirname(__DIR__) . "/library/HybridAuth/Hybrid/Endpoint.php" );
        $this->hybridauth = new \Hybrid_Auth($config);
    }
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('public');
    }

    public function indexAction()
    {


        \Hybrid_Endpoint::process();
    }

    /**
     * Allow a user to signup to the system
     */
    public function signupAction()
    {
        $form = new SignUpForm();

        if ($this->request->isPost()) {

            if ($form->isValid($this->request->getPost()) != false) {

                $user = new Users();

                // Avatar
                if ($this->request->hasFiles(TRUE)) {
                    $uFiles = $this->request->getUploadedFiles();

                    foreach ($uFiles as $file) {

                        if (!$file->isUploadedFile()) continue;
                        
                        $ext = strtolower($file->getExtension());

                        if (!preg_match("/^image\/(jpeg|png|gif|svg\+xml)$/", $file->getRealType())) {
                            $this->flash->error("File type not permitted! Please upload a JPG, PNG, GIF or SVG file!");
                            break;
                        }

                        if (!strlen($ext)) {
                            $this->flash->error("Missing extension!");
                            break;
                        }

                        $img = substr($file->getName(), 0, -(strlen($ext)+1)); // Strip extension
                        $img = substr($img, 0, 35-strlen($ext)); // Clip too long names
                        $img = strtolower(str_replace([' ', '_'], '-', $img)) . uniqid("-") .".". $ext; // Replace spaces, set to lowercase and append uniqid and extension

                        if (!is_dir("uploads/avatars")) mkdir("uploads/avatars", 0777, TRUE);

                        $file->moveTo("uploads/avatars/". $img);

                        $user->img = $img;
                    }
                }

                $user->name = $this->request->getPost('name', 'striptags');
                $user->email = $this->request->getPost('email');
                $user->password = $this->security->hash($this->request->getPost('password'));
                $user->profilesId = 2;

                if ($user->save()) {
                    return $this->dispatcher->forward([
                        'controller' => 'index',
                        'action' => 'index'
                    ]);
                }

                $this->flash->error($user->getMessages());
            }
        }

        $this->view->form = $form;
    }

    /**
     * Starts a session in the admin backend
     */
    public function loginAction()
    {
        $form = new LoginForm();

        try {

            if (!$this->request->isPost()) {

                if ($this->auth->hasRememberMe()) {
                    return $this->auth->loginWithRememberMe();
                }
            } else {

                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {

                    $this->auth->check([
                        'email' => $this->request->getPost('email'),
                        'password' => $this->request->getPost('password'),
                        'remember' => $this->request->getPost('remember')
                    ]);

                    return $this->response->redirect('users');
                }
            }
        } catch (AuthException $e) {
            $this->flash->error($e->getMessage());
        }

        $this->view->form = $form;
    }

    /**
     * Shows the forgot password form
     */
    public function forgotPasswordAction()
    {
        $form = new ForgotPasswordForm();

        if ($this->request->isPost()) {
            
            // Send emails only is config value is set to true
            if ($this->getDI()->get('config')->useMail) {

                if ($form->isValid($this->request->getPost()) == false) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                } else {

                    $user = Users::findFirstByEmail($this->request->getPost('email'));
                    if (!$user) {
                        $this->flash->success('There is no account associated to this email');
                    } else {

                        $resetPassword = new ResetPasswords();
                        $resetPassword->usersId = $user->id;
                        if ($resetPassword->save()) {
                            $this->flash->success('Success! Please check your messages for an email reset password');
                        } else {
                            foreach ($resetPassword->getMessages() as $message) {
                                $this->flash->error($message);
                            }
                        }
                    }
                }
            } else {
                $this->flash->warning('Emails are currently disabled. Change config key "useMail" to true to enable emails.');
            }
        }

        $this->view->form = $form;
    }

    /**
     * Closes the session
     */
    public function logoutAction()
    {
        $this->auth->remove();

        return $this->response->redirect('index');
    }

    public function loginSocialAction($type){
        try
        {
            $provider = $this->hybridauth->authenticate($type);

            // get the user profile
            $ser_profile = $provider->getUserProfile();
            $this->session->set('auth-identity', [
                'id' => $ser_profile->identifier,
                'name' => $ser_profile->displayName,
                'profile' => 'Users'
            ]);
            return $this->response->redirect('index');
        }
        catch( \Exception $e ){
            $this->logger->error($e->getMessage());
        }
    }
}
