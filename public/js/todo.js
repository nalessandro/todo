function visibility(e) {
    if(e.is(':checked'))
        $('.task-complete').removeClass('hidden')
    if($('.todo:checkbox:checked').length == 0)
        $('.task-complete').addClass('hidden')
}

$(document).ready( function(){
    $('#count').text($('ul#todo-items li').length + ' remaining');
    
});

$('#complete').click(function(event){
    event.preventDefault();
    $('.todo:checkbox:checked').each(function(){
        $.ajax({
            url: '/todos/' + this.value + '/edit',
            method: 'GET'
        });
    });
    window.location.reload();
})