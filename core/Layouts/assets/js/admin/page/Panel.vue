<template>
    <div class="box-body">
        <div  class="form-group">
            <label class="col-sm-2 control-label">Panel name for {{ panel }}</label>
            <div class="col-sm-4">
                <input v-if="selected == 'NEW'" type="text" class="form-control" v-bind:name="inputname">
                <select v-model='selected' class="form-control"  v-else  v-bind:name="selectname">
                    <option v-for='selections in panels' :value='selections.id'>{{ selections.name }}</option>
                </select>
            </div>
        </div> 
        <div v-bind:class="classObject">
            <div class="col-sm-12">
                <textarea  v-bind:name="textname"></textarea>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['panel','javascripts','css', 'mainpanels', 'regularpanels'],
        data () {
            return {
                selected: null
            }
        },
        mounted() {
            tinymce.init({
                selector: 'textarea',
                height: 300,
                theme: 'modern',
                plugins: 'code print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools  contextmenu colorpicker textpattern help',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                image_advtab: true,
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                }
            });
        },
        computed: {
            classObject () {
                if(this.selected == 'NEW') {
                    return 'show';
                } else {
                    return 'hide';
                }
            },
            panels () {
                if(this.panel == 'Main') {
                    return this.mainpanels;
                } else {
                    return this.regularpanels;
                }
            },
            inputname () {
                return this.panel + '[name]';
            },
            textname () {
                return this.panel + '[html_template]';
            },
            selectname () {
                return this.panel + '[selected_panel]';
            }
        },
        methods: {
            onSelect(data) {
                this.selected = data.id;
            } 
        }
    }
</script>