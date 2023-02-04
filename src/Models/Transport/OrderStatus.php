<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'order_status';
    protected $primaryKey = 'id_order_status';

    public function order() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Order','id_order','id_order');
    }

    public function user() {
        return $this->belongsTo('App\User','id_user','id');
    }

    public function scopeFilterStatus($query, $id_order, $status) {
        return $query->where('id_order',$id_order)
                    ->where('status',$status);
    }
}
