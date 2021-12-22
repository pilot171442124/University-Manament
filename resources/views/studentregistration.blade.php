@extends('umslayout')
@section('titlename') Student Registration by Semester Entry @endsection


@section('maincontent')

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-6">
                <h3>Student Registration by Semester Entry</h3>
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
                        <strong>Student Registration by Semester Entry</strong>
                    </li>
                </ol>
            </div>
        </div>

        
        <div class="wrapper wrapper-content animated fadeInRight">

             

			<div id="list-panel">
				
				<div class="row">		
					<label class="col-lg-1 col-form-label">Year</label>
					<div class="col-lg-2">
						<select data-placeholder="Choose a Year..." class="chosen-select" id="FYearId">
							<!--<option value="0">All Year</option>-->
						</select>
					</div>

					<label class="col-lg-1 col-form-label">Semester</label>
					<div class="col-lg-2">
						<select data-placeholder="Choose a Semester..." class="chosen-select" id="FSemesterId">
							<option value="0">All Semester</option>
						</select>
					</div>
					
					<div class="col-lg-6">
					</div>
				</div>	

				<div class="row">
					<div class="col-lg-12">
						<div class="ibox ">
							<div class="ibox-title">
								<h5>Student Registration by Semester List</h5>
								<div class="ibox-tools">
									<button class="btn btn-info btn-sm" type="button" id="btnAdd"><i class="fa fa-plus"></i>&nbsp;&nbsp;<span class="bold">Add</span></button>
								</div>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="tableMain" class="table table-striped table-bordered display table-hover" >
										<thead>
											<tr>
												<th style="display:none;">MapId</th>
												<th>Serial</th>
												<th>Semester</th>
												<th>Student Code</th>
												<th>Student Name</th>
												<th>Phone</th>
												<th>Reg Date</th>
												<th>Action</th>
												<th style="display:none;">StudentsId</th>
												<th style="display:none;">SemesterId</th>
												<th style="display:none;">YearId</th>
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
                            <h5>Student Registration by Semester Form</h5>
							<div class="ibox-tools">
								<button class="btn btn-info btn-sm" type="button" id="btnBack"><i class="fa fa-mail-reply"></i>&nbsp;&nbsp;<span class="bold">Back</span></button>
							</div>
                        </div>
                        <div class="ibox-content">
                            <form role="form" id="addeditform">	
                            	{{ csrf_field() }}							
								<div class="form-group row" id="daterangecontrol">
			
									<label class="col-lg-1 col-form-label">Reg Date<span class="fontred">*</span></label>
									<div class="col-lg-2 daterangecontrol">
										<div class="input-daterange input-group">
											<input type="text" class="form-control-sm form-control" name="RegDate" id="RegDate" data-date-format="yyyy-mm-dd" required />
										</div>										
									</div>
									
									<label class="col-lg-1 col-form-label">Year<span class="fontred">*</span></label>
                                    <div class="col-lg-3">
										<select data-placeholder="Choose a Year..." class="chosen-select" id="YearId" name="YearId" required="true">
											<option value="">Select Year</option>
										</select>
                                    </div>
									
									<label class="col-lg-1 col-form-label">Semester<span class="fontred">*</span></label>
                                    <div class="col-lg-4">
										<select data-placeholder="Choose a Semester..." class="chosen-select" id="SemesterId" name="SemesterId" required="true">
											<option value="">Select Semester</option>
										</select>
                                    </div>
								</div>
								
								<div class="form-group row">
									<label class="col-lg-1 col-form-label">Students<span class="fontred">*</span></label>
                                    <div class="col-lg-4">
										<select data-placeholder="Choose a Students..." class="chosen-select" id="StudentsId" name="StudentsId" required="true">
											<option value="">Select Students</option>
										</select>
                                    </div>
								</div>
								
								<div id="SubjectsDynamicControls">
								</div>
								
								<!--
								<div class="form-group row"><label class="col-lg-1 col-form-label">Remarks</label>
                                    <div class="col-lg-7">
										<input type="text" id="Remarks" name="Remarks" placeholder="Enter Remarks" class="form-control">
                                    </div>
                                </div>
								-->

								<div class="form-group row" style="border:1px solid #e7eaec; padding-top: 3px;">
									<label class="col-lg-1 col-form-label"><strong>Subject</strong></label>
									<div class="col-lg-7">
										<select data-placeholder="Choose the Subject..." class="chosen-select" id="SubjectId" name="SubjectId" required="true" >
											<option value="0">Select Subject</option>
										</select>
									</div>
									<div class="col-lg-1">
										<a href="javascript:void(0)" class="btn btn-warning btn-sm" onClick="addNewSubject()"><i class="fa fa-plus"></i> Add</a>
									</div>
								</div>
                                <div class="form-group row">
                                    <div class="col align-self-center">
										<!--<input type="text" value="insertUpdateRegistrationData" id="action" name="action" style="display:none;">-->
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
	var subjectIds = [];

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
			"url": SITEURL+"/deleteStudentRegistrationRoute",
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
	        url: SITEURL+"/addEditstudentregistrationRoute",
	        data: $("#addeditform").serialize()+"&subjectIds="+JSON.stringify(subjectIds),
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
					$("#FYearId").append($('<option></option>').val(obj.YearId).html(obj.Year));
					$("#YearId").append($('<option></option>').val(obj.YearId).html(obj.Year));
				});
				$("#FYearId,#YearId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>1){
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
					$("#FSemesterId").append($('<option></option>').val(obj.SemesterId).html(obj.Semester));
					$("#SemesterId").append($('<option></option>').val(obj.SemesterId).html(obj.Semester));
				});
				$("#FSemesterId,#SemesterId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>1){
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


function getStudentList() {

	    $.ajax({
	        type: "post",
	        url: SITEURL+"/getStudentListRoute",
	        data: {
	        	"id":1,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){
				$.each(response, function(i, obj) {
					$("#StudentsId").append($('<option></option>').val(obj.StudentsId).html(obj.StudentName));
				});
				$("#StudentsId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>1){
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
 


function getSubjectsControls(MapId) {

	    $.ajax({
	        type: "post",
	        async: false,
	        dataType: "json",
	        url: SITEURL+"/editstudentregistrationRoute",
	        data: {
	        	"id":1,
	        	"MapId":MapId,
        		"_token":$('meta[name="csrf-token"]').attr('content')
        	},
	        success:function(response){

				subjectIds = [];
				var subjectControlHtml="";
				$.each(response, function(SubjectId, obj) {
					subjectIds.push(SubjectId);
					var SubjectName = obj[1];
					subjectControlHtml +='<div class="form-group row" id="Items_'+SubjectId+'">'
						+'<a href="javascript:void(0)" class="btn btn-danger btn-sm" style="height: 29px; margin-top:4px;" onClick="deleteTransType('+SubjectId+');"><i class="fa fa-times"></i></a>'
						+'<label class="col-lg-10 col-form-label">'+SubjectName+'</label>'
						+'<input style="display:none;" type="text" id="Subjects_'+SubjectId+'" value="'+SubjectId+'">'
					+'</div>';
					
					
				});

				$("#SubjectsDynamicControls").html(subjectControlHtml);

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
					$("#SubjectId").append($('<option></option>').val(obj.SubjectId).html(obj.SubjectName));
				});
				$("#SubjectId").trigger("chosen:updated");

				filtercount++;
				if(filtercount>1){
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
	 

	function addNewSubject(){
		var SubjectId = $("#SubjectId").val();
		var SubjectName=$('#SubjectId').find(":selected").text();
		// alert(SubjectId);
		if(SubjectId == 0){
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Please select a subject.");

				}, 1300);
			return;
		}

		if(jQuery.inArray(SubjectId, subjectIds) != -1) {
			setTimeout(function() {
					toastr.options = {
						closeButton: true,
						progressBar: true,
						showMethod: 'slideDown',
						timeOut: 4000
					};
					toastr.error("Already exist this subject.");

				}, 1300);
			return;
		}

		var subjectControlHtml='<div class="form-group row" id="Items_'+SubjectId+'">'
					+'<a href="javascript:void(0)" class="btn btn-danger btn-sm" style="height: 29px; margin-top:4px;" onClick="deleteTransType('+SubjectId+');"><i class="fa fa-times"></i></a>'
					+'<label class="col-lg-10 col-form-label">'+SubjectName+'</label>'
					+'<input style="display:none;" type="text" id="Subjects_'+SubjectId+'" value="'+SubjectId+'">'
				+'</div>';

		$("#SubjectsDynamicControls").append(subjectControlHtml);

		subjectIds.push(SubjectId);
		$("#SubjectId").val(0).trigger("chosen:updated");
	}


	function deleteTransType(SubjectId){
		subjectIds = subjectIds.filter(function(elem){
		   return elem != SubjectId; 
		});
		$("#Items_"+SubjectId).remove();
	}


    $(document).ready(function() {

		getYearList();
		getSemesterList();
		getStudentList();
		getSubjectList();

	    /***Menu Active***/
		$( ".admin-menu" ).addClass( "active" );
		$( ".admin-menu ul" ).addClass( "in" );
		$( ".admin-menu ul" ).attr("aria-expanded", "true");
		$( ".student_registration_by_semester-menu" ).addClass( "active" );

		$('.daterangecontrol .input-daterange').datepicker({
				keyboardNavigation: false,
				forceParse: false,
				autoclose: true,
				format: 'yyyy-mm-dd'
				//format: 'dd/mm/yyyy'
			});

		$('.chosen-select').chosen({width: "100%"});

		$("#btnAdd").click(function () {
	       //resetForm("addeditform");
			//recordId="";
	        //onFormPanel();
	        resetForm("addeditform");
			recordId="";
			subjectIds = [];
			$("#SubjectsDynamicControls").empty();
	        onFormPanel();
			
			var date1 = new Date();
			var defaultCurrentDate = new Date(date1.getFullYear(), date1.getMonth(), date1.getDate());
			$('#RegDate').datepicker('setDate', defaultCurrentDate);
			

			$("#YearId").val('').trigger("chosen:updated");
			$("#SemesterId").val('').trigger("chosen:updated");
			$("#SubjectId").val(0).trigger("chosen:updated");
			$("#StudentsId").val('').trigger("chosen:updated");

	    });
			
		$("#btnSubmit").click(function () {
	        $("#addeditform").submit();
	    });
		
		$("#btnBack").click(function () {
	        onListPanel();
	    });
		
		$("#FYearId,#FSemesterId").change(function () {
	        getTableMainData();
	    });

		//getTableMainData();
 
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
		        "url": "<?php route('studentregistrationTblMain') ?>",
		        "datatype": "json",
		        "type": "post",
		        "data": {
		        	"YearId" : $('#FYearId').val(),
		        	"SemesterId" : $('#FSemesterId').val(),
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
						var sGroup = oSettings.aoData[oSettings.aiDisplay[iDisplayIndex]]._aData['Semester'];
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
		                
							$('#recordId').val(aData['MapId']);
							$('#RegDate').val(aData['RegDate']);
							$("#YearId").val(aData['YearId']).trigger("chosen:updated");
							$("#SemesterId").val(aData['SemesterId']).trigger("chosen:updated");
							$("#StudentsId").val(aData['StudentsId']).trigger("chosen:updated");

							swal({
								title: "Are you sure?",
								text: "Do you really want to edit this data?",
								type: "info",
								showCancelButton: true,
								confirmButtonColor: "#DD6B55",
								confirmButtonText: "Yes",
								closeOnConfirm: true
							}, function () {
								getSubjectsControls(aData['MapId']);
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
							onConfirmWhenDelete(aData['StudentsId']);
						});
					});
				});


		            
		    },
		    "columns":[
		        {"data":"MapId","bVisible" : false},
		        {"data":"Serial","sWidth": "5%", "sClass": "dt-center", "bSortable": false},
		        {"data":"Semester", "bVisible": false},
		        {"data":"StudentCode","sWidth": "12%"},
		        {"data":"StudentName","sWidth": "36%"},
		        {"data":"Phone","sWidth": "12%"},
		        {"data":"RegDate","sWidth": "10%"},
		        {"data":"action","sWidth": "10%", "sClass": "dt-center", "bSortable": false},
		        {"data":"StudentsId","bVisible" : false},
		        {"data":"SemesterId","bVisible" : false},
		        {"data":"YearId","bVisible" : false},
		        {"data":"Subjects","bVisible" : false}
		    ]
		});
}
</script>
 @endsection