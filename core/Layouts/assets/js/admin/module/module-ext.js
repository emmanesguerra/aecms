

proccessdata = function (id, method) {
    axios({
        method: method,
        url: moduleindexurl + '/' + id
    }).then(function (response) {
        $('#modal-danger').modal('hide');
        moduletable.ajax.reload();
        window.moduleformvue.reset();
        proccessnoti({data:{title:'Action Completed',
                message:'This module id #'+id+' has been removed from the system <br />',
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
    module_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

moduletable = $('#modulelists').DataTable({
    processing: true,
    "ajax": moduledataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "module_name"},
        {"data": "description"},
        {"data": "permissions"},
        {"data": "created_at"},
        {"data": "updated_at"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<button onclick="showmodal(' + full.id + ')" class="btn btn-primary btn-xs"><i class="fa fa-trash"></i></button>'
            }
        }
    ]
});