<?php

namespace Supala\ETransport\Models\Transport;


use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    protected $connection = 'transport_system';
    protected $table = 'transport_system.m_survey_questions';
    protected $primaryKey = 'id';

    public function survey() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Survey','survey_id','id');
    }

}
