<?php
/**
 * Class ServiceReferOut
 *
 */

class ServiceReferOut extends Eloquent
{
    protected $table = 'service_refer_out';

    public static $roles = [
        'refer_date'     => 'required',
        'provider_id'    => 'required',
        'diag_code' => 'required',
        'to_hospital'    => 'required',
        'cause_id'       => 'required',
        'service_id'     => 'required'
    ];

    public function scopeGetDetail($query, $service_id)
    {
        return $query->select(
            'service_refer_out.*', 'h.hname as hospital_name', 'i.desc_r as diag_name'
        )
            ->leftJoin('hospitals as h', 'h.hmain', '=', 'service_refer_out.to_hospital')
            ->leftJoin('diagnosis as i', 'i.code', '=', 'service_refer_out.diagnosis_code')
            ->where('service_refer_out.service_id', $service_id);
    }
}
