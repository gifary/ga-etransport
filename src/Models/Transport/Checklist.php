<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'm_checklist';
    protected $primaryKey = 'id';

}
