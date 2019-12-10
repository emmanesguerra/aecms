@extends('admin.layouts.app')

@section('pageHeader')
Navigation
@endsection

@section('content')
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class='nav-tabs-custom'>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs " role="tablist">
                    <li role="presentation" class="active"><a href="#list" id='listtab' aria-controls="list" role="tab" data-toggle="tab">Navigation List</a></li>
                    <li role="presentation"><a href="#form" id='formtab' aria-controls="form" role="tab" data-toggle="tab">Navigation Settings</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="list">
                        <div class="box-body">
                            <div class="dataTables_wrapper form-inline dt-bootstrap">
                                <table id="navigationlists" class="table table-hover dataTable" role="grid" aria-describedby="navigationlists_info" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th width='10%'>Image</th>
                                            <th width='30%'>Filename</th>
                                            <th width='40%'>Use these texts for your contents</th>
                                            <th width='10%'>Extension</th>
                                            <th width='10%'>Size</th>
                                            <th width='10%'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Image</th>
                                            <th>Filename</th>
                                            <th>Use these texts for your contents</th>
                                            <th>Extension</th>
                                            <th>Size</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="form">
                        <div class="box-body">
                             <form autocomplete="off" v-on:submit.prevent="onSubmit" id="navigationform" class="form-horizontal col-sm-12">
                                <navigation-form v-bind:info="model"
                                                 v-bind:errors="errors">
                                </navigation-form>
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
                <p>You are about to remove this navigation record (<strong id="idtobedeleted2"></strong>) in the system. Do you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button onclick="proccessdata(navigation_id, `delete`)" type="button" class="btn btn-outline">Yes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('ae-scripts')

<script>
    var navigationindexurl = "{{ route('navigation.index') }}";
    var navigationdataurl = "{{ route('navigation.getdata') }}";
</script>

<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('core/js/navigation-vue.js') }}"></script>
<script src="{{ asset('core/js/navigation-ext.js') }}"></script>


@endsection