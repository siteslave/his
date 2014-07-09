<?php

/**
 * Vaccine
 */
class Vaccine extends Eloquent
{
    protected $table = 'vaccines';

    public function scopeGetAnc($query)
    {
        return $query->where('is_anc', '=', 'Y');
    }

    public function scopeGetWbc($query)
    {
        return $query->where('is_wbc', '=', 'Y');
    }

    public function scopeGetStudent($query)
    {
        return $query->where('is_student', '=', 'Y');
    }

        public function scopeGetOther($query)
    {
        return $query->where('is_wbc', '=', 'N')
            ->where('is_student', '=', 'N')
            ->where('is_anc', '=', 'N');
    }


}
