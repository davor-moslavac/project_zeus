<?php

namespace MediaRatings\Models;

/**
 * Media
 * 
 * @package MediaRatings\Models
 * @autogenerated by Phalcon Developer Tools
 * @date 2017-03-29, 22:02:40
 */
class Media extends \Phalcon\Mvc\Model
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
    protected $external_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $plot;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    protected $backdrop_path;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    protected $homepage_path;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    protected $poster_path;

    /**
     *
     * @var string
     * @Column(type="string", length=1024, nullable=true)
     */
    protected $tagline;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $status_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $vote_count;

    /**
     *
     * @var double
     * @Column(type="double", length=4, nullable=true)
     */
    protected $vote_average;

    /**
     *
     * @var double
     * @Column(type="double", length=16, nullable=true)
     */
    protected $popularity;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    protected $trailer_url;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $release_date;

    /**
     *
     * @var double
     * @Column(type="double", length=15, nullable=true)
     */
    protected $budget;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $language;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    protected $adult;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $is_detail_downloaded;

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
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field plot
     *
     * @param string $plot
     * @return $this
     */
    public function setPlot($plot)
    {
        $this->plot = $plot;

        return $this;
    }

    /**
     * Method to set the value of field backdrop_path
     *
     * @param string $backdrop_path
     * @return $this
     */
    public function setBackdropPath($backdrop_path)
    {
        $this->backdrop_path = $backdrop_path;

        return $this;
    }

    /**
     * Method to set the value of field homepage_path
     *
     * @param string $homepage_path
     * @return $this
     */
    public function setHomepagePath($homepage_path)
    {
        $this->homepage_path = $homepage_path;

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
     * Method to set the value of field tagline
     *
     * @param string $tagline
     * @return $this
     */
    public function setTagline($tagline)
    {
        $this->tagline = $tagline;

        return $this;
    }

    /**
     * Method to set the value of field type_id
     *
     * @param integer $type_id
     * @return $this
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * Method to set the value of field status_type_id
     *
     * @param integer $status_type_id
     * @return $this
     */
    public function setStatusTypeId($status_type_id)
    {
        $this->status_type_id = $status_type_id;

        return $this;
    }

    /**
     * Method to set the value of field vote_count
     *
     * @param integer $vote_count
     * @return $this
     */
    public function setVoteCount($vote_count)
    {
        $this->vote_count = $vote_count;

        return $this;
    }

    /**
     * Method to set the value of field vote_average
     *
     * @param double $vote_average
     * @return $this
     */
    public function setVoteAverage($vote_average)
    {
        $this->vote_average = $vote_average;

        return $this;
    }

    /**
     * Method to set the value of field popularity
     *
     * @param double $popularity
     * @return $this
     */
    public function setPopularity($popularity)
    {
        $this->popularity = $popularity;

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
     * Method to set the value of field release_date
     *
     * @param string $release_date
     * @return $this
     */
    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;

        return $this;
    }

    /**
     * Method to set the value of field budget
     *
     * @param double $budget
     * @return $this
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Method to set the value of field language
     *
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Method to set the value of field adult
     *
     * @param string $adult
     * @return $this
     */
    public function setAdult($adult)
    {
        $this->adult = $adult;

        return $this;
    }

    /**
     * Method to set the value of field is_detail_downloaded
     *
     * @param string $is_detail_downloaded
     * @return $this
     */
    public function setIsDetailDownloaded($is_detail_downloaded)
    {
        $this->is_detail_downloaded = $is_detail_downloaded;

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
     * Returns the value of field external_id
     *
     * @return integer
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field plot
     *
     * @return string
     */
    public function getPlot()
    {
        return $this->plot;
    }

    /**
     * Returns the value of field backdrop_path
     *
     * @return string
     */
    public function getBackdropPath()
    {
        return $this->backdrop_path;
    }

    /**
     * Returns the value of field homepage_path
     *
     * @return string
     */
    public function getHomepagePath()
    {
        return $this->homepage_path;
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
     * Returns the value of field tagline
     *
     * @return string
     */
    public function getTagline()
    {
        return $this->tagline;
    }

    /**
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Returns the value of field status_type_id
     *
     * @return integer
     */
    public function getStatusTypeId()
    {
        return $this->status_type_id;
    }

    /**
     * Returns the value of field vote_count
     *
     * @return integer
     */
    public function getVoteCount()
    {
        return $this->vote_count;
    }

    /**
     * Returns the value of field vote_average
     *
     * @return double
     */
    public function getVoteAverage()
    {
        return $this->vote_average;
    }

    /**
     * Returns the value of field popularity
     *
     * @return double
     */
    public function getPopularity()
    {
        return $this->popularity;
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
     * Returns the value of field release_date
     *
     * @return string
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * Returns the value of field budget
     *
     * @return double
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Returns the value of field language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Returns the value of field adult
     *
     * @return string
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * Returns the value of field is_detail_downloaded
     *
     * @return string
     */
    public function getIsDetailDownloaded()
    {
        return $this->is_detail_downloaded;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', __NAMESPACE__ . '\MediaGender', 'media_id', array('alias' => 'mediaGenders'));
        $this->hasMany('id', __NAMESPACE__ . '\MediaCreators', 'media_id', array('alias' => 'mediaCreators'));
        $this->hasOne('id',  __NAMESPACE__ . '\MediaSeriesDetail', 'id', array('alias' => 'mediaSeriesDetail'));
        $this->hasMany('id', __NAMESPACE__ . '\MediaSeriesSeason', 'media_id', array('alias' => 'mediaSeriesSeason'));
        $this->hasManyToMany('id', __NAMESPACE__ . '\MediaProductionCompanies', 'media_id', 'production_company_id', __NAMESPACE__ . '\ProductionCompany', 'id', array('alias' => 'productionCompanies'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Media[]|Media
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Media
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
        return 'media';
    }

}
