<?php

namespace Supala\ETransport\Models\Stationery;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'stationery_system';
    protected $table = 'm_product';
    protected $primaryKey = 'id_product';

    // CATEGORY
    const ATK = '01';
    const KOMPUTER = '02';

    public function getImageThumbnailAttribute() {
        if($this->image) {
            return 'data:image/jpeg;base64,'.$this->image;
        }
        return asset('img/portal/stationery.png');
    }

    public function category() {
        return $this->belongsTo('Supala\ETransport\Models\Stationery\ProductCategory','id_product_category','id_product_category');
    }
}
