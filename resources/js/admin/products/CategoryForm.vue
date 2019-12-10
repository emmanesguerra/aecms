<template>
    <div class="box-body">
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="name" class="col-sm-2 control-label">Category Name</label>
            <div class="col-sm-6">
                <input maxlength="50" type="text" class="form-control" id="name" v-model="info.name" placeholder="Category Name" >
                <form-error v-if="errors.name" :errors="errors.name ">
                    {{ errors.name }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.short_description ? 'form-group has-error' : 'form-group'">
            <label for="short_description" class="col-sm-2 control-label">Brief Description</label>
            <div class="col-sm-8">
                <input maxlength="255" type="text" class="form-control" id="short_description" v-model="info.short_description" placeholder="Brief Description" >
                <form-error v-if="errors.short_description" :errors="errors.short_description ">
                    {{ errors.short_description }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.description ? 'form-group has-error' : 'form-group'">
            <label for="description" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-8">
                <textarea rows="5" class="form-control" id="description"  v-model="info.description"> </textarea>
                <form-error v-if="errors.description" :errors="errors.description ">
                    {{ errors.description }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.image ? 'form-group has-error' : 'form-group'">
            <label for="image" class="col-sm-2 control-label">Display Image</label>
            <div class="col-sm-3">
                <vueDropzone ref="myVueDropzone" 
                             id="fileDropZone" 
                             :options="dropzoneOptions"
                             @vdropzone-success="onSuccess" 
                             ></vueDropzone>
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
    </div>
</template>

<script>

    import vue2Dropzone from 'vue2-dropzone'
    
    export default {
        props: ['info', 'errors'],
        components: {
            vueDropzone: vue2Dropzone
        },
        data: function () {
            return {
                dropzoneOptions: {
                    url: imageuploadurl,
                    maxFilesize: 0.5,
                    maxFiles: 1,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            }
        },
        computed: {
        },
        methods: {
            onSuccess (file, response) {
                this.$emit('emit-setimage', {
                    data: response.file,
                });
            }
        }
    }
</script>