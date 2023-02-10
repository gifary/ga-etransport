<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;
use Supala\ETransport\Models\User;

class Order extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $dates = ['date_departure','date_arrival', 'start_date', 'end_date'];

    protected $with = ['user'];

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
            ->where('personnel_area',$this->personnel_area);
    }

    public function followers() {
        return $this->belongsToMany('App\User','transport_system.order_follower','id_order','id_user');
    }

    public function listFollower() {
        return $this->hasMany('Supala\ETransport\Models\Transport\OrderFollower','id_order','id_order');
    }

    public function delegate() {
        return $this->hasOne(Delegate::class,'id_order','id_order');
    }

    public function user() {
        if (class_exists("App\Models\UserETransport")) {
            return $this->belongsTo("App\Models\UserETransport",'id_user','id');
        }else{
            return $this->belongsTo(User::class,'id_user','id');
        }
    }

    public function statusOrders() {
        return $this->hasMany('Supala\ETransport\Models\Transport\OrderStatus','id_order','id_order')
                    ->orderBy('status');
    }

    public function scopeFilterDelegateDriver() {
        return $this->join('delegate','order.id_order','=','delegate.id_order')
                    ->where('delegate.type_delegate','01');
    }

    public function scopeFilterDelegateVoucher() {
        return $this->join('delegate','order.id_order','=','delegate.id_order')
                    ->where('delegate.type_delegate','02');
    }
    public function scopeFilterDelegateGrab() {
        return $this->join('delegate','order.id_order','=','delegate.id_order')
                    ->where('delegate.type_delegate','04');
    }

    public function setGenerateCodeAttribute($count) {
        $this->attributes['order_code'] = date('Ym').'/TRS/'.sprintf('%06d', $count);
    }

    public function getFormatedDateDepartureAttribute() {
        return $this->date_departure->formatLocalized('%A, %d %B %Y');
    }

    public function scopeFilterPersonnelArea($filter, User $user) {
        if($user->hasRole('Admin GA')) {
            return $filter;
        } else if($user->hasRole('Admin Pool Pusat')) {
            return $filter
                ->where('personnel_area',$user->ad_personnel_area);
            } else if($user->hasRole('Admin Pool')) {
                return $filter
                    ->where('personnel_area',$user->ad_personnel_area)
                    ->where('personnel_sub_area',$user->ad_personnel_sub_area);
                } else {
                    return $filter
                        ->where('id_user', $user->id_user);
                }
    }

    public function evidences()
    {
        return $this->hasMany(OrderEvidence::class,'id_order','id_order');
    }
}
