

proccessdata = function (id, method) {
    axios({
        method: method,
        url: filedata,
        data: {
            file: id
        }
    }).then(function (response) {
        if(response.status == 201) {
            $('#modal-info').modal('hide');
            filetable.ajax.reload();
            archivetable.ajax.reload();
            proccessnoti({data:{title:'Action Completed',
                    message:'This file '+id+' has been archived from the system <br />',
                    icon:'icon glyphicon glyphicon-ok',
                    type: 'info'
                },statusText:''})
        } else if (response.status == 200) {
            $('#modal-success').modal('hide');
            filetable.ajax.reload();
            archivetable.ajax.reload();
            proccessnoti({data:{title:'Action Completed',
                    message:'This file '+id+' has been restored to the system <br />',
                    icon:'icon glyphicon glyphicon-ok',
                    type: 'success'
                },statusText:''})
        } else {
            $('#modal-danger').modal('hide');
            archivetable.ajax.reload();
            proccessnoti({data:{title:'Action Completed',
                    message:'This file '+id+' has been removed from the system <br />',
                    icon:'icon glyphicon glyphicon-trash',
                    type: 'danger'
                },statusText:''})
        }
    }).catch(function (error) {
        if (error.response) {
            proccessnoti(error);
        }
    });
}

showmodal = function (id, action) {
    file_id = id;
    switch(action)
    {
        case "archived":
            $('#idtobedeleted1').html(id);
            $('#modal-info').modal('show');
            break;
        case "deleted":
            $('#idtobedeleted2').html(id);
            $('#modal-danger').modal('show');
            break;
        case "restore":
            $('#idtobedeleted3').html(id);
            $('#modal-success').modal('show');
            break;
    }
    
}

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
        {"data": "basename"},
        {"data": "path"},
        {"data": "extension"},
        {"data": "size"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<button onclick="showmodal(\'' + full.basename + '\', \'archived\')" class="btn btn-info btn-xs"  title="archive"><i class="fa fa-archive"></i></button>'
            }
        }
    ]
});

archivetable = $('#archiveslists').DataTable({
    processing: true,
    "ajax": filedata + '/archive',
    "aaSorting": [],
    "columns": [
        {
            mRender: function (data, type, full) {
                if(full.extension == 'jpg' || full.extension == 'png' || full.extension == 'gif') {
                    return '<img src="'+full.path+'" width="250" />';
                } else {
                    return '<i class="fa fa-file-word">';
                }
            }
        },
        {"data": "basename"},
        {"data": "extension"},
        {"data": "size"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<button onclick="showmodal(\'' + full.basename + '\', \'restore\')" class="btn btn-success btn-xs" title="restore"><i class="fa fa-window-restore "></i></button>&nbsp;&nbsp;'
                        + '<button onclick="showmodal(\'' + full.basename + '\', \'deleted\')" class="btn btn-danger btn-xs" title="delete"><i class="fa fa-trash"></i></button>'
            }
        }
    ]
});