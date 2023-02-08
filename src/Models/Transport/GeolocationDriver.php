<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class GeolocationDriver extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'm_geolocation_driver';
    protected $primaryKey = 'id';


    public function driver() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Driver','id_driver','id_driver');
    }
}
