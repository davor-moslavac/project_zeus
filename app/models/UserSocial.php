<?php

namespace MediaRatings\Models;

class UserSocial extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $user_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $social_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $social_provider_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $social_data;

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
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field social_id
     *
     * @param string $social_id
     * @return $this
     */
    public function setSocialId($social_id)
    {
        $this->social_id = $social_id;

        return $this;
    }

    /**
     * Method to set the value of field social_provider_id
     *
     * @param integer $social_provider_id
     * @return $this
     */
    public function setSocialProviderId($social_provider_id)
    {
        $this->social_provider_id = $social_provider_id;

        return $this;
    }

    /**
     * Method to set the value of field social_data
     *
     * @param string $social_data
     * @return $this
     */
    public function setSocialData($social_data)
    {
        $this->social_data = $social_data;

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
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field social_id
     *
     * @return string
     */
    public function getSocialId()
    {
        return $this->social_id;
    }

    /**
     * Returns the value of field social_provider_id
     *
     * @return integer
     */
    public function getSocialProviderId()
    {
        return $this->social_provider_id;
    }

    /**
     * Returns the value of field social_data
     *
     * @return string
     */
    public function getSocialData()
    {
        return $this->social_data;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('social_provider_id',  __NAMESPACE__ . '\SocialProvider', 'id', ['alias' => 'socialProvider']);
        $this->belongsTo('user_id',  __NAMESPACE__ . '\Users', 'id', ['alias' => 'users']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'user_social';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserSocial[]|UserSocial
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserSocial
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
