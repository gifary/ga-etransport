<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class DelegateDriver extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'delegate_driver';
    protected $primaryKey = 'id_delegate_driver';

    public function delegate() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Delegate','id_delegate','id_delegate');
    }

    public function driver() {
        if (class_exists("App\ModelsDriverETransport")) {
            return $this->belongsTo("App\ModelsDriverETransport",'id_driver','id_driver');
        }else{
            return $this->belongsTo(Driver::class,'id_driver','id_driver');
        }

    }

    public function vehicle() {
        return $this->belongsTo(Vehicle::class,'id_vehicle','id_vehicle');
    }

    public function scopeFilterPersonnelArea($filter, User $user) {
        return $filter
            ->where('personnel_area',$user->ad_personnel_area)
            ->where('personnel_sub_area',$user->ad_personnel_sub_area);
    }
}
