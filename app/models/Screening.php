<?php
/**
 * Class Screen
 *
 */

class Screening extends Eloquent
{
    protected $table = 'service_screenings';

    public static $roles = array(
        'service_id'    => 'required|numeric',
        'screen_id'     => 'required|numeric',
        'height'        => 'required|numeric',
        'weight'        => 'required|numeric',
        'body_temp'     => 'required|numeric',
        'sbp'           => 'required|numeric',
        'dbp'           => 'required|numeric'
    );
}
