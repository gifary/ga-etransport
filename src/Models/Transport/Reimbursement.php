<?php

namespace Supala\ETransport\Models\Transport;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reimbursement extends Model
{
    use SoftDeletes;

    protected $connection = 'transport_system';
    protected $table = 'transport_system.reimbursements';
    protected $primaryKey = 'id';

    protected $guarded = [ '_token'];
    protected $fillable = ['user_id','personnel_area','personnel_sub_area','travel_date','total_submission','total_approved','status','created_at','updated_at','deleted_at', 'driver_id'];

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
                    ->where('personnel_area',$this->personnel_area);
    }

    public function scopeFilterPersonnelArea($filter, User $user) {
        return $filter
            ->where('personnel_area',$user->ad_personnel_area)
            ->where('personnel_sub_area',$user->ad_personnel_sub_area);
    }

    public function user() {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function driver() {
        return $this->belongsTo(Driver::class,'driver_id','id_driver');
    }

    public function reimbursementDetail() {
        return $this->hasMany('Supala\ETransport\Models\Transport\ReimbursementDetail','reimbursement_id','id');
    }
}
