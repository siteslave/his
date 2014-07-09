<?php
/**
 * Class VisitInsurance
 *
 */

class ServiceInsurance extends Eloquent
{
    protected $table = 'service_insurances';

    public function service($value='')
    {
        return $this->belongsTo('Service');
    }

    public function insurance()
    {
        return $this->belongTo('Insurance');
    }

}
