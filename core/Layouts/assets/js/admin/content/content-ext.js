

proccessdata = function (id, method) {
    axios({
        method: method,
        url: contentindexurl + '/' + id
    }).then(function (response) {
        window.contentformvue.model = response.data;
        window.contentformvue.errors = [];
        $('#formtab').tab('show');
        proccessnoti({data: {title: 'Action Completed',
                message: 'This page id #' + id + ' has been retreived and ready to be updated <br />',
                icon: 'icon glyphicon glyphicon-info-sign',
                type: 'info'
            }, statusText: ''})
    }).catch(function (error) {
        if (error.response) {
            proccessnoti(error);
        }
    });
}

showmodal = function (id) {
    content_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

contenttable = $('#contentlists').DataTable({
    processing: true,
    "ajax": contentdataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "name"},
        {
            render: function (data, type, full) {
                if(full.type == 'M') {
                    return 'Main';
                } else {
                    return 'Panel';
                }
            }
        },
        {
            render: function (data, type, full) {
                var page = '';
                _.each(full.pages, function(data) {
                    page += (page == '') ? data.name: ', ' + data.name;
                });
                return page;
            }
        },
        {"data": "created_at"},
        {"data": "updated_at"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<button onclick="proccessdata(' + full.id + ', `get`)" class="btn btn-primary btn-xs"><i class="fa fa-pencil "></i></button>'
            }
        }
    ]
});

filetable = $('#filelists').DataTable({
    processing: true,
    "ajax": filedata + '/active',
    "aaSorting": [],
    "columns": [
        {
            mRender: function (data, type, full) {
                if(full.extension == 'jpg' || full.extension == 'png' || full.extension == 'gif') {
                    return '<img src="'+full.path+'" width="250" />';
                } else {
                    return '<i class="fa fa-file" style="font-size: 100px">';
                }
            }
        },
        {"data": "path"}
    ]
});