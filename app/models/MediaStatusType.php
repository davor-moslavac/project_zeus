<?php

namespace MediaRatings\Models;

/**
 * MediaStatusType
 * 
 * @package MediaRatings\Models
 * @autogenerated by Phalcon Developer Tools
 * @date 2017-03-30, 20:51:22
 */
class MediaStatusType extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $name;

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
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return MediaStatusType[]|MediaStatusType
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MediaStatusType
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * If status type exists return id, else create status type and return id.
     * @param $statusName
     * @return status id
     */
    public static function upsertStatusType($statusName){
        $status = MediaStatusType::findFirstByName($statusName);
        if(!$status){
            $new_status = new MediaStatusType();
            $new_status->name = $statusName;
            if ($new_status->save() === true) {
                $status = MediaStatusType::findFirstByName($statusName);
            }
        }
        return $status->id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'media_status_type';
    }

}
