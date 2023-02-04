<?php

namespace Supala\ETransport\Models\SAP;

use Illuminate\Database\Eloquent\Model;

class SAPHrp1513 extends Model
{
    protected $connection = 'portal_hc';
    protected $table = 'sap_hrp_1513';
    protected $visible = ['objid','mgrp','sgrp','begda','endda'];
}
