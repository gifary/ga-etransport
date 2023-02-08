<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class SurveyUserQuestion extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'transport_system.survey_user_questions';
    protected $primaryKey = 'id';

    public function survey() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Survey','survey_id','id');
    }

    public function survey_user() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\SurveyUser','survey_user_id','id');
    }

    public function survey_question() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\SurveyQuestion','survey_question_id','id');
    }
}
