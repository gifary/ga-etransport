<?php

namespace Supala\ETransport\Models;


class PersonnelSubArea extends BaseModelETransport
{

    protected $table = 'public.m_personnel_sub_area';
    protected $fillable = ['id', 'personnel_area', 'personnel_sub_area', 'description'];

    public function scopeFilterAuth($filter, User $user) {
        return $filter
            // KANTOR PUSAT
            ->when($user->ad_personnel_area == '1000', function ($query) use ($user) {
            })
            // UNIT INDUK (LEVEL 1)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area == '0001'), function($query) use ($user) {
                $query->where('personnel_area', $user->ad_personnel_area);
            })
            // UNIT PELAKSANA (LEVEL 2)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area != '0001') && (substr($user->ad_personnel_sub_area,2,4) == '00'), function($query) use ($user) {
                $query->where('personnel_area', $user->ad_personnel_area);
                $query->where('personnel_sub_area','ILIKE',substr($user->ad_personnel_sub_area,0,2).'%');
            })
            // UNIT LAYANAN (LEVEL 3)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area != '0001') && (substr($user->ad_personnel_sub_area,2,4) != '00'), function($query) use ($user) {
                $query->where('personnel_area', $user->ad_personnel_area);
                $query->where('personnel_sub_area', $user->ad_personnel_sub_area);
            });
    }

    public function personnelArea()
    {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }
}
