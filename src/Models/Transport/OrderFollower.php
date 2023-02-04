<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class OrderFollower extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'order_follower';
}
