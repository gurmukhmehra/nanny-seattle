<template>
    <main> 
        <section style="background-color: #e58eb2;padding-top:12px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <p class="text-center text-white">Questions? Call or Text Us! (425) 243-7032</p>
                    </div>
                </div>
            </div>
        </section>       
        <section class="sec-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <h3 style="margin-bottom: 0;">Laura Scoccolo</h3>
                        <p>Founder/Chief Mommy</p> 
                        <hr style="color: #e58eb2;">                           
                        <p>I grew up the youngest of four girls on a farm in the small town of Forks, Washington. Finances were tight in my family so at a young age I began riding my bike up the street to babysit for my neighbors. Every year I would put this money toward new clothes for school. Working with kids from a young age allowed me to transition to working as a nanny during college. Back then I connected with families in search of a nanny by scouring the classified section of the Seattle Times! </p>
                        <img src="/public/assets/images/Scoccolo.JPG" class="align-right">
                        <p>Ten years later I was returning to work after having my second child and searching for a nanny. I couldn’t afford to spend a lot of money working with a nanny agency and I wasn’t having much luck with Craigslist or the corporate sites. I was excited when I found an area nanny group on Facebook – surely that would be the perfect place to find a nanny! When I was told I couldn’t join because the group was for nannies only, the Nanny Parent Connection was born. </p>
                        <p>I love that the Nanny Parent Connection makes access to quality childcare easy. It is an amazing community of people who come together to provide support to one another by answering questions, sharing important information, and helping each other with their childcare or nanny family search. I truly enjoy working with our members to make those connections because I know how stressful finding childcare or families to work with can be.</p>
                        <p>I have learned so much in the 15 years I have been in the industry and I am happy to answer any questions or assist you in any way that I can – whether that’s finding your dream nanny family, building a list of experienced babysitters or finding the perfect nanny to care for your children. </p>
                        <p>As a nanny years ago, connecting with families in need of care without the help of an agency was difficult. As a parent I have found childcare to be one of the more challenging pieces of the parenting puzzle. My hope with this platform is that I can help to take some of the stress out of the childcare process for parents and help care providers connect with families searching for childcare – because it takes a village to raise and care for our precious little ones!</p>
                        <p>
                            <router-link to="/sign-up-chooser">
                                <img :src="'/public/assets/images/Laura-Signature-1-300x84.png'">
                            </router-link>
                        </p>
                    </div>
                </div>  
            </div> 
        </section>
    </main>
</template>

<script>
    export default {
        name:'about-us',
        data() {
            return {
                pageName : 'aboutUs'
                // pageTitle : 'Experienced Seattle Nannies and Babysitters | Nanny Near Me!',
                // pageMetaDescription : '',
                // pageMetaKeywords : ''
            }  
        },
        method:{},
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
