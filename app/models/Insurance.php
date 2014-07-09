<?php
/**
 * Class Insurance
 *
 */

class Insurance extends Eloquent
{
    protected $table = 'insurances';

    public function scopeGetActive($query)
    {
        return $query->where('is_active', '=', 'Y');
    }

    public function insuranceLog()
    {
        return $this->hasOne('InsuranceLog');
    }

    public function serviceInsurance()
    {
        return $this->hasMany('ServiceInsurance');
    }
}
