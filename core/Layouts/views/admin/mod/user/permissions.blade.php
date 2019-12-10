@extends('admin.layouts.app')

@section('pageHeader')
User Permissions
@endsection

@section('headerShortDesc')
Displays/List modules' and users' permissions
@endsection


@section('content')

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                     <form autocomplete="off" v-on:submit.prevent="onSubmit" id="permissionform" class="form-horizontal col-sm-9 col-md-9 col-lg-6">
                        <permission-form 
                            v-bind:info='model'
                            v-bind:users='users'
                            v-bind:modules='modules'
                            v-bind:errors="errors"
                            v-on:emit-perm="setPerm"
                            v-on:emit-user="setUser">
                        </permission-form>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="button" class="btn btn-default">Discard Changes</button>
                            <button @click='submit' type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('ae-scripts')

<script>    
    var uesrs = {!! json_encode($data['users']) !!};
    var modules = {!! json_encode($data['modules']) !!};
    
    var permissionindexurl = "{{ route('permission.index') }}";
</script>

<script src="{{ asset('core/js/permission-vue.js') }}"></script>

@endsection