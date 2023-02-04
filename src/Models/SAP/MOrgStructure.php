<?php

namespace Supala\ETransport\Models\SAP;

use Illuminate\Database\Eloquent\Model;

class MOrgStructure extends Model
{
    protected $connection = 'portal_hc';
    protected $table = 'm_org_structure';
    protected $visible = ['org_unit','start_date','end_date',
                        'org1_code','org1_sname','org2_code','org2_sname','org3_code','org3_sname',
                        'org4_code','org4_sname','org5_code','org5_sname','org6_code','org6_sname'];
}
