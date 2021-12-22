<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\UserEntry;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserEntryController extends Controller
{
     function getUserData(Request $request){
/*
		//datatable column index => database column name. here considaer datatable visible and novisible column
		
		$columns = array(2=>'name',3=>'usercode',4=>'phone',5=>'email',6=>'userrole',7=>'activestatus');

		$totalData = UserEntry::count();
		$limit = $_POST['length'];
		$start = $_POST['start'];
		$order = $columns[$_POST['order'][0]['column']];
		$dir = $_POST['order'][0]['dir'];

		$search = $_POST['search']['value'];

		$posts = DB::table('users')
            ->select('id','name','usercode','email','userrole','activestatus','password','phone')
            ->where('name', 'LIKE', '%'.$search.'%')
			->orWhere('usercode', 'LIKE', '%'.$search.'%')
			->orWhere('phone', 'LIKE', '%'.$search.'%')
            ->orWhere('email', 'LIKE', '%'.$search.'%')
			->orWhere('userrole', 'LIKE', '%'.$search.'%')
			->orWhere('activestatus', 'LIKE', '%'.$search.'%')
			->offset($start)
			->limit($limit)
			->orderByRaw("$order $dir")
            ->get();

		$data = array();

		if($posts){

			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){
				$arr['id'] = $r->id;
				$arr['Serial'] = $serial++;
				$arr['name'] = $r->name;
				$arr['usercode'] = $r->usercode;
				$arr['phone'] = $r->phone;
				$arr['email'] = $r->email;
				$arr['userrole'] = $r->userrole;
				$arr['activestatus'] = $r->activestatus;
				$arr['action'] =$y.$z;
				$arr['password'] = $r->password;
				
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
		}*/
	}

     public function addEditUser(Request $request){
		$curDateTime = date ( 'Y-m-d H:i:s' );
		/*when id already exist then  update otherwise insert*/
		/*DB::table('users')
		    ->updateOrInsert(
		        ['id' => $request->input("recordId")],

		        ['name' => $request->input("name"), 
		        'usercode' => $request->input("usercode"), 
		        'phone' => $request->input("phone"), 
		        'email' => $request->input("email"),
		        'userrole' => $request->input("userrole"),
		        'activestatus' => $request->input("activestatus"),
		        'password' => Hash::make($request->input("password")),
		        'LastPostViewDate' => $curDateTime]		       
		    );*/
    }

     public function editUser(Request $request){

		/*when id already exist then  update otherwise insert*/
		/*DB::table('users')
		    ->updateOrInsert(
		        ['id' => $request->input("recordIdedit")],

		        ['name' => $request->input("nameedit"), 
		        'usercode' => $request->input("usercodeedit"), 
		        'phone' => $request->input("phoneedit"), 
		        'email' => $request->input("emailedit"),
		        'userrole' => $request->input("userroleedit"),
		        'activestatus' => $request->input("activestatusedit")]		       
		    );*/
    }

	 public function deleteUser(Request $request){
		/*$id = $request->input("id");

		$user = UserEntry::where('id',$id)->delete();
		return Response::json($user);*/
    }

}
