<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 18.3.2017.
 * Time: 19:33
 */

namespace MediaRatings\Import;
use MediaRatings\Models;

class MoviesImport  extends BaseImport
{
    /**
     *
     */
    public function ImportListOfPopularMovies($getFullDetails) {
        try
        {
            $started = new \DateTime();
            $this->logger->info('Import of popular movies started at:'. $started->format('Y-m-d H:i:s'));
            $page = 1;
            $pageNumber = 1;
            do {
                $response = $this->getDatabaseMovieResponse("movie/popular?page=" . $page . "&language=en-US");
                $pageNumber = $response['total_pages'];
                if (isset($response) && isset($response['results'])) {
                    foreach ($response['results'] as $movie) {
                        $media = new  Models\Media();
                        $media->setExternalId($movie['id']);
                        $media->setPosterPath($movie['poster_path']);
                        $media->setAdult($movie['adult']);
                        $media->setPlot($movie['overview']);
                        $media->setReleaseDate($movie['release_date']);
                        $genders = array();
                        foreach ($movie['genre_ids'] as $gender_id) {
                            $media_gender = new Models\MediaGender();
                            $media_gender->setGenderId($gender_id);
                            $genders[] = $media_gender;
                        }
                        $media->mediaGenders = $genders;
                        $media->setTitle($movie['title']);
                        $media->setLanguage($movie['original_language']);
                        $media->setBackdropPath($movie['backdrop_path']);
                        $media->setPopularity($movie['popularity']);
                        $media->setVoteAverage($movie['vote_average']);
                        $media->setVoteCount($movie['vote_count']);
                        $media->setTypeId(1);

                        if($getFullDetails) {
                            $media = $this->getMovieDetails($media);
                        }
                        if ($media->save() === false) {
                            throw new Exception(implode(';', $media->getMessages()));
                        }
                    }
                }
                $page++;
                if($page == 5){
                    break;
                }
            } while ($pageNumber > 1);
            $finished = new \DateTime();
            $this->logger->info('Import of movies finished at:'. $finished->format('Y-m-d H:i:s'));
            return true;
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
        }
        return false;
    }

    public function ImportMovieDetails($movie) {
        try
        {
            $movie = $this->getMovieDetails($movie);
            if ($movie->save() === false) {
                throw new Exception(implode(';', $movie->getMessages()));
            }
            return true;
        } catch (Exception $e) {
            $this->logger->error('Import (TMDB): ' . $e);
        }
        return false;
    }

    private function getMovieDetails(Models\Media $movie){
        $response = $this->getDatabaseMovieResponse("movie/". $movie->getExternalId() . '?append_to_response=videos,credits');
        if (isset($response)) {
            $movie->setBudget($response['budget']);
            $movie->setHomepagePath($response['homepage']);
            $movie->setTrailerUrl($this->getTrailerUrl($response['videos']));
            $statusTypeId = Models\MediaStatusType::upsertStatusType($response['status']);
            $movie->setStatusTypeId($statusTypeId);
            $movie->setTagline($response['tagline']);
            $creators = array();
            foreach ($response['created_by'] as $creator) {
                $media_creator = new Models\MediaCreators();
                $media_creator->setMediaId($series->getId());
                $media_creator->setExternalId($creator['id']);
                $media_creator->setName($creator['name']);
                $media_creator->setProfilePath($creator['profile_path']);
                $creators[] = $media_creator;
            }
            $movie->mediaCreators = $creators;
            $productionCompanies = array();
            foreach ($response['production_companies'] as $company) {
                $production_company = new Models\ProductionCompany();
                $production_company->setName($company['name']);
                $production_company->setId($company['id']);
                $productionCompanies[] = $production_company;
            }
            $movie->productionCompanies = $productionCompanies;
            $movie->setIsDetailDownloaded(true);
        }
        return $movie;
    }
}