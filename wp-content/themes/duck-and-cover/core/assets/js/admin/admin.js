jQuery(document).ready(function ($) {
	var downloadable_file_frame;
	var file_path_field;
	$(document).on('click', '.facewp-abbey-button-upload-image', function (event) {

		var $el = $(this);

		file_path_field = $('#' + $el.data('input'));

		event.preventDefault();

		// If the media frame already exists, reopen it.
		if (downloadable_file_frame) {
			downloadable_file_frame.open();
			return;
		}

		var downloadable_file_states = [
			// Main states.
			new wp.media.controller.Library({
				library: wp.media.query(),
				multiple: true,
				title: $el.data('choose'),
				priority: 20,
				filterable: 'uploaded',
			})
		];

		// Create the media frame.
		downloadable_file_frame = wp.media.frames.downloadable_file = wp.media({
			// Set the title of the modal.
			title: $el.data('choose'),
			library: {
				type: ''
			},
			button: {
				text: $el.data('update'),
			},
			multiple: true,
			states: downloadable_file_states,
		});

		// When an image is selected, run a callback.
		downloadable_file_frame.on('select', function () {

			var file_path = '';
			var selection = downloadable_file_frame.state().get('selection');

			selection.map(function (attachment) {

				attachment = attachment.toJSON();

				if (attachment.url)
					file_path = attachment.url

			});

			file_path_field.val(file_path);
		});

		// Finally, open the modal.
		downloadable_file_frame.open();
	});

	$(document).on('click', '.facewp-abbey-button-remove-image', function () {
		var $el = $(this);

		file_path_field = $('#' + $el.data('input'));
		file_path_field.val('');

		event.preventDefault();
	});
});