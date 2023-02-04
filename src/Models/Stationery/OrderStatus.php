<?php

namespace Supala\ETransport\Models\Stationery;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $connection = 'stationery_system';
    protected $table = 'order_status';
    protected $primaryKey = 'id_order_status';

    public function order() {
        return $this->belongsTo('Supala\ETransport\Models\Stationery\Order','id_order','id_order');
    }

    public function user() {
        return $this->belongsTo('App\User','id_user','id');
    }
}
