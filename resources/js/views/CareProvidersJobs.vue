<template>
    <main>
        <section class="sec-padding of-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-7">
                        <h1 class="sec-heading text-left">Current Open Positions</h1>
                        <p>Click the links below to review open positions in our community.</p>
                        <p>If you would like to apply for any of the below positions, click the “Apply” button for that position and complete the form. A member of our Search Team will get back to you shortly.</p>
                        <p>If you need help, please <a href="mailto:admin@nannyparentconnection.com">email us by clicking here</a> or call/text us at <a href="tel:+14252437032">(425) 243-7032</a>.</p>
                        <p>Want to <span style="text-decoration:underline;">browse more child care opportunities? Sign up for a FREE Care Provider membership today! <router-link to="/sign-care-provider">Click here to get started.</router-link></span></p>
                    </div>
                    <div class="col-md-6 col-lg-5"><img src="/public/assets/images/Nanny-Feeding-Little-Girl.JPG" class="img-style"></div>
                </div>
            </div>
        </section>
        <section class="sec-padding" style="background-color: #ddeefd;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h4 class="text-center" style="text-align: center; padding-bottom: 1em; font-size: 16px; line-height: 1.3em;">Don’t see a position you love? We post new positions every week! Click the button below to tell us about your childcare background and what you’re looking for. We can help connect you with families.</h4>
                        <p class="text-center mt-2 mb-5"> 
                            <router-link to="/apply-job" class="custom_yellow_btn" style="padding-left: 35px;padding-right: 35px;padding-top: 7px;padding-bottom: 7px;">Get Started</router-link>
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h4 class="text-center" style="text-align: center; padding-bottom: 1em; font-size: 16px; line-height: 1.3em;">Click any of the links below to read more about that specific position:</h4>
                        <h4 style="text-align: center; padding-bottom: 0em; font-size: 16px;">JOBS UPDATED {{ currentDate }}:</h4>
                        <h4 class="text-center" style="text-align: center; font-size: 16px; line-height: 1.3em;">FEATURED:</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <p v-for="(job, index) in jobs" :key="job.id" :index="index" style="color:#e58eb2;cursor: pointer;text-align: center;">
                            <a v-on:click="scrollJob(job.id)">
                                <strong>{{job.jobTitle}} – {{job.job_id}}</strong>
                            </a>
                        </p>
                    </div>
                </div>               
                <!-- <div class="row border-d">&nbsp;</div> -->           
            </div>
        </section>
        <section class="sec-padding">
            <div class="container">
                <div class="row" :id="'scroll'+job.id" v-for="(job , index) in jobs" :key="job.id" :index="index">
                    <div class="col-md-12 col-lg-12">
                        <h5 style="margin-bottom: 10px;"><b>{{job.jobTitle}}</b></h5>
                        <h5 style="margin-bottom: 20px;"><b>{{job.job_id}}</b></h5>
                        <p><strong>DETAILS:</strong></p>
                        <p><b>Location:</b> {{job.jobLocatin}}</p>
                        <p><strong>Ideal Start Date:</strong> {{job.IdealStartDate}}</p>
                        <p><strong>Schedule:</strong>{{job.jobSchedule}}</p>
                        <p><strong>Children:</strong> {{job.children}}</p>
                        <p><strong>Compensation:</strong> {{job.compensation}}</p>
                        <p><b> {{job.jobExperience}}</b></p>
                        <p><b>*** {{job.legally_authorized_state}} *** </b></p>
                        <p><strong>The Family:</strong></p>
                            <span v-html="job.AboutFamily"></span>                        
                        <p><strong>The Job Description:</strong></p>
                            <span v-html="job.jobDescription"></span>                            
                        <p><strong>Nanny Attributes/Qualifications/Requirements:</strong></p>                            
                            <span v-html="job.Qualification_Requirement"></span>
                                                        
                        <p class="text-center mt-5 mb-5"><router-link :to="{name: 'apply-job', 
                                    params: { 
                                        job_id: job.job_id
                                    }
                                }" class="custom_yellow_btn" style="margin-bottom: 0;padding: 5px 45px;">
                            Apply</router-link>
                            <!--a class="button-primary button-black mt-4" href="" style="margin-bottom: 0;">Apply</a-->
                        </p>
                    </div>
                    <div class="row border-d">&nbsp;</div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
    const axios = require('axios');
    export default {
        name:'care-providers-jobs',
        data() {
            return {
                jobs: [],
                currentDate:"",
                pageName : 'CareProvidersJobs'
                // pageTitle : 'Browse Families Seeking Child Care | Nanny Parent Connection',
				// pageMetaDescription : 'Click the links below to review open positions in our community. If you would like to apply for any of these positions, click the "Apply"...',
				// pageMetaKeywords : ''
            }
        },
        methods: {
            scrollJob(id){            
                document.getElementById('scroll'+id).scrollIntoView({behavior: "smooth", block: "start"});
            },                       
        },
        mounted(){	
			axios.get(`/api/get-seo-page`).then((response) => {
				var getData = response.data.page_seo_data.find((employee) => employee.page_Name == this.pageName);					
				document.title = getData.seo_Title;
				document.getElementsByTagName('meta')["description"].content = ""+getData.meta_description+"";
				document.getElementsByTagName('meta')["keywords"].content = ""+getData.meta_tags+"";					
			}).catch((err) => console.error(err));					
		},
        created() { 
            window.scrollTo(0,0);           
            axios.get(`/api/care-provider-jobs`).then(({ data }) => {
                this.jobs= data.jobs;
                this.currentDate = data.currentDate;
            })
            .catch((err) => console.error(err));            
        }
    		
    }
</script>
