$(function(){
    $('#createTask').click(function(){
        $('#model').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

    $('#listTask').click(function(){
        window.location = "index.php?r=task%2Flist";
    });

    $('#createUser').click(function(){
        $('#model').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
});