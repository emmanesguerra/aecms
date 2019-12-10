<template>
    <div class="box-body">
        <div  class='form-group'>
            <label for="primary_image" class="col-sm-2 control-label">Upload your file(s) in the box below</label>
        </div>
        <div  class='form-group'>
            <div class="col-sm-9">
                <vueDropzone ref="myVueDropzone" 
                             id="fileDropZone" 
                             :options="dropzoneOptions"
                             @vdropzone-success="onSuccessPrimary" 
                             ></vueDropzone>
            </div>
        </div>
    </div>
</template>

<script>
    
    import vue2Dropzone from 'vue2-dropzone'

    export default {
        props: [],
        data: function () {
            return {
                dropzoneOptions: {
                    url: uploadurl,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            }
        },
        components: {
            vueDropzone: vue2Dropzone
        },
        computed: {
        },
        methods: {
            onSuccessPrimary (file, response) {
                filetable.ajax.reload();
            },
        }
    }
</script>