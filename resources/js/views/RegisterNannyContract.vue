<template>
    <main>    
        <div class="container">
            <p class="mt-4">
                Price: ${{planDetail.mepr_product_price}} with access to our nanny contract for six months in case you need to download another copy in the future.
            </p>     
            <input type="hidden"  v-model="planDetail.id">
            <input type="hidden"  v-model="planDetail.mepr_product_price">           
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mt-3">
                        <label for="firstName">First Name:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="firstName" placeholder="" v-model="firstName">
                        <small class="text-danger">{{ error_firstName }} </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="lastName">Last Name:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="lastName" placeholder="" v-model="lastName">
                        <small class="text-danger">{{ error_lastName }} </small>
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="address1">Address Line 1:<sup class="text-danger">*</sup></label>
                        <input type="text" @keyup="addressValue" ref="Autocomplete_address1" class="form-control" id="address1 autocomplete" placeholder="" v-model="address1">
                        <small class="text-danger">{{ error_address1 }} </small>
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
                        <small class="text-danger">{{ error_stateProvince }} </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="postalCode">Zip/Postal Code:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="postalCode postcode" placeholder="" v-model="postalCode">
                        <small class="text-danger">{{ error_postalCode }} </small>
                    </div>
                </div>
            </div>          
                
            <!-- <div class="form-group  mt-3">
                <label for="phoneNumber">Phone number to receive SMS (text message) notification when a member wants to connect with you:<sup class="text-danger">*</sup></label>
                <input type="text" class="form-control" id="phoneNumber" placeholder="" v-model="phoneNumber">
                <small class="text-danger">{{ error_phoneNumber }} </small>
            </div> -->
    
            <div v-if="!isLoggedIn" class="row">
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="userName">Username:<sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" id="userName" placeholder="" v-model="userName">
                        <small class="text-danger">{{ error_userName }} </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="email">Email:<sup class="text-danger">*</sup></label>
                        <input type="email" class="form-control" id="email" placeholder="" v-model="email">
                        <small class="text-danger">{{ error_email }} </small>
                    </div>
                </div>
            </div>
    
            <div v-if="!isLoggedIn" class="row">
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="password">Password:<sup class="text-danger">*</sup></label>
                        <input type="password" class="form-control" id="password" placeholder="" v-model="password">
                        <small class="text-danger">{{ error_password }} </small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group  mt-3">
                        <label for="ConfirmPassword">Confirm Password:<sup class="text-danger">*</sup></label>
                        <input type="password" class="form-control" id="ConfirmPassword" placeholder="" v-model="ConfirmPassword">
                        <small class="text-danger">{{ error_ConfirmPassword }} </small>
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
            <div class="form-group  mt-3">           
                <button v-on:click="register" class="custom_yellow_btn w-100" style="font-weight: bold;text-transform: uppercase;">
                    <span v-if="loading" class="spinner-border spinner-border-sm" role="status"></span> PURCHASE
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
                error_firstName: "",
                error_lastName: "",
                error_address1: "",
                error_stateProvince: "",
                error_postalCode: "",
                error_phoneNumber: "",
                error_userName: "",
                error_email: "",
                error_password: "",
                error_ConfirmPassword: "",

                Coupon_Code:false
            };
        },
        methods: {
            showCouponCode(){
                this.Coupon_Code = true;
            },
            read() {
                axios.get(`/api/buy-plan/${this.planID}`).then(({ data }) => {
                    this.planDetail = data;
                })
                .catch((err) => console.error(err));
            },
            register() { 
                this.loading = true;           
                axios.post(`/api/registerSave`, {
                    planID: this.planDetail.id,
                    planPrice: this.planDetail.mepr_product_price,
                    planPriceID: this.planDetail.stripe_prod_priceID,
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
                    router.push({ name: `nanny-contract-payment`, 
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
                        this.error_firstName = error.response.data.error.firstName,
                        this.error_lastName = error.response.data.error.lastName,
                        this.error_address1 = error.response.data.error.address1,
                        this.error_stateProvince = error.response.data.error.stateProvince,
                        this.error_postalCode = error.response.data.error.postalCode,
                        this.error_phoneNumber = error.response.data.error.phoneNumber,
                        this.error_userName = error.response.data.error.userName,
                        this.error_email = error.response.data.error.email,
                        this.error_password = error.response.data.error.password,
                        this.error_ConfirmPassword = error.response.data.error.ConfirmPassword
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
        }, 
        created() {
            window.scrollTo(0,0); 
        }   
    }
    </script>
    