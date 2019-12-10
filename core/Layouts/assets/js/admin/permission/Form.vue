<template>
    <div class="box-body">
        <div  v-bind:class="errors.userid ? 'form-group has-error' : 'form-group'">
            <label for="timezone" class="col-sm-3 control-label">Select user*</label>
            <div class="col-sm-8">
                <multiselect v-bind:value="assignuser"
                             target="id"
                             label="email"
                             v-bind:options="users"
                             @select="onSelect"
                             placeholder="Select user">
                </multiselect>
                <form-error v-if="errors.userid" :errors="errors">
                    {{ errors.userid }}
                </form-error>
            </div>
        </div>
        <div class="form-group" v-for="module in modules">
            <label for="timezone" class="col-sm-3 control-label">{{ module.name }}</label>
            <div class="col-sm-9">
                <div class="form-group col-sm-4"  v-for="permission in module.permissions">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" @click="toggle(permission)" v-bind:name="permission" v-bind:checked="ischecked(permission)"> {{ permission }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import FormError from '../../components/FormError.vue';

    export default {
        props: ['info', 'users', 'modules', 'errors'],
        mounted() {
        },
        components: {
            FormError,
        },
        computed: {
            assignuser() {
                var id = parseInt(this.info.userid);
                let selected = this.users.find(function (obj) { return obj.id === id; });
                return selected;
            }
        },
        methods: {
            toggle(data) {
                this.$emit('emit-perm', data);
            },
            onSelect(data) {
                this.$emit('emit-user', {
                    id: data.id
                });
            },
            ischecked(data) {
                var index = this.info.perms.indexOf(data);
                if (index > -1) {
                    return true;
                } else {
                    return false;
                }
            }
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