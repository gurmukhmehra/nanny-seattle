<template>
    <main>    
        <section class="sec-padding of-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h5 class="mb-4 text-center">Thank you! Your responses have been submitted.</h5>
                        <p>I will review your completed form shortly. Next, <span style="text-decoration: underline;">please schedule a phone call with me</span> so that I can learn more about your child care need and answer any questions you may have.</p>
                        <p>Please take a look at my availability and set up time for a call that works for your schedule <strong>by clicking the below link:</strong></p>
                        <p><strong><a href="https://calendly.com/laura-npc/nannysearchfamilyconsultation" target="_blank" rel="noopener">Click here to schedule a phone consultation</a></strong></p>
                        <p>If your need is urgent, or there are no times that work with your schedule, please <a href="mailto:laura@nannyparentconnection.com">email me by clicking here</a> and we can find a time that works for your schedule.</p>
                        <p>I look forward to speaking with you!</p>
                        <p><img :src="'/public/assets/images/sign.png'"></p>
                        <p>Laura Scoccolo</p>
                        <p>Founder and “Chief Mommy”</p>
                        <p>Phone/Text: (425) 243-7032</p>
                        <p><img :src="'/public/assets/images/Scoccolo.JPG'"></p>
                    </div>			
                </div>
            </div>
        </section>
    </main>
    </template>
    <script>
        const axios = require('axios');
        export default {        
            name:'thank-you-concierge',
            mounted() {},
			created() {},
            updated() {
                window.scrollTo(0,0);
            }
        }
        
    </script>
    
        
    