(function ($) {
	var progressTemplate = _.template($('#facewp-import-progress').html()),
		$result = $('#facewp-import-result'),
		importing = false;

	function get_progressbar_element(data) {
		return $result.find('#facewp-import-progress-' + data + ' .facewp-import-progressbar');
	}

	function facewp_import(demo, type, data, step) {
		importing = true;

		$result.parent().addClass('open');

		// Do AJAX
		$.ajax({
			url: ajaxurl,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'facewp_import',
				demo: demo,
				type: type,
				data: data,
				step: step
			},
			success: function (response) {
				if (typeof response.step != 'undefined') {
					// Display progressbar when the step equals to 1
					if (1 == response.step) {
						var title = 'Importing ' + facewp_import_data.types[data];

						$result.html(progressTemplate({title: title, data: data}));
					}

					var $bar = get_progressbar_element(response.data),
						percent = response.step / response.length * 100;

					$result.find('.facewp-import-progressbar-inner').css('width', percent + '%');

					if ( percent >= 100 ) {
						$bar.addClass('done');
					}
				}

				if (typeof response.next_data == 'undefined') {
					facewp_import(response.demo, response.type, response.data, response.step);
				} else if ('none' != response.next_data) {
					facewp_import(response.demo, response.type, response.next_data, 0);
				} else if ('none' == response.next_data) {
					$('body').trigger('facewp_import_done');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert("There is a error. Please contact us via email hifacewp@gmail.com.\r\n" + thrownError + "\r\n" + xhr.responseText);
			}
		});
	}

	window.onbeforeunload = function(evt){
		if ( true == importing ) {
			if (!evt) {
				evt = window.event;
			}

			evt.cancelBubble = true;
			evt.returnValue = 'The importer is running. Please don\'t navigate away from this page.';

			if (evt.stopPropagation) {
				evt.stopPropagation();
				evt.preventDefault();
			}
		}
	};

	$(document).ready(function () {
		var $trigger = $('.facewp-demo-source-install');

		$trigger.on('click', function (evt) {
			evt.preventDefault();

			if (!confirm('Do you want to import this demo?')) {
				return false;
			}

			var $this = $(this);

			$this.addClass('installing').html('Installing...');

			$trigger.prop('disabled', true);

			facewp_import($this.data('demo'), 'all', 'all', 0);
		});

		$('body').on('facewp_import_done', function () {
			importing = false;

			$trigger
				.prop('disabled', false)
				.filter('.installing')
				.html('Install');

			var doneTemplate = _.template($('#facewp-import-done-template').html());
			
			$('#facewp-import-result').html(doneTemplate());

			$('.facewp-import-button-close').on('click', function () {
				$('#facewp-import-result').parent().removeClass('open');

				return false;
			});

			alert('Import is successful!');
		});
	});
})(jQuery);