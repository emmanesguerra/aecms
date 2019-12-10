@extends('admin.layouts.app')

@section('pageHeader')
Contact Us
@endsection

@section('headerShortDesc')
Setup email sender, cc and bccs
@endsection


@section('content')

<!-- Main content -->
<section class="content container-fluid">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-body">
                     <form autocomplete="off" v-on:submit.prevent="onSubmit" id="contactform" class="form-horizontal col-sm-9 col-md-9 col-lg-6">
                        <contact-form 
                            v-bind:info='model'
                            v-bind:errors="errors">
                        </contact-form>

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
    var model = {!! json_encode($data['model']) !!};
    
    var contactusindexurl = "{{ route('contactus.index') }}";
</script>

<script src="{{ asset('core/js/setting-vue.js') }}"></script>

@endsection