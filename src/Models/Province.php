<?php

namespace Supala\ETransport\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'm_province';
    protected $fillable = ['id', 'name'];

    public function regencys()
    {
        return $this->hasMany('Supala\ETransport\Models\Regency','id_province','id');
    }
}
