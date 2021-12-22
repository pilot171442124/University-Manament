<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\SubjectEntry;
use DB;

class SubjectEntryController extends Controller
{
     function getSubjectData(Request $request){
		//echo '<pre>';
		//print_r( $_POST);

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'SubjectCode',3=>'SubjectName',4=>'Credits');

		$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_subjects')
                     ->select(DB::raw('count(*) as rcount'))
                     ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('SubjectCode','like', '%' . $search . '%');
		                   $query->orWhere('SubjectName','like', '%' . $search . '%');
		                   $query->orWhere('Credits','like', '%' . $search . '%');
		                endif;
		              })
                     ->get();

		$totalData = $rowTotalObj[0]->rcount;



		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		
		

		$posts= SubjectEntry::offset($start)
		->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('SubjectCode','like', '%' . $search . '%');
                   $query->orWhere('SubjectName','like', '%' . $search . '%');
                   $query->orWhere('Credits','like', '%' . $search . '%');
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
				$arr['SubjectId'] = $r->SubjectId;
				$arr['Serial'] = $serial++;				
				$arr['SubjectCode'] = $r->SubjectCode;
				$arr['SubjectName'] = $r->SubjectName;
				$arr['Credits'] = $r->Credits;
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

    public function addEditSubject(Request $request){

		/*when SubjectId already exist then  update otherwise insert*/
		DB::table('t_subjects')
		    ->updateOrInsert(
		        ['SubjectId' => $request->input("recordId")],

		        ['SubjectCode' => $request->input("SubjectCode"),
		        'SubjectName' => $request->input("SubjectName"),
		        'Credits' => $request->input("Credits")]
		    );
    }

    public function deleteSubject(Request $request){
		$id = $request->input("id");

		$output = SubjectEntry::where('SubjectId',$id)->delete();
		return Response::json($output);
    }
}
