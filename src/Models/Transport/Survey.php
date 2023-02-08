<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class Survey extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'transport_system.m_surveys';
    protected $primaryKey = 'id';

    public function surveyQuestion() {
        return $this->hasMany('Supala\ETransport\Models\Transport\SurveyQuestion','survey_id','id');
    }
}
