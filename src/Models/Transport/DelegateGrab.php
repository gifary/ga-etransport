<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class DelegateGrab extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'delegate_grab';
    protected $primaryKey = 'id_delegate_grab';
    protected $fillable = ['grab_code','status','period','personnel_area','personnel_sub_area', 'total'];

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
            ->where('personnel_area',$this->personnel_area);
    }

    public function delegate() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Delegate','id_delegate','id_delegate');
    }

    public function scopeFilterDelegate() {
        return $this->leftJoin('delegate','delegate_grab.id_delegate','=','delegate.id_delegate');
    }
    public function getFormatedUsedDateAttribute() {
        return $this->used_date->formatLocalized('%A, %d %B %Y');
    }

    public function scopeFilterPersonnelArea($filter, User $user) {
        return $filter
            ->where('personnel_area',$user->ad_personnel_area)
            ->where('personnel_sub_area',$user->ad_personnel_sub_area);
    }

}
