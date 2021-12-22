<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\ClassEntry;
use DB;

class ClassEntryController extends Controller
{
    function getClassData(Request $request){


		$YearId = $_POST['YearId'];
		$SemesterId = $_POST['SemesterId'];
		$SubjectId = $_POST['SubjectId'];

		$rowTotalObj = DB::table('t_class')
           	->select(DB::raw('count(*) as rcount'))
           	->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_class.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_class.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($SubjectId)
	          {
	            if($SubjectId > 0):
	               $query->Where('t_class.SubjectId','=', $SubjectId);
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];


		$posts = DB::table('t_class')
            ->join('t_subjects', 't_class.SubjectId', '=', 't_subjects.SubjectId')

            ->select(DB::raw("t_class.`ClassId`,t_class.`YearId`,t_class.`SemesterId`,
            	t_class.`SubjectId`,t_class.`ClassDate`,t_class.ClassTitle,t_class.`ClassURL`,
				concat(t_subjects.SubjectCode,' ',t_subjects.SubjectName) AS SubjectName"))
            
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_class.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_class.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($SubjectId)
	          {
	            if($SubjectId > 0):
	               $query->Where('t_class.SubjectId','=', $SubjectId);
	            endif;
	          })
			->offset($start)
			->limit($limit)
			->orderByRaw("t_class.ClassDate DESC,t_subjects.`SubjectCode`")
            //->tosql();
            ->get();

		$data = array();

		if($posts){

			//$x = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				//$ClassDate = date("d/m/Y", strtotime($r->ClassDate));
				$ClassDate = date("Y/m/d", strtotime($r->ClassDate));

				$arr['ClassId'] = $r->ClassId;
				$arr['Serial'] = $serial++;
				$arr['ClassDate'] =$ClassDate;
				$arr['SubjectName'] = $r->SubjectName;
				$arr['ClassTitle'] = $r->ClassTitle;
				$arr['ClassURL'] = $r->ClassURL;
				$arr['action'] = $y .$z;
				$arr['YearId'] = $r->YearId;
				$arr['SemesterId'] = $r->SemesterId;
				$arr['SubjectId'] = $r->SubjectId;
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

 public function addEditClass(Request $request){

		/*when ClassId already exist then  update otherwise insert*/
		DB::table('t_class')
		    ->updateOrInsert(
		        ['ClassId' => $request->input("recordId")],
		        ['YearId' => $request->input("YearId"),
		    	'SemesterId' => $request->input("SemesterId"),
		    	'SubjectId' => $request->input("SubjectId"),
		    	'ClassTitle' => $request->input("ClassTitle"),
		    	'ClassDate' => $request->input("ClassDate"),
		    	'ClassURL' => $request->input("ClassURL")] 	
		    );
    }

public function deleteClass(Request $request){
		$id = $request->input("id");

		$obj = ClassEntry::where('ClassId',$id)->delete();
		return Response::json($obj);
    }





}
