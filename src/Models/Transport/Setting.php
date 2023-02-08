<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class Setting extends BaseModelETransport
{
    protected $table ='settings';
    protected $connection = 'transport_system';

    protected $guarded = ['id'];

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
            ->where('personnel_area',$this->personnel_area);
    }

    public function scopeFilterPersonnelArea($filter, User $user) {
        return $filter
            ->where('personnel_area',$user->ad_personnel_area)
            ->where('personnel_sub_area',$user->ad_personnel_sub_area);
    }
}
