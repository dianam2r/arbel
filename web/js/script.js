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

    $('#searchUser').click(function(){
        $('#searchModel').modal('show')
            .find('#searchModelContent')
            .load($(this).attr('value'));
    });

    $('#searchTask').click(function(){
        $('#searchModel').modal('show')
            .find('#searchModelContent')
            .load($(this).attr('value'));
    });
});