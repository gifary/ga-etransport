<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class Vehicle extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'm_vehicle';
    protected $primaryKey = 'id_vehicle';

    protected $guarded = ['id', '_token'];

    protected $casts = [
        'km_vehicle',
        'end_km_vehicle'
    ];

    public function drivers() {
        return $this->belongsToMany('Supala\ETransport\Models\Transport\Driver','Supala\ETransport\Models\Transport\DriverVehicle','id_vehicle','id_driver');
    }

    public function services() {
        return $this->hasMany(VehicleService::class,'id_vehicle','id_vehicle');
    }

    public function lastOdometer() {
        return $this->hasOne('Supala\ETransport\Models\Transport\VehicleUsage','id_vehicle','id_vehicle')
                    ->orderBy('date_submission','DESC');
    }

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->hasOne('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
                    ->where('personnel_area',$this->personnel_area);
    }

    public function scopeFilterPersonnelArea($filter, User $user) {
        return $filter
            ->where('personnel_area',$user->ad_personnel_area)
            ->where('personnel_sub_area',$user->ad_personnel_sub_area);
    }

    public function scopeFilterPersonnelAreaLevel($filter, User $user) {
        return $filter
            // KANTOR PUSAT
            ->when($user->ad_personnel_area == '1000', function($query) use ($user) {
            })
            // UNIT INDUK (LEVEL 1)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area == '0001'), function($query) use ($user) {
                $query->where('personnel_area', $user->ad_personnel_area);
            })
            // UNIT PELAKSANA (LEVEL 2)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area != '0001') && (substr($user->ad_personnel_sub_area,2,4) == '00'), function($query) use ($user) {
                $query->where('personnel_area', $user->ad_personnel_area);
                $query->where('personnel_sub_area','ILIKES',substr($user->ad_personnel_sub_area,0,2).'%');
            })
            // UNIT LAYANAN (LEVEL 3)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area != '0001') && (substr($user->ad_personnel_sub_area,2,4) != '00'), function($query) use ($user) {
                $query->where('personnel_area', $user->ad_personnel_area);
                $query->where('personnel_sub_area', $user->ad_personnel_sub_area);
            });
    }
}
