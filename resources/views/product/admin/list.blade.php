@extends('admin.layouts.app')

@section('pageHeader')
Products
@endsection


@section('content')
<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class='nav-tabs-custom'>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs " role="tablist">
                    <li role="presentation" class="active"><a href="#category" id='categorytab' aria-controls="list" role="tab" data-toggle="tab">Category</a></li>
                    <li role="presentation"><a href="#product" id='producttab' aria-controls="form" role="tab" data-toggle="tab">Products</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" style="padding: 0;">
                    <div role="tabpanel" class="tab-pane active" id="category">
                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation" class="active"><a href="#categorylist" id='categorylisttab' aria-controls="list" role="tab" data-toggle="tab">List</a></li>
                            <li role="presentation"><a href="#categoryform" id='categoryformtab' aria-controls="form" role="tab" data-toggle="tab">Create/ Update Form</a></li>
                        </ul>
                        <div class="box-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="categorylist">
                                    <div class="box-body">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                                            <table id="categorylists" class="table table-hover dataTable" role="grid" aria-describedby="categorylists_info" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th>Name</th>
                                                        <th>Short Description</th>
                                                        <th width="5%">Sequence</th>
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
                                                        <th>Name</th>
                                                        <th>Short Description</th>
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
                                <div role="tabpanel" class="tab-pane" id="categoryform">
                                    <div class="box-body">
                                        <form autocomplete="off" v-on:submit.prevent="onSubmit" id="categoryform" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                                            <category-form 
                                                v-bind:info='model'
                                                v-bind:errors="errors"
                                                v-on:emit-setimage="setImage">
                                            </category-form>

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
                    <div role="tabpanel" class="tab-pane" id="product">
                        <ul class="nav nav-tabs " role="tablist">
                            <li role="presentation" class="active"><a href="#productlist" id='productlisttab' aria-controls="list" role="tab" data-toggle="tab">List</a></li>
                            <li role="presentation"><a href="#productform" id='productformtab' aria-controls="form" role="tab" data-toggle="tab">Create/ Update Form</a></li>
                        </ul>
                        <div class="box-body">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="productlist">
                                    <div class="box-body">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap">
                                            <table id="productlists" class="table table-hover dataTable" role="grid" aria-describedby="productlists_info" style="width: 100%">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">ID</th>
                                                        <th>Category</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th width="5%">Sequence</th>
                                                        <th width="5%">Bestseller</th>
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
                                                        <th>Category</th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Price</th>
                                                        <th>Sequence</th>
                                                        <th>Bestseller</th>
                                                        <th>Date Updated</th>
                                                        <th>Image</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="productform">
                                    <div class="box-body">
                                        <form autocomplete="off" v-on:submit.prevent="onSubmit" id="productform" class="form-horizontal col-sm-12" enctype="multipart/form-data">
                                            <product-form 
                                                v-bind:info='model'
                                                v-bind:errors="errors"
                                                v-bind:categories="categories"
                                                v-bind:products="products"
                                                v-on:emit-category="setCategory"
                                                v-on:emit-setprimaryimage="setPrimaryImage"
                                                v-on:emit-setalternateimage="setAlternateImage"
                                                v-on:emit-setmoreimage="setMoreImage">
                                            </product-form>

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
                <p>You are about to remove this category record (<strong id="idtobedeleted"></strong>) in the system. Do you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button onclick="proccessdata(category_id, `delete`)" type="button" class="btn btn-outline">Yes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-danger fade in" id="modal-danger2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Danger!</h4>
            </div>
            <div class="modal-body">
                <p>You are about to remove this product record (<strong id="idtobedeleted2"></strong>) in the system. Do you wish to continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button onclick="proccessdataproduct(product_id, `delete`)" type="button" class="btn btn-outline">Yes</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('ae-scripts')

<script>
    var categoryindexurl = "{{ route('category.index') }}";
    var categorydataurl = "{{ route('category.data') }}";
    
    var productindexurl = "{{ route('products.index') }}";
    var productdataurl = "{{ route('products.data') }}";
    
    var imageuploadurl = "{{ route('products.upload.images') }}";
    
    var productoptionurl = "{{ route('products.options.product') }}";
    var categoryoptionurl = "{{ route('products.options.category') }}";
</script>

<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.4.3/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/admin/products-vue.js') }}"></script>
<script src="{{ asset('js/admin/products-ext.js') }}"></script>


@endsection