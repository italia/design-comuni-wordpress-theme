(function($) {
  'use strict';

	$('.iconselectfa').each(function(){
		$(this).fontIconPicker({
			theme: 'fip-grey'
		})
	})

	// Before a new group row is added, destroy Select2. We'll reinitialise after the row is added
	$('.cmb-repeatable-group').on('cmb2_add_group_row_start', function (event, instance) {
		var $table = $(document.getElementById($(instance).data('selector')));
		var $oldRow = $table.find('.cmb-repeatable-grouping').last();

		$oldRow.find('.iconselectfa').each(function () {
			$(this).fontIconPicker().destroyPicker();
		});
	});

	// When a new group row is added, clear selection and initialise Select2
	$('.cmb-repeatable-group').on('cmb2_add_row', function (event, newRow) {
		$(newRow).find('.iconselectfa').each(function () {
			$('option:selected', this).removeAttr("selected");
			$(this).fontIconPicker().refreshPicker({
				theme: 'fip-grey'
			});
		});

		// Reinitialise the field we previously destroyed
		$(newRow).prev().find('.iconselectfa').each(function () {
			$(this).fontIconPicker().refreshPicker({
				theme: 'fip-grey'
			});
		});
	});

	// Before a group row is shifted, destroy Select2. We'll reinitialise after the row shift
	$('.cmb-repeatable-group').on('cmb2_shift_rows_start', function (event, instance) {
		var groupWrap = $(instance).closest('.cmb-repeatable-group');
		groupWrap.find('.iconselectfa').each(function () {
			$(this).fontIconPicker().destroyPicker();
		});

	});

	// When a group row is shifted, reinitialise Select2
	$('.cmb-repeatable-group').on('cmb2_shift_rows_complete', function (event, instance) {
		var groupWrap = $(instance).closest('.cmb-repeatable-group');
		groupWrap.find('.iconselectfa').each(function () {
			$(this).fontIconPicker().refreshPicker({
				theme: 'fip-grey'
			});
		});
	});

	// Before a new repeatable field row is added, destroy Select2. We'll reinitialise after the row is added
	$('.cmb-add-row-button').on('click', function (event) {
		var $table = $(document.getElementById($(event.target).data('selector')));
		var $oldRow = $table.find('.cmb-row').last();

		$oldRow.find('.iconselectfa').each(function () {
			$(this).fontIconPicker().destroyPicker();
		});
	});

	// When a new repeatable field row is added, clear selection and initialise Select2
	$('.cmb-repeat-table').on('cmb2_add_row', function (event, newRow) {

		// Reinitialise the field we previously destroyed
		$(newRow).prev().find('.iconselectfa').each(function () {
			$('option:selected', this).removeAttr("selected");
				$(this).fontIconPicker().refreshPicker({
				theme: 'fip-grey'
				});
		});
	});

	$( "#target" ).click(function() {
		alert( "Handler for .click() called." );
	});

	jQuery('.it-designers-italia').click(function(){
		console.log('hello');
		jQuery('.it-designers-italia').find('i').replaceWith('<svg className="icon"> <use href="/bootstrap-italia/dist/svg/sprite.svg#it-video"></use></svg>');
	});

})(jQuery);
