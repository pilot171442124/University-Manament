<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Redirect,Response;
use App\ExaminationEntry;
use DB;

class ExaminationEntryController extends Controller
{
     function getExaminationData(Request $request){

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'ExamName');

		$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_examination')
                     ->select(DB::raw('count(*) as rcount'))
                     ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('ExamName','like', '%' . $search . '%');
		                endif;
		              })
                     ->get();

		$totalData = $rowTotalObj[0]->rcount;

		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];


		$posts= ExaminationEntry::offset($start)
		->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('ExamName','like', '%' . $search . '%');
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
				$arr['ExamId'] = $r->ExamId;
				$arr['Serial'] = $serial++;				
				$arr['ExamName'] = $r->ExamName;
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

    public function addEditExamination(Request $request){

		/*when ExamId already exist then  update otherwise insert*/
		DB::table('t_examination')
		    ->updateOrInsert(
		        ['ExamId' => $request->input("recordId")],

		        ['ExamName' => $request->input("ExamName")]
		    );
    }

    public function deleteExamination(Request $request){
		$id = $request->input("id");

		$output = ExaminationEntry::where('ExamId',$id)->delete();
		return Response::json($output);
    }
}
