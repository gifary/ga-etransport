<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class UserCop extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'user_cop';

    protected $fillable = ['id_user','employee_number','status'];

    public function user() {
        return $this->belongsTo('App\User','id_user', 'id');
    }
}
