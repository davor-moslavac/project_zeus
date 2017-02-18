<?php
namespace MediaRatings\Controllers;

/**
 * Display the "About" page.
 */
class MediaController extends ControllerBase
{
    /**
     * Default action. Set the public layout (layouts/public.volt)
     */
    public function initialize()
    {
        $this->view->setTemplateBefore('public');
    }

    /**
     * Default action.
     */
    public function indexAction()
    {
        $this->view->title = "All media";
    }

    /**
     * Movies action.
     */
    public function moviesAction()
    {
        $this->view->title = "Movies";
    }

    /**
     * TV Shows action.
     */
    public function TVShowsAction()
    {
        $this->view->title = "TV Shows";
    }

    /**
     * Animes action.
     */
    public function AnimesAction()
    {
        $this->view->title = "Anime";
    }

    
}
