<template>
    <div class="box-body">
        <div  v-bind:class="errors.module_name ? 'form-group has-error' : 'form-group'">
            <label for="module_name" class="col-sm-3 control-label">Module name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="module_name" v-model="info.module_name" placeholder="Module name">
                    <form-error v-if="errors.module_name" :errors="errors.module_name">
                        {{ errors.module_name }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.description ? 'form-group has-error' : 'form-group'">
            <label for="description" class="col-sm-3 control-label">Brief Description</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="description" v-model="info.description" placeholder="Brief Description">
                    <form-error v-if="errors.description" :errors="errors.description">
                        {{ errors.description }}
                    </form-error>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Include Panel</label>
            <div class="col-sm-8">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" v-model="info.includepanel"> Check this to create panel for this module
                    </label>
                </div>
            </div>
        </div>
        <div  v-bind:class="errors.link ? 'form-group has-error' : 'form-group'">
            <label for="link" class="col-sm-3 control-label">Module Route Link</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="link" v-model="info.link" placeholder="Module Route Link">
                    <form-error v-if="errors.link" :errors="errors.link">
                        {{ errors.link }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.icon ? 'form-group has-error' : 'form-group'">
            <label for="icon" class="col-sm-3 control-label">Module Icon</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="link" v-model="info.icon" placeholder="Module Icon">
                    <form-error v-if="errors.icon" :errors="errors.icon">
                        {{ errors.icon }}
                    </form-error>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Load default permissions</label>
            <div class="col-sm-8">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" v-model="info.loaddefault" v-on:change='processdefaults()'> Check this to create initial permissions
                    </label>
                </div>
            </div>
        </div>
        <div  v-bind:class="errors.permissions ? 'form-group has-error' : 'form-group'">
            <label for="permissions" class="col-sm-3 control-label">Permissions</label>
            <div class="col-sm-8">
                <multiselect v-model="info.permissions"
                             v-bind:options="perm" 
                             v-bind:taggable="true"
                             v-bind:multiple="true"
                             v-bind:close-on-select="false"
                             @tag="addTag"
                             placeholder="Type a keyword then enter">
                </multiselect>
                <form-error v-if="errors.permissions" :errors="errors.permissions">
                    {{ errors.permissions }}
                </form-error>
            </div>
        </div>
    </div>
</template>

<script>

    import FormError from '../../components/FormError.vue';

    export default {
        props: ['info', 'errors'],
        data: function () {
            return {
                'perm': []
            }
        },
        mounted() {
        },
        components: {
            FormError,
        },
        methods: {
            addTag(newTag) {
                this.perm.push(newTag)
                if (this.info.permissions) {
                    this.info.permissions.push(newTag)
                } else {
                    this.info.permissions = [];
                    this.info.permissions.push(newTag);
                }
            },
            processdefaults() {
                if (this.info.loaddefault) {
                    this.info.permissions.push('create');
                    this.info.permissions.push('view');
                    this.info.permissions.push('update');
                    this.info.permissions.push('delete');
                } else {
                    var index = this.info.permissions.indexOf('create');
                    if (index > -1) {
                        this.info.permissions.splice(index, 1);
                    }
                    var index = this.info.permissions.indexOf('view');
                    if (index > -1) {
                        this.info.permissions.splice(index, 1);
                    }
                    var index = this.info.permissions.indexOf('update');
                    if (index > -1) {
                        this.info.permissions.splice(index, 1);
                    }
                    var index = this.info.permissions.indexOf('delete');
                    if (index > -1) {
                        this.info.permissions.splice(index, 1);
                    }
                }
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