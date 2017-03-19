<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 18.3.2017.
 * Time: 19:33
 */

namespace MediaRatings\Import;
use Phalcon\Config\Adapter;
use MediaRatings\Models;

class SeriesImport  extends BaseImport
{
    /**
     *
     */
    public function ImportListOfSeries() {
        $dbAPI = $this->config->movieDatabase;
        $response = new Adapter\Json(APP_PATH . "/config/movies.json");//$this->getDatabaseMovieResponse("genre/movie/list");
        if (isset($response) && isset($response['results'])) {
            foreach ($response['results'] as $series) {
                $media = new  Models\Media();
                $media->external_id = $series->id;
                $media->poster_path = $dbAPI->image_url . $series->poster_path;
                $media->popularity = $series->popularity;
                $media->vote_average = $series->vote_average;
                $media->backdrop_path = $dbAPI->image_url . $series->backdrop_path;
                $media->plot =  $series->overview;
                $media->release_date = $series->first_air_date;
                $media->vote_count = $series->vote_count;
                $media->language = $series->original_language;
                $media->type_id = 2;
                $media->title = $series->name;
                $genders = array();
                foreach ($series['genre_ids'] as $gender_id) {
                    $media_gender = new Models\MediaGender();
                    $media_gender->gender_id = $gender_id;
                    $genders[] = $media_gender;
                }
                $media->mediaGenders = $genders;
                if ($media->save() === false) {
                    echo "Umh, We can't store series right now: \n";

                    $messages = $media->getMessages();

                    foreach ($messages as $message) {
                        echo $message, "\n";
                    }
                }
            }
        }
    }
}