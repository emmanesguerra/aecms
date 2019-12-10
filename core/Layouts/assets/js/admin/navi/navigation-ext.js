

proccessdata = function (id, method) {
    axios({
        method: method,
        url: navigationindexurl + '/' + id
    }).then(function (response) {
        $('#modal-danger').modal('hide');
        navigationtable.ajax.reload();
        window.navigationformvue.reset();
        proccessnoti({data:{title:'Action Completed',
                message:'This navigation id #'+id+' has been removed from the system <br />',
                icon:'icon glyphicon glyphicon-trash',
                type: 'info'
            },statusText:''})
    }).catch(function (error) {
        if (error.response) {
            proccessnoti(error);
        }
    });
}

showmodal = function (id) {
    navigation_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

navigationtable = $('#navigationlists').DataTable({
    buttons: [
        'copy', 'excel', 'pdf'
    ]
});