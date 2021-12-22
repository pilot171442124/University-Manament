@extends('umslayout')
@section('titlename') Subject Entry @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Subject Entry</h3>
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
                        <strong>Subject Entry</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             

			<div class="row" id="list-panel">
                <div class="col-lg-12">
					<div class="ibox ">
						<div class="ibox-title">
							<h5>Subject List</h5>
							<div class="ibox-tools">
								<a class="" href="javascript:void(0);" id="btnAdd"><span class="label label-info"><i class="fa fa-plus"></i>&nbsp;Add</span></a>
							</div>
						</div>
						<div class="ibox-content">
							<div class="table-responsive">
								<table id="tableMain" class="table table-striped table-bordered display table-hover" >
									<thead>
										<tr>
											<th style="display:none;">Subject Id</th>
											<th>Serial</th>
											<th>Subject Code</th>
											<th>Subject Name</th>
											<th>Credits</th>
											<th>Action</th>
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
                            <h5>Subject Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditform">
                            	{{ csrf_field() }}
                                <div class="form-group row">
									<label class="col-lg-2 col-form-label">Subject Code<span class="fontred">*</span></label>
                                    <div class="col-lg-5">
										<input type="text" id="SubjectCode" name="SubjectCode" placeholder="Enter Subject Code" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
									<label class="col-lg-2 col-form-label">Subject Name<span class="fontred">*</span></label>
                                    <div class="col-lg-5">
										<input type="text" id="SubjectName" name="SubjectName" placeholder="Enter Subject Name" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group row">
									<label class="col-lg-2 col-form-label">Credits</label>
                                    <div class="col-lg-5">
										<input type="text" id="Credits" name="Credits" placeholder="Enter Credits" class="form-control">
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
			"url": SITEURL+"/deleteSubjectRoute",
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
	        //url: "http://localhost/olms/addEditBookTypeRoute",
	        url: SITEURL+"/addEditSubjectRoute",
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


    $(document).ready(function() {

	    /***Menu Active***/
		$( ".admin-menu" ).addClass( "active" );
		$( ".admin-menu ul" ).addClass( "in" );
		$( ".admin-menu ul" ).attr("aria-expanded", "true");
		$( ".subject-menu" ).addClass( "active" );

		$("#btnAdd").click(function () {
	        resetForm("addeditform");
			recordId="";
	        onFormPanel();
	    });
			
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });
		
		$("#btnBack").click(function () {
	        onListPanel();
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
		        "url": "<?php route('subjectListTblMain') ?>",
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
		                    
		                    resetForm("addeditform");
                            $('#recordId').val(aData['SubjectId']);
		                    $('#SubjectCode').val(aData['SubjectCode']);
		                    $('#SubjectName').val(aData['SubjectName']);
		                    $('#Credits').val(aData['Credits']);

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
							onConfirmWhenDelete(aData['SubjectId']);
						});
					});
				});

		            
		        },
		    "columns":[
		        {"data":"SubjectId","bVisible" : false},
		        {"data":"Serial","sWidth": "10%", "sClass": "dt-center", "bSortable": false},
		        {"data":"SubjectCode","sWidth": "15%"},
		        {"data":"SubjectName","sWidth": "55%"},
		        {"data":"Credits","sWidth": "10%","sClass": "dt-right"},
		        {"data":"action","sWidth": "10%", "sClass": "dt-center", "bSortable": false}
		    ]
		});
 
    });
</script>
 @endsection