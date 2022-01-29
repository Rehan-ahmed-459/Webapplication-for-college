$(document).ready(function(){	

	var studentRecords = $('#studentListing').DataTable({
		"lengthChange": false,
		"processing":true,
		"serverSide":true,		
		"bFilter": false,
		'serverMethod': 'post',		
		"order":[],
		"ajax":{
			url:"student_action.php",
			type:"POST",
			data:{action:'listStudents'},
			dataType:"json"
		},
		"columnDefs":[
			{
				"targets":[0, 4],
				"orderable":false,
			},
		],
		"pageLength": 10
	});	
	
	$("#studentListing").on('click', '.view', function(){
		var id = $(this).attr("id");
		var action = 'getStudent';
		$.ajax({
			url:'student_action.php',
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data){				
				$("#studentDetails").on("shown.bs.modal", function () { 					
					$('#name').html(data.name);
					$('#email').html(data.email);
					$('#mobile').html(data.mobile);
					$('#class').html(data.class_name);				
					$('#roll_no').html(data.roll_no);
					$('#fname').html(data.father_name);	
					$('#fmobile').html(data.father_mobile);	
					$('#mname').html(data.mother_name);	
					$('#mmobile').html(data.mother_mobile);	
					$('#address').html(data.current_address);							
				}).modal();			
			}
		});
	});
	
});