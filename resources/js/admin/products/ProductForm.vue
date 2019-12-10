<template>
    <div class="box-body">
        <div  v-bind:class="errors.category_id ? 'form-group has-error' : 'form-group'">
            <label for="category_id" class="col-sm-2 control-label">Product Category*</label>
            <div class="col-sm-6">
                <multiselect v-bind:value="assigncategory"
                             target="id"
                             label="name"
                             v-bind:options="categories"
                             @select="onSelectCategory"
                             placeholder="Select Category">
                </multiselect>
                <form-error v-if="errors.category_id" :errors="errors.category_id">
                    {{ errors.category_id }}
                </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="name" class="col-sm-2 control-label">Product Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="name" v-model="info.name" placeholder="Product Name" >
                <form-error v-if="errors.name" :errors="errors.name ">
                    {{ errors.name }}
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
        <div  v-bind:class="errors.factory_price ? 'form-group has-error' : 'form-group'">
            <label for="factory_price" class="col-sm-2 control-label">Factory Price</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="factory_price" v-model="info.factory_price" placeholder="Factory Price" >
                <form-error v-if="errors.factory_price" :errors="errors.factory_price ">
                    {{ errors.factory_price }}
                </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.selling_price ? 'form-group has-error' : 'form-group'">
            <label for="selling_price" class="col-sm-2 control-label">Selling Price</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="selling_price" v-model="info.selling_price" placeholder="Selling Price" >
                <form-error v-if="errors.selling_price" :errors="errors.selling_price ">
                    {{ errors.selling_price }}
                </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.stocks ? 'form-group has-error' : 'form-group'">
            <label for="stocks" class="col-sm-2 control-label">Available Stocks</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="stocks" v-model="info.stocks" placeholder="Available Stocks" >
                <form-error v-if="errors.stocks" :errors="errors.stocks ">
                    {{ errors.stocks }}
                </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.primary_image ? 'form-group has-error' : 'form-group'">
            <label for="primary_image" class="col-sm-2 control-label">Primary Image</label>
            <div class="col-sm-3">
                <vueDropzone ref="myVueDropzone" 
                             id="fileDropZone" 
                             :options="dropzoneOptions"
                             @vdropzone-success="onSuccessPrimary" 
                             ></vueDropzone>
                <form-error v-if="errors.primary_image" :errors="errors.primary_image ">
                    {{ errors.primary_image }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.alternative_image ? 'form-group has-error' : 'form-group'">
            <label for="alternative_image" class="col-sm-2 control-label">Alternative Image</label>
            <div class="col-sm-3">
                <vueDropzone ref="myVueDropzone2" 
                             id="fileDropZone2" 
                             :options="dropzoneOptions"
                             @vdropzone-success="onSuccessAlternate" 
                             ></vueDropzone>
                <form-error v-if="errors.alternative_image" :errors="errors.alternative_image ">
                    {{ errors.alternative_image }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.more_image ? 'form-group has-error' : 'form-group'">
            <label for="more_image" class="col-sm-2 control-label">More Images</label>
            <div class="col-sm-8">
                <vueDropzone ref="myVueDropzone3" 
                             id="fileDropZone3" 
                             :options="dropzoneOptions2"
                             @vdropzone-success="onSuccessMore" 
                             ></vueDropzone>
                <form-error v-if="errors.more_image" :errors="errors.more_image ">
                    {{ errors.more_image }}
                </form-error>
            </div>
        </div> 
        <div class="form-group">
            <label for="is_bestseller" class="col-sm-2 control-label">Best Seller</label>
            <div class="col-sm-8">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" v-model="info.is_bestseller"> Check this box to include this item to your best seller panel
                    </label>
                </div>
            </div>
        </div>
        <div  v-bind:class="errors.sequence ? 'form-group has-error' : 'form-group'">
            <label for="sequence" class="col-sm-2 control-label">Sequence</label>
            <div class="col-sm-1">
                <input type="number" class="form-control" id="sequence" v-model="info.sequence" placeholder="Sequence" >
                <form-error v-if="errors.sequence" :errors="errors.sequence ">
                    {{ errors.sequence }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.related_products ? 'form-group has-error' : 'form-group'">
            <label for="category_id" class="col-sm-2 control-label">Related Products</label>
            <div class="col-sm-6">
                <multiselect v-bind:value="assignproducts"
                             target="id"
                             label="name"
                             v-bind:options="products"
                             v-bind:multiple="true"
                             @close="onSelectProduct"
                             placeholder="Select Related Products">
                </multiselect>
                <form-error v-if="errors.related_products" :errors="errors.related_products">
                    {{ errors.related_products }}
                </form-error>
            </div>
        </div>
    </div>
</template>

<script>

    import vue2Dropzone from 'vue2-dropzone'
    
    export default {
        props: ['info', 'errors', 'categories', 'products'],
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
                },
                dropzoneOptions2: {
                    url: imageuploadurl,
                    maxFilesize: 0.5,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            }
        },
        computed: {
            assigncategory () {
                var code = this.info.category_id;
                let selected = this.categories.filter(function (obj) {
                    return obj.id == code;
                });
                return selected[0];
            },
            assignproducts () {
                
            }
        },
        methods: {
            onSuccessPrimary (file, response) {
                this.$emit('emit-setprimaryimage', {
                    data: response.file,
                });
            },
            onSuccessAlternate (file, response) {
                this.$emit('emit-setalternateimage', {
                    data: response.file,
                });
            },
            onSuccessMore (file, response) {
                this.$emit('emit-setmoreimage', {
                    data: response.file,
                });
            },
            onSelectCategory (selected) {
                this.$emit('emit-category', {
                    id: selected.id,
                });
            },
            onSelectProduct () {
                return;
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .multiselect,
    .multiselect__tags {
        min-height: 35px;
    }
    .multiselect__select,
    .multiselect__tags{
        min-height: 35px;
        padding-top: 4px;
        border-radius: 0;
        border-color: #d2d6de;
    }
    .multiselect, .multiselect__input, .multiselect__single {
        font-size: 14px;
        color: #555;
    }
    .has-error .multiselect__select,
    .has-error .multiselect__tags{
        border-color: #dd4b39;
    }
</style>