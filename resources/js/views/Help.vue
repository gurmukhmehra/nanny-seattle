<template>
    <main> 
        <section class="sec-padding" style="background-color: #000;">
            <div class="container">
                <div class="row text-center">
                    <h3 style="color: #e58eb2;">Welcome to the Nanny Parent Connection Help Center</h3>
                    <p style="color: #fff;">Get fast answers to most of your questions by using our Help menu below. You can also use the Search tool to find answers.</p>
                    <div class="search-container"> 
                        <input type="text" @keyup.keypress="checklength()" v-model="helpContent" placeholder="Search.." @keyup.enter="findHelps()" style="width:50%;">
                        <button v-on:click="findHelps" style="padding: 7px 15px 12px;"><i class="fa fa-search"></i></button>                        
                    </div>                    
                </div>
            </div>
        </section> 
        <div class="container" v-show="loader">
            <div class="row text-center mt-5 mb-3" >
                <span style="color:rgb(229, 142, 178);">
                    <span class="spinner-grow spinner-grow-md"></span>
                    <span class="spinner-grow spinner-grow-md"></span>
                    <span class="spinner-grow spinner-grow-md"></span>
                </span>
            </div>
        </div>
        <div class="container" v-show="not_found">
            <div class="row text-center mt-5 mb-3" >
                <p class="text-danger">{{ not_found_text }}</p> 
            </div>
        </div>
        <section class="sec-padding" v-show="helpSeacrhDiv">
            <div class="container">                             
                <div class="row">
                    <p class="text-center" v-for="(helplist, index) in GetHeplsList" :key="helplist.id" :index="index">
                        <a v-on:click="scrollHelp(helplist.id)" style="color:#e58eb2;cursor: pointer;">{{ helplist.post_title }}</a>
                    </p>
                </div>
                <div class="row mt-3" :id="'scroll'+helplist.id" v-for="(helplist, index) in GetHeplsList" :key="helplist.id" :index="index">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <p class="mb-0"><strong>{{ helplist.post_title }}</strong></p>
                        <p v-html="helplist.post_content"></p>
                    </div>
                    <hr>
                </div>
            </div>
        </section> 
                    
        <section class="sec-padding" v-show="defaultContent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <span v-for="(HelpsLink, index) in AllHelpsLink" :key="HelpsLink.id" :index="index">                            
                            <span v-if="HelpsLink.helpLink.length>0">
                                <p class="text-center" style="margin-bottom: 20px;font-size: 20px;text-decoration: underline;text-transform: uppercase;">{{ HelpsLink.catName }}</p>
                                <p class="text-center" v-for="(HelpLinks, index) in HelpsLink.helpLink" :key="HelpLinks.id" :index="index">
                                    <a v-on:click="scrollHelpLink(HelpLinks.id)" style="color:#e58eb2;cursor: pointer;text-transform: uppercase;">
                                        {{ HelpLinks.post_title.substring(HelpLinks.post_title.indexOf('-') + 1)  }}
                                    </a>
                                </p>
                            </span>
                        </span>
                    </div>
                </div>

                <span v-for="(HelpsLink, index) in AllHelpsLink" :key="HelpsLink.id" :index="index">
                    <span v-if="HelpsLink.helpLink.length>0">
                        <h3>{{ HelpsLink.catName }}</h3>
                        <div class="row" :id="'scroll'+HelpLinks.id" v-for="(HelpLinks, index) in HelpsLink.helpLink" :key="HelpLinks.id" :index="index">
                            <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">                               
                                <p><strong>{{ HelpLinks.post_title }}</strong></p>
                                <p v-html="HelpLinks.post_content"></p>
                            </div>
                            <hr>
                        </div> 
                    </span>               
                </span>

            </div>
        </section>
    </main>
</template>

<script>
    const axios = require('axios');
    export default {
        name:'help',
        data() {            
            return {                
                loader: false,
                defaultContent: true,
                helpContent:'',
                helpSeacrhDiv: false,
                GetHeplsList:[],
                not_found:false,
                not_found_text:'',
                AllHelpsLink:[],
                pageName : 'help'
                // pageTitle : 'Need Help or Have A Question?| Nanny Parent Connection',
				// pageMetaDescription : 'Need help or have questions about using our site or our Seattle nanny and childcare services? Get fast answers to your questions by browsing our Help menu.',
				// pageMetaKeywords : ''
            }
        },
        methods: {
            findHelps() {
                this.loader = true;
                this.defaultContent = false;
                axios.post(`/api/helpFind`, {
                    helpContent:this.helpContent
                }).then((response) => {                    
                    this.loader = false;
                    if(response.data.dataNotfound){
                        this.not_found = true;
                        this.not_found_text = response.data.dataNotfound;
                    }else {
                        this.not_found = false;
                        this.not_found_text = '';
                        this.helpSeacrhDiv = true;
                        this.GetHeplsList = response.data.GetHeplsList;
                    }                        
                }).catch(error => {
                });     
            },
            scrollHelp(id){            
                document.getElementById('scroll'+id).scrollIntoView({behavior: "smooth", block: "start"});
            },
            scrollHelpLink(id){            
                document.getElementById('scroll'+id).scrollIntoView({behavior: "smooth", block: "start"});
            },
            
            getAllHelps() {
                axios.get(`/api/helpsList`, {
                }).then((response) => { 
                    this.loader = false;
                    //console.log('Testing : ',response.data.AllHelpsLink);
                    this.AllHelpsLink = response.data.AllHelpsLink;
                }).catch(error => {
                });  
            }
        },
        async updated() {
            this.$nextTick(() => {
                if(this.$route.hash) {                
                    const el = document.querySelector(this.$route.hash);
                    el && el.scrollIntoView();
                }
            }); 
            if(this.helpContent.length>0){
                
            } else {
                this.helpSeacrhDiv = false;
                this.not_found = false;
                this.not_found_text = '';
                this.defaultContent = true;
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
        async created() {
            this.getAllHelps();
            this.loader = true;                         
        }      	
    }
    
</script>
