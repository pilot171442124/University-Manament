<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\ExaminationMarksEntry;
use DB;

class ExaminationMarksEntryController extends Controller
{
    function getMarksData(Request $request){

		$YearId = $_POST['YearId'];
		$SemesterId = $_POST['SemesterId'];
		$SubjectId = $_POST['SubjectId'];
		$ExamId = $_POST['ExamId'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		//$columns = array(2=>'StudentCode',3=>'RegNo',4=>'StudentName',5=>'Batch',6=>'Phone',6=>'Email');

		//$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_examinationmaster')
           	->select(DB::raw('count(*) as rcount'))
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_examinationmaster.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_examinationmaster.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($SubjectId)
	          {
	            if($SubjectId > 0):
	               $query->Where('t_examinationmaster.SubjectId','=', $SubjectId);
	            endif;
	          })
            ->where(function($query) use ($ExamId)
	          {
	            if($ExamId > 0):
	               $query->Where('t_examinationmaster.ExamId','=', $ExamId);
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];

		$posts = DB::table('t_examinationmaster')
            ->join('t_subjects', 't_examinationmaster.SubjectId', '=', 't_subjects.SubjectId')
            ->join('t_examination', 't_examinationmaster.ExamId', '=', 't_examination.ExamId')

            ->select(DB::raw("t_examinationmaster.`EMId`,t_examinationmaster.`YearId`,t_examinationmaster.`SemesterId`
            	,t_examinationmaster.`SubjectId`,t_examinationmaster.`AttDate`,
            	concat(t_subjects.SubjectCode,' ',t_subjects.SubjectName) AS SubjectName,t_examination.ExamName
            	,t_examinationmaster.ExamId,t_examinationmaster.ExamMarks,t_examinationmaster.MarkConsider"))
            
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_examinationmaster.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_examinationmaster.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($SubjectId)
	          {
	            if($SubjectId > 0):
	               $query->Where('t_examinationmaster.SubjectId','=', $SubjectId);
	            endif;
	          })
            ->where(function($query) use ($ExamId)
	          {
	            if($ExamId > 0):
	               $query->Where('t_examinationmaster.ExamId','=', $ExamId);
	            endif;
	          })
			  ->offset($start)
			->limit($limit)
			->orderByRaw("t_examinationmaster.AttDate DESC,t_subjects.`SubjectCode`,t_examination.ExamName")
            //->tosql();
            ->get();

		$data = array();

		if($posts){

			//$x = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
		
				$AttDate = date("d/m/Y", strtotime($r->AttDate));

				$arr['EMId'] = $r->EMId;
				$arr['Serial'] = $serial++;
				$arr['AttDate'] =$AttDate;
				$arr['SubjectName'] = $r->SubjectName;
				$arr['ExamName'] = $r->ExamName;
				$arr['ExamMarks'] = $r->ExamMarks;
				$arr['MarkConsider'] = $r->MarkConsider;
				$arr['action'] = $y .$z;
				$arr['YearId'] = $r->YearId;
				$arr['SemesterId'] = $r->SemesterId;
				$arr['SubjectId'] = $r->SubjectId;
				$arr['ExamId'] = $r->ExamId;
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


 public function addExaminationMasterItems(Request $request){

		$recordId = $_POST['recordId'];

		$AttDate = $_POST['AttDate'];
	    $YearId = $_POST['YearId'];
	    $SemesterId = $_POST['SemesterId'];
	    $SubjectId = $_POST['SubjectId'];
	    $ExamId = $_POST['ExamId'];
	    $ExamMarks = $_POST['ExamMarks'];
	    $MarkConsider = $_POST['MarkConsider'];



		$EMId =0;
		$saveFlag = 0;
	    if ($recordId == "") {


			DB::table('t_examinationmaster')->insert(
				    ['YearId' => $YearId, 'SemesterId' => $SemesterId, 'SubjectId' => $SubjectId, 'AttDate' => $AttDate, 'ExamId' => $ExamId, 'ExamMarks' => $ExamMarks, 'MarkConsider' => $MarkConsider]
				);

			//get mysqli_insert_id
			$rowTotalObj = DB::table('t_examinationmaster')
	                     ->select(DB::raw('max(EMId) as EMId'))
	                     ->get();

			$EMId = $rowTotalObj[0]->EMId;


			//get subject list
			$posts = DB::table('t_semester_student_map')
	            ->join('t_semester_student_sub_map', 't_semester_student_map.MapId', '=', 't_semester_student_sub_map.MapId')
	            ->select(DB::raw("t_semester_student_map.`StudentsId`"))
				->where('t_semester_student_map.YearId', '=',  $YearId)
				->where('t_semester_student_map.SemesterId', '=',  $SemesterId)
				->where('t_semester_student_sub_map.SubjectId', '=',  $SubjectId)
	            ->get();


			if($posts){

				foreach($posts as $r){
					DB::table('t_examination_items')->insert(
					    ['EMId' => $EMId, 'StudentsId' => $r->StudentsId, 'Marks' => 0]
					);

					$saveFlag = 1;
				}

			}

		    if ($saveFlag)
		        echo $EMId;
		    else
		        echo 0;

    	}
    	else{
			echo "Occured an error.";
    	}

}


/***Fetch Marks Item List***/
public function getExaminationItemData(Request $request){
	$EMId = $_POST['EMId'];
	$totalData = 0;

	$posts = DB::table('t_examination_items')
            ->join('t_students', 't_examination_items.StudentsId', '=', 't_students.StudentsId')
            ->select(DB::raw("t_examination_items.`EMItemId`,t_examination_items.`EMId`,t_examination_items.`StudentsId`,
            	t_students.`StudentCode`,t_students.`Batch`,t_students.`StudentName`,t_examination_items.`Marks`"))
            ->where('t_examination_items.EMId', '=',  $EMId)
			->orderByRaw("t_students.StudentCode")
            //->tosql();
            ->get();

		$data = array();

		if($posts){

			$serial = 1;
			foreach($posts as $r){

				$EMItemId=$r->EMItemId;
		
				$Marks = "<input class='dt-right' onblur='updateMarks(".$EMItemId.")' type='text' id='Marks".$EMItemId."' value='".$r->Marks."' placeholder='Enter Marks' class='form-control'>";


				$arr['EMItemId'] = $EMItemId;
				$arr['Serial'] = $serial++;
				$arr['StudentCode'] = $r->StudentCode;
				$arr['StudentName'] = $r->StudentName;
				$arr['Batch'] = $r->Batch;
				$arr['Marks'] = $Marks;
				$arr['EMId'] = $r->EMId;
				$arr['StudentsId'] = $r->StudentsId;
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



/***Delete updateExaminationItemMarks***/
public function updateExaminationItemMarks(Request $request){

    $recordId = $_POST['recordId'];
    $Marks = $_POST['Marks'];

    if ($recordId != "") {
    	
    	if($Marks == "")
			$Marks=0;

		DB::table('t_examination_items')
              ->where('EMItemId', $recordId)
              ->update(['Marks' => $Marks]);

		echo 1;
    }
	else
       echo "Data Can not save.";
}

 public function deleteExaminationMarks(Request $request){
		$recordId = $request->input("id");

	    if ($recordId != "") {
	    	//delete items
			DB::table('t_examination_items')->where('EMId', '=', $recordId)->delete();
			//delete master
			DB::table('t_examinationmaster')->where('EMId', '=', $recordId)->delete();
			echo 1;
	    }
		else
	       echo "Data Can not Delete.";

    }
}
