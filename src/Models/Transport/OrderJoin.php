<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class OrderJoin extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'order_join';
    protected $primaryKey = 'id_order_join';

    public function order() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Order','id_order','id_order');
    }

    public function user() {
        return $this->belongsTo(User::class,'id_user','id');
    }
}
