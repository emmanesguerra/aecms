<template>
    <div>
        <button @click="addEntry" class="btn btn-primary"><i class="fa fa-long-arrow-down " style="font-size: 12px;"></i> &nbsp;Add Entry</button>
        <table class="table table-hover dataTable" role="grid" aria-describedby="pagelists_info" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Url</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Template</th>
                    <th>Type</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <page-lists-row v-for="page in pagelists" 
                                v-bind:page="page"
                                v-bind:index="page.id"
                                v-bind:key="page.id"/>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['pagelists'],
        mounted() {
        },
        methods: {
            addEntry () {
                this.$emit('add-entry');
            }
        }
    }
</script>