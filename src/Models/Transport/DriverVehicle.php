<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class DriverVehicle extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'm_driver_vehicle';
}
