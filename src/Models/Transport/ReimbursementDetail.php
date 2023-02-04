<?php

namespace Supala\ETransport\Models\Transport;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReimbursementDetail extends Model
{
    use SoftDeletes;

    protected $connection = 'transport_system';
    protected $table = 'transport_system.reimbursement_details';
    protected $primaryKey = 'id';

    protected $guarded = [ '_token'];
    protected $fillable = ['reimbursement_id','title','total_submission','total_approved','file','created_at','updated_at','deleted_at'];

}
