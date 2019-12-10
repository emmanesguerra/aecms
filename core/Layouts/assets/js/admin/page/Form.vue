<template>
    <div class="box-body">
        <div  class="form-group" v-if="info.id > 0">
            <label class="col-sm-3 control-label">ID</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" v-model="info.id" disabled="true">
            </div>
        </div> 
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
                <label for="name" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="name" v-model="info.name" placeholder="name">
                        <form-error v-if="errors.name" :errors="errors.name">
                            {{ errors.name }}
                        </form-error>
                </div>
            </div>
            <div  v-bind:class="errors.url ? 'form-group has-error' : 'form-group'">
                <label for="url" class="col-sm-3 control-label">Url</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="url" v-model="info.url" placeholder="url">
                        <form-error v-if="errors.url" :errors="errors.url">
                            {{ errors.url }}
                        </form-error>
                </div>
            </div>
            <div  v-bind:class="errors.javascripts ? 'form-group has-error' : 'form-group'">
                <label for="javascripts" class="col-sm-3 control-label">Javascripts</label>
                <div class="col-sm-8">
                    <multiselect v-model="info.javascripts"
                                 v-bind:options="javascripts" 
                                 v-bind:multiple="true"
                                 v-bind:close-on-select="false"
                                 v-bind:hide-selected="true"
                                 placeholder="Select a javascript(s)">
                    </multiselect>
                    <form-error v-if="errors.javascripts" :errors="errors.javascripts">
                        {{ errors.javascripts }}
                    </form-error>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div  v-bind:class="errors.title ? 'form-group has-error' : 'form-group'">
                <label for="title" class="col-sm-3 control-label">Title</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="title" v-model="info.title" placeholder="title">
                        <form-error v-if="errors.title" :errors="errors.title">
                            {{ errors.title }}
                        </form-error>
                </div>
            </div>
            <div  v-bind:class="errors.description ? 'form-group has-error' : 'form-group'">
                <label for="description" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="description" v-model="info.description" placeholder="description">
                        <form-error v-if="errors.description" :errors="errors.description">
                            {{ errors.description }}
                        </form-error>
                </div>
            </div>
            <div  v-bind:class="errors.css ? 'form-group has-error' : 'form-group'">
                <label for="css" class="col-sm-3 control-label">Styles</label>
                <div class="col-sm-8">
                    <multiselect v-model="info.css"
                                 v-bind:options="styles" 
                                 v-bind:multiple="true"
                                 v-bind:close-on-select="false"
                                 v-bind:hide-selected="true"
                                 placeholder="Select a style(s)">
                    </multiselect>
                    <form-error v-if="errors.css" :errors="errors.css">
                        {{ errors.css }}
                    </form-error>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div  v-bind:class="errors.template ? 'form-group has-error' : 'form-group'">
                <label for="template" class="col-sm-3 control-label">Template</label>
                <div class="col-sm-8">
                    <multiselect v-model="info.template"
                                 v-bind:options="templates" 
                                 @select="onSelect"
                                 placeholder="Select a template">
                    </multiselect>
                    <form-error v-if="errors.template" :errors="errors.template">
                        {{ errors.template }}
                    </form-error>
                </div>
            </div>       
        </div>

        <div  v-bind:class="errorsp ? 'form-group has-error' : 'form-group'">
            <div class="col-sm-8 col-sm-offset-2">
                <form-error v-if="errorsp" :errors="errorsp">
                    {{ errorsp }}
                </form-error>
            </div>
        </div>
    </div>
</template>

<script>

    import FormError from '../../components/FormError.vue';

    export default {
        props: ['info', 'templates', 'javascripts', 'styles', 'errors', 'errorsp'],
        mounted() {
        },
        components: {
            FormError,
        },
        methods: {
            onSelect(data) {
                this.$emit('emit-template', {
                    template: data
                });
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .multiselect,
    .multiselect__tags {
        min-height: 34px;
    }
    .multiselect__select,
    .multiselect__tags{
        min-height: 34px;
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