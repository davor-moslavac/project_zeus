<?php
namespace MediaRatings\Models;
class MediaProductionCompanies extends \Phalcon\Mvc\Model
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
     * @var string
     * @Column(type="string", length=1024, nullable=false)
     */
    public $name;

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
    public $production_company_id;

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
        return 'media_production_companies';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaProductionCompanies[]|MediaProductionCompanies
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaProductionCompanies
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
