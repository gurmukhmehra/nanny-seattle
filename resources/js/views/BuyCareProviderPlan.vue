<template>
    <main>    
        <div class="container">
            <p class="mt-5" v-if="planDetail.mepr_product_period=='years'">              
                Terms:Free 48 hour trial. Cancel anytime in the first 48 hours and your card will not be 
                charged. After the trial has ended, ${{planDetail.mepr_product_price}} per calendar year for premium access to our 
                community. Membership includes access to our CareCalendar, Last Minute Care Text Service, 
                Verified Care Provider Service, Jobs Board and personal support from our team. Membership 
                renews automatically. To avoid charges for the next year, cancel before the renewal date.
            </p> 
            <p class="mt-5" v-else-if="planDetail.mepr_product_period=='months'"></p>     
            <p class="mt-5" v-else-if="planDetail.mepr_product_period=='lifetime'"></p>
            <p v-else></p>

            <input type="hidden"  v-model="planDetail.id">
            <input type="hidden"  v-model="planDetail.mepr_product_price">
            <input type="hidden"  v-model="planDetail.stripe_prod_priceID">           
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
                        <input type="text" @keyup="addressValue" ref="Autocomplete_address1" class="form-control" id="address1" placeholder="" v-model="address1">
                        
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
                        <input type="text" class="form-control" id="postalCode" placeholder="" v-model="postalCode">
                        
                    </div>
                </div>
            </div>          
                
            <div class="form-group  mt-3">
                <label for="phoneNumber">Phone number to receive SMS (text message) notification when a member wants to connect with you:</label>
                <input type="text" class="form-control" id="phoneNumber" @input="formatPhoneNumber" placeholder="(000) 000-0000" v-model="phoneNumber">
            </div>

            <div class="form-group mt-3 mb-2">
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
            <div class="form-group  mt-3">
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
                    <span v-if="loading" class="spinner-border spinner-border-sm" role="status"></span> Sign up
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
            planID: String         
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
                pageTitle : 'Are You Looking for Seattle Childcare Jobs? Join our Community!',
				pageMetaDescription : 'Looking to find Seattle childcare jobs? Access the MOST families looking for long term, short term, date night, and last minute care in the Puget Sound.',
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
                axios.get(`/api/buy-care-provider-plan/${this.planID}`).then(({ data }) => {
                    this.planDetail = data;
                })
                .catch((err) => console.error(err));
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
                    UserGroup:this.UserGroup,
                    memberType: 'care_provider_member',
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
                    this.loading = true;
                    //console.log(response.data.userInfo.email);
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
                    router.push({ name: `stripepayment`, 
                                    params: {                                    
                                        planID:response.data.planDetail.id,
                                        planTitle:response.data.planDetail.post_title,
                                        planPrice:response.data.planDetail.mepr_product_price,
                                        planPriceID:response.data.planDetail.stripe_prod_priceID,
                                        planProduct_period:response.data.planDetail.mepr_product_period,
                                        userEmail:response.data.userInfo.email,
                                        userIDs:response.data.userInfo.id
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
                this.UserGroup = response.data.allGroups[1].id;
            }).catch((err) => console.error(err));
        },
        created(){
            
        },
        updated() {
            
        }
    }
    </script>
    