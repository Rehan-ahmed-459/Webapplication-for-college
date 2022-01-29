$(document).ready(function(){
	var urlPath = window.location.pathname,
    urlPathArray = urlPath.split('.'),
    tabId = urlPathArray[0].split('/').pop();
	$('#dashboard, #teacher, #student, #attendance, #attendance_report').removeClass('active');	
	$('#'+tabId).addClass('active');


	

});