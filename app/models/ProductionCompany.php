<?php

namespace MediaRatings\Models;

class ProductionCompany extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=256, nullable=false)
     */
    public $name;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'MediaRatings\Models\MediaProductionCompanies', 'production_company_id', ['alias' => 'mediaProductionCompanies']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'production_company';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductionCompany[]|ProductionCompany
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ProductionCompany
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
