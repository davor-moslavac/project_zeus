<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.2.2017.
 * Time: 20:46
 */

namespace MediaRatings\Import;

use MediaRatings\Models\GenderMediaType;


class MiscImport extends BaseImport
{

    /**
     *
     */
    public function ImportMediaGenres() {
        $response = $this->getDatabaseMovieResponse("genre/movie/list");
        if (isset($response) && isset($response['genres'])) {
            foreach ($response['genres'] as $genre) {
                $obj = new  GenderMediaType();
                //TODO - check with Davor about array saving
                $obj->save($genre);
            }
        }
    }
}