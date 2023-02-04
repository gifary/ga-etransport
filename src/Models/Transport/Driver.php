<?php

namespace Supala\ETransport\Models\Transport;


use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'transport_system.m_driver';
    protected $primaryKey = 'id_driver';

    protected $guarded = ['id_driver', '_token'];
    protected $fillable = ['phonenumber','name','personnel_area','personnel_sub_area','email','no_contract','password','status','expired_contract'];

    CONST NON_ACTV = 'NON-ACTV';
    const ACTV = 'ACTV';

    public function vehicles() {
        return $this->belongsToMany('Supala\ETransport\Models\Transport\Vehicle','Supala\ETransport\Models\Transport\DriverVehicle','id_driver','id_vehicle');
    }

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

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtoupper($value);
    }

    public function getStatusAttribute()
    {
        return strtoupper($this->attributes['status']);
    }
}
