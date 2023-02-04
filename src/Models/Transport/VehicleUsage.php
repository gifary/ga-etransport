<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class VehicleUsage extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'vehicle_usage';
    protected $primaryKey = 'id_vehicle_usage';
    protected $appends = ['formated_date_submission','formated_odometer_usage'];
    protected $dates = ['date_submission'];

    public function driver() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Driver','id_driver','id_driver');
    }

    public function vehicle() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Vehicle','id_vehicle','id_vehicle');
    }

    public function getFormatedOdometerUsageAttribute() {
        return $this->odometer_usage.' Km';
    }

    public function getFormatedDateSubmissionAttribute() {
        return $this->date_submission->formatLocalized('%B %Y');
    }
}
