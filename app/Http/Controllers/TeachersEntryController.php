<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\TeachersEntry;
use DB;
use Illuminate\Support\Facades\Hash;

class TeachersEntryController extends Controller
{
	
	function getTeacherData(Request $request){

		$DesignationId = $_POST['DesignationId'];
		//echo "ID:".$DesignationId;

		//datatable column index => database column name. here considaer datatable visible and novisible column
		$columns = array(2=>'Designation',3=>'TeacherCode',4=>'TeacherName',5=>'Phone',6=>'Email');

		$search = $_POST['search']['value'];

		$rowTotalObj = DB::table('t_teachers')
            ->join('t_designation', 't_teachers.DesignationId', '=', 't_designation.DesignationId')
            ->select(DB::raw('count(*) as rcount'))
            ->where(function($query) use ($DesignationId)
	          {
	            if($DesignationId != 0):
	               $query->Where('t_teachers.DesignationId','=', $DesignationId);
	            endif;
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('TeacherCode','like', '%' . $search . '%');
	               $query->orWhere('TeacherName','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	               $query->orWhere('Email','like', '%' . $search . '%');
	               $query->orWhere('NID','like', '%' . $search . '%');
	               $query->orWhere('Address','like', '%' . $search . '%');
	               $query->orWhere('Designation','like', '%' . $search . '%');
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];
		

		$posts = DB::table('t_teachers')
            ->join('t_designation', 't_teachers.DesignationId', '=', 't_designation.DesignationId')
            ->select('t_teachers.*', 't_designation.DesignationId', 't_designation.Designation')
            ->where(function($query) use ($DesignationId)
	          {
	            if($DesignationId != 0):
	               $query->Where('t_teachers.DesignationId','=', $DesignationId);
	            endif;
	          })
	        ->where(function($query) use ($search)
	          {
	            if(!empty($search)):
	               $query->Where('TeacherCode','like', '%' . $search . '%');
	               $query->orWhere('TeacherName','like', '%' . $search . '%');
	               $query->orWhere('Phone','like', '%' . $search . '%');
	               $query->orWhere('Email','like', '%' . $search . '%');
	               $query->orWhere('NID','like', '%' . $search . '%');
	               $query->orWhere('Address','like', '%' . $search . '%');
	               $query->orWhere('Designation','like', '%' . $search . '%');
	            endif;
	          })
			  ->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();

		$data = array();

		if($posts){
			$x = "<a class='task-del itmAccessEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-primary'>Access</span></a>";
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['TeachersId'] = $r->TeachersId;
				$arr['Serial'] = $serial++;
				$arr['Designation'] = $r->Designation;
				$arr['TeacherCode'] = $r->TeacherCode;
				$arr['TeacherName'] = $r->TeacherName;
				$arr['Phone'] = $r->Phone;
				$arr['Email'] = $r->Email;
				$arr['action'] =$x.$y.$z;
				$arr['Address'] = $r->Address;
				$arr['NID'] = $r->NID;
				$arr['DesignationId'] = $r->DesignationId;
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

     public function addEditTeacher(Request $request){

		if($request->input("recordId") != ""){
			DB::table('users')
			->where('teacherstudentid', $request->input("recordId"))
			->where('userrole', 'Teacher')
			->update(['Email' => $request->input("Email")]);
		}

		/*when TeachersId already exist then  update otherwise insert*/
		DB::table('t_teachers')
		    ->updateOrInsert(
		        ['TeachersId' => $request->input("recordId")],

		        ['DesignationId' => $request->input("DesignationId"),
		        'TeacherCode' => $request->input("TeacherCode"),
		        'TeacherName' => $request->input("TeacherName"),
		        'Phone' => $request->input("Phone"),
		        'Email' => $request->input("Email"),
		        'Address' => $request->input("Address"),
		        'NID' => $request->input("NID")]
		    );
    }


    public function setTeacherAccess(Request $request){
		
		$teacherstudentid=0;
		$name='';
		$email='';
		$password='';

		$posts = DB::table('t_teachers')
            ->select('t_teachers.*')
            ->where('TeachersId', '=', $request->input("id"))
            ->get();

		if($posts){
			foreach($posts as $r){
				$teacherstudentid = $r->TeachersId;
				$name = $r->TeacherName;
				$email = $r->Email;
				$password = $request->input("password");
			}
		}


		if(($teacherstudentid !=0) && ($name !='') && ($email !='') && ($password !='')){
			/*when id already exist then  update otherwise insert*/
			DB::table('users')
		    ->updateOrInsert(
		        ['teacherstudentid' => $teacherstudentid,
		        'userrole' => 'Teacher'],

		        ['name' => $name, 
		        'email' => $email,
		        'password' => Hash::make($password)]		       
		    );
		    
		    echo 1;
		}
    }
    

    public function deleteTeacher(Request $request){
		$id = $request->input("id");

		$stddel = TeachersEntry::where('TeachersId',$id)->delete();

		if($stddel == 1){
			$userdel = UserEntry::where('teacherstudentid',$id)->where('userrole','Teacher')->delete();
		}
		
		return Response::json($stddel);
    }
}
