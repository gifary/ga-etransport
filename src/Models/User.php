<?php

namespace Supala\ETransport\Models;


use Illuminate\Database\Eloquent\SoftDeletes;


class User extends BaseModelETransport
{
    use SoftDeletes;

    protected $table = 'public.cms_users';
    protected $fillable = ['username', 'email', 'password','last_login_at','status','device_token'];
    protected $hidden = ['password', 'remember_token','ad_objectguid','ad_thumbnail_photo'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['username','email','ad_display_name','ad_phonenumber', 'ad_company', 'ad_department', 'ad_title', 'ad_employee_number','status'];

    public function notifications() {
        return $this->morphMany(Notification::class, 'notifiable')
                ->orderBy('created_at', 'desc');
    }

    public function companyCode() {
        return $this->hasOne(CompanyCode::class,'company_code','ad_company_code');
    }

    public function businessArea() {
        return $this->hasOne(BusinessArea::class,'business_area','ad_business_area');
    }

    public function personnelArea() {
        return $this->hasOne(PersonnelArea::class,'personnel_area','ad_personnel_area');
    }

    public function personnelSubArea() {
        return $this->hasOne(PersonnelSubArea::class,'personnel_sub_area','ad_personnel_sub_area')
                    ->where('personnel_area',$this->ad_personnel_area);
    }

    public function officer() {
        return $this->hasOne(User::class,'ad_employee_number','hr_officer_employee_number');
    }

    public function altOfficer() {
        return $this->hasMany(DirectOfficer::class,'user_id','id');
    }

    public function routeNotificationForFcm()
    {
        return $this->device_token;
    }

    public function customRoles()
    {
        return $this->belongsToMany(Role::class, 'public.cms_model_has_roles', 'model_id', 'role_id')
            ->withPivot(['model_type']);
    }
}
