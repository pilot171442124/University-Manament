@extends('umslayout')
@section('titlename') Examination Marks Entry @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Examination Marks Entry</h3>
            </div>
            <div class="col-lg-6">
				<ol class="breadcrumb float-right">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <strong>Admin</strong>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Examination Marks Entry</strong>
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

					<label class="col-lg-1 col-form-label">Subject</label>
					<div class="col-lg-4">
						<select data-placeholder="Choose a Semester..." class="chosen-select" id="fSubjectId">
							<option value="0">All Subject</option>
						</select>
					</div>

					<label class="col-lg-1"></label>
				</div>	<br/>

				<div class="row">
					<label class="col-lg-1 col-form-label">Exam</label>
					<div class="col-lg-3">
						<select data-placeholder="Choose a Examination..." class="chosen-select" id="fExamId">
							<option value="0">All Examination</option>
						</select>
					</div>
				</div>

				<div class="row">
	                <div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5> Examination Marks</h5>
								<div class="ibox-tools">
									<a class="" href="javascript:void(0);" id="btnAdd"><span class="label label-info"><i class="fa fa-plus"></i>&nbsp;New</span></a>
								</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="tableMain" class="table table-striped table-bordered display table-hover" >
										<thead>
											<tr>
												<th style="display:none;">EMId</th>
												<th>Serial</th>
												<th>Date</th>
												<th>Subject</th>
												<th>Examination</th>
												<th>Marks</th>						
												<th>Consider(%)</th>
												<th>Action</th>											
												<th style="display:none;">YearId</th>
												<th style="display:none;">SemesterId</th>
												<th style="display:none;">SubjectId</th>
												<th style="display:none;">ExamId</th>
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





			<div class="row" id="form-panel" style="display:none;">
				<div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Examination Marks Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditform">
                            	{{ csrf_field() }}			
								<div class="form-group row" id="daterangecontrol">
									<label class="col-lg-1 col-form-label">Year<span class="fontred">*</span></label>
                                    <div class="col-lg-2">
										<select data-placeholder="Choose a Year..." class="chosen-select" id="YearId" name="YearId">
											<option value="">Select Year</option>
										</select>
                                    </div>
									
									<label class="col-lg-1 col-form-label">Semester<span class="fontred">*</span></label>
                                    <div class="col-lg-2">
										<select data-placeholder="Choose a Semester..." class="chosen-select" id="SemesterId" name="SemesterId">
											<option value="">Select Semester</option>
										</select>
                                    </div>
									
									<label class="col-lg-1 col-form-label">Date<span class="fontred">*</span></label>
									<div class="col-lg-2">
										<div class="input-daterange input-group">
											<input type="text" class="form-control-sm form-control" name="AttDate" id="AttDate" data-date-format="yyyy/mm/dd" required />
										</div>
									</div>
                                </div>
								
								<div class="form-group row">
									<label class="col-lg-1 col-form-label">Subject<span class="fontred">*</span></label>
                                    <div class="col-lg-5">
										<select data-placeholder="Choose a Subject..." class="chosen-select" id="SubjectId" name="SubjectId">
											<option value="">Select Subject</option>
										</select>
                                    </div>
									<label class="col-lg-1 col-form-label">Examination<span class="fontred">*</span></label>
                                    <div class="col-lg-5">
										<select data-placeholder="Choose a Examination..." class="chosen-select" id="ExamId" name="ExamId">
											<option value="">Select Examination</option>
										</select>
                                    </div>
									
                                </div>
								
								<div class="form-group row">
								
									<label class="col-lg-1 col-form-label">Marks<span class="fontred">*</span></label>
                                    <div class="col-lg-2">
										<input type="text" id="ExamMarks" name="ExamMarks" placeholder="Enter Total Marks" class="form-control" required>
                                    </div>
									
									<label class="col-lg-2 col-form-label">Marks Consider(%)<span class="fontred">*</span></label>
                                    <div class="col-lg-2">
										<input type="text" id="MarkConsider" name="MarkConsider" placeholder="Enter Consider Percentage" class="form-control" required>
                                    </div>
                                </div>
								  
								  
                                <div class="form-group row">
                                    <div class="col align-self-center">
										<input type="text" id="recordId" name="recordId" style="display:none;">
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Start Marks Entry</a>
										<!--<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="onListPanel();"><i class="fa fa-times"></i> Cancel</a>-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
              </div>




            <div class="row" id="list-item-panel" style="display:none;">
                <div class="col-lg-12">
					<div class="ibox ">
						<div class="ibox-title">
							<h5>Enter Marks</h5>
								<div class="ibox-tools">
									<button class="btn btn-info btn-sm" type="button" id="btnBackItem"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
								</div>
						</div>
						<div class="ibox-content">
						
							<div style="background: #3cb427; padding: 5px; color: white;">
								<label><strong>Year:</strong> </label>
								<label id="ManyYear"> </strong></label>
								
								<label><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semester:</strong> </label>
								<label id="ManySemester"> </label>
								
								<label><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date:</strong> </label>
								<label id="ManyDate"> </label>

								<label><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Subject:</strong> </label>
								<label id="ManySubject"> </label>
								
								<label><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Exam:</strong> </label>
								<label id="ManyExam"> </label>
								<br/>
								<label><strong>Marks:</strong> </label>
								<label id="ManyExamMarks"> </label>
								
								<label><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Consider(%):</strong> </label>
								<label id="ManyExamMarksConsider"> </label>
							</div>


							<div class="table-responsive">
								<table id="tableItems" class="table table-striped table-bordered display table-hover" >
									<thead>
										<tr>
											<th style="display:none;">EMItemId</th>
											<th>Serial</th>
											<th>Student Code</th>
											<th>Student Name</th>
											<th>Batch</th>
											<th>Marks</th>										
											<th style="display:none;">EMId</th>
											<th style="display:none;">StudentsId</th>
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
    var tableItems;
	var recordId="";
	var filtercount = 0;

	/***Hide entry form and show table***/
	function onListPanel(){
		$("#form-panel,#list-item-panel").hide();
		$("#list-panel,#filterCriteria").show();
		tableMain.fnDraw();
	}
	/***Hide table and show entry form***/
	function onFormPanel(){
		$("#list-panel,#filterCriteria,#list-item-panel").hide();
		$("#form-panel").show();
	}

	/***show item table table***/
	function onListItemPanel(){
		$("#form-panel,#list-panel,#filterCriteria").hide();
		$("#list-item-panel").show();
	}

	/***Reset the control***/
	function resetForm(id) {
		$('#' + id).each(function() {
			this.reset();
		});
	}


	/***Data Delete***/
	function onConfirmWhenDelete(recordId) {

		$.ajax({
			"type" : "POST",
			"url": SITEURL+"/deleteExaminationMarksRoute",
			datatype:"json",
            data: {
            	"id":recordId,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
			"success" : function(response) {
				if (response == 1) {
					$("#tableMain").dataTable().fnDraw();
					var msg = "Data removed successfully.";
					setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 4000
						};
						toastr.success(msg);

					}, 1300);
				} else {
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
			}	
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
	        url: SITEURL+"/addExaminationMasterItemsRoute",
	        data: $("#addeditform").serialize(),
	        success:function(response){
	            //alert("success");
				
				var msg="";
	            if(response > 0) {
	           	    msg = "Started new marks entry";
	            } else {
	           	    msg = "Student not registered of this semester.";
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
	            $("#recordId").val(response);
				
				$('#ManyYear').html($('#YearId').find(":selected").text());
				$('#ManySemester').html($('#SemesterId').find(":selected").text());
				$('#ManyDate').html($('#AttDate').val());
				$('#ManySubject').html($('#SubjectId').find(":selected").text());
				$('#ManyExam').html($('#ExamId').find(":selected").text());
				$('#ManyExamMarks').html($('#ExamMarks').val());
				$('#ManyExamMarksConsider').html($('#MarkConsider').val());

                onListItemPanel();
				getItemData();

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
					$("#fYearId").append($('<option></option>').val(obj.YearId).html(obj.Year));
					$("#YearId").append($('<option></option>').val(obj.YearId).html(obj.Year));
				});
				$("#fYearId,#YearId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>3){
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
				if(filtercount>3){
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
					$("#SubjectId").append($('<option></option>').val(obj.SubjectId).html(obj.SubjectName));
				});
				$("#fSubjectId,#SubjectId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>3){
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
		 

	function getExamList() {

		    $.ajax({
		        type: "post",
		        url: SITEURL+"/getExaminationListRoute",
		        data: {
		        	"id":1,
	        		"_token":$('meta[name="csrf-token"]').attr('content')
	        	},
		        success:function(response){
					$.each(response, function(i, obj) {
						$("#fExamId").append($('<option></option>').val(obj.ExamId).html(obj.ExamName));
						$("#ExamId").append($('<option></option>').val(obj.ExamId).html(obj.ExamName));
					});
					$("#fExamId,#ExamId").trigger("chosen:updated");

					filtercount++;
					if(filtercount>3){
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
		getExamList();


	    /***Menu Active***/
		$( ".admin-menu" ).addClass( "active" );
		$( ".admin-menu ul" ).addClass( "in" );
		$( ".admin-menu ul" ).attr("aria-expanded", "true");
		$( ".examinationmarks-menu" ).addClass( "active" );

		$('.chosen-select').chosen({width: "100%"});

		$('.daterangecontrol .input-daterange').datepicker({
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				format: 'yyyy-mm-dd'
				//format: 'dd/mm/yyyy'
			});


		$("#btnAdd").click(function () {
	        resetForm("addeditform");
			recordId="";
			$("#YearId").val($("#fYearId").val()).trigger("chosen:updated");
			$("#SemesterId").val($("#fSemesterId").val()).trigger("chosen:updated");
			$("#SubjectId").val("").trigger("chosen:updated");
			$("#ExamId").val("").trigger("chosen:updated");
		
	        onFormPanel();
			$("#btnSubmit").show();
			var date1 = new Date();
			var defaultCurrentDate = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
			$('#AttDate').datepicker('setDate', defaultCurrentDate);
	    });
			
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });

		$("#btnBack,#btnBackItem").click(function () {
	        onListPanel();
	    });
	

		$("#fYearId,#fSemesterId,#fSubjectId,#fExamId").change(function () {
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
		    "bInfo" : true,
		    "bPaginate" : true,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
		    "aaSorting" : [[2, 'asc']],
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('getMarksDataListTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"YearId":$("#fYearId").val(),
		        	"SemesterId":$("#fSemesterId").val(),
		        	"SubjectId":$("#fSubjectId").val(),
		        	"ExamId":$("#fExamId").val(),
		        	"_token":$('meta[name="csrf-token"]').attr('content')
		        }
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }
		            
		            $('a.itmEdit', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);
		                    
		                    resetForm("addeditform");

							$('#recordId').val(aData["EMId"]);
/*
							$('#ManyYear').html($('#fYearId').find(":selected").text());
		                    $('#ManySemester').html($('#fSemesterId').find(":selected").text());
		                    $('#ManyDate').html(aData['AttDate']);
		                    $('#ManySubject').html(aData['SubjectName']);*/

		                    $('#ManyYear').html($('#fYearId').find(":selected").text());
		                    $('#ManySemester').html($('#fSemesterId').find(":selected").text());
		                    $('#ManyDate').html(aData['AttDate']);
		                    $('#ManySubject').html(aData['SubjectName']);
		                    $('#ManyExam').html(aData['ExamName']);
		                    $('#ManyExamMarks').html(aData['ExamMarks']);
		                    $('#ManyExamMarksConsider').html(aData['MarkConsider']);

							swal({
								title: "Are you sure?",
								text: "Do you really want to edit this data?",
								type: "info",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes",
								closeOnConfirm: true
							}, function () {
								onListItemPanel();
								getItemData();
							});

		                    
		                });
		            });

		 
				$('a.itmDrop', tableMain.fnGetNodes()).each(function() {
					
					$(this).click(function() {
						var nTr = this.parentNode.parentNode;
						var aData = tableMain.fnGetData(nTr);
						recordId = aData[0];
						swal({
							title: "Are you sure?",
							text: "Do you really want to delete this data?",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes",
							closeOnConfirm: true
						}, function () {
							onConfirmWhenDelete(aData['EMId']);
						});
					});
				});

		            
		        },
		    "columns":[
		        {"data":"EMId","bVisible" : false},
		        {"data":"Serial","sWidth": "6%", "sClass": "dt-center", "bSortable": false},
		        {"data":"AttDate","sWidth": "10%"},
		        {"data":"SubjectName","sWidth": "40%"},
		        {"data":"ExamName","sWidth": "14%"},
		        {"data":"ExamMarks","sWidth": "10%","sClass": "dt-right"},
		        {"data":"MarkConsider","sWidth": "10%","sClass": "dt-right"},
		        {"data":"action","sWidth": "10%", "sClass": "dt-center", "bSortable": false},
		        {"data":"YearId","bVisible" : false},
		        {"data":"SemesterId","bVisible" : false},
		        {"data":"SubjectId","bVisible" : false},
		        {"data":"ExamId","bVisible" : false}
		    ]
		});
 

    }

    function getItemData(){

		tableItems = $("#tableItems").dataTable({
				    "bFilter" : false,
		    		"bDestroy": true,
					"bJQueryUI": false,		
					"bSort" : false,
					"bInfo" : false,
					"bPaginate" : false,
					"bSortClasses" : false,
					"bProcessing" : true,
					"bServerSide" : true,
					"aaSorting" : [[2, 'asc'],[4, 'asc']],
					"aLengthMenu" : [[25, 50, 100], [25, 50, 100]],
					"iDisplayLength" : 25,
				    "ajax":{
				        url: SITEURL+"/examinationmarksentryItemRoute",
				        "datatype": "json",
				        "type": "post",
				        "data": {
				        	"EMId":$("#recordId").val(),
				        	"_token":$('meta[name="csrf-token"]').attr('content')
				        }
				    },
				    "fnDrawCallback" : function(oSettings) {
			
				            if (oSettings.aiDisplay.length == 0) {
				                return;
				            }
				            
			
				        },
				    "columns":[
				        {"data":"EMItemId","bVisible" : false},
				        {"data":"Serial","sWidth": "6%", "sClass": "dt-center", "bSortable": false},
				        {"data":"StudentCode","sWidth": "15%"},
				        {"data":"StudentName","sWidth": "54%"},
				        {"data":"Batch","sWidth": "15%"},
				        {"data":"Marks","sWidth": "10%","sClass": "dt-right"},
				        {"data":"EMId","bVisible" : false},
				        {"data":"StudentsId","bVisible" : false}
				    ]
				});

 
    }



function updateMarks(EMItemId){
		var Marks = $("#Marks"+EMItemId).val();

		$.ajax({
				"type" : "POST",
				"url": SITEURL+"/updateExaminationItemMarksRoute",
				datatype:"json",
		        data: {
		        	"recordId":EMItemId,
		        	"Marks":Marks,
		    		"_token":$('meta[name="csrf-token"]').attr('content')
				},
				"success" : function(response) {
					if (response != 1) {
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
				}	
			});


	}
</script>
 @endsection

