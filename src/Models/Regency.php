<?php

namespace Supala\ETransport\Models;

class Regency extends BaseModelETransport
{
    protected $table = 'm_regency';
    protected $fillable = ['id', 'id_province', 'name'];

    public function province()
    {
        return $this->belongsTo('Supala\ETransport\Models\Province','id_province','id');
    }

    public function districts()
    {
        return $this->hasMany('Supala\ETransport\Models\District','id_regency','id');
    }
}
