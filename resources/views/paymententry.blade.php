@extends('umslayout')
@section('titlename') Payment Entry @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Payment Entry</h3>
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
                        <strong>Payment Entry</strong>
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

					<label class="col-lg-1 col-form-label">Student</label>
					<div class="col-lg-4">
						<select data-placeholder="Choose a Student..." class="chosen-select" id="fStudentsId">
							<option value="0">All Student</option>
						</select>
					</div>

					<label class="col-lg-1"></label>
				</div>	


				
	            <div class="row">

	                <div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Payment List</h5>
									<div class="ibox-tools">
										<button class="btn btn-info btn-sm" type="button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add</span></button>
									</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="tableMain" class="table table-striped table-bordered display table-hover" >
										<thead>
											<tr>
												<th style="display:none;">PaymentId</th>
												<th>Serial</th>
												<th>Payment Date</th>
												<th>Student Name</th>
												<th>Amount</th>
												<th>Action</th>											
												<th style="display:none;">YearId</th>
												<th style="display:none;">SemesterId</th>
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

			<div class="row" id="form-panel" style="display:none;">
				<div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Payment Entry Form</h5>
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

									<label class="col-lg-1 col-form-label">Student<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Student..." class="chosen-select" id="StudentsId" name="StudentsId">
											<option value="">Select Student</option>
										</select>
                                    </div>
									
                                </div>
								 <div class="form-group row">

								 	<label class="col-lg-1 col-form-label">Payment Date<span class="fontred">*</span></label>
									<div class="col-lg-3 daterangecontrol">
										<div class="input-daterange input-group">
											<input type="text" class="form-control-sm form-control" name="PaymentDate" id="PaymentDate" data-date-format="dd/mm/yyyy" required />
										</div>	

									</div>

									<label class="col-lg-1 col-form-label">Amount<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Amount" name="Amount" placeholder="Enter Amount" class="form-control" required>
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
			"url": SITEURL+"/deletePaymentRoute",
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
	        url: SITEURL+"/addEditPaymentRoute",
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

 
function getStudentsList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getStudentListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#fStudentsId").append($('<option></option>').val(obj.StudentsId).html(obj.StudentName));
					$("#StudentsId").append($('<option></option>').val(obj.StudentsId).html(obj.StudentName));
				});
				$("#fStudentsId,#StudentsId").trigger("chosen:updated");

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
		getStudentsList();
		

	    /***Menu Active***/
		$( ".admin-menu" ).addClass( "active" );
		$( ".admin-menu ul" ).addClass( "in" );
		$( ".admin-menu ul" ).attr("aria-expanded", "true");
		$( ".paymententry-menu" ).addClass( "active" );

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
			$("#StudentsId").val('').trigger("chosen:updated");

	        onFormPanel();

	        var date1 = new Date();
			var defaultCurrentDate = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
			$('#PaymentDate').datepicker('setDate', defaultCurrentDate);

	    });
			
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


			if($("#StudentsId").val() == ""){
				 setTimeout(function() {
							toastr.options = {
								closeButton: true,
								progressBar: true,
								showMethod: 'slideDown',
								timeOut: 4000
							};
						toastr.error("Select Student");

						}, 1300);
				 return;
			}



	        $("#addeditform").submit();
	    });
		
		$("#btnBack").click(function () {
	        onListPanel();
	    });
		
		$("#fYearId,#fSemesterId,#fStudentsId").change(function () {
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
		        "url": "<?php route('paymentListTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"YearId":$("#fYearId").val(),
		        	"SemesterId":$("#fSemesterId").val(),
		        	"StudentsId":$("#fStudentsId").val(),
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
                            $('#recordId').val(aData['PaymentId']);
							$("#YearId").val(aData['YearId']).trigger("chosen:updated");
							$("#SemesterId").val(aData['SemesterId']).trigger("chosen:updated");
							$("#StudentsId").val(aData['StudentsId']).trigger("chosen:updated");
							$('#PaymentDate').val(aData['PaymentDate']);
							$('#Amount').val(aData['Amount']);

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
							onConfirmWhenDelete(aData['PaymentId']);
						});
					});
				});

		            
		        },
		    "columns":[
		        {"data":"PaymentId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"PaymentDate","sWidth": "15%"},
		        {"data":"StudentName","sWidth": "50%"},
		        {"data":"Amount","sWidth": "20%", "sClass": "dt-right"},
		        {"data":"action","sWidth": "10%", "sClass": "dt-center", "bSortable": false},
		        {"data":"YearId","bVisible" : false},
		        {"data":"SemesterId","bVisible" : false},
		        {"data":"StudentsId","bVisible" : false}
		    ]
		});
    }
</script>
 @endsection