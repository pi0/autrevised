<?php

namespace App\Http\Controllers;

use App\country;
use App\field;
use App\fund;
use App\organization;
use App\tag;
use Illuminate\Http\Request;

class searchController extends Controller
{


    public function search(Request $r){
        $filter = $r->filter;
        $offset = $r->offset * 5;

//        return $filter;
        if(isset($filter['$org_ids']))
            $org_ids = $filter['$org_ids'];
        else
            $org_ids = [];

        if(isset($filter['$field_ids']))
            $field_ids = $filter['$field_ids'];
        else
            $field_ids = [];

        if(isset($filter['$tag_ids']))
            $tag_ids = $filter['$tag_ids'];
        else
            $tag_ids = [];

        if(isset($filter['$country_ids']))
            $country_ids = $filter['$country_ids'];
        else
            $country_ids = [];
        $ratings = [];

        $filteredByOrgs = $this->filterByOrg($org_ids);
        $filteredByOrgsNFields = $this->filterByField($filteredByOrgs, $field_ids);
        $filteredByOrgFieldTag = $this->filterByTag($filteredByOrgsNFields, $tag_ids);
        $filteredByOrgFieldTagCountry = $this->filterByCountry($filteredByOrgFieldTag, $country_ids);
        $final = $this->filterByRating($filteredByOrgFieldTagCountry, $ratings);
        $count = fund::find($final)->count();
        $Results = fund::with('organization')->find($final)->toArray();
        $finalResults = array_slice($Results,$offset,5);
        return response()->json(['count'=> $count, 'result'=>$finalResults]);
    }

    private function filterByOrg($org_ids){

        $res = array();
        if(empty($org_ids)){
            foreach (fund::all() as $fund)
                array_push($res, $fund->id);
            return $res;
        }

        $tmp = organization::find($org_ids);
        foreach ($tmp as $t){
            foreach ($t->funds as $fund)
                array_push($res, $fund->id);
        }
        return $res;
    }


    private function filterByField($filteredBeforeResult, $field_ids){
        if(empty($field_ids))
            return $filteredBeforeResult;
        $ree = array();
        $rmp = field::find($field_ids);
        foreach ($rmp as $r){
            foreach ($r->funds as $fund)
                if(in_array($fund->id, $filteredBeforeResult))
                    array_push($ree, $fund->id);
        }
        return array_unique($ree);
    }

    private function filterByTag($filteredBeforeResult, $tag_ids){
        if(empty($tag_ids))
            return $filteredBeforeResult;
        $ree = array();
        $rmp = tag::find($tag_ids);
        foreach ($rmp as $r){
            foreach ($r->funds as $fund)
                if(in_array($fund->id, $filteredBeforeResult))
                    array_push($ree, $fund->id);
        }

        return array_unique($ree);
    }

    private function filterByCountry($filteredBeforeResult, $country_ids){
        if(empty($country_ids))
            return $filteredBeforeResult;
        $ree = array();
        $rmp = country::find($country_ids);
        foreach ($rmp as $r){
            foreach ($r->funds as $fund)
                if(in_array($fund->id, $filteredBeforeResult))
                    array_push($ree, $fund->id);
        }

        return array_unique($ree);
    }

    private function filterByRating($before, $ratings){
        if(empty($ratings))
            return $before;
        $res = array();
        foreach ($ratings as $rating){
            $funds = fund::where('rating', $rating)->get();
            foreach ($funds as $fund)
                if(in_array($fund->id, $before))
                    array_push($res, $fund->id);
        }

        return $res;
    }


}
