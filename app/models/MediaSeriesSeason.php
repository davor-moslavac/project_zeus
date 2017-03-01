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
    public $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=false)
     */
    public $media_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $air_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=false)
     */
    public $external_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $episode_count;

    /**
     *
     * @var string
     * @Column(type="string", length=512, nullable=true)
     */
    public $poster_path;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    public $season_number;

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
        return 'media_series_season';
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

}
