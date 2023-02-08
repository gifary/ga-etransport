<?php

namespace Supala\ETransport\Models;

class DirectOfficer extends BaseModelETransport
{
    protected $table = 'public.cms_direct_officer';

    public function user() {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function officer() {
        return $this->hasOne(User::class,'ad_employee_number','officer_employee_number');
    }
}
