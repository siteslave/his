<?php

/**
 * Clinic
 */
class Clinic extends Eloquent
{
    protected $table = 'clinics';

    public function scopeGetActive($query)
    {
        return $query->where('is_active', 'Y');
    }
}
