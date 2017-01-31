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
//        $filter = ;
        $org_ids = [1,2];
        $field_ids = [1,3];
        $tag_ids = [1,2,3];
        $country_ids = [2,1];
        $ratings = [3];

        $filteredByOrgs = $this->filterByOrg($org_ids);
        $filteredByOrgsNFields = $this->filterByField($filteredByOrgs, $field_ids);
        $filteredByOrgFieldTag = $this->filterByTag($filteredByOrgsNFields, $tag_ids);
        $filteredByOrgFieldTagCountry = $this->filterByCountry($filteredByOrgFieldTag, $country_ids);
        $final = $this->filterByRating($filteredByOrgFieldTagCountry, $ratings);
        $finalResults = fund::find($final);

        return $finalResults;
    }

    private function filterByOrg($org_ids){
        $res = array();
        $tmp = organization::find($org_ids);
        foreach ($tmp as $t){
            foreach ($t->funds as $fund)
                array_push($res, $fund->id);
        }
        return $res;
    }


    private function filterByField($filteredBeforeResult, $field_ids){
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
