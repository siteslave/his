<?php
/**
 * Class ServiceIncome
 *
 */

class ServiceIncome extends Eloquent
{
    protected $table = 'service_incomes';

    public static $roles = [
        'service_id' => 'required',
        'income_id'  => 'required',
        'price'      => 'required',
        'qty'        => 'required'
    ];

    public function scopeIsDuplicate($query, $service_id, $income_id)
    {
        return $query->where('service_id', (int) $service_id)
            ->where('income_id', (int) $income_id);
    }

    public function scopeGetList($query, $service_id)
    {
        return $query->select('service_incomes.*', 'i.name as income_name', 'u.name as unit_name')
            ->leftJoin('incomes as i', 'i.id', '=', 'service_incomes.income_id')
            ->leftJoin('income_units as u', 'u.id', '=', 'i.unit_id')
            ->where('service_incomes.service_id', (int) $service_id);
    }
}
