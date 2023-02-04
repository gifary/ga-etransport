<?php

namespace Supala\ETransport\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;


class User extends Model
{
    use Notifiable;
    use SoftDeletes;

    protected $connection = 'pgsql';
    protected $table = 'public.cms_users';
    protected $fillable = ['username', 'email', 'password','last_login_at','status','device_token'];
    protected $hidden = ['password', 'remember_token','ad_objectguid','ad_thumbnail_photo'];
    protected $appends = ['formated_created_at'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['username','email','ad_display_name','ad_phonenumber', 'ad_company', 'ad_department', 'ad_title', 'ad_employee_number','status'];

    public function getDescriptionForEvent(string $eventName): string
    {
        switch ($eventName) {
            case 'created':
                return 'Add new user <strong>:subject.username</strong>';
                break;
            case 'updated':
                return 'Edit user <strong>:subject.username</strong>';
                break;
            case 'deleted':
                return 'Delete user <strong>:subject.username</strong>';
                break;
            default:
                break;
        }
        return '';
    }

    public function notifications() {
        return $this->morphMany(Notification::class, 'notifiable')
                ->orderBy('created_at', 'desc');
    }


    public function getUserThumbnailAttribute() {
        if($this->ad_thumbnail_photo) {
            return 'data:image/jpeg;base64,'.$this->ad_thumbnail_photo;
        }
        return asset('img/default-user.png');
    }

    public function getFormatedCreatedAtAttribute() {
        return $this->created_at->formatLocalized('%A, %d %B %Y');
    }

    public function getIsPegawaiAttribute() {
        if(!empty($this->hr_pernr) && !empty($this->hr_org_unit) && !empty($this->ad_employee_number)) {
            return true;
        }
        return false;
    }

    public function getIsStructuralAttribute() {
        if($this->hr_job_level == '04') {
            return true;
        }
        return false;
    }

    public function getUnitIndukAttribute() {
        return OrgUnit::select('org_code','stext')->where('org_code',OrgUnit::getUnitInduk($this->hr_org_unit))->first();
    }

    public function scopeFilterCompanyCode($filter, User $user) {
        return $filter
            // KANTOR PUSAT
            ->when($user->ad_company_code == '1000', function ($query) use ($user) {
            })
            // UNIT INDUK
            ->when(($user->ad_company_code != '1000') && (substr($user->ad_business_area,2,4) != '01'), function ($query) use ($user) {
                $query->where('ad_company_code', $user->ad_company_code);
            })
            // UNIT PELAKSANA
            ->when(substr($user->ad_business_area,2,4) != '01', function ($query) use ($user) {
                $query->where('ad_business_area', $user->ad_business_area);
            });
    }

    public function scopeFilterPersonnelArea($filter, User $user) {
        return $filter
            ->where('ad_personnel_area',$user->ad_personnel_area)
            ->where('ad_personnel_sub_area',$user->ad_personnel_sub_area);
    }

    public function scopeFilterPersonnelAreaLevel($filter, User $user) {
        return $filter
            // KANTOR PUSAT
            ->when($user->ad_personnel_area == '1000', function ($query) use ($user) {
            })
            // UNIT INDUK (LEVEL 1)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area == '0001'), function($query) use ($user) {
                $query->where('ad_personnel_area', $user->ad_personnel_area);
            })
            // UNIT PELAKSANA (LEVEL 2)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area != '0001') && (substr($user->ad_personnel_sub_area,2,4) == '00'), function($query) use ($user) {
                $query->where('ad_personnel_area', $user->ad_personnel_area);
                $query->where('ad_personnel_sub_area','ILIKE',substr($user->ad_personnel_sub_area,0,2).'%');
            })
            // UNIT LAYANAN (LEVEL 3)
            ->when(($user->ad_personnel_area != '1000') && ($user->ad_personnel_sub_area != '0001') && (substr($user->ad_personnel_sub_area,2,4) != '00'), function($query) use ($user) {
                $query->where('ad_personnel_area', $user->ad_personnel_area);
                $query->where('ad_personnel_sub_area', $user->ad_personnel_sub_area);
            });
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
}
