<?php

namespace Supala\ETransport\Models;

class BusinessArea extends BaseModelETransport
{
    protected $table = 'm_business_area';
    protected $fillable = ['id', 'business_area', 'description'];
    protected $visible = ['company_code','business_area', 'description'];

    public function scopeFilterAuth($filter, User $user) {
        return $filter
            ->when($user->ad_company_code != '1000' && substr($user->ad_business_area,2,2) == '01', function ($query) use ($user) {
                $query->where('company_code', $user->ad_company_code);
            });
    }

    public function companyCode()
    {
        return $this->belongsTo('Supala\ETransport\Models\CompanyCode','company_code','company_code');
    }
}
