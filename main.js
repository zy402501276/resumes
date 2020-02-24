function send_form( form_id ){
   alert(111);
    $.post( $("#"+form_id).attr("action") , $( "#"+form_id ).serialize() , function( data ){
        if( $( "#"+form_id+"_notice" ) ) 
            $( "#"+form_id+"_notice" ).html(data);
    })

    
}