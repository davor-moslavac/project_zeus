<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 18.3.2017.
 * Time: 19:33
 */

namespace MediaRatings\Import;
use MediaRatings\Models;

class SeriesImport  extends BaseImport
{
    /**
     *
     */
    public function ImportListOfSeries() {
        try
        {
            $dbAPI = $this->config->movieDatabase;
            $page = 1; //TODO: pull from some temp table
            $response = $this->getDatabaseMovieResponse("tv/popular?page=". $page ."&language=en-US");
            if (isset($response) && isset($response['results'])) {
                foreach ($response['results'] as $series) {
                    $media = new  Models\Media();
                    $media->external_id = $series['id'];
                    $media->poster_path = $dbAPI->image_url . $series['poster_path'];
                    $media->popularity = $series['popularity'];
                    $media->vote_average = $series['vote_average'];
                    $media->backdrop_path = $dbAPI->image_url . $series['backdrop_path'];
                    $media->plot = $series['overview'];
                    $media->release_date = $series['first_air_date'];
                    $media->vote_count = $series['vote_count'];
                    $media->language = $series['original_language'];
                    $media->type_id = 2;
                    $media->title = $series['name'];
                    $genders = array();
                    foreach ($series['genre_ids'] as $gender_id) {
                        $media_gender = new Models\MediaGender();
                        $media_gender->gender_id = $gender_id;
                        $genders[] = $media_gender;
                    }
                    $media->mediaGenders = $genders;
                    if ($media->save() === false) {
                        throw new Exception(implode(';', $media->getMessages()));
                    }
                    return true;
                }
            }
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
        }
        return false;
    }

    public function ImportSeriesDetails($series) {
        try
        {
            $dbAPI = $this->config->movieDatabase;
            $response = $this->getDatabaseMovieResponse("tv/". $series->external_id);;
            if (isset($response)) {
                $creators = array();
                foreach ($response['created_by'] as $creator) {
                    $media_creator = new Models\MediaCreators();
                    $media_creator->media_id = $series->id;
                    $media_creator->external_id = $creator['id'];
                    $media_creator->name = $creator['name'];
                    $media_creator->profile_path = $dbAPI->image_url . $creator['profile_path'];
                    $creators[] = $media_creator;
                }
                $series->mediaCreators = $creators;
                $media_series_detail = new Models\MediaSeriesDetail();
                $media_series_detail->id = $series->id;
                if(isset($response['last_air_date'])) {
                    $media_series_detail->end_date = $response['last_air_date'];
                }
                $media_series_detail->episode_run_time = implode(', ', $response['episode_run_time']);
                $media_series_detail->in_production = $response['in_production'];
                $media_series_detail->number_of_episode = $response['number_of_episodes'];
                $media_series_detail->number_of_seasons = $response['number_of_seasons'];
                $media_series_detail->origin_country = implode(', ', $response['origin_country']);
                $series->mediaSeriesDetail = $media_series_detail;
                $series->homepage_path = $response['homepage'];
                $mediaSeriesSeasons = array();
                foreach ($response['seasons'] as $season) {
                    $media_series_season = new Models\MediaSeriesSeason();
                    $media_series_season->media_id = $series->id;
                    $media_series_season->external_id = $season['id'];
                    $media_series_season->air_date = $season['air_date'];
                    $media_series_season->episode_count = $season['episode_count'];
                    $media_series_season->poster_path = $dbAPI->image_url . $season['poster_path'];
                    $media_series_season->season_number = $season['season_number'];
                    $mediaSeriesSeasons[] = $media_series_season;
                }
                $series->mediaSeriesSeason = $mediaSeriesSeasons;
                $series->status_type_id = $this->handleStatusType($response['status']);
                $productionCompanies = array();
                foreach ($response['production_companies'] as $company) {
                    $production_company = new Models\ProductionCompany();
                    $production_company->name = $company['name'];
                    $production_company->id = $company['id'];
                    $productionCompanies[] = $production_company;
                }
                $series->productionCompanies = $productionCompanies;
                $series->is_detail_downloaded = true;
                if ($series->save() === false) {
                    throw new Exception(implode(';', $series->getMessages()));
                }
                return true;
            }
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
        }
        return false;
    }
}