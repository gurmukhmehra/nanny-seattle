<template>
    <main>    
        <section class="sec-padding" style="background-image: linear-gradient(#e0eafc, rgba(207, 222, 243, 0.31));border-width:0px;">
            <div class="container">
                <div class="row text-center">
                    <p>
                        <i class="fa bg-inserted-icon fa-line-chart" style="font-size: 36px; border-width: 0px; color: #dd3333;" aria-hidden="true"> 
                            <span style="display: none;">&nbsp;</span> 
                        </i>
                    </p>
                    <h1>How much do nannies charge?</h1>
                    <p>With your help, we provide up-to-date nanny compensation information to thousands of parents, nannies, and agencies across the Pacific Northwest.</p>
                    <p>Results delivered directly to your inbox for FREE.</p>
                </div>                
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <p class="pt-4">Nanny Parent Connection is a community of parents, care providers, and agencies working together to ensure excellent childcare for our little ones. We number over 20,000 members and are exclusively located in the Puget Sound region of Washington.</p>
                    <p>Every year, we ask our community and neighbors to complete a pay rate survey so that we may provide a snapshot of the average childcare costs for different scenarios (i.e. one child, two children, nanny shares, sitter, part-time, etc.) as well as other information. You can find the results of our past surveys by clicking the below button.</p>
                    <p class="text-center">
                        <a href="https://blog.nannyparentconnection.com/table-of-contents/" target="_blank" class="custom_yellow_btn">View Past Survey Results</a>
                    </p>
                    <p>Due to the ongoing COVID-19 pandemic, we have included several questions/options to gauge the impact of the continuing pandemic on childcare costs and availability in our region.</p>
                    <p>This year, we have broken down the survey results into three categories:</p>
                    <p><strong>To view all survey results in one graphic, <a href="/nanny-pay-survey-2023-results#allresults">click here.</a></strong></p>
                    <p>To view the results from respondents living in or offering care in the 98000 to 98099 zip code range,<router-link to="/nanny-pay-bellevue-kirkland-survey-results-2023">click here.</router-link></p>
                    <p>To view the results from respondents living in or offering care in the 98100 to 98199 zip code range,<router-link to="/nanny-pay-seattle-survey-results-2023">click here.</router-link></p>
                    <p>If you have any questions about the results, feel free to <a href="mailto:info@nannyparentconnection.com">email us here</a></p>
                    <p><em>March 8, 2023: We converted several of the benefit information infographics to bar charts to make them easier to read.&nbsp;</em></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <div id="allresults">
                        <p class="text-center">
                            <a href="https://www.seattle.gov/covid-19" target="_blank">
                                <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-1.png" alt="How Much Do Nannies Charge"/>
                            </a>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-2.png" alt="wedgwood nanny"/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-3.png" alt="How Much Do Nannies Charge"/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-4.png" alt="ballard nanny"/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-5-Final.png" alt="How Much Do Nannies Charge"/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-6.png" alt=""/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-7-Revised.png" alt="seattle babysitter cost"/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-8-Revised.png" alt=""/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-9.png" alt=""/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-10.png" alt=""/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-11.png" alt=""/>
                        </p>
                        <p class="text-center">
                            <img src="public/uploads/All-Responses-2023-Childcare-Pay-Rate-Survey-Results-12.png" alt="How Much Do Nannies Charge"/>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {
    name:'nanny-pay-survey-2023-results',
    data(){
        return {    
            pageTitle : 'How Much Do Nannies Charge? | 2023 Pay Survey Results',
            pageMetaDescription : 'Every year, we ask our community and neighbors to complete pay rate surveys so that we may provide a snapshot of nanny childcare costs in...',
            pageMetaKeywords : ''              
        }
    },
    methods:{},
    mounted(){	
        document.title = this.pageTitle;
        document.getElementsByTagName('meta')["description"].content = ""+this.pageMetaDescription+"";
        document.getElementsByTagName('meta')["keywords"].content = ""+this.pageMetaKeywords+"";		
    },
    created() {
        window.scrollTo(0,0); 
    }
}
</script>