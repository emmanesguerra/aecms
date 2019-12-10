

proccessdata = function (id, method) {
    axios({
        method: method,
        url: userindexurl + '/' + id
    }).then(function (response) {
        if(response.status == 200) {
            window.userformvue.model = response.data;
            window.userformvue.errors = [];
            $('#formtab').tab('show');
            proccessnoti({data:{title:'Action Completed',
                    message:'This user id #'+id+' has been retreived and ready to be updated <br />',
                    icon:'icon glyphicon glyphicon-info-sign',
                    type: 'info'
                },statusText:''})
        } else {
            $('#modal-danger').modal('hide');
            usertable.ajax.reload();
            window.userformvue.reset();
            proccessnoti({data:{title:'Action Completed',
                    message:'This user id #'+id+' has been removed from the system <br />',
                    icon:'icon glyphicon glyphicon-trash',
                    type: 'info'
                },statusText:''})
        }
    }).catch(function (error) {
        if (error.response) {
            proccessnoti(error);
        }
    });
}

showmodal = function (id) {
    user_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

usertable = $('#userlists').DataTable({
    processing: true,
    "ajax": userdataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "firstname"},
        {"data": "middlename"},
        {"data": "lastname"},
        {"data": "email"},
        {"data": "usertype"},
        {"data": "created_at"},
        {"data": "updated_at"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<button onclick="proccessdata(' + full.id + ', `get`)" class="btn btn-primary btn-xs"><i class="fa fa-pencil "></i></button>&nbsp;&nbsp;'
                        + '<button onclick="showmodal(' + full.id + ')" class="btn btn-primary btn-xs"><i class="fa fa-trash"></i></button>'
            }
        }
    ]
});