<?php
namespace MediaRatings\Models;
class UserMessages extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $sender_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    public $receiver_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $message;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $sent_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    public $seen;

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
        return 'user_messages';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserMessages[]|UserMessages
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UserMessages
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }


    //temp solution
    public static function getMessages($user_id = NULL, $user_id_2 = NULL) {
        return parent::find(["sender_id = ?1 OR receiver_id = ?1 AND sender_id = ?2 OR receiver_id = ?2", "bind" => [1 => $user_id, 2 => $user_id_2], "order" => "sent_time DESC"]);
    }

}
