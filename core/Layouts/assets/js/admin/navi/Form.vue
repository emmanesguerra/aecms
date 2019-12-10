<template>
    <div class="box-body">
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="name" class="col-sm-2 control-label">Navigation Name</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="name" v-model="info.name" placeholder="Navigation name">
                    <form-error v-if="errors.name" :errors="errors.name">
                        {{ errors.name }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="start" class="col-sm-2 control-label">Start Element</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="name" v-model="info.start" placeholder="Start Element">
                    <form-error v-if="errors.start" :errors="errors.start">
                        {{ errors.start }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="passive" class="col-sm-2 control-label">Passive Element</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="name" v-model="info.passive" placeholder="Passive Element">
                    <form-error v-if="errors.passive" :errors="errors.passive">
                        {{ errors.passive }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="active" class="col-sm-2 control-label">Active Element</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="name" v-model="info.active" placeholder="Active Element">
                    <form-error v-if="errors.active" :errors="errors.active">
                        {{ errors.active }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="hover" class="col-sm-2 control-label">Hovered Element</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="name" v-model="info.hover" placeholder="Hovered Element">
                    <form-error v-if="errors.hover" :errors="errors.hover">
                        {{ errors.hover }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="end" class="col-sm-2 control-label">End Element</label>
            <div class="col-sm-2">
                <input type="text" class="form-control" id="name" v-model="info.end" placeholder="End Element">
                    <form-error v-if="errors.end" :errors="errors.end">
                        {{ errors.end }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.name ? 'form-group has-error' : 'form-group'">
            <label for="sublevel" class="col-sm-2 control-label">Sub Level</label>
            <div class="col-sm-1">
                <input type="text" class="form-control" id="name" v-model="info.sublevel" placeholder="Sub Level">
                    <form-error v-if="errors.sublevel" :errors="errors.sublevel">
                        {{ errors.sublevel }}
                    </form-error>
            </div>
        </div>
    </div>
</template>

<script>

    import FormError from '../../components/FormError.vue';

    export default {
        props: ['info', 'errors'],
        mounted() {
        },
        components: {
            FormError,
        },
        methods: {
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