$(document).ready(function() {
	
	$("input[type='checkbox']").change(function() {
		$(this).closest("label").toggleClass("active"); 
	});



});