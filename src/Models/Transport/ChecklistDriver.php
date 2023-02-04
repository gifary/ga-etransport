<?php

namespace Supala\ETransport\Models\Transport;


use Illuminate\Database\Eloquent\Model;

class ChecklistDriver extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'checklist_driver';
    protected $primaryKey = 'id';


    public function driver() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Driver','id_driver','id_driver');
    }
    public function vehicle() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Vehicle','id_vehicle','id_vehicle');
    }
    public function checklist() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Checklist','id_checklist','id');
    }
    public function order() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Order','id_order','id_order');
    }
    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
