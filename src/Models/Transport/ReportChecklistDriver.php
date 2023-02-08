<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class ReportChecklistDriver extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'report_checklist_driver';
    protected $primaryKey = 'id_report_checklist';

    public function driver() {
        return $this->belongsTo(Driver::class,'id_driver','id_driver');
    }
    public function vehicle() {
        return $this->belongsTo(Vehicle::class,'id_vehicle','id_vehicle');
    }
    public function checklistDriver() {
        return $this->hasMany(ChecklistDriver::class,'id_report_checklist','id_report_checklist');
    }

    public function scopeFilterPersonnelArea($filter, User $user)
    {
        if ($user->hasRole('Admin GA')) {
            return $filter;
        } else if ($user->hasRole('Admin Pool')) {
            return $filter
                ->whereHas('vehicle', function($query) use ($user) {
                    $query
                        ->where('personnel_area', $user->ad_personnel_area)
                        ->orWhere('personnel_sub_area', $user->ad_personnel_area);
                });
        } else {
            return null;
        }
    }

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personnel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personnel_sub_area','personnel_sub_area')
                    ->where('personnel_area',$this->personnel_area);
    }
}
