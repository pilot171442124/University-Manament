
@extends('olmslayout')

@section('titlename') User Entry @endsection

@section('maincontent')
	

		<!-- Section -->
		<section class="bg-section ysuccess pt-10 pb-10" data-black-overlay="8" style="background-image: url({{ asset('public/images/background/bg-2.jpg') }})">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-7">
						<i class="fa fa-home white"></i> <span> / Admin / User Entry</span>	
					</div>
					<div class="col-lg-5 align-right">
						<span>Hi, {{ Auth::user()->name }}</span>
						<a class="btn btn-primary mb-0" href="{{ url('logout') }}"><i class="fa fa-lock"></i> {{ __('Logout') }}</a>
					</div>
				</div>
			</div>
		</section>
		<!-- /Section -->	

		<!-- Testimonial Section -->
		<section class="testimonial-area pt-10 pb-10">
			<div class="container">

				<div id="listpanel">
				
					<div class="row">
						<div class="col-lg-12 form-group">
							<div class="pull-right">
								<button class="btn btn-primary" id="btnAdd">Add</button>
								<button class="btn btn-success" id="btnExport">Excel</button>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">	
							<table id="tableMain" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th style="display:none;">Id</th>
										<th>Serial</th>
										<th>User Name</th>
										<th>User Code</th>
										<th>Phone No</th>
										<th>E-mail</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>
										<th style="display:none;">Password</th>
									</tr>
								</thead>
								<tbody>
								</tbody>				
							</table>
						</div>
					</div>
				</div>
				

				<div id="formpanel" style="display:none;">
					<div class="row">
						<div class="col-lg-12 mb-10">
							<button class="btn btn-info btn-sm pull-right" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body">

									<form role="form" id="addeditform">
									{{ csrf_field() }}
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>User Name<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="name" id="name" data-required="true" placeholder="Enter User Name">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>User Code<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="usercode" id="usercode" data-required="true" placeholder="Enter User Code">
												</div>
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>Phone No<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="phone" id="phone" data-required="true" placeholder="Enter User Phone No">
												</div>
											</div>
											
										</div>


										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label>User Role<span class="red">*</span></label>													
													<select data-placeholder="Choose User Role..." class="chosen-select" id="userrole" name="userrole" required>
														<option value="Admin">Admin</option>
														<option value="Teacher">Teacher</option>
														<option value="Student">Student</option>
														<!--<option value="Other">Other</option>-->
													</select>
												</div>											
											</div>

											<div class="col-md-4">
												<div class="form-group">
													<label>E-mail <span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="email" id="email" data-required="true" placeholder="Enter User E-mail">
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Password<span class="red">*</span></label>
													<input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>Active Status<span class="red">*</span></label>													
													<select data-placeholder="Choose Active Status..." class="chosen-select" id="activestatus" name="activestatus" required>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select>
												</div>											
											</div>
											<div class="col-md-4"></div>
											<div class="col-md-4"></div>
										</div>

										<div class="form-group row">
											<div class="col align-self-center">
												<input type="text" id="recordId" name="recordId" style="display:none;">
												<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmit"><i class="fa fa-save"></i> Save</a>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="onListPanel();"><i class="fa fa-times"></i> Cancel</a>
											</div>
										</div>
									</form>



									<form role="form" id="usereditform">
									{{ csrf_field() }}
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>User Name<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="nameedit" id="nameedit" data-required="true" placeholder="Enter User Name">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>User Code<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="usercodeedit" id="usercodeedit" data-required="true" placeholder="Enter User Code">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Phone No<span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="phoneedit" id="phoneedit" data-required="true" placeholder="Enter User Phone No">
												</div>
											</div>

											
										</div>


										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label>User Role<span class="red">*</span></label>													
													<select data-placeholder="Choose User Role..." class="chosen-select" id="userroleedit" name="userroleedit" required>
														<option value="Admin">Admin</option>
														<option value="Teacher">Teacher</option>
														<option value="Student">Student</option>
														<option value="Other">Other</option>
													</select>
												</div>											
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>E-mail <span class="red">*</span></label>
													<input type="text" class="form-control parsley-validated" name="emailedit" id="emailedit" data-required="true" placeholder="Enter User E-mail">
												</div>
											</div>							

											<div class="col-md-4">
												<div class="form-group">
													<label>Active Status<span class="red">*</span></label>													
													<select data-placeholder="Choose Active Status..." class="chosen-select" id="activestatusedit" name="activestatusedit" required>
														<option value="Active">Active</option>
														<option value="Inactive">Inactive</option>
													</select>
												</div>											
											</div>
										</div>

										<div class="form-group row">
											<div class="col align-self-center">
												<input type="text" id="recordIdedit" name="recordIdedit" style="display:none;">
												<a href="javascript:void(0)" class="btn btn-primary btn-sm" id="btnSubmitEdit"><i class="fa fa-save"></i> Save</a>
												<a href="javascript:void(0)" class="btn btn-danger btn-sm" onClick="onListPanel();"><i class="fa fa-times"></i> Cancel</a>
											</div>
										</div>
									</form>

								</div>
							</div>
					
					</div>
				</div>
              </div>
				
				
			</div>
		</section>

 
		</div>
		<!-- /Testimonial Section -->
		
	
 @endsection


@section('customjs')

<script>
	var tableMain;
 	var SITEURL = '{{URL::to('')}}';

	/***Hide entry form and show table***/
	function onListPanel(){
		$("#formpanel").hide();
		$("#listpanel").show();
	}
	/***Hide table and show entry form***/
	function onFormPanel(){
		$("#listpanel").hide();
		$("#formpanel").show();
		$("#usereditform").hide();
		$("#addeditform").show();
	}

	/***Hide table and show entry form***/
	function onFormPanelEdit(){
		$("#listpanel").hide();
		$("#formpanel").show();
		$("#addeditform").hide();
		$("#usereditform").show();
	}




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


	/***Data Insert***/
	function onConfirmWhenAddEdit() {

	    $.ajax({
	        type: "post",
	        //url: "http://localhost/olms/addEditBookTypeRoute",
	        url: SITEURL+"/addEditUserRoute",
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
				//return Redirect::to("booktypeentry")->withSuccess('Great! Todo has been inserted');
	        },
	        error:function(error){
	            //alert("fail");
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Operation fail");

				}, 1300);

	        }

	    });
	}



/*Edit*/
jQuery("#usereditform").parsley({
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
				onConfirmWhenEdit();
				return false;
			}
		}
	}
});

/***Data update***/
	function onConfirmWhenEdit() {

	    $.ajax({
	        type: "post",
	        //url: "http://localhost/olms/addEditBookTypeRoute",
	        url: SITEURL+"/userEditUserRoute",
	        data: $("#usereditform").serialize(),
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
				//return Redirect::to("booktypeentry")->withSuccess('Great! Todo has been inserted');
	        },
	        error:function(error){
	            //alert("fail");
	            setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error("Operation fail");

				}, 1300);

	        }

	    });
	}

	/***Data Delete***/
	function onConfirmWhenDelete(recordId) {

		$.ajax({
            type: "post",
            //url: "http://localhost/olms/deleteBookTypeRoute",
            url: SITEURL+"/deleteUserRoute",
            
            datatype:"json",
            data: {
            	"id":recordId,
        		"_token":$('meta[name="csrf-token"]').attr('content')
    		},
            success:function(response){
                //alert("success");
				//console.log(response);
				//$("#tableMain").dataTable().fnDraw();

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
                onListPanel();
                $("#tableMain").dataTable().fnDraw();
			},
            error:function(error){
                //alert("fail");
                //console.log(error.responseJSON.message);

                setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
				toastr.error(error.responseJSON.message);

				}, 1300);

            }

        });
	}




	$(document).ready(function() {
		
		$('.chosen-select').chosen({width: "100%"});
		

		//getBookTypeList();
		//getBookAccessTypeList();

		$('#btnAdd').on('click', function(){
			resetForm("addeditform");
			recordId="";
			onFormPanel();
		});
		
		$('#btnBack').on('click', function(){
			onListPanel();
		}); 
		
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });

		$("#btnSubmitEdit").click(function () {
	        $("#usereditform").submit();
	    });
	 

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
		        "url": "<?php route('usertabledatafetch') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {"_token":$('meta[name="csrf-token"]').attr('content')}
		    },
		    "fnDrawCallback" : function(oSettings) {
	
		            if (oSettings.aiDisplay.length == 0) {
		                return;
		            }
		            
		            $('a.itmEdit', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);
		                    
		                    $.confirm({
		                        title: 'Are you sure?!',
		                        content: 'Do you really want to edit this data?',
		                        icon: 'fa fa-question',
		                        theme: 'bootstrap',
		                        closeIcon: true,
		                        animation: 'scale',
		                        type: 'orange',
		                        buttons: {
		                            confirm: function () {
		                                
		                                resetForm("usereditform");
		                                $('#recordIdedit').val(aData['id']);
		                                $('#nameedit').val(aData['name']);
		                                $('#usercodeedit').val(aData['usercode']);
		                                $('#phoneedit').val(aData['phone']);
		                                $('#emailedit').val(aData['email']);
		                                //$('#password').vala(Data['password']);
		                                $('#userroleedit').val(aData['userrole']).trigger("chosen:updated");
		                                $('#activestatusedit').val(aData['activestatus']).trigger("chosen:updated");

		                                onFormPanelEdit();
		                                //$.alert('Confirmed!');
		                            },
		                            cancel: function () {
		                                //$.alert('Canceled!');
		                            }
		                        }
		                    });
		                    
		                });
		            });

					
		            $('a.itmDrop', tableMain.fnGetNodes()).each(function() {

		                $(this).click(function() {

		                    var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);

		                    $.confirm({
		                    title: 'Are you sure?!',
		                    content: 'Do you really want to delete this data?',
		                    icon: 'fa fa-question',
		                    theme: 'bootstrap',
		                    closeIcon: true,
		                    animation: 'scale',
		                    type: 'red',
		                    buttons: {
		                        confirm: function () {
		                            onConfirmWhenDelete(aData['id']);
		                        },
		                        cancel: function () {
		                            //$.alert('Canceled!');
		                        }
		                    }
		                });

		                });
		            });
		                        
		        },
		    "columns":[
		        {"data":"id","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "align-center", "bSortable": false},
		        {"data":"name","sWidth": "22%"},
		        {"data":"usercode","sWidth": "12%"},
		        {"data":"phone","sWidth": "12%"},
		        {"data":"email","sWidth": "19%"},
		        {"data":"userrole","sWidth": "10%"},
		        {"data":"activestatus","sWidth": "10%"},		       
		        {"data":"action","sWidth": "10%", "sClass": "align-center", "bSortable": false},
		        {"data":"password", "bVisible": false}
		    ]
		});
		
	} );

</script>

<style>

	.align-left {
		text-align: left;
	}
	.align-center {
		text-align: center !important;
	}
	.align-right {
		text-align: right;
	}



/* start Modal css*/
.popupModal {
	display: none; 
	position: fixed; 
	z-index: 999; 
	padding-top: 100px;
	left: 0;
	top: 0;
	width: 100%; 
	height: 100%; 
	overflow: auto; 
	background-color: rgb(0,0,0); 
	background-color: rgba(0,0,0,0.4);
}
.modal-header{
	background: #c6da89;
}
</style>
 @endsection