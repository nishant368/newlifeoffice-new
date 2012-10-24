function sectionSelection() {
	
	jQuery( '#raw_panel_left > li:first' ).addClass( 'active' );
	jQuery( '#raw_panel_right > li:first' ).show().addClass( 'active' );
	
	//when clicked
	jQuery( '#raw_panel_left > li' ).click(function() {
		
		if( jQuery( this ).attr( 'class' ) != 'active' ) {
			
			jQuery( '#raw_panel_left > li.active' ).removeClass( 'active' );
			jQuery( this ).addClass( 'active' );
			
			var id = jQuery( this ).attr( 'id' );
			
			jQuery( '#raw_panel_right > li.active' ).hide();
			jQuery( '#raw_panel_right > li.active' ).removeClass( 'active' );
			jQuery( '.'+id ).show().addClass( 'active' );
			
			tabSelection();

		}
		
	});
	
}

function tabSelection() {
	
	jQuery( '#raw_panel_right > li.active > .raw_section_tabs > li' ).removeClass( 'active' );
	jQuery( '#raw_panel_right > li.active > .raw_section_tabs > li:first' ).addClass( 'active' );
	jQuery( '.raw_section_panels > li').hide();
	jQuery( '#raw_panel_right > li.active > .raw_section_panels > li:first' ).show();
	
	jQuery( '.raw_section_tabs > li' ).click(function() {
		
		if( jQuery( this ).attr('class') != 'active' ) {
			
			var tabId = jQuery( this ).attr( 'id' );
			
			jQuery( '.raw_section_panels > li' ).hide();
			jQuery( '.raw_section_panels > li.'+tabId ).show();
			
			jQuery( '.raw_section_tabs > li.active' ).removeClass( 'active' );
			jQuery( '#'+tabId ).addClass( 'active' );
			
		}
		
	});
	
}