<template>
    <main>    
        <div class="container">
            <p class="mt-5" v-if="planDetail.id == '29748' || planDetail.id=='184396'">
                Terms: ${{planDetail.mepr_product_price}} per calendar year for premium access to our community.
                Membership includes FREE nanny contract or nanny share contract, discounted pricing on all 
                background checks, and access to our CareCalendar, Last Minute Care Text Service, Verified Care 
                Provider Service and personal support from our team. Membership renews automatically.
                To avoid charges for the next year, cancel before the renewal date.
            </p>
            <p class="mt-5" v-else-if="planDetail.id == '184397' || planDetail.id=='155721'">                
                Terms: ${{planDetail.mepr_product_price}}/month for premium access to our community. Membership
                includes discounts on all background checks, 10% off all nanny contracts and access to our 
                CareCalendar, Last Minute Care Text Service and Verified Care Provider Service. Cancel anytime.               
            </p>
            <p class="mt-5" v-else-if="planDetail.id == '155718' || planDetail.id=='184398'">                
                Price: ${{planDetail.mepr_product_price}} for one month of premium access to our community.
                Includes discounts on all background checks and access to our CareCalendar, Last Minute Care 
                Text Service and Verified Care Provider Service.                
            </p>
            <p class="mt-5" v-else-if="planDetail.id == '184399' || planDetail.id=='29896'">                
                Terms: Free 48 hour trial. Cancel anytime in the first 48 hours and your card will not be 
                charged. After the trial has ended, $35.88 per calendar year for premium access to our 
                community. Membership includes access to our CareCalendar, Last Minute Care Text Service, 
                Verified Care Provider Service, Jobs Board and personal support from our team. Membership 
                renews automatically. To avoid charges for the next year, cancel before the renewal date.               
            </p>
            <p class="mt-5" v-else-if="planDetail.id == '184400' || planDetail.id=='30019'">                
                Terms: ${{planDetail.mepr_product_price}} per calendar year for premium access to our community. Membership includes weekly 
                advertising, access to CareCalendar, Last Minute Care Service, Verified Care Provider Service 
                and discounts on all background checks. Membership renews automatically. To avoid charges for 
                the next year, cancel before the renewal date.               
            </p>
            <p class="mt-5" v-else-if="planDetail.id == '184401' || planDetail.id=='155715'">                
                Terms: ${{planDetail.mepr_product_price}}/month for premium access to our community. Membership 
                includes weekly advertising, access to CareCalendar, Last Minute Care Service and discounts on all 
                background checks. Cancel anytime.               
            </p>
            <p class="mt-5" v-else-if="planDetail.id == '184402' || planDetail.id=='155712'">                
                Terms: ${{planDetail.mepr_product_price}} for one month of premium access to our community. 
                Includes weekly advertising, access to CareCalendar, Last Minute Care Service and discounts 
                on all background checks.         
            </p> 
            <p class="mt-5" v-else-if="planDetail.id == '184403' || planDetail.id=='139545'">                
                Terms: ${{planDetail.mepr_product_price}} with access to our nanny contract for six months in case you need to download another copy in the future.         
            </p>
            <p class="mt-5" v-else-if="planDetail.id == '184404' || planDetail.id=='154368'">                
                Terms: ${{planDetail.mepr_product_price}} with access to our nanny share contract for six months in case you need to download another copy in the future.         
            </p>
            <p v-else></p>      
            
            <input type="hidden"  v-model="planDetail.id">
            <input type="hidden"  v-model="planDetail.mepr_product_price">        
            <input type="hidden" name="memberType" class="form-control" :value="family_parent_member">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <label for="firstName">First Name:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="firstName" placeholder="" v-model="firstName">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="lastName">Last Name:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="lastName" placeholder="" v-model="lastName">
                        
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="address1">Address Line 1:<sup class="text-danger">*</sup></label>
                        <input type="text" @keyup="addressValue" ref="Autocomplete_address1" class="form-control" id="address1 autocomplete" placeholder="" v-model="address1">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="address2">Address Line 2:</label>
                        <input type="text" class="form-control" id="address2" placeholder="" v-model="address22">
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="stateProvince">State/Province:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="stateProvince" placeholder="" v-model="stateProvince">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="postalCode">Zip/Postal Code:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="postalCode postcode" placeholder="" v-model="postalCode">
                        
                    </div>
                </div>
            </div>          
                
            <div class="form-group mt-3" v-if="planDetail.id == '184403' || planDetail.id=='139545' || planDetail.id=='184404' || planDetail.id=='154368'"></div>
            <div class="form-group mt-3" v-else> 
                <label for="phoneNumber">Phone number to receive SMS (text message) notification when a member wants to connect with you:</label>
                <input type="text" class="form-control" id="phoneNumber" @input="formatPhoneNumber" placeholder="(000) 000-0000" v-model="phoneNumber">
            </div>
            

            <div class="form-group mt-3 mb-2" v-if="planDetail.id == '184403' || planDetail.id=='139545' || planDetail.id=='184404' || planDetail.id=='154368'">
             </div>
            <div class="form-group mt-3 mb-2" v-else>
                <label for="phoneNumber">Would you like access to our Facebook communities?:</label>
                <div class="form-check-inline ml-3">
                    <label class="form-check-label">
                        <input type="radio" style="margin-top: 5px;" @change="onChangeRadio($event)" class="form-check-input" name="accessFacebookCommunities" value="Yes" v-model="accessFacebookCommunities">Yes
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" style="margin-top: 5px;" @change="onChangeRadio($event)" class="form-check-input" name="accessFacebookCommunities" value="No" v-model="accessFacebookCommunities">No
                    </label>
                </div>
            </div>
            
            <span v-if="FacebookCommunityYes">
                <div class="form-group mb-0">
                    <label for="phoneNumber">Which Facebook community would you like access to:</label>
                </div>
                <div class="form-check ml-4">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="Seattle Nanny Parent Connection" v-model="SelectFacebookCommunity"> Seattle Nanny Parent Connection
                    </label>
                </div>
                <div class="form-check ml-4">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="405 Eastside Nanny Parent Connection" v-model="SelectFacebookCommunity"> 405/Eastside Nanny Parent Connection
                    </label>
                </div>
            </span>                            
    
            <div v-if="!isLoggedIn" class="row">
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="userName">Username:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="userName" placeholder="" v-model="userName">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="email">Email:<sup class="text-danger">*</sup></label>
                        <input type="email" class="form-control" id="email" placeholder="" v-model="email">
                        
                    </div>
                </div>
            </div>
    
            <div v-if="!isLoggedIn" class="row">
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="password">Password:<sup class="text-danger">*</sup></label>
                        <input type="password" class="form-control" id="password" placeholder="" v-model="password">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="ConfirmPassword">Confirm Password:<sup class="text-danger">*</sup></label>
                        <input type="password" class="form-control" id="ConfirmPassword" placeholder="" v-model="ConfirmPassword">
                    </div>
                </div>
            </div>
            <div class="form-group mt-2">
                <span class="text_pink" v-on:click="showCouponCode">Have a coupon?</span>                
            </div> 
            <div class="form-group mb-4" v-if="Coupon_Code">
                <label for="CouponCode">Coupon Code:</label>
                <input type="text" class="form-control" id="CouponCode" placeholder="Enter Coupon code.." v-model="CouponCode">
            </div>
            <div class="form-group mb-4 mt-2">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" required value=""> 
                        <router-link to="/terms-of-use" rel="Terms of Use" target="_blank" style="font-weight: 600;">
                            I have read and agree to the Terms of Use<sup class="text-danger">*</sup>
                        </router-link>
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked value=""> 
                        <span style="font-weight: 600;">Sign up for important news, discounts and updates! Not to worry...we only send one email per week.</span>                       
                    </label>
                </div>
            </div>
            <div class="form-group">
                <ul>
                    <div v-for="(errorArray, idx) in error_inputs" :key="idx">
                        <div v-for="(allErrors, idx) in errorArray" :key="idx">
                            <li><span class="text-danger">{{ allErrors}} </span></li>
                        </div>
                    </div>
                </ul>                    
            </div>      
            <div class="form-group  mt-3">           
                <button v-on:click="register" class="custom_yellow_btn w-100" style="font-weight: bold;text-transform: uppercase;">
                    <span v-if="loading" class="spinner-border spinner-border-sm" role="status"></span> Sign Up
                </button>    
            </div>                  
        </div>    
    </main>
    </template>
    
    <script>        
        const axios = require('axios');
        import router from '../router'; 
        export default {    
        props: { 
            props: ['planID']       
        },    
        data() {
            return { 
                planDetail: {},                                   
                loading: false,
                isLoggedIn: false,
                groupsList :[],
                UserGroup:"",
                firstName: "",
                lastName: "",
                address1: "",
                stateProvince: "",
                postalCode: "",
                phoneNumber: "",
                userName: "",
                email: "",
                password: "",
                ConfirmPassword: "",
                error_inputs: "",

                publishableKey:"",
                FacebookCommunityYes: false,
                SelectFacebookCommunity:[],
                Coupon_Code:false,
                pageTitle : 'Experienced Nannies in Seattle | Nanny Parent Connection',
				pageMetaDescription : 'Hundreds of experienced nannies in Seattle! Stop waiting hours or days to hear back from child care providers. Find nannies and sitters within MINUTES!',
				pageMetaKeywords : ''
            };
        },
        methods: {
            onChangeRadio(event) {
                var RadioVal = event.target.value;
                if(RadioVal=='Yes'){
                    this.FacebookCommunityYes = true;
                } else {
                    this.FacebookCommunityYes = false;
                }
            },
            showCouponCode(){
                this.Coupon_Code = true;
            },
            read() {
                axios.get(`/api/buy-plan/${this.$route.params.slug}`).then(({ data }) => {
                    this.planDetail = data;
                })
                .catch((err) => console.error(err));
            },
            stripeDetail() {
                axios.get(`/api/payment-gateway`, {
                }).then((response) => { 
					this.publishableKey = response.data.patmentGateway.StripePublishablekey;                    
                }).catch(error => {
                });  
            },
            formatPhoneNumber(event) {
                this.PhoneNumberTsst = event.target.value;
                this.phoneNumber = this.formatAsPhoneNumber(this.PhoneNumberTsst);
            },
            formatAsPhoneNumber(value) {
                value = value.replace(/\D/g, '');
                if (value.length > 10) {
                    value = value.slice(0, 10);
                }
                value = '('+ value.slice(0, 3)+')' + ' ' + value.slice(3, 6) + '-' + value.slice(6);
                return value;
            },
            register() { 
                this.loading = true;           
                axios.post(`/api/register`, {                                   
                    planID: this.planDetail.id,
                    planPrice: this.planDetail.mepr_product_price,
                    planPriceID: this.planDetail.stripe_prod_priceID,
                    //memberType: 'family_parent_member',
                    UserGroup:this.UserGroup,
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    address1: this.address1,
                    address22: this.address22,
                    stateProvince: this.stateProvince,
                    postalCode: this.postalCode,
                    phoneNumber: this.phoneNumber,
                    userName: this.userName,
                    password: this.password,
                    ConfirmPassword: this.ConfirmPassword,
                }).then((response) => {
                    //console.log(response.data.userInfo.email);
                    this.loading = true;
                    this.email = "";
                    this.firstName = "";
                    this.lastName = "";
                    this.email = "";
                    this.address1 = "";
                    this.address22 = "";
                    this.stateProvince = "";
                    this.postalCode = "";
                    this.phoneNumber = "";
                    this.userName = "";
                    this.password = "";
                    this.ConfirmPassword = "";                
                    router.push({ name: 'stripepayment', 
                                    params: {
                                        publishableKeys: response.data.patmentGateway.StripePublishablekey,
                                        planID:response.data.planDetail.id,
                                        planTitle:response.data.planDetail.post_title,
                                        planPrice:response.data.planDetail.mepr_product_price,
                                        planPriceID:response.data.planDetail.stripe_prod_priceID,
                                        planProduct_period:response.data.planDetail.mepr_product_period,
                                        userEmail:response.data.userInfo.email,
                                        userIDs:response.data.userInfo.id,
                                        sessionId:response.data.checkout_sessionID
                                    } 
                                });
                }).catch(error => {
                    //this.correct = true, 
                    this.loading = false;
                    this.error_inputs = error.response.data.error
                });
            },
            addressValue(){
                if(this.address1.length>0){
                    this.initAutocomplete();
                }else{
                    this.address1 = ''; 
                    this.postalCode = ''; 
                    this.stateProvince = '';
                }
            },
            initAutocomplete() {                             
                const autocomplete = new google.maps.places.Autocomplete(this.$refs['Autocomplete_address1'],
                    { country: "us" }
                );                
                autocomplete.addListener("place_changed", () => {
                    const place = autocomplete.getPlace();                     
                    this.address1 = place.formatted_address; 
                    this.postalCode = ''; 
                    this.stateProvince = '';                                                         
                    for (const component of place.address_components) {
                        const componentType = component.types[0];                        
                        switch (componentType) {                                            
                            case "postal_code": {
                                this.postalCode = component.long_name;
                                break;
                            }
                            case "administrative_area_level_1":
                                this.stateProvince = component.long_name;
                            break;                                                                                        
                        }                           
                    }                      
                });                 
            }
        },    
        mounted() { 
            document.title = this.pageTitle;
			document.getElementsByTagName('meta')["description"].content = ""+this.pageMetaDescription+"";
			document.getElementsByTagName('meta')["keywords"].content = ""+this.pageMetaKeywords+"";                        
            this.initAutocomplete();         
            this.loading = false;
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
            if (window.Laravel.user) {
                this.userid = window.Laravel.user.id;
                this.firstName = window.Laravel.user.firstName,
                this.lastName = window.Laravel.user.lastName,
                this.address1 = window.Laravel.user.address1,
                this.address22 = window.Laravel.user.address2,
                this.stateProvince = window.Laravel.user.state,
                this.postalCode = window.Laravel.user.postal_code,
                this.phoneNumber = window.Laravel.user.mobile,
                this.email = window.Laravel.user.email,
                this.userName = window.Laravel.user.username
            }
            this.read();
            axios.get(`/api/groups`).then((response) => {            
                this.UserGroup = response.data.allGroups[0].id;
            }).catch((err) => console.error(err)); 
                      
        },
        created(){
            this.stripeDetail();
            window.scrollTo(0,0);
        },
        updated() {
            
        }
        
    }
    </script>
    