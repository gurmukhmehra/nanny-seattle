<template>
    <main>    
        <div class="container">
            <p class="mt-2">
                Terms:<b>${{this.planPrice}}</b> per calendar year for premium access to our community. Membership includes 
                FREE nanny contract or nanny share contract, discounted pricing on all background checks, 
                and access to our CareCalendar, Last Minute Care Text Service, Verified Care Provider Service 
                and personal support from our team. Membership renews automatically. To avoid charges for the 
                next year, cancel before the renewal date.
            </p>
             
            <div class="table-responsive-sm">
              <table class="table">
                  <thead>
                      <tr>
                          <th>DESCRIPTION</th>
                          <th>AMOUNT</th>
                      </tr>
                  </thead>
                  <tbody>  
                        <tr>
                            <td>{{this.planTitle}}</td>
                            <td>${{this.planPrice}}</td>
                        </tr>
                         <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>${{this.planPrice}}</strong></td>                        
                        </tr>
                  </tbody>
              </table>
            </div>
            <div class="row text-center">                                
                <button v-if="!!this.planPrice" @click="MakePayment" class="btn btn-warning mb-4">
                    <span v-show="loader">
                        <span style="color:#333">
                            <span class="spinner-border spinner-border-sm"></span>
                        </span>                    
                    </span>
                    Pay Now
                </button> 
                <p v-else class=""></p>
            </div>          
            
        </div>    
    </main>
    </template>
    
    <script>          
        export default { 
            props:{
                planTitle:String,
                planPrice:Number
            },        
            data(){                                             
                return {  
                    loader :false,
                    planPriceID:'',
                    planProduct_period:'',
                    userEmail:''                                  
                }
            },
            methods: {            
                MakePayment(){
                    this.loader = true;
                    axios.post(`/api/stripe-checkout`, {
                        stripe_prod_priceID: this.planPriceID,
                        customer_email: this.userEmail,
                    }).then((response) => {
                        window.location.href = response.data.payment_url;
                    }).catch(error => {
                    });
                }  
            },        
            mounted() {  
                       
            },
            created() {                
                axios.get('api/get-user-session', {
                }).then((response) => { 
                    this.planPriceID = response.data.userSession.planPriceID;
                    this.userEmail = response.data.userSession.email;                   
                }).catch(error => {
                }); 
                window.scrollTo(0,0); 
            }       
        }
    </script>
    