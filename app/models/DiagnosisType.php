<?php

/**
 * Provider
 */
class DiagnosisType extends Eloquent
{
    protected $table = 'diagnosis_type';

    public function scopeGetActive($query)
    {
        return $query->where('is_active', 'Y');
    }
}
