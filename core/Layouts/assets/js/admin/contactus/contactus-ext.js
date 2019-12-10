

proccessdata = function (id, method) {
    axios({
        method: method,
        url: contactindexurl + '/' + id
    }).then(function (response) {
        if(response.status == 200) {
            window.contactformvue.model = response.data;
            window.contactformvue.model.storehours.push({
                day: null,
                start: null,
                end: null,
            });
            window.contactformvue.errors = [];
            window.contactformvue.removehours = [];
            $('#formtab').tab('show');
            proccessnoti({data: {title: 'Action Completed',
                    message: 'This page id #' + id + ' has been retreived and ready to be updated <br />',
                    icon: 'icon glyphicon glyphicon-info-sign',
                    type: 'info'
                }, statusText: ''})
        } else {
            $('#modal-danger').modal('hide');
            contacttable.ajax.reload();
            window.contactformvue.reset();
            proccessnoti({data:{title:'Action Completed',
                    message:'This contact id #'+id+' has been removed from the system <br />',
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
    contact_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

contacttable = $('#contactlists').DataTable({
    processing: true,
    "ajax": contactdataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "address"},
        {"data": "contact_person"},
        {
            mRender: function (data, type, full) {
                return (full.marker).substring(0, 40) + '...';
            }
        },
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