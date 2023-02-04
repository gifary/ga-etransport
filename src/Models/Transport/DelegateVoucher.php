<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class DelegateVoucher extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'delegate_voucher';
    protected $primaryKey = 'id_delegate_voucher';

    public function delegate() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Delegate','id_delegate','id_delegate');
    }
}
