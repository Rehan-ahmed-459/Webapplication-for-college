$(document).ready(function(){	
	$('#search').click(function(){
		$('#studentList').removeClass('hidden');		
		if ($.fn.DataTable.isDataTable("#studentList")) {
			$('#studentList').DataTable().clear().destroy();
		}
		var classid = $('#classid').val();		
		var attendanceDate = $('#attendanceDate').val();		
		if(classid && attendanceDate) {			
			$('#studentList').DataTable({
				"lengthChange": false,
				"processing":true,
				"serverSide":true,
				"order":[],
				"ajax":{
					url:"attendance_action.php",
					type:"POST",				
					data:{classid:classid, attendanceDate:attendanceDate, action:'getStudentsAttendance'},
					dataType:"json"
				},
				"columnDefs":[
					{
						"targets":[0],
						"orderable":false,
					},
				],
				"pageLength": 10
			});				
		}
	});	
});