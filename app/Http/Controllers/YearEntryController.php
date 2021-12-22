<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\YearEntry;
use DB;

class YearEntryController extends Controller
{
     function getYearData(Request $request){

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'Year');

		$search = $_POST['search']['value'];
		$rowTotalObj = DB::table('t_year')
                     ->select(DB::raw('count(*) as rcount'))
                     ->where(function($query) use ($search)
		              {
		                if(!empty($search)):
		                   $query->Where('Year','like', '%' . $search . '%');
		                endif;
		              })
                     ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		

		$posts= YearEntry::offset($start)
		->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('Year','like', '%' . $search . '%');
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
				$arr['YearId'] = $r->YearId;
				$arr['Serial'] = $serial++;				
				$arr['Year'] = $r->Year;
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

     public function addEditYear(Request $request){

		/*when YearId already exist then  update otherwise insert*/
		DB::table('t_year')
		    ->updateOrInsert(
		        ['YearId' => $request->input("recordId")],
		        ['Year' => $request->input("Year")]
		    );
    }

    public function deleteYear(Request $request){
		$id = $request->input("id");

		$obj = YearEntry::where('YearId',$id)->delete();
		return Response::json($obj);
    }
}
