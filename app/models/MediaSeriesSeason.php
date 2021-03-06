<?php

namespace MediaRatings\Models;

class MediaSeriesSeason extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $media_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $air_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $external_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $episode_count;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    protected $poster_path;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $season_number;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    protected $trailer_url;

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
     * Method to set the value of field media_id
     *
     * @param integer $media_id
     * @return $this
     */
    public function setMediaId($media_id)
    {
        $this->media_id = $media_id;

        return $this;
    }

    /**
     * Method to set the value of field air_date
     *
     * @param string $air_date
     * @return $this
     */
    public function setAirDate($air_date)
    {
        $this->air_date = $air_date;

        return $this;
    }

    /**
     * Method to set the value of field external_id
     *
     * @param integer $external_id
     * @return $this
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;

        return $this;
    }

    /**
     * Method to set the value of field episode_count
     *
     * @param integer $episode_count
     * @return $this
     */
    public function setEpisodeCount($episode_count)
    {
        $this->episode_count = $episode_count;

        return $this;
    }

    /**
     * Method to set the value of field poster_path
     *
     * @param string $poster_path
     * @return $this
     */
    public function setPosterPath($poster_path)
    {
        $this->poster_path = $poster_path;

        return $this;
    }

    /**
     * Method to set the value of field season_number
     *
     * @param integer $season_number
     * @return $this
     */
    public function setSeasonNumber($season_number)
    {
        $this->season_number = $season_number;

        return $this;
    }

    /**
     * Method to set the value of field trailer_url
     *
     * @param string $trailer_url
     * @return $this
     */
    public function setTrailerUrl($trailer_url)
    {
        $this->trailer_url = $trailer_url;

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
     * Returns the value of field media_id
     *
     * @return integer
     */
    public function getMediaId()
    {
        return $this->media_id;
    }

    /**
     * Returns the value of field air_date
     *
     * @return string
     */
    public function getAirDate()
    {
        return $this->air_date;
    }

    /**
     * Returns the value of field external_id
     *
     * @return integer
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Returns the value of field episode_count
     *
     * @return integer
     */
    public function getEpisodeCount()
    {
        return $this->episode_count;
    }

    /**
     * Returns the value of field poster_path
     *
     * @return string
     */
    public function getPosterPath()
    {
        return $this->poster_path;
    }

    /**
     * Returns the value of field season_number
     *
     * @return integer
     */
    public function getSeasonNumber()
    {
        return $this->season_number;
    }

    /**
     * Returns the value of field trailer_url
     *
     * @return string
     */
    public function getTrailerUrl()
    {
        return $this->trailer_url;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__ . '\MediaSeriesSeasonEpisodes', 'season_id', array('alias' => 'mediaSeriesSeasonEpisodes'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaSeriesSeason[]|MediaSeriesSeason
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaSeriesSeason
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
        return 'media_series_season';
    }

}
