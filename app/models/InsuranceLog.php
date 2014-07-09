<?php
/**
 * Class InsuranceLog
 *
 */

class InsuranceLog extends Eloquent
{
    protected $table = 'insurance_log';

    public function insurance()
    {
        return $this->belongsTo('Insurance');
    }
}
