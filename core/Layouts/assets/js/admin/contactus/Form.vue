<template>
    <div class="box-body">
        <div  v-bind:class="errors.address ? 'form-group has-error' : 'form-group'">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="address" v-model="info.address" placeholder="address" >
                <form-error v-if="errors.address" :errors="errors.address">
                    {{ errors.address }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.contact_person ? 'form-group has-error' : 'form-group'">
            <label for="contact_person" class="col-sm-2 control-label">Contact Persons</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="contact_person" v-model="info.contact_person" placeholder="Contact Persons" >
                <form-error v-if="errors.contact_person" :errors="errors.contact_person ">
                    {{ errors.contact_person }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.telephone ? 'form-group has-error' : 'form-group'">
            <label for="telephone" class="col-sm-2 control-label">Telephone</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="telephone" v-model="info.telephone" placeholder="Telephone" >
                <form-error v-if="errors.telephone" :errors="errors.telephone ">
                    {{ errors.telephone }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.mobile ? 'form-group has-error' : 'form-group'">
            <label for="mobile" class="col-sm-2 control-label">Mobile</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="mobile" v-model="info.mobile" placeholder="Mobile" >
                <form-error v-if="errors.mobile" :errors="errors.mobile ">
                    {{ errors.mobile }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.email ? 'form-group has-error' : 'form-group'">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="email" v-model="info.email" placeholder="Email" >
                <form-error v-if="errors.email" :errors="errors.email ">
                    {{ errors.email }}
                </form-error>
            </div>
        </div> 
        <div  v-bind:class="errors.marker ? 'form-group has-error' : 'form-group'">
            <label for="marker" class="col-sm-2 control-label">Google Map Pin</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="marker" v-model="info.marker" placeholder="Marker">
                <form-error v-if="errors.marker" :errors="errors.marker ">
                    {{ errors.marker }}
                </form-error>
                <br />
                <div class="alert alert-info" role="alert">
                    How to retrieve your google map pin?
                    <ol>
                        <li>Go to <a href="https://www.google.com/maps/" target="_blank">google maps</a></li>
                        <li>Search the address</li>
                        <li>Click the share button</li>
                        <li>Click the copy link</li>
                        <li>Paste the copied link to the input field above</li>
                    </ol>
                </div>
            </div>
        </div> 

        <div  class="form-group">
            <label for="marker" class="col-sm-2 control-label">Store Hours</label>
        </div>
        <div  class="form-group col-sm-12 col-md-12" v-for="hours, index in info.storehours">
            <label v-if="!hours.isdeleted" for="marker" class="col-sm-2 control-label">Day</label>
            <div v-if="!hours.isdeleted" class="col-sm-2">
                <input type="text" class="form-control" id="marker" v-model="hours.day" placeholder="Day">
            </div>
            <label v-if="!hours.isdeleted" for="marker" class="col-sm-1 control-label">Start</label>
            <div v-if="!hours.isdeleted" class="col-sm-2 col-md-2 col-lg-1">
                <input type="text" class="form-control" id="marker" v-model="hours.start" placeholder="Start">
            </div>
            <label v-if="!hours.isdeleted" for="marker" class="col-sm-1 control-label">End</label>
            <div v-if="!hours.isdeleted" class="col-sm-2 col-md-2 col-lg-1">
                <input type="text" class="form-control" id="marker" v-model="hours.end" placeholder="End">
            </div>
            <label for="marker" class="col-sm-2 control-label" style="text-align: left;"><i class="fa fa-plus-circle" @click="addMore"></i> <i v-if="hours.id" class="fa fa-minus-circle" style="color: #f00;" @click="removeSelected(index, hours.id)"></i></label>
        </div>
    </div>
</template>

<script>

    import FormError from '../../components/FormError.vue';
    
    export default {
        props: ['info', 'errors'],
        components: {
            FormError,
        },
        computed: {
        },
        methods: {
            addMore() {
                this.$emit('emit-addmore');
            },
            removeSelected(index, id) {
                this.$emit('emit-removeselected', {
                    index: index,
                    id: id,
                });
            }
        }
    }
</script>