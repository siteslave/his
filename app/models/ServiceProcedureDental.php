<?php
/**
 * Class ServiceProcedureDental
 *
 */

class ServiceProcedureDental extends Eloquent
{
    protected $table = 'service_procedure_dentals';

    public static $roles = [
        'service_id'   => 'required|integer',
        'procedure_id' => 'required|integer',
        'provider_id'  => 'required|integer',
        'tcode'        => 'required',
        'price'        => 'required|numeric'
    ];

    public function scopeIsDuplicate($query, $service_id, $procedure_id)
    {
        return $query->where('service_id', (int) $service_id)
            ->where('procedure_id', (int) $procedure_id);
    }

    public function scopeGetList($query, $service_id)
    {
        return $query->select('service_procedure_dentals.*', 'p.name as procedure_name', 'pd.fname', 'pd.lname')
            ->leftJoin('procedures as p', 'p.id', '=', 'service_procedure_dentals.procedure_id')
            ->leftJoin('providers as pd', 'pd.id', '=', 'service_procedure_dentals.provider_id')
            ->where('service_procedure_dentals.service_id', (int) $service_id);
    }
}
