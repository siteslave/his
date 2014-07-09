<?php
/**
 * Class ServiceAppointment
 *
 */

class ServiceAppointment extends Eloquent
{
    protected $table = 'service_appointments';

    public static $roles = [
        'service_id'   => 'required',
        'appoint_id'   => 'required',
        'appoint_date' => 'required',
        'clinic_id'    => 'required',
        'provider_id'  => 'required'
    ];

    public function scopeIsDuplicate($query, $service_id, $appoint_id, $appoint_date)
    {
        return $query->where(function($query) use ($service_id, $appoint_id)
            {
                $query->where('service_id', $service_id)
                    ->where('appoint_type_id', $appoint_id);
            })
            ->orWhere(function($query) use ($appoint_date, $appoint_id)
            {
                $query->where('appoint_date', $appoint_date)
                    ->where('appoint_type_id', $appoint_id)
                    ->where('hospcode', Auth::user()->hospcode);
            });
    }

    public function scopeGetList($query, $service_id)
    {
        return $query->select(
            'service_appointments.*', 'ap.name as appoint_name', 'ap.th_name', 'pd.fname',
            'pd.lname', 'c.name as clinic_name'
        )
            ->leftJoin('appoint_type as ap', 'ap.id', '=', 'service_appointments.appoint_type_id')
            ->leftJoin('providers as pd', 'pd.id', '=', 'service_appointments.provider_id')
            ->leftJoin('clinics as c', 'c.id', '=', 'service_appointments.clinic_id')
            ->where('service_appointments.service_id', '=', $service_id);
    }
}
