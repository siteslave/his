<?php

/**
 * Provider
 */
class Provider extends Eloquent
{
    protected $table = 'providers';

    public function scopeGetActive($query)
    {
        return $query->where('is_active', 'Y')
			->where('hospcode', '=', Auth::user()->hospcode);
    }
}
