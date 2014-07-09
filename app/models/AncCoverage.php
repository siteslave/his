<?php

class AncCoverage extends Eloquent {

    /**
     * Table name
     */
    protected $table = 'anc_coverages';

    /**
     * Roles
     */
    public static $roles = [
        'gravida' => 'required',
        'ga' => 'required|numeric|between:1,60',
        'person_id' => 'required|integer',
        'service_date' => 'required',
        'service_place' => 'required|numeric',
        'anc_result' => 'required'
    ];
} 