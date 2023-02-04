<?php

namespace Supala\ETransport\Models\Stationery;

use Illuminate\Database\Eloquent\Model;

class OrgUnitBudget extends Model
{
    protected $connection = 'stationery_system';
    protected $table = 'm_org_unit_budget';
    protected $primaryKey = 'id_org_unit_budget';

    public function unit() {
        return $this->belongsTo('Supala\ETransport\Models\OrgUnit','org_unit','org_code');
    }
}
