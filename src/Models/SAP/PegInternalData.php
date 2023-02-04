<?php

namespace  Supala\ETransport\Models\SAP;

use Illuminate\Database\Eloquent\Model;

class PegInternalData extends Model
{
    protected $connection = 'portal_hc';
    protected $table = 'peg_internal_data';
    protected $visible = ['nipeg','effective_date','end_date','reference_code'];
}
