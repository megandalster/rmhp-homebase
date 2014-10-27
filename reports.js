$(function() {
	$( "#from" ).datepicker();
	$( "#to" ).datepicker();

	$(document).on("keyup", ".volunteer-name", function() {
		var str = $(this).val();
		var target = $(this);
		$.ajax({
			type: 'get',
			url: 'reportsAjax.php?q='+str,
			success: function (response) {
				var suggestions = $.parseJSON(response);
				console.log(target);
				target.autocomplete({
					source: suggestions
				});
			}
		});
	});

	$("input[name='date']").change(function() {
		if ($("input[name='date']:checked").val() == 'date-range') {
			$("#fromto").show();
		} else {
			$("#fromto").hide();
		}
	});

	$("#report-submit").on('click', function (e) {
		e.preventDefault();
		$.ajax({
			type: 'post',
			url: 'reportsAjax.php',
			data: $('#search-fields').serialize(),
			success: function (response) {
				$("#outputs").html(response);
			}
		});
	} );
	
	$("#add-more").on('click', function(e) {
		e.preventDefault();
		var new_input = '<div class="ui-widget"> <input type="text" name="volunteer-names[]" class="volunteer-name"></div>';
		$("#volunteer-name-inputs").append(new_input);
	})

});