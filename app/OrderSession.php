<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class OrderSession extends Model
{
    use Eloquence;

    protected $table = 'order_session';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'order_quantity', 'beer_type', 'confirmation'
    ];


    public function scopeUser($q, $userUid)
    {
        return $q->whereUid($userUid);
    }

    public function getOrderQuantity()
    {
        return $this->order_quantity;
    }

    public function getBeerType()
    {
        return $this->beer_type;
    }

    public function isConfirmed()
    {
        return $this->confirmation;
    }

}
