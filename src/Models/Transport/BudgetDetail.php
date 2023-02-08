<?php

namespace Supala\ETransport\Models\Transport;

use Supala\ETransport\Models\BaseModelETransport;

class BudgetDetail extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'm_budget_details';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
