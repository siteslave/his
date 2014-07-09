<?php

/**
 * AppointType
 */
class AppointType extends Eloquent
{
    protected $table = 'appoint_type';

    public function scopeGetActive($query)
    {
        return $query->where('is_active', 'Y');
    }
}
