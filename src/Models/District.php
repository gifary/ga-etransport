<?php

namespace Supala\ETransport\Models;


class District extends BaseModelETransport
{
    protected $table = 'public.m_district';
    protected $fillable = ['id', 'name'];

    public function regency()
    {
        return $this->belongsTo('Supala\ETransport\Models\Regency','id_regency','id');
    }
}
