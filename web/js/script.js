$(function(){
    $('#createTask').click(function(){
        $('#modelTask').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
});