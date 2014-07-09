<?php
/**
 * Class ServiceDrug
 *
 */

class ServiceDrug extends Eloquent
{
    protected $table = 'service_drugs';

    public static $roles = [
        'drug_id'    => 'required',
        'usage_id'   => 'required',
        'price'      => 'required',
        'qty'        => 'required',
        'service_id' => 'required'
    ];

    public function scopeIsExist($query, $service_id, $drug_id)
    {
        return $query->where('service_id', (int) $service_id)
            ->where('drug_id', (int) $drug_id);
    }

    public function scopeGetList($query, $service_id)
    {
        return $query->select('service_drugs.*', 'd.name as drug_name', 'dg.code as usage_name')
            ->leftJoin('drugs as d', 'd.id', '=', 'service_drugs.drug_id')
            ->leftJoin('drugusages as dg', 'dg.id', '=', 'service_drugs.usage_id')
            ->where('service_drugs.service_id', '=', $service_id);
    }
}
