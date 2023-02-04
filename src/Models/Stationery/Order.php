<?php

namespace Supala\ETransport\Models\Stationery;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'stationery_system';
    protected $table = 'order';
    protected $primaryKey = 'id_order';

    public function items() {
        return $this->hasMany('Supala\ETransport\Models\Stationery\OrderItem','id_order','id_order');
    }

    public function statusOrders() {
        return $this->hasMany('Supala\ETransport\Models\Stationery\OrderStatus','id_order','id_order')
                    ->orderBy('status');
    }
}
