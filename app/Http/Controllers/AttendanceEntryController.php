<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\AttendanceEntry;
use DB;

class AttendanceEntryController extends Controller
{
     function getAttendanceData(Request $request){

		$YearId = $_POST['YearId'];
		$SemesterId = $_POST['SemesterId'];
		$SubjectId = $_POST['SubjectId'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		//$columns = array(2=>'StudentCode',3=>'RegNo',4=>'StudentName',5=>'Batch',6=>'Phone',6=>'Email');

		//$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_attendance')
           	->select(DB::raw('count(*) as rcount'))
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_attendance.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_attendance.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($SubjectId)
	          {
	            if($SubjectId > 0):
	               $query->Where('t_attendance.SubjectId','=', $SubjectId);
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];


		$posts = DB::table('t_attendance')
            ->join('t_subjects', 't_attendance.SubjectId', '=', 't_subjects.SubjectId')

            ->select(DB::raw("t_attendance.`AttId`,t_attendance.`YearId`,t_attendance.`SemesterId`,t_attendance.`SubjectId`,t_attendance.`AttDate`,
	concat(t_subjects.SubjectCode,' ',t_subjects.SubjectName) AS SubjectName
	,(SELECT COUNT(`AttItemId`) FROM `t_attendance_items` WHERE t_attendance_items.`AttId`=t_attendance.`AttId` AND t_attendance_items.`IsPresent`=0) AS Absence
	,(SELECT COUNT(`AttItemId`) FROM `t_attendance_items` WHERE t_attendance_items.`AttId`=t_attendance.`AttId` AND t_attendance_items.`IsPresent`=1) AS Present"))
            
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_attendance.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_attendance.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($SubjectId)
	          {
	            if($SubjectId > 0):
	               $query->Where('t_attendance.SubjectId','=', $SubjectId);
	            endif;
	          })
			  ->offset($start)
			->limit($limit)
			->orderByRaw("t_attendance.AttDate DESC,t_subjects.`SubjectCode`")
            //->tosql();
            ->get();

		$data = array();

		if($posts){

			//$x = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				//$details = "<a class='pMore' href='javascript:void(0);'><span class='label label-primary' title='".$r->Subjects."'>More</span></a>";

				$AttDate = date("d/m/Y", strtotime($r->AttDate));

				$PresentPercent=0;
				if($r->Present>0 || $r->Absence>0){
					$total =$r->Present+$r->Absence;
					$PresentPercent = number_format(((100*$r->Present)/$total),1);
				}

				$arr['AttId'] = $r->AttId;
				$arr['Serial'] = $serial++;
				$arr['AttDate'] =$AttDate;
				$arr['SubjectName'] = $r->SubjectName;
				$arr['Absence'] = $r->Absence;
				$arr['Present'] = $r->Present;
				$arr['PresentPercent'] = $PresentPercent."%";
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
	    

 
 public function addAttendanceMasterItems(Request $request){

		$recordId = $_POST['recordId'];
	    $AttDate = $_POST['AttDate'];
	    $YearId = $_POST['YearId'];
	    $SemesterId = $_POST['SemesterId'];
	    $SubjectId = $_POST['SubjectId'];

		$AttId =0;
		$saveFlag = 0;
	    if ($recordId == "") {

				DB::table('t_attendance')->insert(
				    ['YearId' => $YearId, 'SemesterId' => $SemesterId, 'SubjectId' => $SubjectId, 'AttDate' => $AttDate]
				);

				//get mysqli_insert_id
				$rowTotalObj = DB::table('t_attendance')
		                     ->select(DB::raw('max(AttId) as AttId'))
		                     ->get();

				$AttId = $rowTotalObj[0]->AttId;


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
						DB::table('t_attendance_items')->insert(
						    ['AttId' => $AttId, 'StudentsId' => $r->StudentsId, 'IsPresent' => 1]
						);

						$saveFlag = 1;
					}

				}

			    if ($saveFlag)
			        echo $AttId;
			    else
			        echo 0;

    	}
    	else{
			echo "Occured an error.";
    	}

}

/***Fetch Attendance Item List***/
public function getAttendanceItemData(Request $request){
	$AttId = $_POST['AttId'];
	$totalData = 0;

	$posts = DB::table('t_attendance_items')
            ->join('t_students', 't_attendance_items.StudentsId', '=', 't_students.StudentsId')
            ->select(DB::raw("t_attendance_items.`AttItemId`,t_attendance_items.`AttId`,t_attendance_items.`StudentsId`,
            	t_students.`StudentCode`,t_students.`Batch`,t_students.`StudentName`,t_attendance_items.`IsPresent`"))
            ->where('t_attendance_items.AttId', '=',  $AttId)
			->orderByRaw("t_students.StudentCode")
            //->tosql();
            ->get();

		$data = array();

		if($posts){

			$serial = 1;
			foreach($posts as $r){

				$checkedAbsence="";
				$checkedPresent="";
				
				if($r->IsPresent == 1){
					$checkedPresent="checked";
				}
				else{
					$checkedAbsence="checked";
				}

				$AttItemId=$r->AttItemId;

				$Absence = "<input class='attChange' type='radio' id='absence".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='A' ".$checkedAbsence.">";
				$Present = "<input class='attChange' type='radio' id='present".$AttItemId."' name='AttendanceRadio".$AttItemId."' value='P' ".$checkedPresent.">";

				$arr['AttItemId'] = $AttItemId;
				$arr['Serial'] = $serial++;
				$arr['StudentCode'] = $r->StudentCode;
				$arr['StudentName'] = $r->StudentName;
				$arr['Batch'] = $r->Batch;
				$arr['Absence'] = $Absence;
				$arr['Present'] = $Present;
				$arr['AttId'] = $r->AttId;
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



/***Delete updateAttendanceStatus***/
public function updateAttendanceStatus(Request $request){

    $recordId = $_POST['recordId'];
    $IsPresent = $_POST['IsPresent'];

    if ($recordId != "") {

		DB::table('t_attendance_items')
              ->where('AttItemId', $recordId)
              ->update(['IsPresent' => $IsPresent]);

		echo 1;
    }
	else
       echo "Data Can not save.";
}


 public function deleteAttendance(Request $request){
		$recordId = $request->input("id");

	    if ($recordId != "") {
	    	//delete items
			DB::table('t_attendance_items')->where('AttId', '=', $recordId)->delete();
			//delete master
			DB::table('t_attendance')->where('AttId', '=', $recordId)->delete();
			echo 1;
	    }
		else
	       echo "Data Can not Delete.";

    }


}
