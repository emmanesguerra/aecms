@extends('admin.layouts.app')

@section('pageHeader')
Sliders
@endsection

@section('headerShortDesc')
Manage homepage's sliding images
@endsection

@section('content')
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class='nav-tabs-custom'>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs " role="tablist">
                    <li role="presentation" class="active"><a href="#list" id='listtab' aria-controls="list" role="tab" data-toggle="tab">Lists</a></li>
                    <li role="presentation"><a href="#form" id='formtab' aria-controls="form" role="tab" data-toggle="tab">Create/ Update Form</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="list">
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <table id="sliderlists" class="table table-hover dataTable" role="grid" aria-describedby="sliderlists_info" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width="5%">ID</th>
                                            <th>Header</th>
                                            <th>Description</th>
                                            <th>Sequence</th>
                                            <th width="10%">Date Created</th>
                                            <th width="10%">Date Updated</th>
                                            <th>Image</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Header</th>
                                            <th>Description</th>
                                            <th>Sequence</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="form">
                        <div class="box-body">
                             <form autocomplete="off" v-on:submit.prevent="onSubmit" id="sliderform" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                                <slider-form 
                                    v-bind:info='model'
                                    v-bind:errors="errors"
                                    v-on:emit-setimage="setImage"
                                    v-on:emit-image-remove="deleteImage"
                                    v-on:emit-reset='reset'>
                                </slider-form>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal modal-danger fade in" id="modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Danger!</h4>
            </div>
            <div class="modal-body">
                <p>You are about to remove this slider record (<strong id="idtobedeleted"></strong>) in the system. Do you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button onclick="proccessdata(slider_id, `delete`)" type="button" class="btn btn-outline">Yes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('ae-scripts')

<script>
    var sliderindexurl = "{{ route('sliders.index') }}";
    var sliderdataurl = "{{ route('sliders.data') }}";
    var slideruploadurl = "{{ route('sliders.upload') }}";
</script>

<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/admin/sliders-vue.js') }}"></script>
<script src="{{ asset('js/admin/sliders-ext.js') }}"></script>


@endsection