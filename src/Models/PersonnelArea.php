<?php

namespace Supala\ETransport\Models;

use Illuminate\Database\Eloquent\Model;

class PersonnelArea extends Model
{
    protected $connection = 'pgsql';
    protected $table = 'public.m_personnel_area';
    protected $fillable = ['id', 'personnel_area', 'description'];

    public function scopeFilterAuth($filter, User $user) {
        return $filter
            // KANTOR PUSAT
            ->when($user->ad_personnel_area == '1000', function ($query) use ($user) {
            })
            // UNIT
            ->when($user->ad_personnel_area != '1000', function ($query) use ($user) {
                $query->where('personnel_area', $user->ad_personnel_area);
            });
    }

    public function personnelSubAreas()
    {
        return $this->hasMany('Supala\ETransport\Models\PersonnelSubArea','personnel_area','personnel_area');
    }
}
