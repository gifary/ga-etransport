<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class BillVoucher extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'bill_voucher';
    protected $primaryKey = 'id_bill_voucher';
    protected $appends = ['formated_date_trip','formated_nominal'];
    protected $dates = ['date_trip'];

    public function delegate() {
        return $this->hasOne('Supala\ETransport\Models\Transport\Delegate','voucher_number','voucher_number');
    }

    public function getFormatedNominalAttribute() {
        return 'Rp '.number_format($this->nominal,0,',','.');
    }

    public function getFormatedDateTripAttribute() {
        return $this->date_trip ? $this->date_trip->formatLocalized('%A, %d %B %Y') : null;
    }
}
