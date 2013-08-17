jQuery(document).ready(function($){
	// Focus on first input in the body (nice to avoid tabbing through navigation with keyboard)
	$('body input:first').focus();
	
	// Requests page
		// Drag & drop
/* 		$('ul.requests').sortable().disableSelection(); */

    $('.requestshigh, .requestsmedium, .requestssmall').sortable().disableSelection();
 
    var $tabs = $('#tabs').tabs();
 
    var $tab_items = $( "ul:first li", $tabs ).droppable({
      accept: ".ui-sortable li",
      hoverClass: "ui-state-hover",
      drop: function( event, ui ) {
        var $item = $( this );
        var $list = $( $item.find( "a" ).attr( "href" ) )
          .find( ".ui-sortable" );
 
        ui.draggable.hide( "slow", function() {
          $tabs.tabs( "option", "active", $tab_items.index( $item ) );
          $( this ).appendTo( $list ).show( "slow" );
        });
      }
    });

});