<?php

namespace Supala\ETransport\Models\SAP;

use Illuminate\Database\Eloquent\Model;

class MPosition extends Model
{
    protected $connection = 'portal_hc';
    protected $table = 'm_position';
    protected $visible = ['pos_code', 'pos_stext_name', 'pos_ltext_name',
                        'pos_org_unit', 'start_date', 'end_date'];
}
