<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class OrderFollower extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'order_follower';
}
