<template>
    <tr v-if="page.editable">
        <td>X</td>
        <td><input type='text' v-model='newentry.name' /></td>
        <td><input type='text' v-model='newentry.url' /></td>
        <td><input type='text' v-model='newentry.title' /></td>
        <td><input type='text' v-model='newentry.description' /></td>
        <td></td>
        <td>
            <select v-model='newentry.type'>
                <option value='Head'>Head</option>
                <option value='Web Page'>Web Page</option>
            </select>
        </td>
        <td></td>
        <td></td>
        <td><button @click="save" class="btn btn-success btn-xs">Save</button></td>
    </tr>
    <tr v-else>
        <td>{{ page.id }}</td>
        <td>
            <b v-for="n in page.lvl">--&raquo;| </b> {{ page.name }}
        </td>
        <td>{{ page.url }}</td>
        <td>{{ page.title }}</td>
        <td>{{ page.description }}</td>
        <td>{{ page.template }}</td>
        <td>{{ page.type }}</td>
        <td>{{ page.created_at }}</td>
        <td>{{ page.updated_at }}</td>
        <td><button @click="addSubEntry" class="btn btn-primary btn-xs"><i class="fa fa-long-arrow-down "></i> Sub</button>&nbsp;&nbsp; 
            <button v-if="page.type=='Web Page'" @click="getData" class="btn btn-primary btn-xs"><i class="fa fa-pencil "></i></button>&nbsp;&nbsp; 
            <button v-if="page.type=='Web Page'" @click="getData" class="btn btn-primary btn-xs">Move</button>&nbsp;&nbsp; 
            <button v-if="removable" @click="removeData" class="btn btn-primary btn-xs"><i class="fa fa-trash"></i></button>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['page'],
        data: function () {
            return {'newentry': {
                    name: null,
                    url: null,
                    title: null,
                    description: null,
                    template: null,
                    type: null,
                    created_at: null,
                    updated_at: null,
                }
            };
        },
        mounted() {
        },
        computed: {
            removable () {
                if((this.page.lft + 1) == this.page.rgt) {
                    return true;
                }
                return false;
            }
        },
        methods: {
            getData () {
                proccessdata(this.page.id, 'get')
            },
            removeData () {
                showmodal(this.page.id);
            },
            save () {
                
            }
        }
    }
</script>