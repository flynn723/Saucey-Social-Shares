console.log('admin-plugin-scripts.js loaded');

// requires jQuery UI Sortable
jQuery(document).ready( function($) {
    $('#post-body').sortable();
    $('#post-body').disableSelection();
});

jQuery( ".ui-sortable .toggle-postbox-inside" ).on('click', function() {
	var toggleElement = jQuery(this).next().next();
	toggleElement.toggle( "slow", function() {
	// Animation complete.
	});
});

function isTwitterEnabled(){
	if (jQuery('input.setting-enable-Twitter').is(':checked')){
		jQuery('.option-twitter-handle-setting-wrap').slideDown();
	} else {
		jQuery('.option-twitter-handle-setting-wrap').slideUp();
	}
}
function isStylingEnabled(){
	if (jQuery('input.setting-saucy-styling').is(':checked')){
		jQuery('.option-styling-theme-setting-wrap, .option-custom-css-setting-wrap').slideUp();
	} else {
		jQuery('.option-styling-theme-setting-wrap, .option-custom-css-setting-wrap').slideDown();
	}
}
jQuery(document).ready(function($){
	isTwitterEnabled();
	isStylingEnabled();
});
jQuery('body').on('click', function($){
	isTwitterEnabled();
	isStylingEnabled();
});

