<?php

namespace Supala\ETransport\Models\Transport;


use Supala\ETransport\Models\BaseModelETransport;

class SurveyUser extends BaseModelETransport
{
    protected $connection = 'transport_system';
    protected $table = 'transport_system.survey_users';
    protected $primaryKey = 'id';

    public function survey() {
        return $this->belongsTo('Supala\ETransport\Models\Transport\Survey','id','survey_id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id','id');
    }

}
