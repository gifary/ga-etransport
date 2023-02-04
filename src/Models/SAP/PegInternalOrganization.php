<?php

namespace  Supala\ETransport\Models\SAP;

use Illuminate\Database\Eloquent\Model;

class PegInternalOrganization extends Model
{
    protected $connection = 'portal_hc';
    protected $table = 'peg_internal_organization';
    protected $visible = ['company_code','business_area','personel_area','sub_area','position','reference_code',
                        'org1_code','org1_sname','org2_code','org2_sname','org3_code','org3_sname',
                        'org4_code','org4_sname','org5_code','org5_sname','org6_code','org6_sname'];

    public function positions() {
        return $this->hasOne('Supala\ETransport\Models\SAP\MPosition','pos_code','position')
                    ->where('end_date','9999-12-31');
    }

    /**
     * Get EVP, SEP, GM
     */
    public function scopeSupervisor() {
        return $this->join('sap_hrp_1513','peg_internal_organization.position','=','sap_hrp_1513.objid')
                    ->where('sap_hrp_1513.mgrp','04')
                    ->where('sap_hrp_1513.sgrp','01')
                    ->where('sap_hrp_1513.endda','9999-12-31')
                    ->where('peg_internal_organization.org_unit','<>','00000000')
                    ->where('peg_internal_organization.end_date','9999-12-31');
    }

    public function getOrgCodeAttribute() {
        $pattern = '/^(DIV|SETPER|IPAD|IPOD|UID|UIK|UIW|UIP|UIT|PUS)/';
        // Check first org_sname
        $is_org6 = preg_match($pattern, $this->org6_sname);
        $is_org5 = preg_match($pattern, $this->org5_sname);
        $is_org4 = preg_match($pattern, $this->org4_sname);
        $is_org3 = preg_match($pattern, $this->org3_sname);
        $is_org2 = preg_match($pattern, $this->org2_sname);
        if($is_org6) {
            $org_code = $this->org6_code;
        } elseif ($is_org5) {
            $org_code = $this->org5_code;
        } elseif ($is_org4) {
            $org_code = $this->org4_code;
        } elseif ($is_org3) {
            $org_code = $this->org3_code;
        } elseif ($is_org2) {
            $org_code = $this->org2_code;
        } else {
            $org_code = null;
        }

        return $org_code;
    }

    public function getOrgNameAttribute() {
        $pattern = '/^(DIV|SETPER|IPAD|IPOD|UID|UIK|UIW|UIP|UIT|PUS)/';
        // Check first org_sname
        $is_org6 = preg_match($pattern, $this->org6_sname);
        $is_org5 = preg_match($pattern, $this->org5_sname);
        $is_org4 = preg_match($pattern, $this->org4_sname);
        $is_org3 = preg_match($pattern, $this->org3_sname);
        $is_org2 = preg_match($pattern, $this->org2_sname);
        if($is_org6) {
            $org_sname = $this->org6_sname;
        } elseif ($is_org5) {
            $org_sname = $this->org5_sname;
        } elseif ($is_org4) {
            $org_sname = $this->org4_sname;
        } elseif ($is_org3) {
            $org_sname = $this->org3_sname;
        } elseif ($is_org2) {
            $org_sname = $this->org2_sname;
        } else {
            $org_sname = null;
        }

        return $org_sname;
    }
}
