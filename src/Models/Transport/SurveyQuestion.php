<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class SurveyQuestion extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'transport_system.m_survey_questions';
    protected $primaryKey = 'id';

    public function survey() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Survey','survey_id','id');
    }

}
