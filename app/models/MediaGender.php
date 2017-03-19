<?php
namespace MediaRatings\Models;

class MediaGender extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $gender_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('gender_id', __NAMESPACE__ . '\GenderMediaType', 'id');
        $this->belongsTo('media_id', __NAMESPACE__ . '\Media', 'id');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'media_gender';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaGender[]|MediaGender
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaGender
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
