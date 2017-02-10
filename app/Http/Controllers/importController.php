<?php

namespace App\Http\Controllers;

use App\field;
use App\fund;
use App\organization;
use App\tag;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class importController extends Controller
{
    public function show(){
        $organizations = organization::with('country')->get();
        return view('importPage')->with(compact('organizations'));
    }

    public function import(Request $r){
        $r->file('f')->storeAs('excels', $r->name .'.xlsx');
        $organization = $r->organization;
        Excel::load('storage\app\excels\DAAD.xlsx', function($reader) use($organization){
            $sheets = $reader->skip(1)->take(3);
            $initRead = $this->InitialRead($sheets);
            $this->FundTableInit($initRead, $organization);
        });

    }


    private function InitialRead($sheets){
        for ($sh = 1; $sh <= $sheets->getSheetCount()-1; $sh++){

            $sheet = $sheets->getSheet($sh);

            $rows = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

            $fund_name_cell = 'B3';

            $fund_name_row = preg_replace("/[^a-zA-Z]/", "", $fund_name_cell);
            $fund_name_col = (int) (preg_replace("/[^0-9]/", "", $fund_name_cell));

            $base_row = array_search($fund_name_row, $rows);
            #B3  - D2 is default base
            $tmpData[$sh]['fund_name'] = $sheet->getCell($rows[$base_row].$fund_name_col.'')->getValue();
            $tmpData[$sh]['rating'] = $sheet->getCell($rows[$base_row+2].($fund_name_col-1).'')->getValue();
            $tmpData[$sh]['fund_id'] = $sheet->getCell($rows[$base_row+4].($fund_name_col-1).'')->getValue();
            $tmpData[$sh]['related_IDs'] = $sheet->getCell($rows[$base_row+6].($fund_name_col-1).'')->getValue();
            $tmpData[$sh]['fund_acceptence'] = $sheet->getCell($rows[$base_row+2].($fund_name_col+1).'')->getValue();
            $tmpData[$sh]['Funding_org'] = $sheet->getCell($rows[$base_row+4].($fund_name_col+1).'')->getValue();
            $tmpData[$sh]['fund_research_area'] = $sheet->getCell($rows[$base_row+6].($fund_name_col).'')->getValue();
            $tmpData[$sh]['fund_program_description'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+1).'')->getValue();
            $tmpData[$sh]['Duration'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+2).'')->getValue();
            $tmpData[$sh]['Financial_support'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+3).'')->getValue();
            $tmpData[$sh]['Requirements'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+4).'')->getValue();
            $tmpData[$sh]['Deadline'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+5).'')->getValue();
            $tmpData[$sh]['Link1'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+6).'')->getValue();
            $tmpData[$sh]['Link2'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+7).'')->getValue();
            $tmpData[$sh]['Memo'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+8).'')->getValue();
            $tmpData[$sh]['Farsi_desc'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+9).'')->getValue();
            $tmpData[$sh]['Tag'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+10).'')->getValue();
            $tmpData[$sh]['Comments'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+11).'')->getValue();



            if(empty($tmpData[$sh]['fund_name'])){
                $tmpData[$sh]['fund_name'] = 'undone';
                $tmpData[$sh]['Comments'] = 'undone - name';
            }
            if(empty($tmpData[$sh]['rating'])){
                $tmpData[$sh]['rating'] = '1';
                $tmpData[$sh]['Comments'] = 'undone - rating';

            }
            if(empty($tmpData[$sh]['Funding_org'])){
                // 	$tmpData[$sh]['Funding_org'] = 'DAAD';
                // $tmpData[$sh]['Comments'] = 'undone - fund_org';

            } if(empty($tmpData[$sh]['fund_research_area'])){
                $tmpData[$sh]['fund_research_area'] = '1';
                $tmpData[$sh]['Comments'] = 'undone - research';

            } if(empty($tmpData[$sh]['Farsi_desc'])){
                $tmpData[$sh]['Farsi_desc'] = 'ناقص';
                $tmpData[$sh]['Comments'] = 'undone - farsi_desc';
            }

            #tags

            $tagTmp = $tmpData[$sh]['Tag'];
            if(empty($tagTmp)){
                $tmpData[$sh]['Tag'] = '1';
                $tmpData[$sh]['Comments'] = 'undone - tag';
            }
            $tagArray = explode(", ", $tagTmp);
            foreach ($tagArray as $x) {
                $x = addslashes($x);
            }


        }
        return $tmpData;
    }

    private function FundTableInit($tmpData, $organization)
    {
        for ($u = 1; $u < count($tmpData); $u++) { #iterate in order to execute queries

            $name = addslashes($tmpData[$u]['fund_name']);
            $description = addslashes($tmpData[$u]['fund_program_description']);
            $rating = addslashes($tmpData[$u]['rating']);
            $accetpence = addslashes($tmpData[$u]['fund_acceptence']);
            $duration = addslashes($tmpData[$u]['Duration']);
            $requirements = addslashes($tmpData[$u]['Requirements']);
            $deadline = addslashes($tmpData[$u]['Deadline']);
            $link1 = addslashes($tmpData[$u]['Link1']);
            $link2 = addslashes($tmpData[$u]['Link2']);
            $memo = addslashes($tmpData[$u]['Memo']);
            $farsi = addslashes($tmpData[$u]['Farsi_desc']);
            $comments = addslashes($tmpData[$u]['Comments']);
            $financial = addslashes($tmpData[$u]['Financial_support']);

            $fund  = new fund();
            $fund->name = $name;
            $fund->description = $description;
            $fund->rating = $rating;
            $fund->duration = $duration;
            $fund->requirements = $requirements;
            $fund->deadline = $deadline;
            $fund->link1 = $link1;
            $fund->link2 = $link2;
            $fund->memo = $memo;
            $fund->farsi = $farsi;
            $fund->comments = $comments;
            $fund->financial = $financial;

            if(empty($name)){
                $fund->name = 'NoName';
                $fund->comments .= ' ERROR-NO NAME';
            }
            if(empty($description)){
                $fund->name = 'NoDescription';
                $fund->comments .= ' ERROR-NO Description';
            }
            if(empty($rating)){
                $fund->rating = 1;
                $fund->comments .= ' ERROR-NO Rating';
            }
            if(empty($farsi)){
                $fund->farsi = 'NoFarsi';
                $fund->comments .= ' ERROR-NO Farsi';
            }


            #----------------------------------------------#
            #           ADD Organization part
            #----------------------------------------------#

            $fund->organization_id = $organization;
            $fund->save();
            $fund->organization()->associate(organization::find($organization));

            #----------------------------------------------#
            #        ADD Research area(Field) part
            #----------------------------------------------#

            $resAreas = trim($tmpData[$u]['fund_research_area']);
            $resAreaArray = explode(",", $resAreas);
            if(empty($resAreaArray)){
                $fund->fields()->attach(field::find(1));
                $fund->comments .= ' ERROR-NO Field';
            } else
                foreach ($resAreaArray as $y) {
                $y = addslashes($y);
                    $fund->fields()->attach(field::find($y));
                }


            #----------------------------------------------#
            #           ADD Tag(Category) Part
            #----------------------------------------------#

            $tagTmp = trim($tmpData[$u]['Tag']);
            $tagArray = explode(", ", $tagTmp);
            if(empty($tagArray)){
                $fund->comments .= ' ERROR-NO Tag';
            } else
                foreach ($tagArray as $x)
                {
                    $x = addslashes($x);
                    if(tag::where('real', $x)->get()->count() > 0){
                        if(!empty(tag::where('real', $x)->get()[0]->children))
                            $fund->tags()->attach(tag::where('real', $x)->get()[0]);
                        else
                            $fund->comments .= ' ERROR-NO Tag';
                    } else
                        $fund->comments .= ' ERROR-NO Tag';

                }

            #----------------------------------------------#
            #              Save fund Part
            #----------------------------------------------#


                $fund->save();
        }
    }
}
