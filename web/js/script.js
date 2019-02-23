$(function(){
    $('#createTask').click(function(){
        $('#modelTask').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

    $('#listTask').click(function(){
        window.location = "index.php?r=task%2Flist";
    });
});