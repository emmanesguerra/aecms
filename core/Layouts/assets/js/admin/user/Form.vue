<template>
    <div class="box-body">
        <div  class="form-group" v-if="info.id > 0">
            <label class="col-sm-3 control-label">ID</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" v-model="info.id" disabled="true">
            </div>
        </div>
        <div  v-bind:class="errors.firstname ? 'form-group has-error' : 'form-group'">
            <label for="firstname" class="col-sm-3 control-label">First name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="firstname" v-model="info.firstname" placeholder="First name">
                    <form-error v-if="errors.firstname" :errors="errors.firstname">
                        {{ errors.firstname }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.middlename ? 'form-group has-error' : 'form-group'">
            <label for="middlename" class="col-sm-3 control-label">Middle name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="middlename" v-model="info.middlename" placeholder="Middle name">
                    <form-error v-if="errors.middlename" :errors="errors.middlename">
                        {{ errors.middlename }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.lastname ? 'form-group has-error' : 'form-group'">
            <label for="lastname" class="col-sm-3 control-label">Last name</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="lastname" v-model="info.lastname" placeholder="Last name">
                    <form-error v-if="errors.lastname" :errors="errors.lastname">
                        {{ errors.lastname }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.email ? 'form-group has-error' : 'form-group'">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="email" v-model="info.email" placeholder="Email">
                    <form-error v-if="errors.email" :errors="errors.email">
                        {{ errors.email }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.password ? 'form-group has-error' : 'form-group'">
            <label for="password" class="col-sm-3 control-label">Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="password" v-model="info.password" placeholder="Password">
                    <p class="form-text text-info">
                        Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
                    </p>
                    <form-error v-if="errors.password" :errors="errors.password">
                        {{ errors.password }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.password_confirmation ? 'form-group has-error' : 'form-group'" v-if="info.id > 0">
            <label for="password_confirmation" class="col-sm-3 control-label">Re Password</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="password_confirmation" v-model="info.password_confirmation" placeholder="Re-type Password">
                    <form-error v-if="errors.password_confirmation" :errors="errors.password_confirmation">
                        {{ errors.password_confirmation }}
                    </form-error>
            </div>
        </div>
        <div  v-bind:class="errors.usertype ? 'form-group has-error' : 'form-group'">
            <label class="col-sm-3 control-label">User Type</label>
            <div class="col-sm-9">
                <multiselect v-model="info.usertype"
                             v-bind:options="options" 
                             placeholder="Select a user type">
                </multiselect>
                <form-error v-if="errors.usertype" :errors="errors.usertype">
                    {{ errors.usertype }}
                </form-error>
            </div>
        </div>
    </div>
</template>

<script>

    import FormError from '../../components/FormError.vue';

    export default {
        props: ['info', 'options', 'errors'],
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