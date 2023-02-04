<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class VehicleFuel extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'vehicle_fuel';
    protected $primaryKey = 'id_vehicle_fuel';
    protected $appends = ['formated_date_submission','formated_nominal'];
    protected $dates = ['date_submission'];

    public function driver() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Driver','id_driver','id_driver');
    }

    public function vehicle() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Vehicle','id_vehicle','id_vehicle');
    }

    public function getFormatedNominalAttribute() {
        return 'Rp '.number_format($this->nominal,0,',','.');
    }

    public function getFormatedDateSubmissionAttribute() {
        return $this->date_submission->formatLocalized('%A, %d %B %Y');
    }
}
