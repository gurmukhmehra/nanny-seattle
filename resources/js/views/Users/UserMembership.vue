<template>   
    <main>
        <section class="sec-padding" style="padding-top:0px;padding-bottom:0px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <MemberHeader/>                                                        
                        </div> 
                        <div class="iq-card">
                            <MemberMenus/>
                        </div>                                                
                    </div>
                    <div class="col-sm-12">
                        <div class="iq-card">
                            <div class="iq-card-body">            
                                <span v-if="isLoggedIn">
                                    <div class="table-responsive">
                                        <table class="table table-borderless">
                                            <thead style="background-color: #ccc;">
                                                <tr>
                                                    <th>Membership</th>
                                                    <th>Terms</th>
                                                    <th>Gateway</th>
                                                    <th>Status</th>
                                                    <th>Created On</th>
                                                    <th>Expire On</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="userplans in userplan" :key="userplans.id">
                                                    <td>
                                                        <!-- <div v-for="plan in plans" :key="plan.id">
                                                            <span v-if="userplans.product_id == plan.id">
                                                                <span v-if="plan.plan_category === 'families_parents'">Family Parents</span>
                                                                <span v-else-if="plan.plan_category === 'care_provider'">Care Provider</span>
                                                                <span v-else-if="plan.plan_category === 'agencies'">Agencies</span> 
                                                                <span v-else></span>                                                              
                                                                - {{plan.post_title}}
                                                            </span>
                                                        </div> -->
                                                        {{userplans.membershipPlanInfo.post_title}}
                                                    </td>
                                                    <td>
                                                        ${{userplans.membershipPlanInfo.mepr_product_price}}/{{userplans.membershipPlanInfo.interval}}
                                                        <!-- <div v-for="plan in plans" :key="plan.id">
                                                            <span v-if="userplans.product_id == plan.id">
                                                                ${{plan.mepr_product_price}}/{{userplans.interval}}
                                                            </span>
                                                        </div> -->
                                                    </td>
                                                    <td>Stripe</td>
                                                    <span v-if="userplans.status === 'cancelled'">
                                                        <td>
                                                            <span class="text-danger">Cancel</span>
                                                        </td>
                                                    </span>
                                                    <span v-else>
                                                        <td v-if="userplans.status === 'active'">
                                                            <span class="text-success">Active</span>
                                                        </td>                               
                                                        <td v-else>
                                                            <span class="text-warning">Expire</span>
                                                        </td>
                                                    </span>                             
                                                                                                
                                                    <td>{{moment(userplans.created_at).format('d MMMM, YYYY')}}</td>
                                                    <td>{{moment(userplans.subscriptionsTransactions.updated_at).format('d MMMM, YYYY')}}</td>
                                                    <td>
                                                        <a v-if="userplans.status === 'cancelled'" class="btn btn-danger text-white">Cancelled </a>
                                                        <a v-else v-on:click="cancelSubscription(userplans.subscr_id)" class="btn btn-outline-info">Cancel</a>
                                                        <span v-show="statusVisible" v-if="subStatus != ''" class="text-success" style="float:left;">{{subStatus}}</span> 
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                                            
                                </span>
                                <span v-else class="text-danger">
                                    not found !..
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
<script>
    const axios = require('axios');
    import moment from "moment";
    import MemberHeader from "../Users/MemberHeader";
    import MemberMenus from "../Users/MemberMenus";    
export default {
    name: "UserMembership",
    components: {
        MemberHeader,
        MemberMenus
    },
    data() {
        return {
            moment: moment, 
            isLoggedIn: false,
            statusVisible: true,
            userplan: [],
            plans: [],
            subStatus:'',
        }
    },
    methods: {
        MyNotificatios(){
            axios.get(`/api/MyNotificatios`).then((response) => {
                this.total_notification = response.data.totalNotification;
            }).catch((err) => console.error(err));
        },
        cancelSubscription(subscription_id){
            if (window.Laravel.user) {
                axios.post(`/api/userCancelSubscription`, {
                    subscriptionId: subscription_id,
                    userIDs: window.Laravel.user.id,
                }).then((response) => {                
                    //console.log(response.data.requestDetail.requestSendTo);                              
                    this.subStatus = response.data.subscriptionStatus; 
                    this.statusVisible = true,
                    setTimeout(() => this.statusVisible = false, 3000);            
                }).catch(error => {
                })
            }
        },        
    },
    mounted() {
        Echo.private('sendfriendReq-channel').listen('FriendRequestSend',(e) => {
            //console.log('Friend request new  : ', e.notification);
            //this.total_notification += e.notification;
            this.MyNotificatios();        
        });
    },
    created() {        
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }	
        if (window.Laravel.user) {	
            axios.get(`/api/userPlan/${window.Laravel.user.id}`).then((response) => {
                //console.log(response.data[0].subscriptions_end_date);
                this.userplan= response.data.userPlans;                 
            }).catch((err) => console.error(err));

            axios.get(`/api/plans`).then(({ data }) => {
                this.plans= data;					
            })
            .catch((err) => console.error(err));
        }
       
    },
    updated() {
        window.scrollTo({
            top: 280,
            behavior: 'smooth',
        })
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
     next();
    }
}
</script>