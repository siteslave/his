<?php

class PostnatalCoverage extends Eloquent {
    protected $table = 'postnatal_coverages';

    public static $roles = [
        'person_id' => 'required|integer',
        'service_place' => 'required',
        'service_date' => 'required',
        'gravida' => 'required',
        'result' => 'required'
    ];
} 