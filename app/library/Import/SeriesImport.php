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
    public function ImportListOfSeries($getFullDetails) {
        try
        {
            $started = new \DateTime();
            $this->logger->info('Import of series started at:'. $started->format('Y-m-d H:i:s'));
            $page = 1;
            $pageNumber = 1;
            $animation_genre = Models\GenderMediaType::findFirstByName('Animation');
            do {
                $response = $this->getDatabaseMovieResponse("tv/popular?page=" . $page . "&language=en-US");
                $pageNumber = $response['total_pages'];
                if (isset($response) && isset($response['results'])) {
                    foreach ($response['results'] as $series) {
                        $media = new  Models\Media();
                        $media->setExternalId($series['id']);
                        $media->setPosterPath($series['poster_path']);
                        $media->setPopularity($series['popularity']);
                        $media->setVoteAverage($series['vote_average']);
                        $media->setBackdropPath($series['backdrop_path']);
                        $media->setPlot($series['overview']);
                        $media->setReleaseDate($series['first_air_date']);
                        $media->setVoteCount($series['vote_count']);
                        $media->setLanguage($series['original_language']);

                        $media->setTitle($series['name']);
                        $genders = array();
                        $isAnimation = false;
                        foreach ($series['genre_ids'] as $gender_id) {
                            $media_gender = new Models\MediaGender();
                            $media_gender->setGenderId($gender_id);
                            $genders[] = $media_gender;
                            if($gender_id == $animation_genre->getId()){
                                $isAnimation = true;
                            }
                        }
                        $media->mediaGenders = $genders;
                        if($isAnimation && $media->getLanguage() == 'ja') {
                            $media->setTypeId(3); //set as anime
                        } else {
                            $media->setTypeId(2);
                        }

                        if($getFullDetails) {
                            $media = $this->getSeriesDetails($media);
                        }
                        if ($media->save() === false) {
                            throw new Exception(implode(';', $media->getMessages()));
                        }
                    }
                }
                $page++;
                if($page == 4){
                    break;
                }
            } while ($pageNumber > 1);
            $finished = new \DateTime();
            $this->logger->info('Import of series finished at:'. $finished->format('Y-m-d H:i:s'));
            return true;
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
        }
        return false;
    }

    public function ImportSeriesDetails($series) {
        try
        {
            $series = $this->getSeriesDetails($series);
            if ($series->save() === false) {
                throw new Exception(implode(';', $series->getMessages()));
            }
            return true;
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
        }
        return false;
    }

    private function getSeriesDetails(Models\Media $series){
        $response = $this->getDatabaseMovieResponse("tv/". $series->getExternalId() . '?append_to_response=videos');
        if (isset($response)) {
            $creators = array();
            foreach ($response['created_by'] as $creator) {
                $media_creator = new Models\MediaCreators();
                $media_creator->setMediaId($series->getId());
                $media_creator->setExternalId($creator['id']);
                $media_creator->setName($creator['name']);
                $media_creator->setProfilePath($creator['profile_path']);
                $creators[] = $media_creator;
            }
            $series->mediaCreators = $creators;
            $media_series_detail = new Models\MediaSeriesDetail();
            $media_series_detail->setId($series->getId());
            if(isset($response['last_air_date'])) {
                $media_series_detail->setEndDate($response['last_air_date']);
            }
            $media_series_detail->setEpisodeRunTime(implode(', ', $response['episode_run_time']));
            $media_series_detail->setInProduction($response['in_production']);
            $media_series_detail->setNumberOfEpisode($response['number_of_episodes']);
            $media_series_detail->setNumberOfSeasons($response['number_of_seasons']);
            $media_series_detail->setOriginCountry(implode(', ', $response['origin_country']));
            $series->mediaSeriesDetail = $media_series_detail;
            $series->setHomepagePath($response['homepage']);
            $series->setTrailerUrl($this->getTrailerUrl($response['videos']));
            $mediaSeriesSeasons = array();
            foreach ($response['seasons'] as $season) {
                $media_series_season = new Models\MediaSeriesSeason();
                $media_series_season->setMediaId($series->getId());
                $media_series_season->setExternalId($season['id']);
                $media_series_season->setAirDate($season['air_date']);
                $media_series_season->setEpisodeCount($season['episode_count']);
                $media_series_season->setPosterPath($season['poster_path']);
                $media_series_season->setSeasonNumber($season['season_number']);
                $media_series_season = $this->updateSeriesSeasonWithEpisodes($series->getExternalId(), $media_series_season);
                $mediaSeriesSeasons[] = $media_series_season;
            }
            $series->mediaSeriesSeason = $mediaSeriesSeasons;
            $statusTypeId = Models\MediaStatusType::upsertStatusType($response['status']);
            $series->setStatusTypeId($statusTypeId);;
            $productionCompanies = array();
            foreach ($response['production_companies'] as $company) {
                $production_company = new Models\ProductionCompany();
                $production_company->setName($company['name']);
                $production_company->setId($company['id']);
                $productionCompanies[] = $production_company;
            }
            $series->productionCompanies = $productionCompanies;
            $series->setIsDetailDownloaded(true);
        }
        return $series;
    }

     function updateSeriesSeasonWithEpisodes($media_id, $season){
        $episodes = array();
         try
        {
            $response = $this->getDatabaseMovieResponse("tv/" . $media_id . '/season/' . $season->season_number . '?append_to_response=videos');
            if (isset($response)) {
                $season->setTrailerUrl($this->getTrailerUrl($response['videos']));
                foreach ($response['episodes'] as $response_episode) {
                    $episode = new Models\MediaSeriesSeasonEpisodes();
                    $episode->setSeasonId($season->id);
                    $episode->setExternalId($response_episode['id']);
                    $episode->setAirDate($response_episode['air_date']);
                    $episode->setEpisodeNumber($response_episode['episode_number']);
                    $episode->setName($response_episode['name']);
                    $episode->setPlot($response_episode['overview']);
                    $episode->setStillPath($response_episode['still_path']);
                    $episode->setVoteAverage($response_episode['vote_average']);
                    $episode->setVoteCount($response_episode['vote_count']);
                    $episodes[] = $episode;
                }
                $season->mediaSeriesSeasonEpisodes = $episodes;
            }
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
        }
        return $season;
    }
}