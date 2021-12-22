@extends('umslayout')
@section('titlename') Teacher Entry @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Teacher Entry</h3>
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
                        <strong>Teacher Entry</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             

			<div class="row border-bottom white-bg dashboard-header form-group" id="filterCriteria">
				<label class="col-lg-1 col-form-label">Designation</label>
				<div class="col-lg-4">
					<select data-placeholder="Choose a Designation..." class="chosen-select" id="fDesignationId">
						<option value="0">All Designation</option>
					</select>
				</div>
			</div>
			
            <div class="row" id="list-panel">
                <div class="col-lg-12">
					<div class="ibox ">
						<div class="ibox-title">
							<h5>Teacher List</h5>
								<div class="ibox-tools">
									<button class="btn btn-info btn-sm" type="button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add</span></button>
								</div>
						</div>
						<div class="ibox-content">
							<div class="table-responsive">
								<table id="tableMain" class="table table-striped table-bordered display table-hover" >
									<thead>
										<tr>
											<th style="display:none;">TeachersId</th>
											<th>Serial</th>
											<th>Designation</th>
											<th>Teacher Code</th>
											<th>Teacher Name</th>
											<th>Phone</th>
											<th>Email</th>
											<th>Action</th>	
											<th style="display:none;">Address</th>
											<th style="display:none;">NID</th>
											<th style="display:none;">DesignationId</th>
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

			<div class="row" id="form-panel" style="display:none;">
				<div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Teacher Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditform">
                            	{{ csrf_field() }}
								<div class="form-group row">
									<label class="col-lg-1 col-form-label">Designation<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Designation..." class="chosen-select" id="DesignationId" name="DesignationId">
											<option value="">Select Designation</option>
										</select>
                                    </div>
									
									<label class="col-lg-1 col-form-label">Teacher Code<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="TeacherCode" name="TeacherCode" placeholder="Enter Teacher Code" class="form-control" required>
                                    </div>									
									
									<label class="col-lg-1 col-form-label">Teacher Name<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="TeacherName" name="TeacherName" placeholder="Enter Teacher Name" class="form-control" required>
                                    </div>
									
                                </div>
								 <div class="form-group row">

									<label class="col-lg-1 col-form-label">Phone<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Phone" name="Phone" placeholder="Enter Phone" class="form-control" required>
                                    </div>

									<label class="col-lg-1 col-form-label">Email<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Email" name="Email" placeholder="Enter Email" class="form-control" required>
                                    </div>

									<label class="col-lg-1 col-form-label">NID</label>
                                    <div class="col-lg-3">
										<input type="text" id="NID" name="NID" placeholder="Enter NID" class="form-control">
                                    </div>

                                </div>
						 
								 <div class="form-group row">
									<label class="col-lg-1 col-form-label">Address</label>
                                    <div class="col-lg-11">
										<input type="text" id="Address" name="Address" placeholder="Enter Address" class="form-control">
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




			<div class="row" id="access-panel" style="display:none;">
				<div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Teacher Access Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnAccessBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditaccessform">
                            	{{ csrf_field() }}
								 
								
								 <div class="form-group row">
									<label class="col-lg-1 col-form-label">Email<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" disabled="true" id="AccessEmail" name="AccessEmail" placeholder="Enter Email" class="form-control" required>
                                    </div>
                                </div>

								 <div class="form-group row">
									<label class="col-lg-1 col-form-label">Password<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Password" name="Password" placeholder="Enter Password" class="form-control" required>
                                    </div>
								</div>

								 <div class="form-group row">
									<label class="col-lg-1 col-form-label">Confirm Password<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="ConfirmPassword" name="ConfirmPassword" placeholder="Enter Confirm Password" class="form-control" required>
                                    </div>
								</div>
                                <div class="form-group row">
                                    <div class="col align-self-center">
										<input type="text" id="arecordId" name="arecordId" style="display:none;">
										<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmitAccess"><i class="fa fa-save"></i> Save</a>
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
	var degId = 0;

	/***Hide entry form and show table***/
	function onListPanel(){
		$("#form-panel,#access-panel").hide();
		$("#list-panel").show();
	}
	/***Hide table and show entry form***/
	function onFormPanel(){
		$("#list-panel").hide();
		$("#form-panel").show();
	}


	/***Hide table and show entry form***/
	function onAccessPanel(){
		$("#list-panel").hide();
		$("#access-panel").show();
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
			"url": SITEURL+"/deleteTeachersRoute",
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
	        url: SITEURL+"/addEditTeachersRoute",
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


	/***set access***/
	function setAccess() {


	if($("#Password").val() == "" || $("#ConfirmPassword").val() == ""){
		setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Password and Confirm Password can not be blank.");

				}, 1300);
		return;
	}


	if($("#Password").val() != $("#ConfirmPassword").val()){
		setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Password and Confirm Password are not matched.");

				}, 1300);
		return;
	}


		$.ajax({
			"type" : "POST",
			"url": SITEURL+"/setTeacherAccessRoute",
			datatype:"json",
            data: {
            	"id":$("#arecordId").val(),
            	"password":$("#Password").val(),
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
			"success" : function(response) {
				if (response == 1) {
					//$("#tableMain").dataTable().fnDraw();
					var msg = "Data saved successfully.";
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


function getDesignationList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getDesignationListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#fDesignationId").append($('<option></option>').val(obj.DesignationId).html(obj.Designation));
					$("#DesignationId").append($('<option></option>').val(obj.DesignationId).html(obj.Designation));
				});
				$("#fDesignationId").trigger("chosen:updated");
				$("#DesignationId").trigger("chosen:updated");
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

		getDesignationList();

	    /***Menu Active***/
		$( ".admin-menu" ).addClass( "active" );
		$( ".admin-menu ul" ).addClass( "in" );
		$( ".admin-menu ul" ).attr("aria-expanded", "true");
		$( ".teachers-menu" ).addClass( "active" );

		$('.chosen-select').chosen({width: "100%"});

		$("#btnAdd").click(function () {
	        resetForm("addeditform");
			recordId="";
			$("#DesignationId").val("").trigger("chosen:updated");
	        onFormPanel();
	    });
			
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });
		$("#btnSubmitAccess").click(function () {
	        setAccess();
	    });
		$("#btnBack").click(function () {
	        onListPanel();
	    });
		
		$("#fDesignationId").change(function () {
			degId = $("#fDesignationId").val();
	        getTableMainData();
	    });

		getTableMainData();
 
    });






    function getTableMainData(){
    	tableMain = $("#tableMain").dataTable({
		    "bFilter" : true,
		    "bDestroy": true,
			"bAutoWidth": false,
		    "bJQueryUI": true,      
		    "bSort" : true,
		    "bInfo" : true,
		    "bPaginate" : true,
		    "bSortClasses" : true,
		    "bProcessing" : true,
		    "bServerSide" : true,
		    "aaSorting" : [[2, 'asc']],
		    "aLengthMenu" : [[10, 25, 50, 100], [10, 25, 50, 100]],
		    "iDisplayLength" : 10,
		    "ajax":{
		        "url": "<?php route('teachersListTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"DesignationId" : degId,
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
                            $('#recordId').val(aData['TeachersId']);
                            $("#DesignationId").val(aData['DesignationId']).trigger("chosen:updated");
		                    $('#TeacherCode').val(aData['TeacherCode']);
							$('#TeacherName').val(aData['TeacherName']);
							$('#Phone').val(aData['Phone']);
							$('#Email').val(aData['Email']);
							$('#Address').val(aData['Address']);
							$('#NID').val(aData['NID']);


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

		 
 					$('a.itmAccessEdit', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);
		                    
		                    resetForm("addeditaccessform");
                            $('#arecordId').val(aData['TeachersId']);
							$('#AccessEmail').val(aData['Email']);

							onAccessPanel();

		                    
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
							onConfirmWhenDelete(aData['TeachersId']);
						});
					});
				});

		            
		        },
		    "columns":[
		        {"data":"TeachersId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"Designation","sWidth": "15%"},
		        {"data":"TeacherCode","sWidth": "12%"},
		        {"data":"TeacherName","sWidth": "26%"},
		        {"data":"Phone","sWidth": "12%"},
		        {"data":"Email","sWidth": "15%"},
		        {"data":"action","sWidth": "15%", "sClass": "dt-center", "bSortable": false},
		        {"data":"Address","bVisible" : false},
		        {"data":"NID","bVisible" : false},
		        {"data":"DesignationId","bVisible" : false}
		    ]
		});
    }
</script>
 @endsection
