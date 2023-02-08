<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\OrgUnit;
use Supala\ETransport\Models\BaseModelETransport;

class Budget extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'm_budgets';
    protected $primaryKey = 'id';

    public function details()
    {
        return $this->hasMany(BudgetDetail::class, 'budget_id');
    }

    public function division()
    {
        return $this->belongsTo(OrgUnit::class, 'division_code', 'org_code');
    }

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
            ->where('personnel_area',$this->personnel_area);
    }
}
