<?php

namespace Supala\ETransport\Models\Stationery;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $connection = 'stationery_system';
    protected $table = 'order_item';
    protected $primaryKey = 'id_order_item';

    public function order() {
        return $this->belongsTo('Supala\ETransport\Models\Stationery\Order','id_order','id_order');
    }

    public function product() {
        return $this->belongsTo('Supala\ETransport\Models\Stationery\Product','id_product','id_product');
    }
}
