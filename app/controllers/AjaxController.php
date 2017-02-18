<?php
namespace MediaRatings\Controllers;

/**
 *
 */
class AjaxController extends ControllerBase
{

    public function initialize()
    {
        if(!($this->request->isPost() && $this->request->isAjax())) 
            return $this->response->redirect();
    }

}
