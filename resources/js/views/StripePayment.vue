<template>
    <main>    
        <div class="container">
            <p class="mt-2">
                Terms: ${{this.planPrice}} per calendar year for premium access to our community. Membership includes 
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
            <div class="row">
                <stripe-checkout
                    ref="checkoutSubRef"
                    mode="subscription"
                    :pk="this.publishableKey"
                    :line-items="lineItems"
                    :customerEmail="customer_email"
                    :success-url="successURL"
                    :cancel-url="cancelURL"
                    @loading="v = loading = v"
                />
                <stripe-checkout
                    ref="checkoutRef"
                    mode="payment"
                    :pk="this.publishableKey"                    
                    :session-id="sessionId"
                    @loading="v = loading = v"
                />
                <button v-if="this.planProduct_period === 'lifetime'" class="btn btn-warning mb-4" @click="oneTimePaymnet">Pay Now</button>            
                <button v-else-if="this.planProduct_period === 'years'" class="btn btn-warning mb-4" @click="submit">Pay Now</button>
                <button v-else-if="this.planProduct_period === 'months'" class="btn btn-warning mb-4" @click="submit">Pay Now</button>
                <span v-else></span>
                <button class="btn btn-danger mb-4" @click="cancelPayment">Cancel Payment</button>
            </div>     
        </div>    
    </main>
    </template>
    
    <script>
        import { StripeCheckout } from '@vue-stripe/vue-stripe';  
        export default { 
            components :{
                StripeCheckout,
            },   
             props:{
                planID:Number,
                planPrice:Number,
                planPriceID:String,
                planTitle:String,
                planProduct_period:String,
                userEmail:String,
                userIDs:Number,
                publishableKeys:String,
                sessionId:String,
                success_url:String
            },        
            data(){
                    //this.publishableKey = process.env.STRIPE_PUBLISHABLE_KEY;                   
                return {  
                    publishableKey :this.publishableKeys,
                    sessionId: this.sessionId,                                     
                    loading: false,                        
                    lineItems: [
                        {
                            price: this.planPriceID,
                            //price: 'price_1LUQXuHHk9pJpDONEIzBwkVX',
                            quantity: 1,                         
                        }                    
                    ],                 
                    customer_email:this.userEmail,                      
                    successURL: this.success_url,
                    cancelURL: `https://seattle.nannyparentconnection.com/cancel`
                }
            },
            methods: {             
                submit(){
                    this.$refs.checkoutSubRef.redirectToCheckout();
                } ,
                oneTimePaymnet(){
                    this.$refs.checkoutRef.redirectToCheckout();
                },
                cancelPayment(){
                    window.location.href = "/";
                }   
            },
            created() {
                window.scrollTo(0,0); 
            }       
        }
    </script>
    