<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\OrgUnit;
use Illuminate\Database\Eloquent\Model;

class GasOilPrice extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'm_gas_oil_prices';
    protected $primaryKey = 'id';

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
            ->where('personnel_area',$this->personnel_area);
    }
}
