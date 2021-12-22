@extends('umslayout')
@section('titlename') Student Entry @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Student Entry</h3>
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
                        <strong>Student Entry</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             
			<div id="list-panel">
				<div class="row border-bottom white-bg dashboard-header form-group" id="filterCriteria">
					<label class="col-lg-1 col-form-label">Program</label>
					<div class="col-lg-3">
						<select data-placeholder="Choose a Program..." class="chosen-select" id="fProgramId">
							<option value="0">All Program</option>
						</select>
					</div>
				</div>
				
	            <div class="row">

	                <div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Student List</h5>
									<div class="ibox-tools">
										<button class="btn btn-info btn-sm" type="button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add</span></button>
									</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="tableMain" class="table table-striped table-bordered display table-hover" >
										<thead>
											<tr>
												<th style="display:none;">StudentsId</th>
												<th>Serial</th>
												<th>Program</th>
												<th>Student Code</th>
												<th>Reg No</th>
												<th>Student Name</th>
												<th>Batch</th>
												<th>Phone</th>
												<th>Email</th>
												<th>Action</th>											
												<th style="display:none;">Gender</th>
												<th style="display:none;">Address</th>
												<th style="display:none;">Latitude</th>
												<th style="display:none;">Longitude</th>
												<th style="display:none;">AdmissionDate</th>
												<th style="display:none;">Session</th>
												<th style="display:none;">BirthDate</th>
												<th style="display:none;">NID</th>
												<th style="display:none;">ProgramId</th>
												<th style="display:none;">GenderId</th>
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
                            <h5>Student Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditform">
                            	{{ csrf_field() }}
								<div class="form-group row">
									<label class="col-lg-1 col-form-label">Program<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Program..." class="chosen-select" id="ProgramId" name="ProgramId">
											<option value="">Select Program</option>
										</select>
                                    </div>
									
									<label class="col-lg-1 col-form-label">Student Code<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="StudentCode" name="StudentCode" placeholder="Enter Student Code" class="form-control" required>
                                    </div>									
									
									<label class="col-lg-1 col-form-label">Reg No<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="RegNo" name="RegNo" placeholder="Enter Reg No" class="form-control" required>
                                    </div>
									
                                </div>
								 <div class="form-group row">

									<label class="col-lg-1 col-form-label">Student Name<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="StudentName" name="StudentName" placeholder="Enter Student Name" class="form-control" required>
                                    </div>

									<label class="col-lg-1 col-form-label">Session<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Session" name="Session" placeholder="Enter Session" class="form-control" required>
                                    </div>
                                
									<label class="col-lg-1 col-form-label">Batch<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Batch" name="Batch" placeholder="Enter Batch" class="form-control" required>
                                    </div>
                                </div>
								
								 <div class="form-group row">
								 
									<label class="col-lg-1 col-form-label">Gender<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Gender..." class="chosen-select" id="GenderId" name="GenderId" required>
										<option value="">Select Gender</option>
										</select>
                                    </div>
									
									<label class="col-lg-1 col-form-label">Phone<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Phone" name="Phone" placeholder="Enter Phone" class="form-control" required>
                                    </div>
                              
									<label class="col-lg-1 col-form-label">Email<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<input type="text" id="Email" name="Email" placeholder="Enter Email" class="form-control" required>
                                    </div>
									
                                </div>
								 <div class="form-group row">
									
                                
									<label class="col-lg-1 col-form-label">Admission Date<span class="fontred">*</span></label>
									<div class="col-lg-3 daterangecontrol">
										<div class="input-daterange input-group">
											<input type="text" class="form-control-sm form-control" name="AdmissionDate" id="AdmissionDate" data-date-format="dd/mm/yyyy" required />
										</div>										
									</div>
								
									<label class="col-lg-1 col-form-label">Birth Date<span class="fontred">*</span></label>
									<div class="col-lg-3 daterangecontrol">
										<div class="input-daterange input-group">
											<input type="text" class="form-control-sm form-control" name="BirthDate" id="BirthDate" data-date-format="dd/mm/yyyy" required />
										</div>
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
                            <h5>Student Access Form</h5>
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
	var ProgramId = 0;

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
			"url": SITEURL+"/deleteStudentsRoute",
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
	        url: SITEURL+"/addEditStudentsRoute",
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
			"url": SITEURL+"/setStudentsAccessRoute",
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
					$("#ProgramId").append($('<option></option>').val(obj.ProgramId).html(obj.Program));
				});
				$("#fProgramId").trigger("chosen:updated");
				$("#ProgramId").trigger("chosen:updated");
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



function getGenderList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getGenderListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#GenderId").append($('<option></option>').val(obj.GenderId).html(obj.Gender));
				});
				$("#GenderId").trigger("chosen:updated");
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

		getProgramList();
		getGenderList();
		

	    /***Menu Active***/
		$( ".admin-menu" ).addClass( "active" );
		$( ".admin-menu ul" ).addClass( "in" );
		$( ".admin-menu ul" ).attr("aria-expanded", "true");
		$( ".students-menu" ).addClass( "active" );

		$('.daterangecontrol .input-daterange').datepicker({
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				format: 'yyyy/mm/dd'
				//format: 'dd/mm/yyyy'
			});

		$('.chosen-select').chosen({width: "100%"});

		$("#btnAdd").click(function () {
	        resetForm("addeditform");
			recordId="";

			$("#ProgramId").val('').trigger("chosen:updated");
			$("#GenderId").val('').trigger("chosen:updated");

	        onFormPanel();
	    });
			
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });


		$("#btnSubmitAccess").click(function () {
	        setAccess();
	    });
		




		$("#btnBack,#btnAccessBack").click(function () {
	        onListPanel();
	    });
		
		$("#fProgramId").change(function () {
			ProgramId = $("#fProgramId").val();
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
		        "url": "<?php route('studentsListTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"ProgramId" : ProgramId,
		        	"_token" : $('meta[name="csrf-token"]').attr('content')		        	
		    		}
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }
		            
		            var nTrs = $('#tableMain tbody tr');
					var iColspan = nTrs[0].getElementsByTagName('td').length;
					var sLastGroup = "";
					for (var i = 0; i < nTrs.length; i++) {
						var iDisplayIndex = i;
						var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData['Program'];
						if (sGroup != sLastGroup) {
							var nGroup = document.createElement('tr');
							var nCell = document.createElement('td');
							nCell.colSpan = iColspan;
							nCell.className = "tableGroupStyle";
							nCell.innerHTML = sGroup;
							nGroup.appendChild(nCell);
							nTrs[i].parentNode.insertBefore(nGroup, nTrs[i]);
							sLastGroup = sGroup;
						}
					}

		            $('a.itmEdit', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);
		                    
		                    resetForm("addeditform");
                            $('#recordId').val(aData['StudentsId']);
							$("#ProgramId").val(aData['ProgramId']).trigger("chosen:updated");
							$('#StudentCode').val(aData['StudentCode']);
							$('#RegNo').val(aData['RegNo']);
							$('#StudentName').val(aData['StudentName']);
							$('#Session').val(aData['Session']);
							$('#Batch').val(aData['Batch']);
							$("#GenderId").val(aData['GenderId']).trigger("chosen:updated");
							$('#Phone').val(aData['Phone']);
							$('#Email').val(aData['Email']);
							$('#AdmissionDate').val(aData['AdmissionDate']);
							$('#BirthDate').val(aData['BirthDate']);
							$('#NID').val(aData['NID']);
							$('#Address').val(aData['Address']);


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
                            $('#arecordId').val(aData['StudentsId']);
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
							onConfirmWhenDelete(aData['StudentsId']);
						});
					});
				});

		            
		        },
		    "columns":[
		        {"data":"StudentsId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"Program", "bVisible": false},
		        {"data":"StudentCode","sWidth": "10%"},
		        {"data":"RegNo","sWidth": "10%"},
		        {"data":"StudentName","sWidth": "25%"},
		        {"data":"Batch","sWidth": "10%"},
		        {"data":"Phone","sWidth": "10%"},		        
		        {"data":"Email","sWidth": "15%"},       
		        {"data":"action","sWidth": "15%", "sClass": "dt-center", "bSortable": false},
		        {"data":"Gender","bVisible" : false},
		        {"data":"Address","bVisible" : false},
		        {"data":"AdmissionDate","bVisible" : false},
		        {"data":"Session","bVisible" : false},
		        {"data":"BirthDate","bVisible" : false},
		        {"data":"NID","bVisible" : false},
		        {"data":"ProgramId","bVisible" : false},
		        {"data":"GenderId","bVisible" : false}
		    ]
		});
    }
</script>
 @endsection