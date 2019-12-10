<template>
    <div class="box-body">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="col-sm-12">
                <div  class="form-group">
                    <h4>Website Profile</h4>
                </div>
                <div  v-bind:class="errors.domain_name ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="domain_name">Domain name *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="domain_name" v-model="info.domain_name" placeholder="ex. your.website.com">
                            <form-error v-if="errors.domain_name" :errors="errors.domain_name">
                                {{ errors.domain_name }}
                            </form-error>
                    </div>
                </div>
                <div  v-bind:class="errors.website_name ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="website_name">Website name *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="website_name" v-model="info.website_name" placeholder="ex. Your Website">
                            <form-error v-if="errors.website_name" :errors="errors.website_name">
                                {{ errors.website_name }}
                            </form-error>
                    </div>
                </div>
                <div  v-bind:class="errors.owner ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="owner">Owner</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="owner" v-model="info.owner" placeholder="Owner's name">
                            <form-error v-if="errors.owner" :errors="errors.owner">
                                {{ errors.owner }}
                            </form-error>
                    </div>
                </div>
                <div  class="form-group">
                    <h4>For SEO purposes</h4>
                </div>
                <div  v-bind:class="errors.meta_title ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="meta_title">Default Page Title *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="meta_title" v-model="info.meta_title" placeholder="Default page title">
                            <form-error v-if="errors.meta_title" :errors="errors.meta_title">
                                {{ errors.meta_title }}
                            </form-error>
                    </div>
                </div>
                <div  v-bind:class="errors.meta_description ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="meta_description">Page Description *</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="meta_description" v-model="info.meta_description" placeholder="Default page description">
                            <form-error v-if="errors.meta_description" :errors="errors.meta_description">
                                {{ errors.meta_description }}
                            </form-error>
                    </div>
                </div>
                <div  v-bind:class="errors.meta_keywords ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="meta_keywords">Keywords/Tags</label>
                    <div class="col-sm-9">
                        <multiselect v-model="info.meta_keywords"
                                     v-bind:options="tags" 
                                     v-bind:taggable="true"
                                     v-bind:multiple="true"
                                     v-bind:close-on-select="false"
                                     @tag="addTag"
                                     placeholder="Type a keyword then enter">
                        </multiselect>
                        <form-error v-if="errors.meta_keywords" :errors="errors.meta_keywords">
                            {{ errors.meta_keywords }}
                        </form-error>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6">
            <div class="col-sm-12">

                <div  class="form-group">
                    <h4>Email Settings</h4>
                </div>
                <div  v-bind:class="errors.email_subject ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="email_subject">Subject</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email_subject" v-model="info.email_subject" placeholder="Subject">
                            <form-error v-if="errors.email_subject" :errors="errors.email_subject">
                                {{ errors.email_subject }}
                            </form-error>
                    </div>
                </div>
                <div  v-bind:class="errors.email_recipients ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="email_recipients">Recipients</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email_recipients" v-model="info.email_recipients" placeholder="Recipient">
                            <form-error v-if="errors.email_recipients" :errors="errors.email_recipients">
                                {{ errors.email_recipients }}
                            </form-error>
                    </div>
                </div>
                <div  v-bind:class="errors.email_cc ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="email_cc">CCs</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email_cc" v-model="info.email_cc" placeholder="Cc">
                            <form-error v-if="errors.email_cc" :errors="errors.email_cc">
                                {{ errors.email_cc }}
                            </form-error> 
                    </div>
                </div>
                <div  v-bind:class="errors.email_bcc ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="email_bcc">BCCs</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="email_bcc" v-model="info.email_bcc" placeholder="Bcc">
                            <form-error v-if="errors.email_bcc" :errors="errors.email_bcc">
                                {{ errors.email_bcc }}
                            </form-error>
                    </div>
                </div>
                <div  class="form-group">
                    <h4>Server Settings</h4>
                </div>
                <div  v-bind:class="errors.timezone ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="timezone">Timezone *</label>
                    <div class="col-sm-9">
                        <multiselect v-model="info.timezone"
                                     v-bind:options="timezones"
                                     placeholder="Select a timezone">
                        </multiselect>
                        <form-error v-if="errors.timezone" :errors="errors.timezone">
                            {{ errors.timezone }}
                        </form-error>
                    </div>
                </div>
                <div  v-bind:class="errors.developer ? 'form-group has-error' : 'form-group'">
                    <label  class="col-sm-3 control-label" for="developer">Developer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="developer" v-model="info.developer" placeholder="Developer's name">
                            <form-error v-if="errors.developer" :errors="errors.developer">
                                {{ errors.developer }}
                            </form-error>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FormError from '../../components/FormError.vue';

    export default {
        props: ['info', 'timezones', 'tags', 'errors'],
        mounted() {
        },
        components: {
            FormError,
        },
        methods: {
            addTag(newTag) {
                this.tags.push(newTag)
                if (this.info.meta_keywords) {
                    this.info.meta_keywords.push(newTag)
                } else {
                    this.info.meta_keywords = [];
                    this.info.meta_keywords.push(newTag);
                }
            }

        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
    .multiselect,
    .multiselect__tags {
        min-height: 35px;
    }
    .multiselect__select,
    .multiselect__tags{
        min-height: 35px;
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