<?php

/**
 * VaccineLots
 */
class VaccineLots extends Eloquent
{
    protected $table = 'vaccine_lots';

    public static $roles = [
        'vaccine_id' => 'required|integer',
        'lot' => 'required'
    ];

    public function scopeIsDuplicate($query, $vaccine_id, $lot)
    {
        return $query->where('vaccine_id', '=', $vaccine_id)
            ->where('lot', '=', $lot);
    }

}
