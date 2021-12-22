<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\AttendanceDetailsReport;
use DB;
use Auth;

class AttendanceDetailsReportController extends Controller
{
   
   function getAttendanceDetailsReportData(Request $request){

		$YearId = $_POST['YearId'];
		$SemesterId = $_POST['SemesterId'];
		$SubjectId = $_POST['SubjectId'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(1=>'StudentCode',2=>'StudentName');

		//$limit = $_POST['length'];
		//$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];

		//$search = $_POST['search']['value'];
/*
        $rowTotalObj = DB::table('t_attendance')
         	->join('t_attendance_items', 't_attendance.AttId', '=', 't_attendance_items.AttId')
			->select(DB::raw('count(*) as rcount'))
			->where('t_attendance.YearId', '=',  $YearId)
			->where('t_attendance.SemesterId', '=',  $SemesterId)
			->where(function($query) use ($SubjectId)
	              {
	                if($SubjectId>0):
	                   $query->Where('t_attendance.SubjectId','=', $SubjectId);
	                endif;
	              })
			//->groupBy('t_attendance_items.StudentsId')
            ->get();


		$totalData = $rowTotalObj[0]->rcount;*/
		$totalData=0;

		//BookTypeId=1=hard copy
        $posts = DB::table('t_attendance')
         	->join('t_attendance_items', 't_attendance.AttId', '=', 't_attendance_items.AttId')
         	->join('t_students', 't_attendance_items.StudentsId', '=', 't_students.StudentsId')

			->select(DB::raw('t_students.StudentCode, t_students.StudentName,
         		COUNT(t_attendance_items.`AttItemId`) AS TotalClass,
         		COUNT(CASE WHEN t_attendance_items.`IsPresent` = 1 THEN 1 ELSE NULL END) Present
				,COUNT(CASE WHEN t_attendance_items.`IsPresent` = 0 THEN 1 ELSE NULL END) Absence'))

			->where('t_attendance.YearId', '=',  $YearId)
			->where('t_attendance.SemesterId', '=',  $SemesterId)
			->where(function($query) use ($SubjectId)
	              {
	                if($SubjectId>0):
	                   $query->Where('t_attendance.SubjectId','=', $SubjectId);
	                endif;
	              })
			/*->where(function($query) use ($search)
              {
                if(!empty($search)):
                   $query->Where('StudentCode','like', '%' . $search . '%');
                   $query->orWhere('StudentName','like', '%' . $search . '%');
                endif;
              })*/
			->groupBy('t_students.StudentCode', 't_students.StudentName')
			//->offset($start)
			//->limit($limit)
			//->orderByRaw("$order $dir")
			//->tosql();
            ->get();


		$data = array();

		if($posts){

			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				$PresentPercent=0;
				if($r->Present>0 || $r->Absence>0){
					$total = $r->TotalClass;
					$PresentPercent = number_format(((100*$r->Present)/$total),1);
				}

				$arr['Serial'] = $serial++;
				$arr['StudentCode'] = $r->StudentCode;
				$arr['StudentName'] = $r->StudentName;
				$arr['TotalClass'] = $r->TotalClass;
				$arr['Present'] = $r->Present;
				$arr['Absence'] = $r->Absence;
				$arr['PresentPercent'] = $PresentPercent;
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
}
