<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\StudentRegistration;
use DB;

class StudentRegistrationController extends Controller
{
    function getStudentRegistrationData(Request $request){

		$YearId = $_POST['YearId'];
		$SemesterId = $_POST['SemesterId'];
		//datatable column index => database column name. here considaer datatable visible and novisible column
		//$columns = array(2=>'StudentCode',3=>'RegNo',4=>'StudentName',5=>'Batch',6=>'Phone',6=>'Email');

		$search = $_POST['search']['value'];


		$rowTotalObj = DB::table('t_semester_student_map')
            ->join('t_students', 't_semester_student_map.StudentsId', '=', 't_students.StudentsId')
            ->select(DB::raw('count(*) as rcount'))            
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_semester_student_map.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_semester_student_map.SemesterId','=', $SemesterId);
	            endif;
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('StudentCode','like', '%' . $search . '%');
	               $query->orWhere('StudentName','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	            endif;
	          })
             ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];


		$posts = DB::table('t_semester_student_map')
            ->join('t_students', 't_semester_student_map.StudentsId', '=', 't_students.StudentsId')
            ->join('t_semester', 't_semester_student_map.SemesterId', '=', 't_semester.SemesterId')

            ->select(DB::raw("t_semester_student_map.`MapId`,t_semester_student_map.`YearId`,
            	t_semester_student_map.`SemesterId`,t_semester.Semester,t_semester_student_map.`StudentsId`,
            	t_semester_student_map.RegDate,t_semester_student_map.`Remarks`,t_students.`StudentCode`,
            	t_students.`StudentName`,t_students.Phone,
(SELECT GROUP_CONCAT(CONCAT(SubjectCode,' ',SubjectName)  SEPARATOR ', ') FROM `t_semester_student_sub_map`
INNER JOIN `t_subjects` ON t_semester_student_sub_map.`SubjectId`=t_subjects.`SubjectId` WHERE t_semester_student_map.`MapId`=t_semester_student_sub_map.MapId) AS Subjects"))
            
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_semester_student_map.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_semester_student_map.SemesterId','=', $SemesterId);
	            endif;
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('StudentCode','like', '%' . $search . '%');
	               $query->orWhere('StudentName','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	            endif;
	          })
			  ->offset($start)
			->limit($limit)
			->orderByRaw("t_semester.Semester,t_students.`StudentCode`")
            //->tosql();
             ->get();

		$data = array();

		if($posts){

			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				$details = "<a class='pMore' href='javascript:void(0);'><span class='label label-primary' title='".$r->Subjects."'>More</span></a>";

				$arr['MapId'] = $r->MapId;
				$arr['Serial'] = $serial++;
				$arr['Semester'] = $r->Semester;
				$arr['StudentCode'] = $r->StudentCode;
				$arr['StudentName'] = $r->StudentName;
				$arr['Phone'] = $r->Phone;
				$arr['RegDate'] = $r->RegDate;
				$arr['Remarks'] = $r->Remarks;
				$arr['action'] =$details.$y.$z;
				$arr['StudentsId'] = $r->StudentsId;
				$arr['SemesterId'] = $r->SemesterId;
				$arr['YearId'] = $r->YearId;
				$arr['Subjects'] = $r->Subjects;
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

     public function addEditStudentRegistration(Request $request){

		$RecordId = $request->input("recordId");
	    $YearId = $request->input("YearId");
	    $SemesterId =$request->input("SemesterId");
	    $StudentsId = $request->input("StudentsId");
	    $RegDate = $request->input("RegDate");
		$subjectIds = json_decode($request->input("subjectIds"), true );

		if(count($subjectIds) == 0){
			 echo "There are no subject.";
			 exit;
		}


		$saveFlag = 1;
	    if ($RecordId == "") {

			//get mysqli_insert_id
			$rowTotalObj = DB::table('t_semester_student_map')
	                     ->select(DB::raw('count(MapId) as rcount'))
	                     ->where('YearId', '=', $YearId)
	                     ->where('SemesterId', '=',  $SemesterId)
	                     ->where('StudentsId', '=', $StudentsId)
	                     ->get();
			$isUplicate = $rowTotalObj[0]->rcount;
			
			if($isUplicate==0){

				DB::table('t_semester_student_map')->insert(
				    ['YearId' => $YearId, 'SemesterId' => $SemesterId, 'StudentsId' => $StudentsId, 'RegDate' => $RegDate]
				);

				//get mysqli_insert_id
				$rowTotalObj = DB::table('t_semester_student_map')
		                     ->select(DB::raw('max(MapId) as MapId'))
		                     ->get();

				$MapId = $rowTotalObj[0]->MapId;

				if($MapId>0){
					foreach($subjectIds as $SubjectId){
						DB::table('t_semester_student_sub_map')->insert(
						    ['MapId' => $MapId, 'SubjectId' => $SubjectId]
						);
					}
				}
				else{
					$saveFlag = 0;
				}
			}
			else{
				$saveFlag = 0;
			}
	    } else {
			DB::table('t_semester_student_map')
              ->where('MapId', $RecordId)
              ->update(['YearId' => $YearId,'SemesterId' => $SemesterId,'StudentsId' => $StudentsId,'RegDate' => $RegDate]);

			
			DB::table('t_semester_student_sub_map')->where('MapId', '=', $RecordId)->delete();

			foreach($subjectIds as $SubjectId){
					DB::table('t_semester_student_sub_map')->insert(
						    ['MapId' => $RecordId, 'SubjectId' => $SubjectId]
						);
				}

	    }
	    if ($saveFlag)
	        echo 1;
	    else
	        echo "Data Can not Save.";

    }


	function getSubjectsControls(Request $request){
		$MapId = $request->input("MapId");

		$posts = DB::table('t_semester_student_sub_map')
            ->join('t_subjects', 't_semester_student_sub_map.SubjectId', '=', 't_subjects.SubjectId')
            ->select('t_semester_student_sub_map.*', 't_subjects.SubjectName')
            ->where('MapId', '=', $MapId)
			->orderByRaw("MapItemId asc")
            ->get();


		$dataList = array();
		foreach($posts as $r){
			$dataList[$r->SubjectId] =array($r->SubjectId, $r->SubjectName);
	    }


	    echo json_encode($dataList);
	}




    public function deleteStudentRegistration(Request $request){
		$recordId = $request->input("id");

	    if ($recordId != "") {
	    	//delete items
			DB::table('t_semester_student_sub_map')->where('MapId', '=', $recordId)->delete();
			//delete master
			DB::table('t_semester_student_map')->where('MapId', '=', $recordId)->delete();
			echo 1;
	    }
		else
	       echo "Data Can not Delete.";

    }
}
