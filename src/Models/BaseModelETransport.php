<?php

namespace Supala\ETransport\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModelETransport extends Model
{
    protected $connection = 'transport_system';
}
