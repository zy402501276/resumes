function form_submit(form_id)
{
    $.post($( "#"+form_id ).attr( "action" ),$( "#"+form_id ).serialize(),function( data ){
        if($("#"+form_id+"_notice"))
        $("#"+form_id+"_notice").html(data);
    })
}

function do_del(id)
{
    if( confirm( "确认删除嘛?" ) )
    {
        $.post('resume_delete.php',{id:id},function( data ){
           alert(data);
           location.reload();
        })
    }
}