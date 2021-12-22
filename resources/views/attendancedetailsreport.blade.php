@extends('umslayout')
@section('titlename') Student Entry @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Attendance Details</h3>
            </div>
            <div class="col-lg-6">
				<ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>Reports</strong>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Attendance Details</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             

			<div class="row border-bottom white-bg dashboard-header form-group" id="filterCriteria">
				<label class="col-lg-1 col-form-label">Year</label>
				<div class="col-lg-2">
					<select data-placeholder="Choose a Year..." class="chosen-select" id="fYearId">
						<!--<option value="0">All Year</option>-->
					</select>
				</div>
				
				<label class="col-lg-1 col-form-label">Semester</label>
				<div class="col-lg-2">
					<select data-placeholder="Choose a Semester..." class="chosen-select" id="fSemesterId">
						<!--<option value="0">All Semester</option>-->
					</select>
				</div>
				
				<label class="col-lg-1 col-form-label">Subject</label>
				<div class="col-lg-5">
					<select data-placeholder="Choose a Subject..." class="chosen-select" id="fSubjectId">
						<option value="0">All Subject</option>
					</select>
				</div>
			</div>
			
            <div class="row" id="list-panel">
                <div class="col-lg-12">
					<div class="ibox ">
						<div class="ibox-title">
							<h5>Daily Attendance</h5>
								<div class="ibox-tools">
									<!--<button class="btn btn-success btn-sm" type="button" onclick=" "><i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;<span class="bold">Export</span></button>-->
								</div>
						</div>
						<div class="ibox-content">
							<div class="table-responsive">
								<table id="tableMain" class="table table-striped table-bordered display table-hover" >
									<thead>
										<tr>
											<th>Serial</th>
											<th>Student Code</th>
											<th>Student Name</th>
											<th>Total Class</th>
											<th>Absence</th>
											<th>Present</th>
											<th>Present(%)</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>






        </div>
 @endsection



@section('customjs')
<script>
    var tableMain;
    var SITEURL = '{{URL::to('')}}';

    var tableMain;
	var recordId="";
	var filtercount=0;

	function getYearList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getYearListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#fYearId").append($('<option></option>').val(obj.YearId).html(obj.Year));
				});
				$("#fYearId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>2){
					getTableMainData();
				}
	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Dropdown can not fillup");

				}, 1300);

	        }

	    });
	}



function getSemesterList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getSemesterListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#fSemesterId").append($('<option></option>').val(obj.SemesterId).html(obj.Semester));
				});
				$("#fSemesterId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>2){
					getTableMainData();
				}
	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Dropdown can not fillup");

				}, 1300);

	        }

	    });
	}


function getSubjectList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getSubjectListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#fSubjectId").append($('<option></option>').val(obj.SubjectId).html(obj.SubjectName));
				});
				$("#fSubjectId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>2){
					getTableMainData();
				}
	        },
	        error:function(error){
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Dropdown can not fillup");

				}, 1300);

	        }

	    });
	}
    $(document).ready(function() {

		getYearList();
		getSemesterList();
		getSubjectList();

	    /***Menu Active***/
		$( ".reports-menu" ).addClass( "active" );
		$( ".reports-menu ul" ).addClass( "in" );
		$( ".reports-menu ul" ).attr("aria-expanded", "true");
		$( ".attendance-report-menu" ).addClass( "active" );


		$('.chosen-select').chosen({width: "100%"});

		$("#fYearId,#fSemesterId,#fSubjectId").change(function () {
	        getTableMainData();
	    });
 
    });



    function getTableMainData(){
    	tableMain = $("#tableMain").dataTable({
		    "bFilter" : false,
		    "bDestroy": true,
			"bAutoWidth": false,
		    "bJQueryUI": true,      
		    "bSort" : false,
		    "bInfo" : false,
		    "bPaginate" : false,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
		    "aaSorting" : [[2, 'asc']],
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('attDetailsTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"YearId" : $('#fYearId').val(),
		        	"SemesterId" : $('#fSemesterId').val(),
		        	"SubjectId" : $('#fSubjectId').val(),
		        	"_token" : $('meta[name="csrf-token"]').attr('content')		        	
		    		}
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }
		        },
		    "columns":[
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"StudentCode","sWidth": "15%"},
		        {"data":"StudentName","sWidth": "40%"},
		        {"data":"TotalClass","sWidth": "10%","sClass": "dt-right"},
		        {"data":"Present","sWidth": "10%","sClass": "dt-right"},
		        {"data":"Absence","sWidth": "10%","sClass": "dt-right"},
		        {"data":"PresentPercent","sWidth": "10%","sClass": "dt-right"}
		    ]
		});
    }
</script>
 @endsection