<?php

namespace MediaRatings\Models;

/**
 * MediaSeriesDetail
 * 
 * @package MediaRatings\Models
 * @autogenerated by Phalcon Developer Tools
 * @date 2017-03-30, 20:50:45
 */
class MediaSeriesDetail extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $number_of_seasons;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $number_of_episode;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $origin_country;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=true)
     */
    protected $episode_run_time;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    protected $in_production;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $end_date;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field number_of_seasons
     *
     * @param integer $number_of_seasons
     * @return $this
     */
    public function setNumberOfSeasons($number_of_seasons)
    {
        $this->number_of_seasons = $number_of_seasons;

        return $this;
    }

    /**
     * Method to set the value of field number_of_episode
     *
     * @param integer $number_of_episode
     * @return $this
     */
    public function setNumberOfEpisode($number_of_episode)
    {
        $this->number_of_episode = $number_of_episode;

        return $this;
    }

    /**
     * Method to set the value of field origin_country
     *
     * @param string $origin_country
     * @return $this
     */
    public function setOriginCountry($origin_country)
    {
        $this->origin_country = $origin_country;

        return $this;
    }

    /**
     * Method to set the value of field episode_run_time
     *
     * @param string $episode_run_time
     * @return $this
     */
    public function setEpisodeRunTime($episode_run_time)
    {
        $this->episode_run_time = $episode_run_time;

        return $this;
    }

    /**
     * Method to set the value of field in_production
     *
     * @param string $in_production
     * @return $this
     */
    public function setInProduction($in_production)
    {
        $this->in_production = $in_production;

        return $this;
    }

    /**
     * Method to set the value of field end_date
     *
     * @param string $end_date
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field number_of_seasons
     *
     * @return integer
     */
    public function getNumberOfSeasons()
    {
        return $this->number_of_seasons;
    }

    /**
     * Returns the value of field number_of_episode
     *
     * @return integer
     */
    public function getNumberOfEpisode()
    {
        return $this->number_of_episode;
    }

    /**
     * Returns the value of field origin_country
     *
     * @return string
     */
    public function getOriginCountry()
    {
        return $this->origin_country;
    }

    /**
     * Returns the value of field episode_run_time
     *
     * @return string
     */
    public function getEpisodeRunTime()
    {
        return $this->episode_run_time;
    }

    /**
     * Returns the value of field in_production
     *
     * @return string
     */
    public function getInProduction()
    {
        return $this->in_production;
    }

    /**
     * Returns the value of field end_date
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaSeriesDetail[]|MediaSeriesDetail
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaSeriesDetail
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'media_series_detail';
    }

}
