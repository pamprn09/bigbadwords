/**
 * File: collaborative-glossary-public.js
 * Description: JavaScript functionalities for the public-facing side of the Collaborative Glossary plugin using vanilla JS.
 */

document.addEventListener( 'DOMContentLoaded', function() {
    var termLinks = document.querySelectorAll( '.collaborative-glossary-term-link' );
    
    termLinks.forEach( function( termLink ) {
        termLink.addEventListener( 'click', function( event ) {
            event.preventDefault();
            
            // Perform actions when a glossary term link is clicked.
            var termId = termLink.dataset.termId;
            
            // Example AJAX call to fetch term details and display them.
            var xhr = new XMLHttpRequest();
            xhr.open( 'POST', your_glossary_plugin_vars.ajaxurl, true );
            xhr.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8' );
            xhr.onreadystatechange = function() {
                if ( this.readyState === 4 && this.status === 200 ) {
                    // Handle the response and display the glossary term details.
                    console.log( 'Glossary Term Details:', this.responseText );
                    
                    // Example: Append term details to a modal or display them inline.
                    var termDetailsContainer = document.getElementById( 'term-details-container' );
                    termDetailsContainer.innerHTML = this.responseText;
                }
            };
            xhr.onerror = function( error ) {
                console.error( 'Error fetching glossary term details:', error );
            };
            
            // Prepare data to send in the request.
            var data = 'action=get_glossary_term_details&term_id=' + encodeURIComponent( termId );
            
            // Send the AJAX request.
            xhr.send( data );
        } );
    } );

} );
