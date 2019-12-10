@extends('admin.layouts.app')

@section('pageHeader')
Main Contents
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
                    <li role="presentation"><a href="#form" id='formtab' aria-controls="form" role="tab" data-toggle="tab">Update Form</a></li>
                    <li role="presentation" style="float:right"><a href="#file" id='filetab' aria-controls="file" role="tab" data-toggle="tab">Uploaded Files</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="list">
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <table id="contentlists" class="table table-hover dataTable" role="grid" aria-describedby="contentlists_info" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Displayed at pages</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Displayed at pages</th>
                                            <th>Date Created</th>
                                            <th>Date Updated</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="form">
                        <div class="box-body">
                             <form autocomplete="off" v-on:submit.prevent="onSubmit" id="contentform" class="form-horizontal col-sm-12">
                                <content-form 
                                    v-bind:info='model'
                                    v-bind:types="types"
                                    v-bind:errors="errors">
                                </content-form>

                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button @click='reset' type="button" class="btn btn-default">Discard Changes</button>
                                    <button @click='submit' type="button" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="file">
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <table id="filelists" class="table table-hover dataTable" role="grid" aria-describedby="filelists_info" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width='10%'>Image</th>
                                            <th width='90%'>Use these texts for your contents</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Image</th>
                                            <th>Use these texts for your contents</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
                <p>You are about to remove this content record (<strong id="idtobedeleted"></strong>) in the system. Do you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button onclick="proccessdata(content_id, `delete`)" type="button" class="btn btn-outline">Yes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('ae-scripts')

<script>
    var contentindexurl = "{{ route('maincontents.index') }}";
    var contentdataurl = "{{ route('maincontents.data') }}";
    var filedata = "{{ route('files.process.get') }}";
</script>

<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('tinymce_4.7.13/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('tinymce_4.7.13/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('core/js/content-vue.js') }}"></script>
<script src="{{ asset('core/js/content-ext.js') }}"></script>


@endsection