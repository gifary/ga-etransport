<?php

namespace Supala\ETransport\Models;

use Cache;

class OrgUnit extends BaseModelETransport
{

    protected $table = 'm_org_unit';
    protected $fillable = ['org_code','stext','ltext','parent_org_code','show_in_dropdown', 'personel_area', 'personel_sub_area'];

    protected $casts = [
        'show_in_dropdown' => 'bool'
    ];

    public function child()
    {
        return $this->hasMany('Supala\ETransport\Models\OrgUnit','parent_org_code','org_code')
                    ->orderBy('stext');
    }

    public function childs()
    {
        return $this->child()->with('childs')
                    ->select(['org_code','stext','ltext','parent_org_code']);
    }

    public function parent()
    {
        return $this->hasOne('Supala\ETransport\Models\OrgUnit','org_code','parent_org_code');
    }

    public function parents()
    {
        return $this->parent()->with('parents')
                    ->select(['org_code','stext','ltext','parent_org_code']);
    }

    public static function getOrgCodesKantorPusat() {
        return self::getOrgCodesChild('15000001');
    }

    public static function getOrgCodesChild($parent) {
        return Cache::remember('org_codes:child:'.$parent, 3600, function() use ($parent) {
            $tree = Array();
            if(!empty($parent)) {
                $org = OrgUnit::select('org_code','stext')->where('parent_org_code',$parent)->get();
                foreach ($org as $data) {
                    if(preg_match('/^(DIV|SETPER|IPAD|IPOD|PUS|UIW|UID|UIK|UIT)/',$data->stext)) {
                        array_push($tree,$data->org_code);
                    } else {
                        $ids = self::getOrgCodesChild($data->org_code);
                        if(!empty($ids)){
                            if(count($ids)>0) $tree = array_merge($tree, $ids);
                        }
                    }
                }
            }
            return $tree;
        });
    }

    public static function getChildren($parent) {
        return Cache::remember('org:unit:child:'.$parent, 3600, function() use ($parent) {
            $tree = Array();
            if (!empty($parent)) {
                $tree = OrgUnit::select('org_code')->where('parent_org_code',$parent)->pluck('org_code')->toArray();
                foreach ($tree as $key => $val) {
                    $ids = self::getChildren($val);
                    if(!empty($ids)){
                        if(count($ids)>0) $tree = array_merge($tree, $ids);
                    }
                }
            }
            return $tree;
        });
    }

    public static function getUnitInduk($child) {
        return Cache::remember('org:unit:induk:'.$child, 3600, function() use ($child) {
            $parent = OrgUnit::select('org_code','stext')->where('org_code',$child)
                        ->where('stext','SIMILAR TO','(DIV|DEP|DIR|SETPER|IPAD|IPOD|UID|UIK|UIW|UIP|UIT|PUS|IAD|IDP)%')
                        ->pluck('org_code')
                        ->first();
            if(!empty($parent)) {
                return $parent;
            }
            $parent = OrgUnit::select('org_code','parent_org_code')->where('org_code',$child)
                        ->pluck('parent_org_code')
                        ->first();
            return $parent ? self::getUnitInduk($parent) : null;
        });
    }

    public function personnelArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelArea','personel_area','personnel_area');
    }

    public function personnelSubArea() {
        return $this->belongsTo('Supala\ETransport\Models\PersonnelSubArea','personel_sub_area','personnel_sub_area')
            ->where('personnel_area',$this->personel_area);
    }
}
