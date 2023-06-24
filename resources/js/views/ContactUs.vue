<template>
    <main>       
        <section class="sec-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <h3 style="margin-bottom: 0;">Contact Us</h3>
                        <p>Please use the contact form below if you have any general questions or feedback. We usually respond in a few hours.</p>
                    </div>
                </div>                    
                <div class="row">
                    <div class="col-md-8 col-lg-8">
                        <div class="nf-form-layout nf-form-ct-layout">
                            <div class="nf-form-fields">Fields marked with an <span class="ninja-forms-req-symbol">*</span> are required</div>
                                <div class="nf-mp-body">
                                    <div class="field-wrap">	
                                        <label>Name <span class="req-symbol">*</span> </label>
                                        <input type="text" v-model="PersonName" class="forms-field" required="">
                                        <small class="text-danger">{{ PersonName_error }} </small>
                                    </div>
                                    <div class="field-wrap">	
                                        <label>Email <span class="req-symbol">*</span> </label>
                                        <input type="email" v-model="PersonEmail" class="forms-field" required="">
                                        <small class="text-danger">{{ PersonEmail_error }} </small>
                                    </div>
                                    <div class="field-wrap">	
                                        <label>Subject <span class="req-symbol">*</span></label>
                                        <input type="text" v-model="PersonSubject" class="forms-field" required="">
                                        <small class="text-danger">{{ PersonSubject_error }} </small>
                                    </div>

                                    <div class="field-wrap">	
                                        <label>Message <span class="req-symbol">*</span> </label>
                                        <textarea class="forms-field" v-model="PersonMessage" required=""></textarea>
                                        <small class="text-danger">{{ PersonMessage_error }} </small>
                                    </div>
                                    <div class="field-submit">	
                                        <button v-on:click="sendEnquery" class="w-100 custom_yellow_btn">
                                            <span v-if="Messageloader" class="spinner-border spinner-border-sm" role="status"></span> Submit
                                        </button>                                            
                                    </div>
                                    <p v-if="successMessage" class="text-success">{{ successMessage }}</p>
                                </div>                                
                            </div>
                        </div>
                    <div class="col-md-4 col-lg-4">
                        <h4 style="text-align:center;"><i class="fa fa-1x fa-envelope"></i> Email</h4>
                        <p style="text-align:center;"><a title="General Inquiries" href="mailto:info@nannyparentconnection.com">General Inquiries</a></p>
                        <p style="text-align:center;">&nbsp;<a title="Technical Questions" href="mailto:tech@nannyparentconnection.com">Technical Questions</a></p>
                        <p style="text-align:center;">&nbsp;<a title="Billing Questions" href="mailto:billing@nannyparentconnection.com">Billing Questions</a></p>
                        <p style="text-align:center;">&nbsp;&nbsp;<a title="Advertising Inquiries" href="mailto:advertising@nannyparentconnection.com">Advertising Inquiries</a></p>
                        <br>
                        <h4 style="text-align:center;"><i class="fa fa-1x fa-phone"></i> Phone/Text</h4>
                        <p style="text-align:center;"><a title="Call Us On" href="tel:(425) 243-7032">(425) 243-7032</a></p>
                        <p style="text-align:center;">
                            <img title="Contact Us" alt="Girl blowing bubbles contact us" width="300" height="225" src="/public/assets/images/adobe-spark-post.JPG">
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
    export default {
        name:'contact-us',
        data(){
            return {
                Messageloader: false, 
                PersonName : '',
                PersonEmail : '',
                PersonSubject : '',
                PersonMessage : '',

                PersonName_error : '',
                PersonEmail_error : '',
                PersonSubject_error : '',
                PersonMessage_error : '',
                successMessage: '',
                pageName : 'contactUs'
                // pageTitle : 'Contact Us - Seattle Nannies and Nanny Shares',
                // pageMetaDescription : 'Have questions about the Nanny Parent Connection? Want to gain access to our network of Seattle nannies & babysitters? Contact us! Call or email us anytime',
                // pageMetaKeywords : '' 
            }
        },
        methods:{
            sendEnquery(){
                this.Messageloader = true;
                axios.post(`/api/ContactUsEnqury`, {
                    Name : this.PersonName,
                    Email : this.PersonEmail,
                    Subject : this.PersonSubject,
                    Message : this.PersonMessage, 
                }).then((response) => {
                    this.Messageloader = false;
                    this.PersonName = '';
                    this.PersonEmail = '';
                    this.PersonSubject = '';
                    this.PersonMessage = '';
                    this.successMessage = response.data.successMessage;
                    setTimeout(() => this.successMessage = '', 2000);
                }).catch(error => {
                    this.Messageloader = false;
                    this.PersonName_error = error.response.data.error.Name[0],
                    this.PersonEmail_error = error.response.data.error.Email[0],
                    this.PersonSubject_error = error.response.data.error.Subject[0],
                    this.PersonMessage_error = error.response.data.error.Message[0],
                    setTimeout(() => this.PersonName_error = '', 1000);
                    setTimeout(() => this.PersonEmail_error = '', 1000);
                    setTimeout(() => this.PersonSubject_error = '', 1000);
                    setTimeout(() => this.PersonMessage_error = '', 1000);
                });                   
            }
        },
        mounted() {
            axios.get(`/api/get-seo-page`).then((response) => {
                var getData = response.data.page_seo_data.find((employee) => employee.page_Name == this.pageName);					
                document.title = getData.seo_Title;
                document.getElementsByTagName('meta')["description"].content = ""+getData.meta_description+"";
                document.getElementsByTagName('meta')["keywords"].content = ""+getData.meta_tags+"";					
            }).catch((err) => console.error(err));
        },
        created() {
            window.scrollTo(0,0); 
        }
        		
    }
</script>
