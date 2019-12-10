
<template>
    <div class="box-body">
        <div class="row mb-5">
            <div class="col-sm-6">
                <iframe v-bind:src="info.marker" width="100%" height="300px" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-sm-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item border-0"><strong>Location:</strong> {{ info.address }}</li>
                    <li class="list-group-item border-0"><strong>Contact Person:</strong> {{ info.contact_person }}</li>
                    <li class="list-group-item border-0"><strong>Email Address:</strong> {{ info.email }}</li>
                    <li class="list-group-item border-0"><strong>Mobile:</strong> {{ info.mobile }}</li>
                    <li class="list-group-item border-0"><strong>Landline:</strong> {{ info.telephone }}</li>
                </ul>
                <div class="col-sm-12" v-if="hourscount">
                    <strong>Store Hours</strong>
                    <store-hours v-for="(hours, index) in info.storehours" v-bind:hours='hours' v-bind:key="index">
                    </store-hours>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['info'],
        mounted() {
        },
        computed: {
            hourscount() {
                return _.size(this.info.storehours);
            }
        },
        methods: {

        }
    }
</script>