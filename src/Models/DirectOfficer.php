<?php

namespace Supala\ETransport\Models;

use Illuminate\Database\Eloquent\Model;

class DirectOfficer extends Model
{
    protected $table = 'cms_direct_officer';

    public function user() {
        return $this->hasOne('App\User','id','user_id');
    }

    public function officer() {
        return $this->hasOne('App\User','ad_employee_number','officer_employee_number');
    }
}
