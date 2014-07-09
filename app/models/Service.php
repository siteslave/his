<?php
/**
* Class Visit
*
*/

class Service extends Eloquent
{
    protected $table = 'services';

    protected $fillable = ['service_status_id'];
    public static $roles = array(
        'pid'                => 'required',
        'service_cc'         => 'required',
        'service_clinic'     => 'required',
        'service_date'       => 'required',
        'service_ins'        => 'required',
        'service_time'       => 'required',
        //'service_doctor_room'=> 'required'
    );

    public function serviceInsurance()
    {
        return $this->hasOne('ServiceInsurance');
    }

    public function screening()
    {
        return $this->hasOne('Screening');
    }

    public function provider()
    {
        return $this->belongsTo('Provider');
    }


}
