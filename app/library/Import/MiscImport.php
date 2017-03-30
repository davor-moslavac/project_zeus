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
        try
        {
            $genres = array();
            $genre_endpoints = array('movie', 'tv');
            foreach ($genre_endpoints as $endpoint_type){
                $response = $this->getDatabaseMovieResponse("genre/". $endpoint_type ."/list");
                if (isset($response) && isset($response['genres'])) {
                    $genres = array_merge($genres, $response['genres']);
                }
            }
            foreach ($genres as $genre) {
                $obj = new  GenderMediaType();
                $obj->save($genre);
            }
            return true;
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
            return false;
        }

    }
}