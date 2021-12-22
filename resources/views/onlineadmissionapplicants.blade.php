@extends('umslayout')
@section('titlename') Online Admission Applicants @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Online Admission Applicants</h3>
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
                        <strong>Online Admission Applicants</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             
			<div id="list-panel">

				<div class="row">		
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

					<label class="col-lg-1 col-form-label">Program</label>
					<div class="col-lg-2">
						<select data-placeholder="Choose a Program..." class="chosen-select" id="fProgramId">
							<!--<option value="0">All Program</option>-->
						</select>
					</div>

					<label class="col-lg-1"></label>
				</div>	


				
	            <div class="row">

	                <div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Online Admission Applicants List</h5>
									<div class="ibox-tools">
										<!--<button class="btn btn-info btn-sm" type="button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add</span></button>-->
									</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="tableMain" class="table table-striped table-bordered display table-hover" >
										<thead>
											<tr>
												<th style="display:none;">FormId</th>
												<th>Serial</th>
												<th>Student Name</th>
												<th>Gender</th>
												<th>Phone</th>
												<th>Email</th>
												<th>SSC GPA</th>
												<th>SSC Board</th>
												<th>HSC GPA</th>
												<th>HSC College</th>
												<th>Apply Date</th>
												<th style="display:none;">Action</th>
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


        </div>
 @endsection



@section('customjs')
<script>
    var tableMain;
    var SITEURL = '{{URL::to('')}}';

    var tableMain;
	var recordId="";
	var filtercount = 0;


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
					$("#YearId").append($('<option></option>').val(obj.YearId).html(obj.Year));
				});
				$("#fYearId,#YearId").trigger("chosen:updated");

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
					$("#SemesterId").append($('<option></option>').val(obj.SemesterId).html(obj.Semester));
				});
				$("#fSemesterId,#SemesterId").trigger("chosen:updated");

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

 
function getProgramList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getProgramListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#fProgramId").append($('<option></option>').val(obj.ProgramId).html(obj.Program));
					//$("#SubjectId").append($('<option></option>').val(obj.SubjectId).html(obj.SubjectName));
				});
				$("#fProgramId").trigger("chosen:updated");

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
		getProgramList();
		

	    /***Menu Active***/
		$( ".reports-menu" ).addClass( "active" );
		$( ".reports-menu ul" ).addClass( "in" );
		$( ".reports-menu ul" ).attr("aria-expanded", "true");
		$( ".onlineadmissionapplicants-menu" ).addClass( "active" );

		$('.chosen-select').chosen({width: "100%"});

		
		$("#fYearId,#fSemesterId,#fProgramId").change(function () {
	        getTableMainData();
	    });

		getTableMainData();
 
    });






    function getTableMainData(){
    	tableMain = $("#tableMain").dataTable({
		    "bFilter" : false,
		    "bDestroy": true,
			"bAutoWidth": false,
		    "bJQueryUI": true,      
		    "bSort" : false,
		    "bInfo" : true,
		    "bPaginate" : true,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
		    "aaSorting" : [[2, 'asc']],
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('admissionFormListTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"YearId":$("#fYearId").val(),
		        	"SemesterId":$("#fSemesterId").val(),
		        	"ProgramId":$("#fProgramId").val(),
		        	"_token" : $('meta[name="csrf-token"]').attr('content')		        	
		    		}
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }
		        },
		    "columns":[
		        {"data":"FormId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"StudentName","sWidth": "15%"},
		        {"data":"Gender","sWidth": "5%"},
		        {"data":"Phone","sWidth": "10%"},
		        {"data":"Email","sWidth": "12%"},
		        {"data":"SSCGPA","sWidth": "6%"},
		        {"data":"SSCBoard","sWidth": "12%"},
		        {"data":"HSCGPA","sWidth": "7%"},
		        {"data":"HSCCollege","sWidth": "20%"},
		        {"data":"AddmisionDate","sWidth": "8%"},
		        {"data":"action","sWidth": "5%", "sClass": "dt-center", "bSortable": false,"bVisible" : false}
		    ]
		});
    }
</script>
 @endsection