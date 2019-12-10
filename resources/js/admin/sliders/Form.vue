<template>
    <div class="box-body">
        <div  class="form-group" v-if="info.id > 0">
            <label for="header" class="col-sm-2 control-label">ID</label>
            <div class="col-sm-2">
                <span class="form-control">{{ info.id }}</span>
            </div>
        </div> 
        <div  v-bind:class="errors.header ? 'form-group has-error' : 'form-group'">
            <label for="header" class="col-sm-2 control-label">Header Title</label>
            <div class="col-sm-6">
                <input maxlength="50" type="text" class="form-control" id="header" v-model="info.header" placeholder="Header Title" >
                <form-error v-if="errors.header" :errors="errors.header ">
                    {{ errors.header }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.description ? 'form-group has-error' : 'form-group'">
            <label for="description" class="col-sm-2 control-label">Short Description</label>
            <div class="col-sm-8">
                <input maxlength="255" type="text" class="form-control" id="description" v-model="info.description" placeholder="Short Description" >
                <form-error v-if="errors.description" :errors="errors.description ">
                    {{ errors.description }}
                </form-error>
            </div>
        </div> 
        <div class="form-group" v-if='info.id > 0' >
            <label for="sequence" class="col-sm-2 control-label">Current Image</label>
            <div class="col-sm-4">
                <img v-bind:src='info.full_path' width='100%'/>
            </div>
        </div> 
        <div  v-bind:class="errors.image ? 'form-group has-error' : 'form-group'">
            <label v-if='info.id > 0' for="image" class="col-sm-2 control-label">Replace current image with</label>
            <label v-else for="image" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-4">
                <vueDropzone ref="myVueDropzoneRef"
                          id="myVueDropzone" 
                          v-bind:use-custom-dropzone-options=true 
                          v-bind:options="dzOptions"
                          v-bind:destroyDropzone="false"
                          @vdropzone-success="onSuccess"
                          @vdropzone-removed-file="deleteImages">
                </vueDropzone>
                <form-error v-if="errors.image" :errors="errors.image ">
                    {{ errors.image }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.sequence ? 'form-group has-error' : 'form-group'">
            <label for="sequence" class="col-sm-2 control-label">Sequence</label>
            <div class="col-sm-1">
                <input max="999" type="number" class="form-control" id="sequence" v-model="info.sequence" placeholder="Sequence" >
                <form-error v-if="errors.sequence" :errors="errors.sequence ">
                    {{ errors.sequence }}
                </form-error>
            </div>
        </div> 
        <div class="box-footer">
            <button @click='reset' type="button" class="btn btn-default">Discard Changes</button>
            <button @click='submit' type="button" class="btn btn-primary">Submit</button>
        </div>
    </div>
</template>

<script>

    import vue2Dropzone from 'vue2-dropzone'
    
    export default {
        props: ['info', 'errors'],
        components: {
            vueDropzone: vue2Dropzone
        },
        computed: {
            dzOptions: function () {
                return {
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    addRemoveLinks: true,
                    dictRemoveFile: 'Remove',
                    acceptedFiles: '.jpg,.jpeg,.png',
                    url: slideruploadurl,
                    thumbnailWidth: 300,
                    thumbnailHeight: 140,
                    maxFiles: 1
                };
            },
        },
        methods: {
            onSuccess (file, response) {
                this.$emit('emit-setimage', {
                    data: response.file,
                });
            },
            deleteImages (file, err, xHR) {
                this.$emit('emit-image-remove', {
                    image: file.name
                });
            },
            reset () {
                this.$refs.myVueDropzoneRef.removeAllFiles();
                this.$emit('emit-reset');
            },
            submit: function () {
                var vm = this;
                var method = 'post';
                if(this.info.id > 0) {
                    method = 'put';
                }

                axios({
                   url: sliderindexurl,
                   method: method,
                   data: this.info,
                }).then(function (response) {
                    slidertable.ajax.reload();
                    proccessnoti(response);
                    vm.$refs.myVueDropzoneRef.removeAllFiles();
                    vm.$emit('emit-reset');
                }).catch(function (error) {
                    vm.errors = [];
                    if (error.response) {         
                        vm.errors = error.response.data.errors;   
                        proccessnoti(error.response);
                    }
                });
            }
        }
    }
</script>