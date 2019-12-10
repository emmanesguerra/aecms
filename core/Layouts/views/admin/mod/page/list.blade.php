@extends('admin.layouts.app')

@section('pageHeader')
Pages
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
                                <table id="pagelists" class="table table-hover dataTable" role="grid" aria-describedby="pagelists_info" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Url</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Template</th>
                                            <th>Type</th>
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
                                            <th>Url</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Template</th>
                                            <th>Type</th>
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
                             <form autocomplete="off" v-on:submit.prevent="onSubmit" id="pageform" class="form-horizontal col-sm-12">
                                <page-form 
                                    v-bind:info='model'
                                    v-bind:templates="templates"
                                    v-bind:javascripts="javascripts"
                                    v-bind:styles="styles"
                                    v-bind:errors="errorsm"
                                    v-bind:errorsp="errorsp"
                                    v-on:emit-template="getTemplate">
                                </page-form>
                                
                                <panel-form  v-for="panel in panels"
                                    v-bind:panel="panel"
                                    v-bind:javascripts="model.javascripts"
                                    v-bind:css="model.styles"
                                    v-bind:mainpanels="mainpanels"
                                    v-bind:regularpanels="regularpanels">
                                </panel-form>

                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button @click='reset' type="button" class="btn btn-default">Discard Changes</button>
                                    <button @click='submit' type="button" class="btn btn-primary">Submit</button>
                                </div>
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
                <p>You are about to remove this page record (<strong id="idtobedeleted"></strong>) in the system. Do you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button onclick="proccessdata(page_id, `delete`)" type="button" class="btn btn-outline">Yes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('ae-scripts')

<script>
    var templates = {!! json_encode($data['templates']) !!};
    var javascripts = {!! json_encode($data['javascripts']) !!};
    var styles = {!! json_encode($data['styles']) !!};
    var mainpanels = {!! json_encode($data['mainpanels']) !!};
    var regularpanels = {!! json_encode($data['regularpanels']) !!};
    
    var pageindexurl = "{{ route('page.index') }}";
    var pagedataurl = "{{ route('page.data') }}";
    var pagetemplateurl = "{{ route('page.template') }}";
</script>

<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('tinymce_4.7.13/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('tinymce_4.7.13/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('core/js/page-vue.js') }}"></script>
<script src="{{ asset('core/js/page-ext.js') }}"></script>


@endsection