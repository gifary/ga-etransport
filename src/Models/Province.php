<?php

namespace Supala\ETransport\Models;

class Province extends BaseModelETransport
{
    protected $table = 'public.m_province';
    protected $fillable = ['id', 'name'];

    public function regencys()
    {
        return $this->hasMany('Supala\ETransport\Models\Regency','id_province','id');
    }
}
