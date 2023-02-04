<?php

namespace Supala\ETransport\Models\Transport;

class Status
{
    // ORDER CODE
    const ORDER_CANCELED = 50;
    const ORDER_CREATED = 100;
    const REJECTED_BY_OFFICER = 150;
    const APPROVED_BY_OFFICER = 200;
    const COMPLETE_DELEGATE = 300;
    const JOB_RUNNING_BY_DRIVER = 400;
    const COMPLETE_ORDER = 500;
}
