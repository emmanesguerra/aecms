
<template>
    <div class="row">
        <div class="col-sm-6">{{ hours.day }}</div>
        <div class="col-sm-3">{{ hours.start }}</div>
        <div class="col-sm-3">{{ hours.end }}</div>
    </div>
</template>

<script>

    export default {
        props: ['hours'],
        mounted() {
        },
        components: {
        },
        methods: {

        }
    }
</script>