<?php
namespace MediaRatings\Controllers;

use MediaRatings\Models\Media;
use MediaRatings\Import;

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

    public function indexAction($id = null)
    {
        if (is_null($id) || !is_numeric($id)) $this->response->redirect();
        $media = Media::findFirstById($id);
        //if($media != null && $media->is_detail_downloaded == false){
            $miscImport = new Import\SeriesImport();
            $status = $miscImport->ImportSeriesDetails($media);
       // }
        $this->view->media = $media;
    }

    /**
     * All action.
     */
    public function allAction()
    {
        $this->view->title = "All media";

        $this->view->medias = Media::find();
    }

    /**
     * Movies action.
     */
    public function moviesAction()
    {
        $this->view->title = "Movies";

        $this->view->medias = Media::find(["conditions" => "type_id = 1"]);
    }

    /**
     * TV Shows action.
     */
    public function TVShowsAction()
    {
        $this->view->title = "TV Shows";

        $this->view->medias = Media::find(["conditions" => "type_id = 2"]);
    }

    /**
     * Animes action.
     */
    public function AnimesAction()
    {
        $this->view->title = "Anime";

        $this->view->medias = Media::find(["conditions" => "type_id = 3"]);
    }
    
}
