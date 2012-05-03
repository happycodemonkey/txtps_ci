$(document).ready(function () {	
	
	$('#nav li').hover(
		function () {
			//show its submenu
			$('ul', this).slideDown(100);

		}, 
		function () {
			//hide its submenu
			$('ul', this).slideUp(100);			
		}
	);
	
	$('.accordian_header').click(
		function() {
			$(this).next('div.accordian').toggle();
		}
	);

	$('#argument_type').change(
		function() {
			if ($(this).val() == "SELECT") {
				$('#argument_select_options').show();
			} else {
				$('#argument_select_options').hide();
			}
		}
	);
});

