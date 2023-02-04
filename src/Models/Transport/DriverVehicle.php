<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class DriverVehicle extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'm_driver_vehicle';
}
