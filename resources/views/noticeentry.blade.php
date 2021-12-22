@extends('umslayout')
@section('titlename') Notice & Assignment @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Notice & Assignment</h3>
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
                        <strong>Notice & Assignment</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             
			<div id="list-panel">
				<div class="row border-bottom white-bg dashboard-header form-group" id="filterCriteria">
					<label class="col-lg-1 col-form-label">Type</label>
					<div class="col-lg-4">
						<select data-placeholder="Choose a Type..." class="chosen-select" id="fTypeId">
							<option value="0">All</option>
							<option value="Notice">Notice</option>
							<option value="Assignment">Assignment</option>
						</select>
					</div>
				</div>


	            <div class="row">
	                <div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Notice & Assignment List</h5>
									<div class="ibox-tools">
										<button class="btn btn-info btn-sm" type="button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add</span></button>
									</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="tableMain" class="table table-striped table-bordered display table-hover" >
										<thead>
											<tr>
												<th style="display:none;">NoticeId</th>
												<th>Serial</th>
												<th>Date</th>
												<th>Type</th>
												<th>Title</th>
												<th>Download</th>
												<th>Action</th>											
												<th style="display:none;">NoticeURL</th>
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
                            <h5>Notice & Assignment Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditform">
                            	{{ csrf_field() }}
								
								 <div class="form-group row">

								 	<label class="col-lg-1 col-form-label">Date<span class="fontred">*</span></label>
									<div class="col-lg-2 daterangecontrol">
										<div class="input-daterange input-group">
											<input type="text" class="form-control-sm form-control" name="NoticeDate" id="NoticeDate" data-date-format="dd/mm/yyyy" required />
										</div>	
									</div>

									<label class="col-lg-1 col-form-label">Type<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Type..." class="chosen-select" id="TypeId" name="TypeId">
											<option value="">Select Type</option>
											<option value="Notice">Notice</option>
											<option value="Assignment">Assignment</option>
										</select>
                                    </div>

									<label class="col-lg-1 col-form-label">Title<span class="fontred">*</span></label>
                                    <div class="col-lg-4">
										<input type="text" id="NoticeTitle" name="NoticeTitle" placeholder="Enter Title" class="form-control" required>
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


		<!-- Modal -->
		<div class="popupModal" id="FileUploadModal">
		  <div class="modal-dialog" role="document">

			<form id="fileUploadForm" method="post" enctype="multipart/form-data"> @csrf
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Select File</h5>
			        <button type="button" class="close" onClick="hidePopupFileUploadModal()" href="javascript:void(0);"><i class="fa fa-times"></i></button>
			      </div>
			      <div class="modal-body">
					<input type="file" name="file">
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" onClick="hidePopupFileUploadModal()" href="javascript:void(0);">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
					<input type="hidden" id="idFileUp" name="idFileUp"  value=""/>
			      </div>
			    </div>
			</form>

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
	var TypeId = 0;

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
			"url": SITEURL+"/deleteNoticeRoute",
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


var PopupFileUploadModal = document.getElementById('FileUploadModal');

	function showPopupFileUploadModal() {
		PopupFileUploadModal.style.display = "block";	
	}

	function hidePopupFileUploadModal() {
		PopupFileUploadModal.style.display = "none";	
	}

	/***Data Insert or update***/
	function onConfirmWhenAddEdit() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/addEditNoticeRoute",
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
		$( ".boards-menu" ).addClass( "active" );
		$( ".boards-menu ul" ).addClass( "in" );
		$( ".boards-menu ul" ).attr("aria-expanded", "true");
		$( ".notice-menu" ).addClass( "active" );

		$('.daterangecontrol .input-daterange').datepicker({
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				format: 'yyyy-mm-dd'
				//format: 'dd/mm/yyyy'
			});

		$('.chosen-select').chosen({width: "100%"});

		$("#btnAdd").click(function () {
	        resetForm("addeditform");
			recordId="";

	        onFormPanel();

	        var date1 = new Date();
			var defaultCurrentDate = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
			$('#NoticeDate').datepicker('setDate', defaultCurrentDate);
            
             $("#TypeId").val("").trigger("chosen:updated");

	    });
			
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });
		
		$("#btnBack").click(function () {
	        onListPanel();
	    });

		$("#fTypeId").change(function () {
			TypeId = $("#fTypeId").val();
	        getTableMainData();
	    });

	    $("#fileUploadForm").on('submit',(function(e) {
			  e.preventDefault();
			  $.ajax({
			   url: SITEURL+"/fileUploadNoticeRoute",
			   type: "POST",
			   data:  new FormData(this),
			   contentType: false,
			   cache: false,
			   processData:false,
			   beforeSend : function()
			   {
			   		//$("#err").fadeOut();
			   },
			   success: function(data)
			      {
					setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 4000
						};
						toastr.success('File uploaded successfully.');

					}, 1300);
					hidePopupFileUploadModal();
	                $("#tableMain").dataTable().fnDraw();

					$("#fileUploadForm")[0].reset(); 
			      },
			     error: function(e) 
			      {
		    	    setTimeout(function() {
						toastr.options = {
							closeButton: true,
							progressBar: true,
							showMethod: 'slideDown',
							timeOut: 4000
						};
					toastr.error("File cann't upload");

					}, 1300);
			      }          
			    });
		 }));
		
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
		        "url": "<?php route('noticeListTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"TypeId":TypeId,
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
                            $('#recordId').val(aData['NoticeId']);
							$('#NoticeDate').val(aData['NoticeDate']);							
							$('#NoticeTitle').val(aData['NoticeTitle']);
                            $("#TypeId").val(aData['TypeId']).trigger("chosen:updated");

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

		 		$('a.fileUpload', tableMain.fnGetNodes()).each(function() {
		               
		                $(this).click(function() {
							
							var nTr = this.parentNode.parentNode;
		                    var aData = tableMain.fnGetData(nTr);

							$('#idFileUp').val(aData['NoticeId']);
							showPopupFileUploadModal();
		                    
		                });
		            });

		 			$('a.fileDownload', tableMain.fnGetNodes()).each(function() {

                        $(this).click(function() {

                            var nTr = this.parentNode.parentNode;
                            var aData = tableMain.fnGetData(nTr);


                            if(aData['NoticeURL'] === null){

                                setTimeout(function() {
                                    toastr.options = {
                                        closeButton: true,
                                        progressBar: true,
                                        showMethod: 'slideDown',
                                        timeOut: 4000
                                    };
                                toastr.error("File not published yet");

                                }, 1300);
                            }
                            else{
                                
                                window.open("storage/app/"+aData['NoticeURL'], '_blank'); 
                            }
                            
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
							onConfirmWhenDelete(aData['NoticeId']);
						});
					});
				});

		            
		        },
		    "columns":[
		        {"data":"NoticeId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"NoticeDate","sWidth": "10%"},
		        {"data":"TypeId","sWidth": "12%"},
		        {"data":"NoticeTitle","sWidth": "48%"},
		        {"data":"FileLink","sWidth": "10%", "sClass": "dt-center"},
		        {"data":"action","sWidth": "15%", "sClass": "dt-center", "bSortable": false},
		        {"data":"NoticeURL","bVisible" : false}
		    ]
		});
    }
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

.label-lemon {
	background-color: #9b59b6;
	color: #FFFFFF;
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
.font-white {
    color: white !important;
}
</style>
 @endsection