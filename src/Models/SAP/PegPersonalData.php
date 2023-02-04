<?php

namespace  Supala\ETransport\Models\SAP;

use Illuminate\Database\Eloquent\Model;

class PegPersonalData extends Model
{
    protected $connection = 'portal_hc';
    protected $table = 'peg_personal_data';
    protected $visible = ['fullname', 'begin_date', 'end_date',
                        'gender', 'birthday', 'place_of_birth', 'religion',
                        'marital_status', 'marital_date', 'nationality','reference_code'];

}
