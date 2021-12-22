@extends('umslayout')
@section('titlename') Dashboard @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Dashboard</h3>
            </div>
            <div class="col-lg-6">
				<ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Dashboard</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             
				<div class="row">
					<div class="col-lg-3">
						<div class="ibox ">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalTeachers"></h1>
								<div class="stat-percent font-bold text-success"><i class="fa fa-users"></i></div>
								<span class="no-margins">Total Teachers</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalStudents"></h1>
								<div class="stat-percent font-bold text-warning"><i class="fa fa-users"></i></div>
								<span class="no-margins">Total Students</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalPrograms"></h1>
								<div class="stat-percent font-bold text-info"><i class="fa fa-star"></i></div>
								<span class="no-margins">Total Programs</span>
							</div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="ibox">
							<div class="ibox-content">
								<h1 class="no-margins" id="totalSubjects"></h1>
								<div class="stat-percent font-bold text-green"><i class="fa fa-book"></i></div>
								<span>Total Subjects</span>
							</div>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-6">
						<div class="ibox ">
							<div class="ibox-content">
								<div id="studentsbygender"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="ibox ">
							<div class="ibox-content">
								<div id="admittedstudenttrend"></div>
							</div>
						</div>
					</div>
				</div>	





        </div>
 @endsection

@section('extralibincludefooter')
   <!-- Highchart -->
	<script src="{{ asset('public/js/plugins/highchart/highcharts.js') }}" crossorigin="anonymous"></script>
	<script src="{{ asset('public/js/plugins/highchart/exporting.js') }}" crossorigin="anonymous"></script>
@endsection


@section('customjs')
<script>
    var tableMain;
    var SITEURL = '{{URL::to('')}}';

    var tableMain;
	var recordId="";
	var ProgramId = 0;

	

function getDashboardBasicInfo() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getDashboardBasicInfoRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$("#totalTeachers").html(response.gTeachersCount);
				$("#totalStudents").html(response.gStudentCount);
				$("#totalPrograms").html(response.gProgramCount);
				$("#totalSubjects").html(response.gSubjectCount);
	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Can not fillup");

				}, 1300);

	        }

	    });
	}



	function getPieByGenderData(){


		$.ajax({
	        type: "post",
	        url: SITEURL+"/getPieByGenderDataRoute",
	        data: {
	        	"id":1,
	    		"_token":$('meta[name="csrf-token"]').attr('content')
	    	},
	        success:function(response){


				$("#studentsbygender").highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: 'pie',
						height:350
					},
					title: {
						text: 'Student count by gender'
					},
					tooltip: {
						pointFormat: '{series.name}: <b> {point.y} ({point.percentage:.1f}%)</b>'
					},
					exporting: {
								filename: "Students_count_by_gender"
							},
					accessibility: {
						point: {
							valueSuffix: '%'
						}
					},
					credits: {
							enabled: false
						},
					plotOptions: {
						pie: {
						   allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
							   enabled: true,
								format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
							}
						}
					},
					series:response
					/*  [{
						"name": 'Students',
						//colorByPoint: true,
						"data": [{
							"name": 'Female',
							"color": '#492970',
							"y": 30
						}, {
							"name": 'Male',
							"color": '#1aadce',
							"y": 70
						}]
					}] */
				});


	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Can not fillup");

				}, 1300);

	        }

	    });


	}



	function getStudentAdmitTrendData(){


		$.ajax({
	        type: "post",
	        url: SITEURL+"/getStudentAdmitTrendDataRoute",
	        data: {
	        	"id":1,
	    		"_token":$('meta[name="csrf-token"]').attr('content')
	    	},
	        success:function(response){


				$("#admittedstudenttrend").highcharts({
				chart: {
						type: "spline",
						height:350
					},
				title: {
					text: "Student Admitted by Year"
				},
				// subtitle: {
					// text: $("#StartDate").val()+" to "+$("#EndDate").val()+" and Accounts Head: "+$('#CarId').find(":selected").text()
				// },
				yAxis: {
					//gridLineWidth: 0,
					title: {
						text: 'Number of admitted students'
					}
				},
				xAxis: {
					// categories: ["1 Aug 18", "2 Aug 18", "3 Aug 18", "4 Aug 18", "5 Aug 18", "6 Aug 18", "7 Aug 18", "8 Aug 18"]
					categories: response.category
					,labels: {
								 //enabled:false,//default is true
								 y : 20, rotation: -45, align: 'right' 
							}
				},
				legend: {
					layout: 'horizontal'
				},
				credits: {
						enabled: false
					},
				exporting: {
						filename: "Student_admitted_by_year"
					},
				tooltip: {
					shared: true,
					crosshairs: true
				},
				plotOptions: {
					series: {
						label: {
							connectorAllowed: false
						},
						marker: {
							//fillColor: '#FFFFFF',
							lineWidth: 1//,
							//lineColor: null // inherit from series
						}
					}
				},
				series: response.series
			});


	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Can not fillup");

				}, 1300);

	        }

	    });


	}
    $(document).ready(function() {
	    /***Menu Active***/
		$( ".dashboard-menu" ).addClass( "active" );

		getDashboardBasicInfo();
		getPieByGenderData();
		getStudentAdmitTrendData();
 
    });





</script>
 @endsection