<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.2.2017.
 * Time: 20:46
 */

namespace MediaRatings\Import;


class MiscImport extends BaseImport
{

    /**
     *
     */
    public function ImportMediaGenres() {
        $response = $this->getDatabaseMovieResponse("genre/movie/list");
        if (isset($response)) {
            return $response['genres'];
        }
        return $response;
    }
}