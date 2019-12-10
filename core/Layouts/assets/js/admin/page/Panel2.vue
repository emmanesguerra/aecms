<template>
    <div class="box-body">
        <div  class="form-group">
            <label class="col-sm-2 control-label">Panel name for {{ panel.panel }}</label>
            <div class="col-sm-4">
                <input v-if="panel.selected == 'NEW'" type="text" class="form-control" v-model="panel.name">
                <select v-model='panel.selected' class="form-control"  v-else>
                    <option v-for='selections in panels' :value='selections.id'>{{ selections.name }}</option>
                </select>
            </div>
        </div> 
        <div v-bind:class="classObject">
            <div class="col-sm-12">
                <editor v-model="panel.html_template"
                        :init="{
                            toolbar: 'undo redo | styleselect |  fontsizeselect forecolor bold italic underline | link unlink | alignleft aligncenter alignright | bullist numlist | image ',
                            height: 400, 
                            importcss_append: true, 
                            forced_root_block: '',
                            content_css:['../css/templates/bootstrap.min.css', 
                                         '../css/templates/common.css'],
                            visual_table_class:'ae-table'
                        }"></editor>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['panel','javascripts','css', 'mainpanels', 'regularpanels'],
        mounted() { 
        },
        watch: {
            'panel.selected' () {
                this.panel.name = this.panel.selected;
            }
        },
        computed: {
            classObject () {
                if(this.panel.selected == 'NEW') {
                    this.panel.isnew = true;
                    return 'show';
                } else {
                    return 'hide';
                }
            },
            panels () {
                if(this.panel.panel == 'Main') {
                    return this.mainpanels;
                } else {
                    return this.regularpanels;
                }
            }
        },
        methods: {
            onSelect(data) {
                this.panel.selected = data.id;
            }
        }
    }
</script>