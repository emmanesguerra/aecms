

proccessdata = function (id, method) {
    axios({
        method: method,
        url: pageindexurl + '/' + id
    }).then(function (response) {
        if (response.status == 200) {
            window.pageformvue.model = response.data.model;
            window.pageformvue.panels = response.data.panels;
            window.pageformvue.errorsm = [];
            window.pageformvue.errorsp = null;
            $('#formtab').tab('show');
            proccessnoti({data: {title: 'Action Completed',
                    message: 'This page id #' + id + ' has been retreived and ready to be updated <br />',
                    icon: 'icon glyphicon glyphicon-info-sign',
                    type: 'info'
                }, statusText: ''})
        } else {
            $('#modal-danger').modal('hide');
            pagetable.ajax.reload();
            window.pageformvue.reset();
            proccessnoti({data: {title: 'Action Completed',
                    message: 'This page id #' + id + ' has been removed from the system <br />',
                    icon: 'icon glyphicon glyphicon-trash',
                    type: 'info'
                }, statusText: ''})
        }
    }).catch(function (error) {
        if (error.response) {
            proccessnoti(error);
        }
    });
}

showmodal = function (id) {
    page_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

pagetable = $('#pagelists').DataTable({
    processing: true,
    "ajax": pagedataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "name"},
        {"data": "url"},
        {"data": "title"},
        {"data": "description"},
        {"data": "template"},
        {"data": "type"},
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