<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class Checklist extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'm_checklist';
    protected $primaryKey = 'id';

}
