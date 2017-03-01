<?php
namespace MediaRatings\Models;
class MediaSeriesDetail extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=20, nullable=false)
     */
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $number_of_seasons;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $number_of_episode;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    public $origin_country;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=true)
     */
    public $episode_run_time;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=true)
     */
    public $in_production;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $end_date;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        
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

}
