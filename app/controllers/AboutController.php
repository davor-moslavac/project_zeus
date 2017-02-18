<?php
namespace MediaRatings\Controllers;

/**
 * Display the "About" page.
 */
class AboutController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('public');
    }
}
