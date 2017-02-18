<?php
namespace MediaRatings\Models;

use Phalcon\Mvc\Model;

/**
 * MediaRatings\Models\Users
 * All the users registered in the application
 */
class UserConnections extends Model
{

    /**
     *
     * @var integer
     */
    public $id;    

    /**
     *
     * @var integer
     */
    public $user_id;    

    /**
     *
     * @var integer
     */
    public $followed_user_id;

    /**
     *
     * @var timestamp
     */
    public $created;



    public function initialize()
    {
        $this->belongsTo('user_id', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'user_id',
            'reusable' => true
        ]);

        $this->belongsTo('followed_user_id', __NAMESPACE__ . '\Users', 'id', [
            'alias' => 'followed_user_id',
            'reusable' => true
        ]);
    }

    public function beforeSave()
    {
        $this->skipAttributes(['created']);
    }

    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
