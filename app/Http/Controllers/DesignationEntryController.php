<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\DesignationEntry;
use DB;

class DesignationEntryController extends Controller
{
    function getDesignationData(Request $request){

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'Designation');

		$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_designation')
                     ->select(DB::raw('count(*) as rcount'))
                     ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('Designation','like', '%' . $search . '%');
		                endif;
		              })
                     ->get();

		$totalData = $rowTotalObj[0]->rcount;

		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];


		$posts= DesignationEntry::offset($start)
		->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('Designation','like', '%' . $search . '%');
                endif;
              })
->offset($start)
		->limit($limit)
		->orderByRaw("$order $dir")
		->get();

		$data = array();

		if($posts){

			$y = "<a class='task-del itmEdit' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['DesignationId'] = $r->DesignationId;
				$arr['Serial'] = $serial++;				
				$arr['Designation'] = $r->Designation;
				$arr['action'] =$y.$z;
				$data[] = $arr;
			}

			$json_data = array(
				"iTotalRecords"=> intval($totalData),
				"iTotalDisplayRecords"=> intval($totalData),
				"draw"=>intval($request->input('draw')),
				"recordsTotal"=> intval($totalData),
				"data"=>$data
			);

			echo json_encode($json_data);
		}
    }

    public function addEditDesignation(Request $request){

		/*when DesignationId already exist then  update otherwise insert*/
		DB::table('t_designation')
		    ->updateOrInsert(
		        ['DesignationId' => $request->input("recordId")],

		        ['Designation' => $request->input("Designation")]
		    );
    }

    public function deleteDesignation(Request $request){
		$id = $request->input("id");

		$output = DesignationEntry::where('DesignationId',$id)->delete();
		return Response::json($output);
    }
}
