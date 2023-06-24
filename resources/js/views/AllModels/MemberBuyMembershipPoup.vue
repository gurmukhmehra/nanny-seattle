<template>
    <div class="c-toast-container ml-3" style="position: fixed;z-index:999;">
        <div v-for="(subscribersPlan, index) in subscribersPlans" :key="subscribersPlan.id" :index="index" :data-index="index" class="c-toast">
            <div class="toast-header">
                <div class="row">
                    <div class="col-md-2 mb-2">
                        <img v-if="!!subscribersPlan.UsersDetails.profileImage" :src="'/public/uploads/profileImage/' + subscribersPlan.UsersDetails.profileImage" alt="profile-img" class="avatar-130 img-fluid" style="width:50px;height:50px;"/>
                        <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="profile-img" class="avatar-130 img-fluid" style="width:50px;height:50px;" />
                    </div>
                    <div class="col-md-10">
                        <div style="width: 100%;padding: 12px 28px 12px 12px;border-radius: 5px;">
                            <div style="font-size: 18px;width: max-content; background: transparent; padding: 0;">
                                <p style="margin:0">
                                <span class="mr-1" style="font-weight:500;">{{ subscribersPlan.UsersDetails.name }}</span> purchased
                                <span style="color:#e58eb2;">
                                    {{ subscribersPlan.MembershipDetail.post_title }}
                                </span> 
                                <button v-on:click="hideModel(index)" type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                                </p>
                                <p class="text-muted" style="margin:0;font-size: 14px;font-style: italic;">{{ moment(subscribersPlan.created_at).fromNow() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .c-toast {
        background-color: #fff;
        display: none;
    }
</style>
<script>
    import moment from "moment";
    export default {
        name:'Member-Buy-Membership-Poup',
        data: () => {
            return {
                popupShow :true,
                subscribersPlans:[],
                moment: moment,
            }
        },
        methods: {
            hideModel(index){
                $(`.c-toast[data-index="${ index }"]`).css('display', "none");
            },
            getSubscribersPlans(){
                axios.get(`/api/purchaseMembership`).then((response) => {
					this.subscribersPlans= response.data.subscribersPlans;
				}).catch((err) => console.error(err));
            },

        },
        mounted: function () {
        },
        updated(){

         },

         created() {
            this.getSubscribersPlans();
        }
    }


</script>

