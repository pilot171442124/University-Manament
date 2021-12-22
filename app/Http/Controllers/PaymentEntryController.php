<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\PaymentEntry;
use DB;

class PaymentEntryController extends Controller
{
    
    function getPaymentData(Request $request){


		$YearId = $_POST['YearId'];
		$SemesterId = $_POST['SemesterId'];
		$StudentsId = $_POST['StudentsId'];

		$rowTotalObj = DB::table('t_payment')
           	->select(DB::raw('count(*) as rcount'))
           	->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_payment.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_payment.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($StudentsId)
	          {
	            if($StudentsId > 0):
	               $query->Where('t_payment.StudentsId','=', $StudentsId);
	            endif;
	          })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];
		//$order = $columns[$_POST['order'][0]['column']];
		//$dir = $_POST['order'][0]['dir'];


		$posts = DB::table('t_payment')
            ->join('t_students', 't_payment.StudentsId', '=', 't_students.StudentsId')

            ->select(DB::raw("t_payment.`PaymentId`,t_payment.`YearId`,t_payment.`SemesterId`,
            	t_payment.`StudentsId`,t_payment.`PaymentDate`,t_payment.Amount,
				concat(t_students.StudentCode,' ',t_students.StudentName) AS StudentName"))
            
            ->where(function($query) use ($YearId)
	          {
	            if($YearId > 0):
	               $query->Where('t_payment.YearId','=', $YearId);
	            endif;
	          })
            ->where(function($query) use ($SemesterId)
	          {
	            if($SemesterId > 0):
	               $query->Where('t_payment.SemesterId','=', $SemesterId);
	            endif;
	          })
            ->where(function($query) use ($StudentsId)
	          {
	            if($StudentsId > 0):
	               $query->Where('t_payment.StudentsId','=', $StudentsId);
	            endif;
	          })
			->offset($start)
			->limit($limit)
			->orderByRaw("t_payment.PaymentDate DESC,t_students.`StudentCode`")
            //->tosql();
            ->get();

		$data = array();

		if($posts){

			//$x = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				$PaymentDate = date("Y/m/d", strtotime($r->PaymentDate));

				$arr['PaymentId'] = $r->PaymentId;
				$arr['Serial'] = $serial++;
				$arr['PaymentDate'] =$PaymentDate;
				$arr['StudentName'] = $r->StudentName;
				$arr['Amount'] = $r->Amount;
				$arr['action'] = $y .$z;
				$arr['YearId'] = $r->YearId;
				$arr['SemesterId'] = $r->SemesterId;
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

 public function addEditPayment(Request $request){

		/*when ClassId already exist then  update otherwise insert*/
		DB::table('t_payment')
		    ->updateOrInsert(
		        ['PaymentId' => $request->input("recordId")],
		        ['YearId' => $request->input("YearId"),
		    	'SemesterId' => $request->input("SemesterId"),
		    	'StudentsId' => $request->input("StudentsId"),
		    	'PaymentDate' => $request->input("PaymentDate"),
		    	'Amount' => $request->input("Amount")] 	
		    );
    }

public function deletePayment(Request $request){
		$id = $request->input("id");

		$obj = PaymentEntry::where('PaymentId',$id)->delete();
		return Response::json($obj);
    }



}
