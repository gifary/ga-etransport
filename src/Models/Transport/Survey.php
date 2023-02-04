<?php

namespace Supala\ETransport\Models\Transport;


use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'transport_system.m_surveys';
    protected $primaryKey = 'id';

    public function surveyQuestion() {
        return $this->hasMany('Supala\ETransport\Models\Transport\SurveyQuestion','survey_id','id');
    }
}
