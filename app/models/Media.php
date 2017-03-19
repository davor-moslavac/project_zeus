<?php
namespace MediaRatings\Models;

class Media extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=20, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=false)
     */
    public $external_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $plot;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    public $backdrop_path;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    public $homepage_path;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    public $poster_path;

    /**
     *
     * @var string
     * @Column(type="string", length=1024, nullable=true)
     */
    public $tagline;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    public $status_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $vote_count;

    /**
     *
     * @var double
     * @Column(type="double", length=4, nullable=true)
     */
    public $vote_average;

    /**
     *
     * @var double
     * @Column(type="double", length=16, nullable=true)
     */
    public $popularity;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    public $trailer_url;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $release_date;

    /**
     *
     * @var double
     * @Column(type="double", length=15, nullable=true)
     */
    public $budget;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $language;

    /**
 *
 * @var string
 * @Column(type="string", length=1, nullable=true)
 */
    public $adult;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    public $is_detail_downloaded;

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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'media';
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

}
