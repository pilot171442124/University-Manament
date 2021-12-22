@extends('umslayout')
@section('titlename') Online Class @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Online Class</h3>
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
                        <strong>Online Class</strong>
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
						<select data-placeholder="Choose a Subject..." class="chosen-select" id="fSubjectId">
							<option value="0">All Subject</option>
						</select>
					</div>

					<label class="col-lg-1"></label>
				</div>	


				
	            <div class="row">

	                <div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Online Class List</h5>
									<div class="ibox-tools">
										<button class="btn btn-info btn-sm" type="button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add</span></button>
									</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="tableMain" class="table table-striped table-bordered display table-hover" >
										<thead>
											<tr>
												<th style="display:none;">ClassId</th>
												<th>Serial</th>
												<th>Class Date</th>
												<th>Subject Name</th>
												<th>Remarks</th>
												<th>Class URL</th>
												<th>Action</th>											
												<th style="display:none;">YearId</th>
												<th style="display:none;">SemesterId</th>
												<th style="display:none;">SubjectId</th>
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
                            <h5>Online Class Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
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



									<label class="col-lg-1 col-form-label">Subject<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Subject..." class="chosen-select" id="SubjectId" name="SubjectId">
											<option value="">Select Subject</option>
										</select>
                                    </div>
									
                                </div>
								 <div class="form-group row">

								 	<label class="col-lg-1 col-form-label">Class Date<span class="fontred">*</span></label>
									<div class="col-lg-3 daterangecontrol">
										<div class="input-daterange input-group">
											<input type="text" class="form-control-sm form-control" name="ClassDate" id="ClassDate" data-date-format="dd/mm/yyyy" required />
										</div>	

									</div>

									<label class="col-lg-1 col-form-label">Remarks<span class="fontred">*</span></label>
                                    <div class="col-lg-7">
										<input type="text" id="ClassTitle" name="ClassTitle" placeholder="Enter Remarks" class="form-control" required>
                                    </div>
                                </div>
								 <div class="form-group row">

									<label class="col-lg-1 col-form-label">Class URL<span class="fontred">*</span></label>
                                    <div class="col-lg-11">
										<input type="text" id="ClassURL" name="ClassURL" placeholder="Enter Class URL" class="form-control" required>
                                    </div>
                                </div>
								 
                                <div class="form-group row">
                                    <div class="col align-self-center">
										<input type="text" id="recordId" name="recordId" style="display:none;">
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Save</a>
										<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="onListPanel();"><i class="fa fa-times"></i> Cancel</a>
										
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

	/***Hide entry form and show table***/
	function onListPanel(){
		$("#form-panel").hide();
		$("#list-panel").show();
	}
	/***Hide table and show entry form***/
	function onFormPanel(){
		$("#list-panel").hide();
		$("#form-panel").show();
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
			"url": SITEURL+"/deleteClassRoute",
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
	        url: SITEURL+"/addEditClassRoute",
	        data: $("#addeditform").serialize(),
	        success:function(response){
	            //alert("success");
				
				var msg="";
	            if($("#recordId").val() == "") {
	           	    msg = "Data added successfully.";
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
                onListPanel();

	            $("#tableMain").dataTable().fnDraw();
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
		$( ".boards-menu" ).addClass( "active" );
		$( ".boards-menu ul" ).addClass( "in" );
		$( ".boards-menu ul" ).attr("aria-expanded", "true");
		$( ".onlineclass-menu" ).addClass( "active" );

		$('.daterangecontrol .input-daterange').datepicker({
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				format: 'yyyy-mm-dd'
				//format: 'dd/mm/yyyy'
			});

/*
	$('#datetimepicker4').datetimepicker({
		format:'Y-m-d H:i',
		inline:true
	});
*/
		$('.chosen-select').chosen({width: "100%"});

		$("#btnAdd").click(function () {
	        resetForm("addeditform");
			recordId="";

			$("#YearId").val('').trigger("chosen:updated");
			$("#SemesterId").val('').trigger("chosen:updated");
			$("#SubjectId").val('').trigger("chosen:updated");

	        onFormPanel();

	        var date1 = new Date();
			var defaultCurrentDate = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
			$('#ClassDate').datepicker('setDate', defaultCurrentDate);

	    });
			
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });
		
		$("#btnBack").click(function () {
	        onListPanel();
	    });
		
		$("#fYearId,#fSemesterId,#fSubjectId").change(function () {
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
		        "url": "<?php route('classListTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"YearId":$("#fYearId").val(),
		        	"SemesterId":$("#fSemesterId").val(),
		        	"SubjectId":$("#fSubjectId").val(),
		        	"_token" : $('meta[name="csrf-token"]').attr('content')		        	
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
                            $('#recordId').val(aData['ClassId']);
							$("#YearId").val(aData['YearId']).trigger("chosen:updated");
							$("#SemesterId").val(aData['SemesterId']).trigger("chosen:updated");
							$("#SubjectId").val(aData['SubjectId']).trigger("chosen:updated");
							$('#ClassDate').val(aData['ClassDate']);							
							$('#ClassTitle').val(aData['ClassTitle']);
							$('#ClassURL').val(aData['ClassURL']);

							swal({
								title: "Are you sure?",
								text: "Do you really want to edit this data?",
								type: "info",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes",
								closeOnConfirm: true
							}, function () {
								onFormPanel();
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
							onConfirmWhenDelete(aData['ClassId']);
						});
					});
				});

		            
		        },
		    "columns":[
		        {"data":"ClassId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"ClassDate","sWidth": "15%"},
		        {"data":"SubjectName","sWidth": "20%"},
		        {"data":"ClassTitle","sWidth": "20%"},
		        {"data":"ClassURL","sWidth": "30%"},
		        {"data":"action","sWidth": "10%", "sClass": "dt-center", "bSortable": false},
		        {"data":"YearId","bVisible" : false},
		        {"data":"SemesterId","bVisible" : false},
		        {"data":"SubjectId","bVisible" : false}
		    ]
		});
    }
</script>
 @endsection