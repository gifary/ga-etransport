<?php

namespace Supala\ETransport\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'm_district';
    protected $fillable = ['id', 'name'];

    public function regency()
    {
        return $this->belongsTo('Supala\ETransport\Models\Regency','id_regency','id');
    }
}
