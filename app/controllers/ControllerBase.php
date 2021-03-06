<?php
namespace MediaRatings\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

/**
 * ControllerBase
 * This is the base controller for all controllers in the application
 */
class ControllerBase extends Controller
{
    /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $controllerName = $dispatcher->getControllerName();

        $this->assets->collection('style')
                    ->addCss('/third-party/css/bootstrap.min.css', true, false)
                    ->addCss('/third-party/css/theme.min.css', true, false)
                    ->addCss('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Condensed:300,400,500,700,900', false)
                    ->addCss('/css/font-awesome.min.css', true, false)
                    ->addCss('/css/bootstrap-social.css', true, false)
                    ->addCss('/css/style.css', true, false);

        $this->assets->collection('scripts')
                    ->addJs('/third-party/js/jquery-3.1.1.min.js', true, false)
                    ->addJs('/third-party/js/bootstrap.min.js', true, false)
                    ->addJs('/js/script.js', true, false);

        // Only check permissions on private controllers
        if ($this->acl->isPrivate($controllerName)) {

            // Get the current identity
            $identity = $this->auth->getIdentity();

            // If there is no identity available the user is redirected to index/index
            if (!is_array($identity)) {

                $this->flash->notice('You don\'t have access to this module: private');

                $dispatcher->forward([
                    'controller' => 'index',
                    'action' => 'index'
                    ]);
                return false;
            }

            // Check if the user have permission to the current option
            $actionName = $dispatcher->getActionName();
            if (!$this->acl->isAllowed($identity['profile'], $controllerName, $actionName)) {

                $this->flash->notice('You don\'t have access to this module: ' . $controllerName . ':' . $actionName);

                if ($this->acl->isAllowed($identity['profile'], $controllerName, 'index')) {
                    $dispatcher->forward([
                        'controller' => $controllerName,
                        'action' => 'index'
                        ]);
                } else {
                    $dispatcher->forward([
                        'controller' => 'user_control',
                        'action' => 'index'
                        ]);
                }

                return false;
            }
        }

        $this->view->setVar('logged_in', is_array($this->auth->getIdentity()));
    }
}
