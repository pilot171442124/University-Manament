<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\ProgramEntry;
use DB;

class ProgramEntryController extends Controller
{
    function getProgramData(Request $request){
		//echo '<pre>';
		//print_r( $_POST);

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'Program');

		$search = $_POST['search']['value'];
		$rowTotalObj = DB::table('t_program')
                     ->select(DB::raw('count(*) as rcount'))
                     ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('Program','like', '%' . $search . '%');
		                endif;
		              })
                     ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		

		$posts= ProgramEntry::offset($start)
		->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('Program','like', '%' . $search . '%');
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
				$arr['ProgramId'] = $r->ProgramId;
				$arr['Serial'] = $serial++;				
				$arr['Program'] = $r->Program;
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

     public function addEditProgram(Request $request){

		/*when ProgramId already exist then  update otherwise insert*/
		DB::table('t_program')
		    ->updateOrInsert(
		        ['ProgramId' => $request->input("recordId")],
		        ['Program' => $request->input("Program")]
		    );
    }

    public function deleteProgram(Request $request){
		$id = $request->input("id");

		$bookType = ProgramEntry::where('ProgramId',$id)->delete();
		return Response::json($bookType);
    }
}
