
<template>
    <div class="box-body">
        <div class="form-row">
            <h3>Send us a message</h3>
        </div>
        <div class="form-row">
            <div  v-bind:class="errors.name ? 'form-group has-error col-sm-12' : 'form-group col-sm-12'">
                <div class="row">
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" v-model="info.name" placeholder="Name">
                            <form-error v-if="errors.name" :errors="errors.name">
                                {{ errors.name }}
                            </form-error>
                    </div>
                    <div class="col-sm-4">
                        <input type="text"  class="form-control" id="email" v-model="info.email" placeholder="Email address">
                            <form-error v-if="errors.email" :errors="errors.email">
                                {{ errors.email }}
                            </form-error>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div  v-bind:class="errors.message ? 'form-group has-error col-sm-12' : 'form-group col-sm-12'">
                <div class="row">
                    <div class="col-sm-8">
                        <textarea class="form-control" v-model="info.message" 
                                  placeholder="Message" style="height: 150px"></textarea>
                        <form-error v-if="errors.message" :errors="errors.message">
                            {{ errors.message }}
                        </form-error>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import FormError from '../../admin/components/FormError.vue';

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