<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;
use \Illuminate\Support\Facades\Storage;

class OrderEvidence extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'order_evidences';
    protected $primaryKey = 'id';
    protected $fillable = ['id_order','image'];

    public function getImageAttribute()
    {
        if(empty($this->attributes['image'])) {
            return '-';
        }
        return Storage::disk('minio')->temporaryUrl($this->attributes['image'],now()->addMinutes(15));
    }

}
