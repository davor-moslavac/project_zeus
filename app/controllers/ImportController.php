<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.2.2017.
 * Time: 20:56
 */

namespace MediaRatings\Controllers;

use MediaRatings\Import;

class ImportController extends ControllerBase
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
    public function miscImportAction()
    {
        $this->view->disable();
        $miscImport = new Import\MiscImport();
        $res = $miscImport->ImportMediaGenres();
        $response = new \Phalcon\Http\Response();
        //Set the content of the response
        $response->setContent(json_encode($res));
        //Return the response
        return $response;
    }

    public function seriesListImportAction()
    {
        $this->view->disable();
        $miscImport = new Import\SeriesImport();
        $res = $miscImport->ImportListOfSeries(true);
        $response = new \Phalcon\Http\Response();
        //Set the content of the response
        $response->setContent(json_encode($res));
        //Return the response
        return $response;
    }
}