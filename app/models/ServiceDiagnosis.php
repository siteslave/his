<?php
/**
 * Class ServiceDiagnosis
 *
 * OPD diagnosis
 */

class ServiceDiagnosis extends Eloquent
{
    protected $table = 'service_diagnosis';

    public static $roles = array(
        'diagnosis_code'      => 'required',
        'diagnosis_type_code' => 'required',
        'service_id'          => 'required|integer'
    );

    public function scopeHasPrincipleDiagnosis($query, $service_id)
    {
        return $query->where('service_id', (int) $service_id)->where('diagnosis_type_code', '1');
    }

    public function scopeDuplicateDiagnosis($query, $service_id, $diagnosis_code)
    {
        return $query->where('service_id', (int) $service_id)->where('diagnosis_code', $diagnosis_code);
    }

    public function scopeGetList($query, $service_id)
    {
        return $query->select(
            'service_diagnosis.diagnosis_code', 'service_diagnosis.diagnosis_type_code', 'dt.name as diagnosis_type_name',
            'service_diagnosis.id', 'icd.desc_r as diagnosis_name'
        )
            ->leftJoin('diagnosis_type as dt', 'dt.code', '=', 'service_diagnosis.diagnosis_type_code')
            ->leftJoin('diagnosis as icd', 'icd.code', '=', 'service_diagnosis.diagnosis_code')
            ->where('service_diagnosis.service_id', (int) $service_id)
            ->orderBy('service_diagnosis.diagnosis_type_code', 'asc');
    }
}
