<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class DelegateMerge extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'delegate_merge';
    protected $primaryKey = 'id_delegate_merge';

    public function delegate() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Delegate','id_delegate','id_delegate');
    }

    public function masterOrder() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Order','id_master_order','id_order');
    }
}
