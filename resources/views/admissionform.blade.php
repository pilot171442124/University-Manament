@extends('umslayout')
@section('titlename') Admission Form @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Admission Form</h3>
            </div>
            <div class="col-lg-6">
				<ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>Board</strong>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Admission Form</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             
			<div id="success-panel" style="display:none;">

				<div class="row">
					<label class="col-lg-12" style="font-size: 20px; color:green;">Your application form submitted successfully</label>
				</div>	

                <div class="form-group row">
                    <div class="col align-self-center">
						<a href="{{ url('admissionform') }}" class="btn btn-primary btn-sm" ><i class="fa fa-refresh"></i> Ok</a>
                    </div>
                </div>


			</div>

			<div class="row" id="form-panel">
				<div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Admission Form</h5>
							<div class="ibox-tools">
								<!--<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>-->
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditform">
                            	{{ csrf_field() }}


                            	<div class="form-group row">
									<label class="col-lg-1 col-form-label">Year<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Year..." class="chosen-select" id="YearId" name="YearId">
											<option value="">Select Year</option>
										</select>
                                    </div>


									<label class="col-lg-1 col-form-label">Semester<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Semester..." class="chosen-select" id="SemesterId" name="SemesterId">
											<option value="">Select Semester</option>
										</select>
                                    </div>



									<label class="col-lg-1 col-form-label">Program<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Program..." class="chosen-select" id="ProgramId" name="ProgramId">
											<option value="">Select Program</option>
										</select>
                                    </div>
									
                                </div>


								<div class="form-group row">
									<label class="col-lg-1 col-form-label">Student Name<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="StudentName" name="StudentName" placeholder="Enter Student Name" class="form-control" required>
                                    </div>

									<label class="col-lg-1 col-form-label">Gender<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Gender..." class="chosen-select" id="GenderId" name="GenderId">
											<option value="">Select Gender</option>
											<option value="1">Male</option>
											<option value="2">Female</option>
										</select>
                                    </div>

									<label class="col-lg-1 col-form-label">Phone<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Phone" name="Phone" placeholder="Enter Phone" class="form-control" required>
                                    </div>

									
                                </div>
								 <div class="form-group row">

								 	
									<label class="col-lg-1 col-form-label">Email<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Email" name="Email" placeholder="Enter Email" class="form-control" required>
                                    </div>


								 	
									<label class="col-lg-1 col-form-label">SSC GPA<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="SSCGPA" name="SSCGPA" placeholder="Enter SSC GPA" class="form-control" required>
                                    </div>


								 	
									<label class="col-lg-1 col-form-label">SSC Board<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="SSCBoard" name="SSCBoard" placeholder="Enter SSC Board" class="form-control" required>
                                    </div>
									
                                </div>
								 <div class="form-group row">

									
									<label class="col-lg-1 col-form-label">HSC GPA<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="HSCGPA" name="HSCGPA" placeholder="Enter HSC GPA" class="form-control" required>
                                    </div>


									<label class="col-lg-1 col-form-label">HSC College<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="HSCCollege" name="HSCCollege" placeholder="Enter HSC College" class="form-control" required>
                                    </div>
                                </div>
								 
                                <div class="form-group row">
                                    <div class="col align-self-center">
										<input type="text" id="recordId" name="recordId" style="display:none;">
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Submit</a>
										<a href="{{ url('admissionform') }}" class="btn btn-danger btn-sm" id="btnCancel"><i class="fa fa-times"></i> Cancel</a>
										
                                    </div>
                                </div>
                            </form>
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

	

	/***Reset the control***/
	function resetForm(id) {
		$('#' + id).each(function() {
			this.reset();
		});
	}



	/***Validation***/
	jQuery("#addeditform").parsley({
		listeners : {
			onFieldValidate : function(elem) {
				if (!$(elem).is(":visible")) {
	                return true;
	            }
	            else {
	                return false;
	            }
			},
			onFormSubmit : function(isFormValid, event) {
				if (isFormValid) {
					onConfirmWhenAddEdit();
					return false;
				}
			}
		}
	});

	/***Data Insert or update***/
	function onConfirmWhenAddEdit() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/addEditAdmissionFormSubmitRoute",
	        data: $("#addeditform").serialize(),
	        success:function(response){
	            //alert("success");
				
				var msg="";
	            if($("#recordId").val() == "") {
	           	    msg = "Application form submitted successfully.";
	            } else {
	           	    msg = "Data updated successfully.";
	            }
				setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.success(msg);

				}, 1300);


	            $("#form-panel").hide();
	            $("#success-panel").show();
	        },
	        error:function(error){
	           setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error(response);

				}, 1300);

	        }

	    });
	}



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
					$("#YearId").append($('<option></option>').val(obj.YearId).html(obj.Year));
				});
				$("#YearId").trigger("chosen:updated");

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
					$("#SemesterId").append($('<option></option>').val(obj.SemesterId).html(obj.Semester));
				});
				$("#SemesterId").trigger("chosen:updated");

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
					$("#ProgramId").append($('<option></option>').val(obj.ProgramId).html(obj.Program));
				});
				$("#ProgramId").trigger("chosen:updated");

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
		$( ".boards-menu" ).addClass( "active" );
		$( ".boards-menu ul" ).addClass( "in" );
		$( ".boards-menu ul" ).attr("aria-expanded", "true");
		$( ".onlineaddmission-menu" ).addClass( "active" );
	
		$('.chosen-select').chosen({width: "100%"});

		$("#btnSubmit").click(function () {



			if($("#YearId").val() == ""){
				 setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Select Year");

						}, 1300);
				 return;
			}


			if($("#SemesterId").val() == ""){
				 setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Select Semester");

						}, 1300);
				 return;
			}


			if($("#ProgramId").val() == ""){
				 setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Select Program");

						}, 1300);
				 return;
			}

			if($("#GenderId").val() == ""){
				 setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Select Gender");

						}, 1300);
				 return;
			}


	        $("#addeditform").submit();
	    });

 
    });

</script>
 @endsection