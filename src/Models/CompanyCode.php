<?php

namespace Supala\ETransport\Models;

class CompanyCode extends BaseModelETransport
{
    protected $table = 'public.m_company_code';
    protected $fillable = ['id', 'company_code', 'description'];
    protected $visible = ['company_code', 'description'];

    public function scopeFilterAuth($filter, User $user) {
        return $filter
            ->when($user->ad_company_code != '1000', function ($query) use ($user) {
                $query->where('company_code', $user->ad_company_code);
            });
    }

    public function businessAreas()
    {
        return $this->hasMany('Supala\ETransport\Models\BusinessArea','company_code','company_code')
                    ->orderBy('business_area');
    }
}
