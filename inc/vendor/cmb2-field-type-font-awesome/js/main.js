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

jQuery( document ).ready(function() {

	loadSvg();

	jQuery('#wpcontent').click(function () {
			loadSvg();
		}
	);

	jQuery('.selector-search input').on('input',function () {
		setTimeout( function(){
			loadSvg();
		}  , 200);
	});

});

function loadSvg(){
	var options = [
		'it-arrow-down',
		'it-arrow-down-circle',
		'it-arrow-down-triangle',
		'it-arrow-left',
		'it-arrow-left-circle',
		'it-arrow-left-triangle',
		'it-arrow-right',
		'it-arrow-right-circle',
		'it-arrow-right-triangle',
		'it-arrow-up',
		'it-arrow-up-circle',
		'it-arrow-up-triangle',
		'it-ban',
		'it-bookmark',
		'it-box',
		'it-burger',
		'it-calendar',
		'it-camera',
		'it-card',
		'it-chart-line',
		'it-check',
		'it-check-circle',
		'it-chevron-left',
		'it-chevron-right',
		'it-clip',
		'it-clock',
		'it-close',
		'it-close-big',
		'it-close-circle',
		'it-code-circle',
		'it-collapse',
		'it-comment',
		'it-copy',
		'it-delete',
		'it-download',
		'it-error',
		'it-exchange-circle',
		'it-expand',
		'it-external-link',
		'it-file',
		'it-files',
		'it-flag',
		'it-folder',
		'it-fullscreen',
		'it-funnel',
		'it-hearing',
		'it-help',
		'it-help-circle',
		'it-horn',
		'it-inbox',
		'it-info-circle',
		'it-key',
		'it-link',
		'it-list',
		'it-locked',
		'it-mail',
		'it-map-marker',
		'it-map-marker-circle',
		'it-map-marker-minus',
		'it-map-marker-plus',
		'it-maximize',
		'it-maximize-alt',
		'it-minimize',
		'it-minus',
		'it-minus-circle',
		'it-more-actions',
		'it-more-items',
		'it-note',
		'it-open-source',
		'it-pa',
		'it-password-invisible',
		'it-password-visible',
		'it-pencil',
		'it-piattaforme',
		'it-pin',
		'it-plug',
		'it-plus',
		'it-plus-circle',
		'it-presentation',
		'it-print',
		'it-refresh',
		'it-rss',
		'it-rss-square',
		'it-search',
		'it-settings',
		'it-share',
		'it-software',
		'it-star-full',
		'it-star-outline',
		'it-telephone',
		'it-tool',
		'it-unlocked',
		'it-upload',
		'it-user',
		'it-video',
		'it-warning',
		'it-warning-circle',
		'it-wifi',
		'it-zoom-in',
		'it-zoom-out',
		'it-restore',
		'it-behance',
		'it-facebook',
		'it-facebook-square',
		'it-flickr',
		'it-flickr-square',
		'it-github',
		'it-instagram',
		'it-linkedin',
		'it-linkedin-square',
		'it-medium',
		'it-medium-square',
		'it-telegram',
		'it-twitter',
		'it-twitter-square',
		'it-whatsapp',
		'it-whatsapp-square',
		'it-youtube',
		'it-google',
		'it-designers-italia',
		'it-team-digitale',
	];

	options.forEach(element => jQuery('.' + element).html('<img src="/wp-content/themes/theme-refactor/assets/svg/' + element + '.svg" alt="'+element+'" style="width:30px; margin-right:10px;">'));
}