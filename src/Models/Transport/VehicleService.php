<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class VehicleService extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'vehicle_service';
    protected $primaryKey = 'id';
}
