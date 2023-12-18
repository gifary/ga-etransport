<?php

namespace Supala\ETransport\Models;

use Cache;

class OrganizationLocation extends BaseModelETransport
{

    protected $table = 'public.m_organization_location';
    protected $guard = ['id'];

}
