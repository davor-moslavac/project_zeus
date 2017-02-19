<?php
namespace MediaRatings\Controllers;

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use MediaRatings\Forms\ChangePasswordForm;
use MediaRatings\Forms\UsersForm;
use MediaRatings\Models\Users;
use MediaRatings\Models\PasswordChanges;

/**
 * MediaRatings\Controllers\UsersController
 * CRUD to manage users
 */
class SocialController extends ControllerBase
{

    public function initialize()
    {
        $this->view->setTemplateBefore('public');
    }

    /**
     * Default action, shows the search form
     */
    public function indexAction()
    {
        $this->view->title = "Users";

        $users = $this->view->users = Users::find();
    }


    public function userAction($id = null)
    {
        if (is_null($id) || !is_numeric($id)) $this->response->redirect();

        $this->view->user = $user = Users::findFirstById($id);
    }

    public function messagesAction()
    {

    }

    public function messageAction($id = null)
    {
        if (is_null($id) || !is_numeric($id)) $this->response->redirect();

    }

    /**
     * Searches for users
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'MediaRatings\Models\Users', $this->request->getPost());
            $this->persistent->searchParams = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = [];
        if ($this->persistent->searchParams) {
            $parameters = $this->persistent->searchParams;
        }

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");
            return $this->dispatcher->forward([
                "action" => "index"
            ]);
        }

        $paginator = new Paginator([
            "data" => $users,
            "limit" => 10,
            "page" => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }
}
