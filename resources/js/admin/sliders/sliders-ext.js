

proccessdata = function (id, method) {
    axios({
        method: method,
        url: sliderindexurl + '/' + id
    }).then(function (response) {
        if(response.status == 200) {
            window.sliderformvue.model = response.data;
            window.sliderformvue.errors = [];
            $('#formtab').tab('show');
            proccessnoti({data: {title: 'Action Completed',
                    message: 'This slider id #' + id + ' has been retreived and ready to be updated <br />',
                    icon: 'icon glyphicon glyphicon-info-sign',
                    type: 'info'
                }, statusText: ''})
                        
        } else {
            $('#modal-danger').modal('hide');
            slidertable.ajax.reload();
            window.sliderformvue.reset();
            proccessnoti({data:{title:'Action Completed',
                    message:'This slider id #'+id+' has been removed from the system <br />',
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
    slider_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

slidertable = $('#sliderlists').DataTable({
    processing: true,
    "ajax": sliderdataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "header"},
        {"data": "description"},
        {"data": "sequence"},
        {"data": "created_at"},
        {"data": "updated_at"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<img width="250px" src="'+full.full_path+'" />';
            }
        },
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