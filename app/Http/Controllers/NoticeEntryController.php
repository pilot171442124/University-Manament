<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect,Response;
use App\NoticeEntry;
use DB;

class NoticeEntryController extends Controller
{
    function getNoticeData(Request $request){
		
		$TypeId = $_POST['TypeId'];
		$search = $_POST['search']['value'];

        $rowTotalObj = DB::table('t_notice')
            ->select(DB::raw('count(*) as rcount'))
            ->where(function($query) use ($TypeId)
	          {
	            if($TypeId != 0):
	               $query->Where('t_notice.TypeId','=', $TypeId);
	            endif;
	          })
            ->where(function($query) use ($search)
	              {
	                if(!empty($search)):
	                   $query->Where('NoticeTitle','like', '%' . $search . '%');
	                endif;
	              })
            ->get();

		$totalData = $rowTotalObj[0]->rcount;

		
		$limit = $_POST['length'];
		$start = $_POST['start'];

		$posts = DB::table('t_notice')
            ->select(DB::raw("t_notice.`NoticeId`, t_notice.`NoticeDate`, t_notice.`NoticeTitle`, t_notice.`NoticeURL`,t_notice.TypeId"))
            ->where(function($query) use ($TypeId)
	          {
	            if($TypeId != '0'):
	               $query->Where('t_notice.TypeId','=', $TypeId);
	            endif;
	          })
            ->where(function($query) use ($search)
	              {
	                if(!empty($search)):
	                   $query->Where('NoticeTitle','like', '%' . $search . '%');
	                endif;
	              })
			->offset($start)
			->limit($limit)
			->orderByRaw("t_notice.NoticeDate DESC,t_notice.`NoticeTitle`")
            //->tosql();
           ->get();

		$data = array();

		if($posts){

			$fileNot = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-upload'></i></span></a>";
			$fileExist = "<a class='task-del fileUpload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-file-pdf-o'></i></span></a>";
			
			$fileDown = "<a class='task-del fileDownload'  href='javascript:void(0);'><span class='label label-lemon'><i class='fa fa-download'></i> Download</span></a>";
				
			$y = "<a class='task-del itmEdit' style='margin-left:4px' href='javascript:void(0);'><span class='label label-info'>Edit</span></a>";
			$z = "<a class='task-del itmDrop' style='margin-left:4px' href='javascript:void(0);'><span class='label label-danger'>Delete</span></a>";
			
			$serial = $_POST['start'] + 1;
			foreach($posts as $r){

				$NoticeDate = date("Y/m/d", strtotime($r->NoticeDate));

				$arr['NoticeId'] = $r->NoticeId;
				$arr['Serial'] = $serial++;
				$arr['NoticeDate'] =$NoticeDate;
				$arr['TypeId'] = $r->TypeId;
				$arr['NoticeTitle'] = $r->NoticeTitle;


				if($r->NoticeURL == ""){
					$arr['FileLink'] = "";
					$arr['action'] =$fileNot.$y.$z;
				}
				else{
					$arr['FileLink'] = $fileDown;
					$arr['action'] =$fileExist.$y.$z;
				}
			
				$arr['NoticeURL'] = $r->NoticeURL;
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

 public function addEditNotice(Request $request){

		/*when NoticeId already exist then  update otherwise insert*/
		DB::table('t_notice')
		    ->updateOrInsert(
		        ['NoticeId' => $request->input("recordId")],
		        ['NoticeDate' => $request->input("NoticeDate"),
		        'TypeId' => $request->input("TypeId"),
		    	'NoticeTitle' => $request->input("NoticeTitle")] 	
		    );
    }

 	public function fileUpload(Request $request){

		$NoticeId = $request->input('idFileUp');
		$filePath = $request->file('file')->store('bookfile');

		DB::table('t_notice')
		->where('NoticeId', $NoticeId)
		->update(['NoticeURL' => $filePath]);
    }

public function deleteNotice(Request $request){
		$id = $request->input("id");

		$obj = NoticeEntry::where('NoticeId',$id)->delete();
		return Response::json($obj);
    }
}
