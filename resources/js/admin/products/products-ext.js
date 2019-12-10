
$('#producttab').on('shown.bs.tab', function (e) {
    $('#productlisttab').trigger('click');
});

$('#productformtab').on('shown.bs.tab', function (e) {
    axios.get(categoryoptionurl).then(function (response) {
        Vue.nextTick( function () {
            productformvue.categories = response.data.data
        });
    });
    axios.get(productoptionurl).then(function (response) {
        Vue.nextTick( function () {
            productformvue.products = response.data.data
        });
    });
});

proccessdata = function (id, method) {
    axios({
        method: method,
        url: categoryindexurl + '/' + id
    }).then(function (response) {
        if(response.status == 200) {
            window.categoryformvue.model = response.data;
            window.categoryformvue.errors = [];
            $('#categoryformtab').tab('show');
            proccessnoti({data: {title: 'Action Completed',
                    message: 'This category id #' + id + ' has been retreived and ready to be updated <br />',
                    icon: 'icon glyphicon glyphicon-info-sign',
                    type: 'info'
                }, statusText: ''})
        } else {
            $('#modal-danger').modal('hide');
            categorytable.ajax.reload();
            window.categoryformvue.reset();
            proccessnoti({data:{title:'Action Completed',
                    message:'This category id #'+id+' has been removed from the system <br />',
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

proccessdataproduct = function (id, method) {
    axios({
        method: method,
        url: productindexurl + '/' + id
    }).then(function (response) {
        if(response.status == 200) {
            window.productformvue.model = response.data;
            window.productformvue.errors = [];
            $('#productformtab').tab('show');
            proccessnoti({data: {title: 'Action Completed',
                    message: 'This product id #' + id + ' has been retreived and ready to be updated <br />',
                    icon: 'icon glyphicon glyphicon-info-sign',
                    type: 'info'
                }, statusText: ''})
        } else {
            $('#modal-danger2').modal('hide');
            producttable.ajax.reload();
            window.productformvue.reset();
            proccessnoti({data:{title:'Action Completed',
                    message:'This product id #'+id+' has been removed from the system <br />',
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
    category_id = id;
    $('#idtobedeleted').html(id);
    $('#modal-danger').modal('show');
}

showmodalProduct = function (id) {
    product_id = id;
    $('#idtobedeleted2').html(id);
    $('#modal-danger2').modal('show');
}

categorytable = $('#categorylists').DataTable({
    processing: true,
    "ajax": categorydataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "name"},
        {"data": "short_description"},
        {"data": "sequence"},
        {"data": "created_at"},
        {"data": "updated_at"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<img width="150px" src="'+full.full_path+'" />';
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

producttable = $('#productlists').DataTable({
    processing: true,
    "ajax": productdataurl,
    "aaSorting": [],
    "columns": [
        {"data": "id"},
        {"data": "category.name"},
        {"data": "name"},
        {"data": "description"},
        {"data": "selling_price"},
        {"data": "sequence"},
        {"data": "is_bestseller"},
        {"data": "created_at"},
        {"data": "updated_at"},
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<img width="150px" src="'+full.full_path_primary+'" />';
            }
        },
        {
            width: "5%",
            bSearchable: false,
            bSortable: false,
            mRender: function (data, type, full) {
                return '<button onclick="proccessdataproduct(' + full.id + ', `get`)" class="btn btn-primary btn-xs"><i class="fa fa-pencil "></i></button>&nbsp;&nbsp;'
                        + '<button onclick="showmodalProduct(' + full.id + ')" class="btn btn-primary btn-xs"><i class="fa fa-trash"></i></button>'
            }
        }
    ]
});
