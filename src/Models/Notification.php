<?php

namespace Supala\ETransport\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification as BaseDatabaseNotification;

class Notification extends BaseDatabaseNotification
{
    protected $connection = 'transport_system';
    protected $table = 'public.cms_notifications';
}
