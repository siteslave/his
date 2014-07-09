<?php
/**
 * Class Home
 *
 */

class Person extends Eloquent
{
    protected $table = 'person';

    public function service()
    {
        return $this->hasMany('Service');
    }
}
