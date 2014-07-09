<?php
/**
 * Class Utils
 *
 * @author  Satit Rinapit <rianpit@gmail.com>
 *
 */

class Utils {
    
    public static function getCurrentInsurance($person_id)
    {
        $ins = DB::table('insurances as i')
            ->select('i.*', 'h1.hname as hospmain_name', 'h2.hname as hospsub_name')
            ->leftJoin('hospitals as h1', 'i.hospmain', '=', 'h1.hmain')
            ->leftJoin('hospitals as h2', 'i.hospsub', '=', 'h2.hmain')
            ->where('i.person_id', $person_id)
            ->first();

        return $ins;
    }

    /**
    * Get short address
    *
    */
    public static function getShortAddress($home_id)
    {
        $address = DB::table('house as h')
            ->select('h.address', 'v.village_name', DB::raw('substr(v.village_code, 7, 2) as moo'), 'c.name as tmb_name')
            ->leftJoin('villages as v', 'v.id', '=', 'h.village_id')
            ->leftJoin('catms as c', 'c.catm', '=', DB::raw('concat(substr(v.village_code, 1, 6), "00")'))
            ->where('h.id', $home_id)
            ->first();

        if (count((array) $address) > 0)
            return $address->address . ' หมู่ ' . $address->moo . ' ต.' . $address->tmb_name;

        return '-';
    }

    public static function searchPersonPIDByFirstName($firstname)
    {
        $result = DB::table('person as p')
            ->select('p.fname', 'p.lname', 'p.id', 'p.cid', 'p.birthdate', 'p.sex', 't.typearea', 'p.home_id')
            ->leftJoin('person_typearea as t', 't.cid', '=', 'p.cid')
            ->where('p.fname', 'like', $firstname . '%')
            ->where('t.hospcode', Auth::user()->hospcode)
            ->take(20)
            ->get();

        return $result;
    }

    public static function searchPersonPIDByLastName($lastname)
    {
        $result = DB::table('person as p')
            ->select('p.id', 'p.cid')
            ->where('p.lname', 'like', $lastname . '%')
            ->take(20)
            ->get();

        return $result;
    }

    public static function searchPersonPIDByFirstNameAndLastName($firstname, $lastname)
    {
        $result = DB::table('person as p')
            ->select('p.id', 'p.cid')
            ->where('p.fname', 'like', $firstname . '%')
            ->where('p.lname', 'like', $lastname . '%')
            ->take(20)
            ->get();

        return $result;
    }

    public static function searchPersonPIDByCID($cid)
    {
        $result = DB::table('person as p')
            ->select('p.id', 'p.cid')
            ->where('p.cid', $cid)
            ->take(20)
            ->get();

        return $result;
    }

}
