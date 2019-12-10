<template>
    <div class="box-body">
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="name" class="col-sm-2 control-label">Panel name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="name" v-model="info.name" placeholder="Panel name" disabled>
                <form-error v-if="errors.name" :errors="errors.name ">
                    {{ errors.name }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.html_template ? 'form-group has-error' : 'form-group'">
            <label for="html_template" class="col-sm-2 control-label">Brief Description</label>
            <div class="col-sm-10">
                <editor v-model="info.html_template" 
                        :init="{
                            toolbar: 'undo redo | styleselect |  fontsizeselect forecolor bold italic underline | link unlink | alignleft aligncenter alignright | bullist numlist | image ',
                            height: 400, 
                            importcss_append: true, 
                            forced_root_block: '',
                            content_css:['../css/templates/bootstrap.min.css', 
                                         '../css/templates/common.css'],
                            visual_table_class:'ae-table'
                        }"
                        plugins='code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help'
                        ></editor>
                <form-error v-if="errors.html_template" :errors="errors.html_template">
                    {{ errors.html_template }}
                </form-error>
            </div>
        </div>
    </div>
</template>


* `id`: An id for the editor so you can later grab the instance by using the `tinymce.get('ID')` method on tinymce, defaults to an automatically generated uuid. 
* `init`: Object sent to the `tinymce.init` method used to initialize the editor.
* `initial-value`: Initial value that the editor will be initialized with.
* `inline`: Shorthand for setting that the editor should be inline, `<editor inline></editor>` is the same as setting `{inline: true}` in the init.
* `tag-name`: Only used if the editor is inline, decides what element to initialize the editor on, defaults to `div`.
* `plugins`: Shorthand for setting what plugins you want to use, `<editor plugins="foo bar"></editor>` is the same as setting `{plugins: 'foo bar'}` in the init.
* `toolbar`: Shorthand for setting what toolbar items you want to show, `<editor toolbar="foo bar"></editor>` is the same as setting `{toolbar: 'foo bar'}` in the init.
* `model-events`: Change on what events you want to trigger the v-model events, defaults to `'change keyup'`. 
* `api-key`: Api key for TinyMCE cloud, more info below.
* `cloud-channel`: Cloud channel for TinyMCE Cloud, more info below.

<script>

    import FormError from '../../components/FormError.vue';

    export default {
        props: ['info', 'types', 'errors'],
        components: {
            FormError,
        },
        computed: {
            assigntype() {
                var code = this.info.type;
                let selected = this.types.find(function (obj) { return obj.code === code; });
                return selected;
            },
            isdisabled () {
                if(this.info.id > 0) {
                    return true;
                }
                return false;
            }
        },
        methods: {
            setType (selected) {
                this.info.type = selected.code;
            },
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