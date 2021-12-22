<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class CommonController extends Controller
{
  


  public function getDesignationList()
  {
 
    $posts = DB::table('t_designation')
            ->select('DesignationId', 'Designation')
            ->orderByRaw("Designation asc")
            ->get();

         return $posts;
  }


  public function getProgramList()
  {
 
    $posts = DB::table('t_program')
            ->select('ProgramId', 'Program')
            ->orderByRaw("Program asc")
            ->get();

         return $posts;
  }


  public function getGenderList()
  {
 
    $posts = DB::table('t_gender')
            ->select('GenderId', 'Gender')
            ->orderByRaw("Gender asc")
            ->get();

         return $posts;
  }

  public function getYearList()
  {
 
    $posts = DB::table('t_year')
            ->select('YearId', 'Year')
            ->orderByRaw("Year desc")
            ->get();

         return $posts;
  }

  public function getSemesterList()
  {
 
    $posts = DB::table('t_semester')
          ->select('SemesterId', 'Semester')
            ->orderByRaw("Semester desc")
            ->get();

         return $posts;
  }

  public function getSubjectList()
  {
 
    $posts = DB::table('t_subjects')
            //->select('SubjectId', 'SubjectName')
          ->select(DB::raw("SubjectId,CONCAT(SubjectCode,' ',SubjectName) as SubjectName"))
            ->orderByRaw("SubjectCode asc")
            ->get();

         return $posts;
  }

  public function getStudentList()
  {
 
    $posts = DB::table('t_students')
           //->select('StudentsId', 'StudentName')
            ->select(DB::raw("StudentsId,CONCAT(StudentCode,' ',StudentName) as StudentName"))
            ->orderByRaw("StudentName asc")
            ->get();

         return $posts;
  }


  public function getExaminationList()
  {
 
    $posts = DB::table('t_examination')
            ->select('ExamId', 'ExamName')
            ->orderByRaw("ExamName asc")
            ->get();

         return $posts;
  }



  /*For dashbard*/
  public function getDashboardBasicInfo()
  {
 
    $basicInfo = array("gTeachersCount"=>0,"gStudentCount"=>0,"gProgramCount"=>0,"gSubjectCount"=>0);


    $rowTotalObj = DB::table('t_teachers')
                     ->select(DB::raw('count(*) as rcount'))
                     ->get();
    $basicInfo['gTeachersCount'] = $rowTotalObj[0]->rcount;
    

    $rowTotalObj = DB::table('t_students')
                     ->select(DB::raw('count(*) as rcount'))
                     ->get();
    $basicInfo['gStudentCount'] = $rowTotalObj[0]->rcount;
    

    $rowTotalObj = DB::table('t_program')
                     ->select(DB::raw('count(*) as rcount'))
                     ->get();
    $basicInfo['gProgramCount'] = $rowTotalObj[0]->rcount;
    

    $rowTotalObj = DB::table('t_subjects')
                     ->select(DB::raw('count(*) as rcount'))
                     ->get();
    $basicInfo['gSubjectCount'] = $rowTotalObj[0]->rcount;
    
    return $basicInfo;
  }

  public function getPieByGenderData()
  {
 

    $posts = DB::table('t_students')
      ->join('t_gender', 't_students.GenderId', '=', 't_gender.GenderId')
      ->select(DB::raw("t_gender.`Gender`,COUNT(t_students.`StudentsId`) AS StudentCount"))
      ->groupByRaw("t_gender.Gender")
      //->tosql();
      ->get();


    $colors = array('#492970','#1aadce', '#2f7ed8', '#0d233a', '#8bbc21', '#910000',  '#f28f43', '#77a1e5', '#c42525', '#a6c96a');
    $dataList = array("name"=>"Students","data"=>array());
    $idx=0;
    foreach($posts as $r){
      settype($r->StudentCount,"int");
      
      $dataList["data"][]=array("name"=>$r->Gender,"color"=>$colors[$idx],"y"=>$r->StudentCount);
      $idx++;   
    }
    
    $output = array($dataList);
    return $output;//json_encode($output);

  }



  public function getStudentAdmitTrendData()
  {

    $posts = DB::table('t_students')
      ->select(DB::raw("YEAR(`AdmissionDate`) AS AdmittedYear,COUNT(`StudentsId`) AS StudentCount"))
      ->groupByRaw("YEAR(`AdmissionDate`)")
      //->tosql();
      ->get();


    $category = array();
    $series = array("name"=>"Students","data"=>array(),"color"=>"green");

    foreach($posts as $r){
      $category[] = $r->AdmittedYear;

      settype($r->StudentCount,"int");
      $series["data"][] = $r->StudentCount;
    }
    
    $output = array();
    $output["category"] = $category;
    $output["series"][] = $series;
    
    return $output;//json_encode($output);

  }

}
