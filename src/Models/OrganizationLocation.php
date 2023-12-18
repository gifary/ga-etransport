<?php

namespace Supala\ETransport\Models;

use Cache;

class OrganizationLocation extends BaseModelETransport
{

    protected $table = 'public.m_organization_location';
    protected $fillable = 
        [
            'id',
            'sap_organization_id',
            'latitude',
            'longitude',
            'timezone',
            'created_by',
            'updated_by',
            'created_at',
            'updated_at',
            'deleted_at',
            'personel_area',
            'personel_sub_area',
            'parent',
            'name',
            'personel_area_name',
            'personel_sub_area_name',
            'divisi_id',
            'range_allowed'
        ];

}
