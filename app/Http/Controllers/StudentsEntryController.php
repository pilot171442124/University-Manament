<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\StudentsEntry;
use App\UserEntry;
use DB;
use Illuminate\Support\Facades\Hash;

class StudentsEntryController extends Controller
{
   function getStudentsData(Request $request){

		$ProgramId = $_POST['ProgramId'];

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'StudentCode',3=>'RegNo',4=>'StudentName',5=>'Batch',6=>'Phone',6=>'Email');

		$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_students')
            ->join('t_program', 't_students.ProgramId', '=', 't_program.ProgramId')
            ->join('t_gender', 't_students.GenderId', '=', 't_gender.GenderId')
             ->select(DB::raw('count(*) as rcount'))
            ->where(function($query) use ($ProgramId)
	          {
	            if($ProgramId != 0):
	               $query->Where('t_students.ProgramId','=', $ProgramId);
	            endif;
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('RegNo','like', '%' . $search . '%');
	               $query->orWhere('StudentCode','like', '%' . $search . '%');
	               $query->orWhere('StudentName','like', '%' . $search . '%');
	               $query->orWhere('Session','like', '%' . $search . '%');
	               $query->orWhere('Batch','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	               $query->orWhere('Gender','like', '%' . $search . '%');
	               $query->orWhere('Email','like', '%' . $search . '%');
	               $query->orWhere('Address','like', '%' . $search . '%');
	               $query->orWhere('NID','like', '%' . $search . '%');
	               $query->orWhere('Program','like', '%' . $search . '%');
	            endif;
	          })
            ->get();


		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];
		

		$posts = DB::table('t_students')
            ->join('t_program', 't_students.ProgramId', '=', 't_program.ProgramId')
            ->join('t_gender', 't_students.GenderId', '=', 't_gender.GenderId')
            ->select('t_students.*', 't_gender.Gender', 't_program.Program')
            ->where(function($query) use ($ProgramId)
	          {
	            if($ProgramId != 0):
	               $query->Where('t_students.ProgramId','=', $ProgramId);
	            endif;
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('RegNo','like', '%' . $search . '%');
	               $query->orWhere('StudentCode','like', '%' . $search . '%');
	               $query->orWhere('StudentName','like', '%' . $search . '%');
	               $query->orWhere('Session','like', '%' . $search . '%');
	               $query->orWhere('Batch','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	               $query->orWhere('Gender','like', '%' . $search . '%');
	               $query->orWhere('Email','like', '%' . $search . '%');
	               $query->orWhere('Address','like', '%' . $search . '%');
	               $query->orWhere('NID','like', '%' . $search . '%');
	               $query->orWhere('Program','like', '%' . $search . '%');
	            endif;
	          })
			  ->offset($start)
			->limit($limit)
			->orderByRaw("Program asc, StudentCode asc")
            ->get();

		$data = array();

		if($posts){
			
			$x = "<a class='task-del itmAccessEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Access</span></a>";
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['StudentsId'] = $r->StudentsId;
				$arr['Serial'] = $serial++;
				$arr['Program'] = $r->Program;
				$arr['StudentCode'] = $r->StudentCode;
				$arr['RegNo'] = $r->RegNo;
				$arr['StudentName'] = $r->StudentName;
				$arr['Batch'] = $r->Batch;
				$arr['Phone'] = $r->Phone;
				$arr['Email'] = $r->Email;
				$arr['action'] =$x.$y.$z;
				$arr['Gender'] = $r->Gender;
				$arr['Address'] = $r->Address;
				$arr['AdmissionDate'] = $r->AdmissionDate;
				$arr['Session'] = $r->Session;
				$arr['BirthDate'] = $r->BirthDate;
				$arr['NID'] = $r->NID;
				$arr['ProgramId'] = $r->ProgramId;
				$arr['GenderId'] = $r->GenderId;
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

/*
	public function GetFormattedDate($pDate) {
		$dateArr = explode('/',$pDate);//pDate.split("/");
		$dateDay = $dateArr[0];
		$dateMonth = $dateArr[1];
		$dateYear = $dateArr[2];

		return $dateYear . "/" . $dateMonth . "/" . $dateDay;
	}*/
//'AdmissionDate' => self::GetFormattedDate($request->input("AdmissionDate")),
//'BirthDate' => self::GetFormattedDate($request->input("BirthDate")),
     public function addEditStudent(Request $request){

		if($request->input("recordId") != ""){
			DB::table('users')
			->where('teacherstudentid', $request->input("recordId"))
			->where('userrole', 'Student')
			->update(['Email' => $request->input("Email")]);
		}

		/*when StudentsId already exist then  update otherwise insert*/
		DB::table('t_students')
		    ->updateOrInsert(
		        ['StudentsId' => $request->input("recordId")],

		        ['ProgramId' => $request->input("ProgramId"),
		        'RegNo' => $request->input("RegNo"),
		        'StudentCode' => $request->input("StudentCode"),
		        'StudentName' => $request->input("StudentName"),
		        'Session' => $request->input("Session"),
		        'Batch' => $request->input("Batch"),
		        'AdmissionDate' => $request->input("AdmissionDate"),
		        'BirthDate' => $request->input("BirthDate"),
		        'Phone' => $request->input("Phone"),
		        'GenderId' => $request->input("GenderId"),
		        'Email' => $request->input("Email"),
		        'Address' => $request->input("Address"),
		        'NID' => $request->input("NID")]
		    );
    }

    public function setStudentsAccess(Request $request){
		
		$teacherstudentid=0;
		$name='';
		$email='';
		$password='';

		$posts = DB::table('t_students')
            ->select('t_students.*')
            ->where('StudentsId', '=', $request->input("id"))
            ->get();

		if($posts){
			foreach($posts as $r){
				$teacherstudentid = $r->StudentsId;
				$name = $r->StudentName;
				$email = $r->Email;
				$password = $request->input("password");
			}
		}


		if(($teacherstudentid !=0) && ($name !='') && ($email !='') && ($password !='')){
			/*when id already exist then  update otherwise insert*/
			DB::table('users')
		    ->updateOrInsert(
		        ['teacherstudentid' => $teacherstudentid,
		        'userrole' => 'Student'],

		        ['name' => $name, 
		        'email' => $email,
		        'password' => Hash::make($password)]		       
		    );
		    
		    echo 1;
		}
    }
    

    public function deleteStudent(Request $request){
		$id = $request->input("id");

		$stddel = StudentsEntry::where('StudentsId',$id)->delete();
		
		if($stddel == 1){
			$userdel = UserEntry::where('teacherstudentid',$id)->where('userrole','Student')->delete();
		}
		return Response::json($stddel);
    }
}
 