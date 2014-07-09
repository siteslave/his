<?php

/**
 * Class Pregnancy
 */
class Pregnancy extends Eloquent
{
    protected $table = 'pregnancies';

    public static $roles_first_visit = [
        'person_id' => 'required|numeric',
        'gravida' => 'required|numeric|between:0,10'
    ];

    /*
     * items.provider_id = $('#slPregnancyProviders').val();
        items.register_date = $('#txtPregnancyRegisterDate').val();
        items.lmp = $('#txtPregnancyLMP').val();
        items.edc = $('#txtPregnancyEDC').val();
        items.first_doctor_date = $('#txtPregnancyFirstDoctorDate').val();
        items.labor_status = $('#slPregnancyStatus').val();
        items.force_export = $('#chkPregnancyForceExport').prop('checked') ? 'Y' : 'N';
        items.force_export_date = $('#txtPregnancyForceExportDate').val();
        items.discharge_status = $('#chkPregnancyDischargeStatus').prop('checked') ? 'Y' : 'N';
     */
    public static $roles_export = [
        'id' => 'required|integer',
        'lmp' => 'required',
        'edc' => 'required',
        'first_doctor_date' => 'required',
        'labor_status' => 'required'
    ];

    public function scopeIsExist($query, $id, $hospcode)
    {
        return $query->where('id', (int) $id)
            ->where('hospcode', $hospcode);
    }

    public function scopeIsDuplicate($query, $person_id, $gravida, $hospcode)
    {
        return $query->where('person_id', (int) $person_id)
            ->where('hospcode', $hospcode)
            ->where('gravida', $gravida);
    }

    public function scopeGetList($query, $hospcode)
    {
        return $query->where('pregnancies.hospcode', $hospcode)
            ->select(
                'p.cid', 'p.fname', 'p.lname', 'p.birthdate', 'pregnancies.first_doctor_date',
                'pregnancies.labor_status', 'p.home_id', 'pregnancies.gravida', 'pregnancies.id'
            )
            ->join('person as p', 'p.id', '=', 'pregnancies.person_id')
            ->join('person_typearea as t', 't.cid', '=', 'p.cid')
            ->orderBy('p.fname');
    }

    public function scopeGetGA($query, $person_id)
    {
        return $query->where('person_id', '=', $person_id)
            ->groupBy('gravida');
    }
}
