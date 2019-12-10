@extends('admin.layouts.app')

@section('pageHeader')
Settings
@endsection

@section('headerShortDesc')
Names and description for website identifications, SEO and etc.
@endsection


@section('content')

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                     <form autocomplete="off" v-on:submit.prevent="onSubmit" id="settingsform" class="form-horizontal col-sm-12 col-md-12 col-lg-11">
                        <settings-form 
                            v-bind:info='model'
                            v-bind:timezones='timezones'
                            v-bind:tags='tags'
                            v-bind:errors="errors">
                        </settings-form>

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
</section>

@endsection

@section('ae-scripts')

<script>
    var timezones = {!! json_encode($data['timezones']) !!};
    var tags = {!! json_encode($data['tags']) !!};
    var model = {!! json_encode($data['model']) !!};
    
    var settingindexurl = "{{ route('setting.index') }}";
</script>

<script src="{{ asset('core/js/setting-vue.js') }}"></script>

@endsection