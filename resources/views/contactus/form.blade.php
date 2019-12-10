<h1>Contact Us</h1>

<div id="contactusmain">
    <contact-list v-for="(item, indx) in model" v-bind:info='item'  v-bind:key="indx">
    </contact-list>
</div>

<form autocomplete="off" v-on:submit.prevent="onSubmit" id="contactform" class="form-horizontal col-sm-12">
    <contact-form 
        v-bind:info='model'
        v-bind:errors="errors">
    </contact-form>

    <!-- /.box-body -->
    <div class="box-footer">
        <button @click='submit' type="button" class="btn btn-primary">Submit</button>
    </div>
</form>


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script>
    var info = {!! json_encode($data['contacts']) !!};
    var contactapi = "{{ route('web.contactus.post') }}";
</script>