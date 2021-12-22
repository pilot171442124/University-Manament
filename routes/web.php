<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

/*Index page*/
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth'); //when not login then redirect to login page



/**dashboard route*/
Route::get('/dashboard/', function () {
    return view('dashboard');
})->middleware('auth'); //when not login then redirect to login page
/*get dashboard basic info*/
Route::post('/getDashboardBasicInfoRoute', 'CommonController@getDashboardBasicInfo');
/*get dashboard student by gender*/
Route::post('/getPieByGenderDataRoute', 'CommonController@getPieByGenderData');
/*get dashboard admitted student by year*/
Route::post('/getStudentAdmitTrendDataRoute', 'CommonController@getStudentAdmitTrendData');



/**attDetails route*/
Route::get('/attendancedetailsreport/', function () {
    return view('attendancedetailsreport');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('attendancedetailsreport','AttendanceDetailsReportController@getAttendanceDetailsReportData')->name('attDetailsTblMain');




/**Online class entry route*/
Route::get('/onlineclassentry/', function () {
    return view('onlineclassentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('onlineclassentry','ClassEntryController@getClassData')->name('classListTblMain');
/*add or edit*/
Route::post('/addEditClassRoute', 'ClassEntryController@addEditClass');
/*delete data*/
Route::post('/deleteClassRoute', 'ClassEntryController@deleteClass');




/**Notice class entry route*/
Route::get('/noticeentry/', function () {
    return view('noticeentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('noticeentry','NoticeEntryController@getNoticeData')->name('noticeListTblMain');
/*add or edit*/
Route::post('/addEditNoticeRoute', 'NoticeEntryController@addEditNotice');
/*file upload*/
Route::post('/fileUploadNoticeRoute', 'NoticeEntryController@fileUpload');
/*delete data*/
Route::post('/deleteNoticeRoute', 'NoticeEntryController@deleteNotice');

//

/**onlineadmissionapplicants form route*/
Route::get('/onlineadmissionapplicants/', function () {
    return view('onlineadmissionapplicants');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('onlineadmissionapplicants','AdmissionFormController@getAdmissionFormData')->name('admissionFormListTblMain');



/**Addmission form route*/
Route::get('/admissionform/', function () {
    return view('admissionform');
})->middleware('auth'); //when not login then redirect to login page
/*add or edit*/
Route::post('/addEditAdmissionFormSubmitRoute', 'AdmissionFormController@addEditAdmissionFormSubmit');






/**programentry route*/
Route::get('/programentry/', function () {
    return view('programentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('programentry','ProgramEntryController@getProgramData')->name('programListTblMain');
/*add or edit*/
Route::post('/addEditProgramRoute', 'ProgramEntryController@addEditProgram');
/*delete data*/
Route::post('/deleteProgramRoute', 'ProgramEntryController@deleteProgram');




/**subject entry route*/
Route::get('/subjectentry/', function () {
    return view('subjectentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('subjectentry','SubjectEntryController@getSubjectData')->name('subjectListTblMain');
/*add or edit*/
Route::post('/addEditSubjectRoute', 'SubjectEntryController@addEditSubject');
/*delete data*/
Route::post('/deleteSubjectRoute', 'SubjectEntryController@deleteSubject');



/**designation entry route*/
Route::get('/designationentry/', function () {
    return view('designationentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('designationentry','DesignationEntryController@getDesignationData')->name('designationListTblMain');
/*add or edit*/
Route::post('/addEditDesignationRoute', 'DesignationEntryController@addEditDesignation');
/*delete data*/
Route::post('/deleteDesignationRoute', 'DesignationEntryController@deleteDesignation');


/**Teachers entry route*/
Route::get('/teachersentry/', function () {
    return view('teachersentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('teachersentry','TeachersEntryController@getTeacherData')->name('teachersListTblMain');
/*add or edit*/
Route::post('/addEditTeachersRoute', 'TeachersEntryController@addEditTeacher');
/*delete data*/
Route::post('/deleteTeachersRoute', 'TeachersEntryController@deleteTeacher');
/*access data*/
Route::post('/setTeacherAccessRoute', 'TeachersEntryController@setTeacherAccess');



/**Students entry route*/
Route::get('/studentsentry/', function () {
    return view('studentsentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('studentsentry','StudentsEntryController@getStudentsData')->name('studentsListTblMain');
/*add or edit*/
Route::post('/addEditStudentsRoute', 'StudentsEntryController@addEditStudent');
/*delete data*/
Route::post('/deleteStudentsRoute', 'StudentsEntryController@deleteStudent');
/*access data*/
Route::post('/setStudentsAccessRoute', 'StudentsEntryController@setStudentsAccess');





/**yearentry route*/
Route::get('/yearentry/', function () {
    return view('yearentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('yearentry','YearEntryController@getYearData')->name('yearListTblMain');
/*add or edit*/
Route::post('/addEditYearRoute', 'YearEntryController@addEditYear');
/*delete data*/
Route::post('/deleteYearRoute', 'YearEntryController@deleteYear');


/**studentregistration route*/
Route::get('/studentregistration/', function () {
    return view('studentregistration');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('studentregistration','StudentRegistrationController@getStudentRegistrationData')->name('studentregistrationTblMain');
/*add or edit*/
Route::post('/addEditstudentregistrationRoute', 'StudentRegistrationController@addEditStudentRegistration');
/*add or edit*/
Route::post('/editstudentregistrationRoute', 'StudentRegistrationController@getSubjectsControls');
/*delete data*/
Route::post('/deleteStudentRegistrationRoute', 'StudentRegistrationController@deleteStudentRegistration');


/**attendance entry route*/
Route::get('/attendanceentry/', function () {
    return view('attendanceentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('attendanceentry','AttendanceEntryController@getAttendanceData')->name('attendanceListTblMain');
/*add or edit*/
Route::post('/addAttendanceMasterItemsRoute', 'AttendanceEntryController@addAttendanceMasterItems');
/*delete data*/
Route::post('/deleteAttendanceRoute', 'AttendanceEntryController@deleteAttendance');
/*data fetch for datatable items*/
Route:: post('/attendanceentryItemRoute','AttendanceEntryController@getAttendanceItemData');
/*update items*/
Route:: post('/updateAttendanceStatusRoute','AttendanceEntryController@updateAttendanceStatus');


/**Examination entry route*/
Route::get('/examinationentry/', function () {
    return view('examinationentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('examinationentry','ExaminationEntryController@getExaminationData')->name('examinationListTblMain');
/*add or edit*/
Route::post('/addEditExaminationRoute', 'ExaminationEntryController@addEditExamination');
/*delete data*/
Route::post('/deleteExaminationRoute', 'ExaminationEntryController@deleteExamination');



/**examinationmarks entry route*/
Route::get('/examinationmarksentry/', function () {
    return view('examinationmarksentry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('examinationmarksentry','ExaminationMarksEntryController@getMarksData')->name('getMarksDataListTblMain');
/*add or edit*/
Route::post('/addExaminationMasterItemsRoute', 'ExaminationMarksEntryController@addExaminationMasterItems');
/*delete data*/
Route::post('/deleteExaminationMarksRoute', 'ExaminationMarksEntryController@deleteExaminationMarks');
/*data fetch for datatable items*/
Route:: post('/examinationmarksentryItemRoute','ExaminationMarksEntryController@getExaminationItemData');
/*update items*/
Route:: post('/updateExaminationItemMarksRoute','ExaminationMarksEntryController@updateExaminationItemMarks');






/**Online class entry route*/
Route::get('/paymententry/', function () {
    return view('paymententry');
})->middleware('auth'); //when not login then redirect to login page
/*data fetch for datatable*/
Route:: post('paymententry','PaymentEntryController@getPaymentData')->name('paymentListTblMain');
/*add or edit*/
Route::post('/addEditPaymentRoute', 'PaymentEntryController@addEditPayment');
/*delete data*/
Route::post('/deletePaymentRoute', 'PaymentEntryController@deletePayment');









 
/*Authentication*/
Route::get('logout', 'Auth\LoginController@logout');






/*CommonController*/
/*get Designation*/
Route::post('/getDesignationListRoute', 'CommonController@getDesignationList');
/*get ProgramList*/
Route::post('/getProgramListRoute', 'CommonController@getProgramList');
/*get GenderList*/
Route::post('/getGenderListRoute', 'CommonController@getGenderList');
/*get year list*/
Route::post('/getYearListRoute', 'CommonController@getYearList');
/*get semester list*/
Route::post('/getSemesterListRoute', 'CommonController@getSemesterList');
/*get Subject list*/
Route::post('/getSubjectListRoute', 'CommonController@getSubjectList');
/*get Student list*/
Route::post('/getStudentListRoute', 'CommonController@getStudentList');
/*get Exam list*/
Route::post('/getExaminationListRoute', 'CommonController@getExaminationList');









Auth::routes();