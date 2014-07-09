<?php
/**
 * Class VisitProcedure
 *
 */

class ServiceProcedure extends Eloquent
{
    protected $table = 'service_procedures';

    public static $roles = [
        'service_id'    => 'required|integer',
        'procedure_id'  => 'required|integer',
        'provider_id'   => 'required|integer',
        'start_time'    => 'required',
        'finished_time' => 'required',
        'price'         => 'required|numeric'
    ];

    public function scopeHasOldData($query, $service_id, $procedure_id)
    {
        return $query->where('service_id', (int) $service_id)
            ->where('procedure_id', (int) $procedure_id);
    }

    /**
     * ->select('vp.*', 'p.name as procedure_name', 'pp.name as position_name', 'pd.fname', 'pd.lname')
    ->leftJoin('ref_procedure as p', 'vp.procedure_id', '=', 'p.id')
    ->leftJoin('ref_procedure_position as pp', 'pp.id', '=', 'vp.procedure_position_id')
    ->leftJoin('provider as pd', 'pd.id', '=', 'vp.provider_id')
    ->where('vp.visit_id', (int) $visit_id)
     */
    public function scopeGetList($query, $service_id)
    {
        return $query->select('service_procedures.*', 'p.name as procedure_name', 'pp.name as position_name', 'pd.fname', 'pd.lname')
            ->leftJoin('procedures as p', 'service_procedures.procedure_id', '=', 'p.id')
            ->leftJoin('procedure_positions as pp', 'pp.id', '=', 'service_procedures.procedure_position_id')
            ->leftJoin('providers as pd', 'pd.id', '=', 'service_procedures.provider_id')
            ->where('service_procedures.service_id', (int) $service_id);
    }
}
