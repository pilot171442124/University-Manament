<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Redirect,Response;
use App\AdmissionForm;
use DB;

class AdmissionFormController extends Controller
{
   function getAdmissionFormData(Request $request){


		$YearId = $_POST['YearId'];
		$SemesterId = $_POST['SemesterId'];
		$ProgramId = $_POST['ProgramId'];

		$rowTotalObj = DB::table('t_admissionform')
           	->select(DB::raw('count(*) as rcount'))
           	->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_admissionform.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_admissionform.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($ProgramId)
	          {
	            if($ProgramId > 0):
	               $query->Where('t_admissionform.ProgramId','=', $ProgramId);
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];


		$posts = DB::table('t_admissionform')
		->join('t_gender', 't_admissionform.GenderId', '=', 't_gender.GenderId')
		
            ->select(DB::raw("FormId,YearId,SemesterId,ProgramId,AddmisionDate,StudentName,t_admissionform.GenderId,Gender,Phone,Email,SSCGPA,SSCBoard,HSCGPA,HSCCollege"))
            
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_admissionform.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_admissionform.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($ProgramId)
	          {
	            if($ProgramId > 0):
	               $query->Where('t_admissionform.ProgramId','=', $ProgramId);
	            endif;
	          })
			->offset($start)
			->limit($limit)
			->orderByRaw("t_admissionform.StudentName")
            //->tosql();
            ->get();

		$data = array();

		if($posts){

			//$x = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				$AddmisionDate = date("Y/m/d", strtotime($r->AddmisionDate));

				$arr['FormId'] = $r->FormId;
				$arr['Serial'] = $serial++;
				$arr['StudentName'] = $r->StudentName;
				$arr['Gender'] = $r->Gender;
				$arr['Phone'] = $r->Phone;
				$arr['Email'] = $r->Email;
				$arr['SSCGPA'] = $r->SSCGPA;
				$arr['SSCBoard'] = $r->SSCBoard;
				$arr['HSCGPA'] = $r->HSCGPA;
				$arr['HSCCollege'] = $r->HSCCollege;
				$arr['AddmisionDate'] =$AddmisionDate;
				$arr['action'] = '';//$y .$z;
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

 public function addEditAdmissionFormSubmit(Request $request){

		$curDateTime = date ( 'Y-m-d' );

		/*when FormId already exist then  update otherwise insert*/
		DB::table('t_admissionform')
		    ->updateOrInsert(
		        ['FormId' => $request->input("recordId")],
		        ['YearId' => $request->input("YearId"),
		    	'SemesterId' => $request->input("SemesterId"),
		    	'ProgramId' => $request->input("ProgramId"),
		    	'AddmisionDate' => $curDateTime,
		    	'StudentName' => $request->input("StudentName"),
		    	'GenderId' => $request->input("GenderId"),
		    	'Phone' => $request->input("Phone"),
		    	'Email' => $request->input("Email"),
		    	'SSCGPA' => $request->input("SSCGPA"),
		    	'SSCBoard' => $request->input("SSCBoard"),
		    	'HSCGPA' => $request->input("HSCGPA"),
		    	'HSCCollege' => $request->input("HSCCollege")] 	
		    );
    }

public function deleteClass(Request $request){
		$id = $request->input("id");

		$obj = AdmissionForm::where('FormId',$id)->delete();
		return Response::json($obj);
    }

}
