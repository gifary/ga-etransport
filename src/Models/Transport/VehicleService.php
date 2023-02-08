<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class VehicleService extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'vehicle_service';
    protected $primaryKey = 'id';
}
