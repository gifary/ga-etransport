<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class Delegate extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'delegate';
    protected $primaryKey = 'id_delegate';

    const DELEGATE_DRIVER = '01';
    const DELEGATE_VOUCHER = '02';
    const DELEGATE_MERGE = '03';
    const DELEGATE_GRAB = '04';

    public function delegateDriver() {
        return $this->hasOne(DelegateDriver::class,'id_delegate','id_delegate');
    }

    public function delegateVoucher() {
        return $this->hasMany('Supala\ETransport\Models\Transport\DelegateVoucher','id_delegate','id_delegate');
    }

    public function delegateGrab() {
        return $this->hasMany(DelegateGrab::class,'id_delegate','id_delegate');
    }

    public function order() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Order','id_order','id_order');
    }

    public function getTypeAttribute() {
        switch ($this->type_delegate) {
            case '01':
                return 'Mobil Dinas';
                break;
            case '02':
                return 'Voucher Taksi';
                break;
            case '03':
                return 'Merge';
                break;
            case '04':
                return 'Grab';
                break;
            default:
                return '';
                break;
        }
    }
}
