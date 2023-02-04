<?php

namespace Supala\ETransport\Models\Transport;

use Illuminate\Database\Eloquent\Model;

class BudgetDetail extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'm_budget_details';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
