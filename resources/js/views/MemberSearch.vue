<template>   
    <main>        
        <!-- <section v-if="isLoggedIn" class="sec-padding of-head"> -->
        <section class="sec-padding of-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h2 class="sec-heading text-center">Suggested Matches</h2>
                        <p class="text-center">Based on your Profile responses, the following members have been selected for you. Click a member's name to learn more.</p>
                    </div>                    
                </div>
                <div class="row" style="margin: 30px 0;">
                    <div class="col-md-12 col-lg-12"> 
                        <div v-show="loader" class="row text-center mt-5 mb-3" >
                            <span style="color:rgb(229, 142, 178);">
                                <span class="spinner-grow spinner-grow-md"></span>
                                <span class="spinner-grow spinner-grow-md"></span>
                                <span class="spinner-grow spinner-grow-md"></span>
                            </span>
                        </div>                       
                        <SuggestedMatched/>                
                    </div>
                </div>
            </div>
            <div class="container">                                    
                <div class="iq-card-body p-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstName" style="font-weight: bold;text-transform: uppercase;">I'M Looking for...</label>
                                <select class="form-control" v-model="SelectMemberType" style="border: 1px solid #333;height: 47px;">
                                    <option value="care_provider_member">Care Provider Offering Care</option>
                                    <option value="family_parent_member">Family/Parent Seeking Care</option>
                                    <option value="agency_member">Agency</option>
                                </select>                                                       
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="font-weight: bold;text-transform: uppercase;">
                                <label for="lastName">Keyword Search</label>
                                <input type="text" class="form-control" placeholder="" v-model="keywordSearch" style="border: 1px solid #333;"/>                            
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstName" style="font-weight: bold;text-transform: uppercase;">Type of Care...</label>
                                <select class="form-control" v-model="SelectTypeCare" multiple="multiple" style="border: 1px solid #333;">
                                    <option value="Full Time Nanny">Full Time Nanny</option>
                                    <option value="Part Time Nanny">Part Time Nanny</option>
                                    <option value="Nanny Share Nanny">Nanny Share Nanny</option>
                                    <option value="Babysitting">Babysitting</option>
                                    <option value="Au Pair">Au Pair</option>
                                    <option value="Last Minute Care">Last Minute Care</option>
                                    <option value="Date Night/Temporary Care">Date Night/Temporary Care</option>
                                    <option value="Before/After School Care">Before/After School Care</option>
                                    <option value="Learning Guide (Academic Support)">Learning Guide (Academic Support)</option>
                                </select>                            
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="font-weight: bold;text-transform: uppercase;">
                                <label for="lastName">In What Area...</label>
                                <select class="form-control" v-model="SelectLocation" multiple="multiple" style="border: 1px solid #333;">
                                    <option value="Seattle">Seattle</option>
                                    <option value="East King County">East King County</option>
                                    <option value="North King County">North King County</option>
                                    <option value="South King County">South King County</option>
                                    <option value="Snohomish County">Snohomish County</option>
                                    <option value="Pierce County">Pierce County</option>
                                </select>                            
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2"></div>
                        <div class="col-md-8 text-center">
                            <button class="custom_yellow_btn w-100" v-on:click="SearchMembers()">Search</button>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                   
                    <div v-show="loader" class="row text-center mt-5 mb-3" >
                        <span style="color:rgb(229, 142, 178);">
                            <span class="spinner-grow spinner-grow-md"></span>
                            <span class="spinner-grow spinner-grow-md"></span>
                            <span class="spinner-grow spinner-grow-md"></span>
                        </span>
                    </div>
                    <div class="row mt-4" v-if="BeforeMemberCheckCount>0 || careProvidersTotal>0">
                        <div class="col-md-3">
                            <p style="font-weight:600;color: #959595;">Viewing {{current_page}} - {{per_page}} of {{careProvidersTotal}} members </p>
                        </div>
                        <div class="col-md-9">                            
                            <ul class="pagination" v-if="links.length > 1 || currentPage > 1">                                
                                <li class="pagination-item" title="Previous">
                                    <span v-if="current_page == 1">
                                        <button type="button" disabled>
                                            <i class="fas fa-chevron-left"></i>
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button type="button" disabled>
                                            <i class="fas fa-chevron-left"></i>
                                        </button>                                        
                                    </span>
                                    <span v-else>
                                        <button type="button" @click="gotoFristPage(from)">
                                            <i class="fas fa-chevron-left"></i>
                                            <i class="fas fa-chevron-left"></i> 
                                        </button>
                                        <button type="button" @click="onClickPrevPage(current_page)">
                                            <i class="fas fa-chevron-left"></i> 
                                        </button>                                        
                                    </span>
                                    
                                </li>
                                <li class="pagination-item" v-for="(page, index) in links" :key="index" :id="'link_'+index">
                                    <span v-if="index == links.length - 1" ></span>
                                    <button v-else type="button" @click="onClickPage(page.label)" :class="page.active ? 'active' : '' ">{{ page.label }}</button>
                                </li>
                                <li class="pagination-item" title="Next"> 
                                    <span v-if="current_page >= last_page">                                        
                                        <button type="button" disabled>
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                        <button type="button" disabled>
                                            <i class="fas fa-chevron-right"></i>
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </span>                                   
                                    <span v-else>                                        
                                        <button type="button" @click="onClickNextPage(current_page)">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                        <button type="button" @click="gotoLastPage(last_page)">
                                            <i class="fas fa-chevron-right"></i>
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </span>
                                    
                                </li>
                            </ul>
                        </div>
                    </div>
                    <span v-if="BeforeMemberCheckCount>0 || careProvidersTotal>0">
                        <div v-for="(careProvider, index) in careProviders" :key="careProviders.id" :index="index">
                            <span class="row mt-5" style="border-bottom: 1px solid #ccc;">
                                <div class="col-md-3 user-img img-fluid text-center">
                                    <span v-if="careProvider.providersInfo.username!=username">                                        
                                        <router-link :to="{name: 'members-about', 
                                            params: { 
                                                username: careProvider.providersInfo.username
                                            }
                                        }" style="text-decoration:none;">                                
                                            <img v-if="careProvider.providersInfo.profileImage" :src="'/public/uploads/profileImage/'+careProvider.providersInfo.profileImage" alt="" class="rounded-circle" style="width: 100px;margin-top: 12px;">
                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="story-img" class="rounded-circle" style="width: 100px;">
                                        </router-link>
                                    </span>
                                    <span v-else>
                                        <router-link to="/UserDashboard" style="text-decoration:none;">
                                            <img v-if="careProvider.providersInfo.profileImage" :src="'/public/uploads/profileImage/'+careProvider.providersInfo.profileImage" alt="" class="rounded-circle" style="width: 100px;margin-top: 12px;">
                                            <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png" alt="story-img" class="rounded-circle" style="width: 100px;">
                                        </router-link>
                                    </span>

                                    <p class="mt-3 mb-3" v-if="careProvider.providersInfo.memberType === 'care_provider_member'"><strong style="font-size:13px;">Currently seeking new families to work with?:</strong></p>
                                    <p class="mt-3 mb-3" v-else-if="careProvider.providersInfo.memberType === 'family_parent_member'"><strong style="font-size:13px;">Currently seeking new provider to work with?:</strong></p>
                                    <p v-else></p>
                                    <p v-if="careProvider.currently_seeking_provider_work === 'Yes'" style="background-color: rgb(165, 220, 134); padding: 5px 15px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 20px; color: rgb(255, 255, 255);width: 35%;margin: 0 auto;">{{ careProvider.currently_seeking_provider_work }}</p>
                                    <p v-else-if="careProvider.currently_seeking_provider_work === 'No'" style="background-color: red; padding: 5px 15px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 20px; color: rgb(255, 255, 255);width: 35%;margin: 0 auto;">{{ careProvider.currently_seeking_provider_work }}</p>
                                    <p v-else style="background-color: red; padding: 5px 15px; border: 1px solid rgba(0, 0, 0, 0.2); border-radius: 20px; color: rgb(255, 255, 255);width: 35%;margin: 0 auto;">No</p>

                                    <p class="text-center mb-0 mt-2"><strong style="font-size:13px;">Desired Pay Range : </strong> 
                                        <span v-if="careProvider.minRange !==''">
                                            ${{careProvider.minRange}}-${{careProvider.maxRange}}/hr
                                        </span>                                
                                        <span v-else >$00-$00/hr</span>
                                    </p>
                                    <p class="text-center"><strong style="font-size:13px;">Experience Level : </strong>
                                        <span v-if="careProvider.providerExperience!= ''">
                                            {{careProvider.providerExperience}}
                                        </span>                                
                                        <span v-else >Nill</span>
                                    </p>
                                </div>
                                <div class="col-md-9 mt-3">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <span v-if="careProvider.providersInfo.username!=username">
                                                <router-link :to="{name: 'members-about', 
                                                    params: { 
                                                        username: careProvider.providersInfo.username
                                                    }
                                                }" style="text-decoration:none;">                               
                                                    <h6 class="mb-0" style="color:#e58eb2;">{{careProvider.providersInfo.name}}</h6>                                
                                                    <p class="mb-0" style="color:#212529;">@{{careProvider.providersInfo.username}}</p>
                                                </router-link>
                                            </span>
                                            <span v-else>
                                                <router-link to="/UserDashboard" style="text-decoration:none;">                               
                                                    <h6 class="mb-0" style="color:#e58eb2;">{{careProvider.providersInfo.name}} <span class="text-success" style="font-weight: bold;font-size: 12px;">(You)</span></h6>                                
                                                    <p class="mb-0" style="color:#212529;">@{{careProvider.providersInfo.username}}</p>
                                                </router-link>
                                            </span>
                                            <p class="mb-0" style="margin-top: 20px;">
                                                <span v-if="careProvider.providersInfo.memberType == 'care_provider_member'">
                                                    <img :src="'/public/uploads/Care-Provider-Icon.png'" title="Care Provider Member" style="cursor: pointer;margin-right: 20px;margin-bottom: 6px;"/>
                                                    <span style="background-color: rgb(57, 182, 255); color: rgb(255, 255, 255);cursor: pointer; padding: 5px 12px 5px 12px;border-radius: 20px;" title="Number of children will provide care for at one time">{{careProvider.providerCareOneTime}}</span>
                                                </span>
                                                <span v-else-if="careProvider.providersInfo.memberType == 'family_parent_member'">
                                                    <img :src="'/public/uploads/Family_Parent-Icon.png'" title="Family/Parent Member" style="cursor: pointer;margin-right: 20px;margin-bottom: 6px;"/>
                                                    <span style="background-color: #8950fb; color: rgb(255, 255, 255);cursor: pointer; padding: 5px 12px 5px 12px;border-radius: 20px;" title="Number of children needs care for">{{careProvider.numnerOfchild}}</span>
                                                </span> 
                                                <span v-else-if="careProvider.providersInfo.memberType == 'agency_member'">
                                                    <img :src="'/public/uploads/Agency-Icon.png'" title="Family/Parent Member" style="cursor: pointer;margin-right: 20px;margin-bottom: 6px;"/>
                                                </span>                               
                                                <span v-else ></span>
                                            </p>                     
                                        </div>
                                        <div class="col-md-3" v-if="careProvider.userID != id">
                                            <button v-if="careProvider.Alreadyfriends == ''" v-on:click="friendRequestSend(careProvider.userID, index)"
                                                class="mr-0 w-100 custom_yellow_btn rounded friendsRequestBtn">
                                                <span v-show="friendRequestLoader[index]" class="spinner-border spinner-border-sm"></span> Send Friend Request
                                            </button>
                                            <button v-else-if="careProvider.Alreadyfriends.requestStatus == 'confirm'" 
                                                class="mr-0 w-100 btn btn-success rounded friendsRequestBtn">
                                                Friend
                                            </button>
                                            <button v-else-if="careProvider.Alreadyfriends.requestStatus == 'pending'" 
                                                class="mr-0 w-100 btn btn-danger rounded friendsRequestBtn" style="font-size: 15px;"> 
                                                Friend Request Pending
                                            </button>                                            
                                            <span v-show="statusVisible[index]" class="text-success" style="float:left;">{{resquestSend}}</span>
                                            <button v-on:click="showPrivateMessageBox(careProvider.userID, index)" class="mr-0 mt-2 w-100 btn btn-dark rounded">
                                                Private Message
                                            </button>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <p class="mt-3"><strong style="font-size:16px;">Intro : </strong>                       
                                            <span v-if="careProvider.aboutMyfamily!= ''">
                                                {{careProvider.aboutMyfamily.substring(0,150) + '...'}}
                                                <span v-if="careProvider.aboutMyfamily.length>150">
                                                    <router-link to="/UserDashboard" rel="login" style="color:#e58eb2;">read more</router-link>
                                                </span>
                                                <span v-else></span>
                                            </span>
                                            <span v-else>Nothing...</span>                                                                                       
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="mb-0"><strong style="font-size:16px;">Desired Childcare Type:</strong></p>                                   
                                            <ul style="list-style-type: disclosure-closed;padding-left:15px;">
                                                <li v-if="careProvider.TypeOfCareLookingData.length>0" v-for="TypeOfCareLooking in careProvider.TypeOfCareLookingData">{{TypeOfCareLooking}}</li>
                                                <li v-else>Nothing...</li>                                                
                                            </ul>                                          
                                        </div>
                                        <div class="col-md-4" v-if="careProvider.providersInfo.memberType == 'care_provider_member'">
                                            <p class="mb-0"><strong style="font-size:16px;">Will care for:</strong></p>
                                            <ul style="list-style-type: disclosure-closed;padding-left:15px;">
                                                <li v-if="careProvider.WillCareForData.length>0" v-for="willCareChild in careProvider.WillCareForData">{{willCareChild}}</li>
                                                <li v-else>Nothing...</li>                                                
                                            </ul>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-0"><strong style="font-size:16px;">Location:</strong></p>
                                            <ul style="list-style-type: disclosure-closed;padding-left:15px;">
                                                <li v-if="careProvider.CareOpportunitiesData.length>0" v-for="locations in careProvider.CareOpportunitiesData">{{locations}}</li>
                                                <li v-else>Nothing...</li>                                                
                                            </ul>
                                        </div>
                                    </div>
                                    <span class="bg-dark ml-2" v-show="PrivateMesageBox[index]">
                                        <div class="row ml-1">                                    
                                            <label class="pl-0" for="SendToSubject">Subject</label>
                                            <input type="text" class="form-control" id="SendToSubject" name="PrivateMessageSubject" placeholder="" v-model="PrivateMessageSubject[index]">
                                        </div>
                                        <div class="row mt-2 ml-1">                                    
                                            <label class="pl-0" for="PrivateMessage">Message</label>
                                            <textarea class="form-control" id="PrivateMessage" name="PrivateMessage" placeholder="Write your message.." v-model="PrivateMessage[index]"></textarea>                                   
                                        </div>
                                        <div class="row mt-2 ml-1 mb-2">
                                            <div class="col-md-2 pl-0">
                                                <button class="custom_yellow_btn" v-on:click="sendPrivateMessage(careProvider.userID, index)">Send</button>
                                            </div>
                                            <div class="col-md-9">
                                                <p v-show="PrivateMesageBoxStatus[index]" class="text-success mb-0 mt-1">Message Sent..</p>
                                            </div>
                                        </div>
                                    </span>
                                </div>                                
                            </span>                      
                        </div>  
                        <div class="row mt-4" v-if="BeforeMemberCheckCount>0 || careProvidersTotal>0">
                            <div class="col-md-3">
                                <p style="font-weight:600;color: #959595;">Viewing {{current_page}} - {{per_page}} of {{careProvidersTotal}} members </p>
                            </div>
                            <div class="col-md-9">
                                <ul class="pagination" v-if="links.length > 1 || currentPage > 1">                                
                                    <li class="pagination-item" title="Previous">
                                        <span v-if="current_page == 1">
                                            <button type="button" disabled>
                                                <i class="fas fa-chevron-left"></i>
                                                <i class="fas fa-chevron-left"></i>
                                            </button>
                                            <button type="button" disabled>
                                                <i class="fas fa-chevron-left"></i>
                                            </button>                                        
                                        </span>
                                        <span v-else>
                                            <button type="button" @click="gotoFristPage(from)">
                                                <i class="fas fa-chevron-left"></i>
                                                <i class="fas fa-chevron-left"></i> 
                                            </button>
                                            <button type="button" @click="onClickPrevPage(current_page)">
                                                <i class="fas fa-chevron-left"></i> 
                                            </button>                                        
                                        </span>
                                        
                                    </li>
                                    <li class="pagination-item" v-for="(page, index) in links" :key="index" :id="'link_'+index">
                                        <span v-if="index == links.length - 1" ></span>
                                        <button v-else type="button" @click="onClickPage(page.label)" :class="page.active ? 'active' : '' ">{{ page.label }}</button>
                                    </li>
                                    <li class="pagination-item" title="Next"> 
                                        <span v-if="current_page >= last_page">                                        
                                            <button type="button" disabled>
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                            <button type="button" disabled>
                                                <i class="fas fa-chevron-right"></i>
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                        </span>                                   
                                        <span v-else>                                        
                                            <button type="button" @click="onClickNextPage(current_page)">
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                            <button type="button" @click="gotoLastPage(last_page)">
                                                <i class="fas fa-chevron-right"></i>
                                                <i class="fas fa-chevron-right"></i>
                                            </button>
                                        </span>
                                        
                                    </li>
                                </ul>
                            </div>
                        </div> 
                    </span>
                    <span v-else class="row mt-4">
                        <p class="text-center text-danger" v-if="notFound">Not found!</p>
                    </span>                             
                </div>               
            </div>
        </section>
        <!-- <section v-else class="sec-padding of-head" style="background-color:#000;color:#fff;">
            <div class="container">
                <div class="row">   
                    <h4 class="text-center">Oops! You must have an active Care Provider, Family/Parent, or Agency membership to access this page.
                        Please login if you are already have an active membership or sign up if you would like to join!
                    </h4>
                    <span class="text-center mt-4">
                        <router-link class="btn btn-warning mr-2 text-white pl-5 pr-5 pt-2 pb-2" to="/sign-up-chooser" rel="SIGN UP" style="background-color: #e58eb2;border-color: #e58eb2;">SIGN UP</router-link>
                        <router-link class="btn btn-info pl-5 pr-5 pt-2 pb-2" to="/login" rel="login">LOGIN</router-link>
                    </span>
                </div>
            </div>
        </section> -->
        <!----------------- Popup-------------------->
        <div v-if="isLoggedIn" class="container">
        </div>
        <div v-else class="container">          
            <div class="modal animated zoomIn" data-keyboard="false" data-backdrop="static" id="CheckMemberLogin" role="dialog">
                <div class="modal-dialog modal-dialog-centered" style="max-width:650px;">
                    <div class="modal-content">                               
                        <div class="modal-body"> 
                            <div class="row">
                                <div class="col-md-6">
                                    <img :src="'/public/assets/images/pexels-gustavo-fring.jpg'" style="height: 350px;width: 100%;"/>
                                </div>
                                <div class="col-md-6 pt-5">
                                    <h4>Ready to join?</h4>
                                    <p>Become part of our community and browse profiles of nannies, sitters, and families in the Puget Sound region.</p>
                                    <a style="color: #e58eb2;cursor: pointer;" v-on:click="redirectLogin"> Already a member? Click here to login </a>
                                    <button v-on:click="redirectSignUpChooser" class="custom_yellow_btn mt-3 w-100">Yes! Sign me up!</button>
                                    <p class="text-center mt-3" style="font-size: 20px;cursor: pointer;">
                                        <a class="w-100" v-on:click="redirectHomePage">No thanks...</a>
                                    </p>
                                </div>
                            </div>                                    
                        </div>	        
                    </div>
                </div>
            </div>            
        </div>
        <!--------------------------------->
    </main>
</template>
<script>
const axios = require('axios');
import SuggestedMatched from './SuggestedMatched';
export default {
    name: "MemberSearch",
    components: {        
        SuggestedMatched
    },    
    data() {        
        return { 
            notFound:false,
            isLoggedIn: false,
            statusVisible: [],         
            careProviders: [],
            ProvidersBiosDetals:[],
            error:'',
            getProviders:'',
            loader: false,
            resquestConfirm:'',
            PrivateMesageBox:[],
            PrivateMesageBoxStatus:[],
            PrivateMessageSubject:[],
            PrivateMessage:[],            
            SelectMemberType:'care_provider_member',
            keywordSearch:'',
            SelectTypeCare:[],
            links:[],
            SelectLocation:[],
            careProvidersTotal:0,
            resquestSend:[],
            friendRequestLoader:[],
            current_page : 1,
            last_page : '',
            per_page : 20,
            from: 1,
            to: 0,
            offset: 4,
            BeforeMemberCheckCount:0,
            prev_page_url :'',
            next_page_url :'',

            SendFrined_notification:[],
            pageName : 'MemberSearch'
            // pageTitle : 'Community – Members – Nanny Parent Connection',
            // pageMetaDescription : '',
            // pageMetaKeywords : ''
        }
    },   
    methods: {
        redirectLogin(){
            $("#CheckMemberLogin").modal('hide');
            window.location.href = "/login";        
        },
        redirectSignUpChooser(){
            $("#CheckMemberLogin").modal('hide');
            window.location.href = "/sign-up-chooser";        
        },
        redirectHomePage(){
            $("#CheckMemberLogin").modal('hide');
            window.location.href = "/";        
        },                     
        friendRequestSend(careProviderID, index){ 
            this.friendRequestLoader[index] = true,           
            axios.post(`/api/friendRequestSend`, {
                RequestSendTo: careProviderID,
                SenderID: this.id,
            }).then((response) => {
                //console.log(response);                         
                this.resquestSend = response.data.resquestSend;                
                this.loader = false; 
                this.friendRequestLoader[index] = false;
                this.statusVisible[index] = true;
                this.SearchMembers()                                              
                setTimeout(() => this.statusVisible[index] = false, 3000);            
            }).catch(error => {
            })
        },
        showPrivateMessageBox(careProviderID, index){
            //console.log('private message : ',careProviderID);
            this.PrivateMesageBox[index] = true           
        },
        sendPrivateMessage(careProviderID, index){    
            axios.post(`/api/sendPrivateMessage`, {
                PrivateMessageSubject:this.PrivateMessageSubject[index],
                PrivateMessageText: this.PrivateMessage[index],
                SendToMember: careProviderID
            }).then((response) => {
                this.PrivateMesageBoxStatus[index] = true;
                this.PrivateMessageSubject[index]="";
                this.PrivateMessage[index]="";
                setTimeout(() => this.PrivateMesageBoxStatus[index] = false, 3000);
                setTimeout(() => this.PrivateMesageBox[index] = false, 5000);
            }).catch(error => {
            });
        },        
        SearchMembers(){
            this.loader = true;
            this.careProvidersTotal = ''; 
            this.notFound = true; 
            axios.get(`/api/careProviders/list/`, {
                params: {
                    SelectMemberType:this.SelectMemberType,
                    keywordSearch:this.keywordSearch,
                    SelectTypeCare:this.SelectTypeCare,
                    SelectLocation:this.SelectLocation
                }                
            }).then((response) => {  
                // console.log('list : ',response.data.providers.data); 
                //console.log('priv : ',response.data.providers.prev_page_url);             
                this.loader = false;
                this.notFound = false;
                this.getProviders = response.data.getProviders;
                this.careProviders= response.data.providers.data;
                this.links= response.data.providers.links;
                this.ProvidersBiosDetals=response.data.ProvidersBios;
                this.careProvidersTotal = response.data.providers.total;
                this.current_page = response.data.providers.current_page;
                this.from = response.data.providers.from;
                this.last_page = response.data.providers.last_page;
                this.per_page = response.data.providers.per_page;                
                this.error= response.data.error;
                this.BeforeMemberCheckCount= response.data.BeforeMemberCheckCount;                
                this.prev_page_url = response.data.providers.prev_page_url;
                this.next_page_url = response.data.providers.next_page_url;                
            }).catch(error => {
            });            
        },
        onClickPage(link) {            
            this.loader = true;
            this.careProvidersTotal = '';  
            axios.get(`/api/careProviders/list?page=${ link }`, {
                params: {
                    SelectMemberType:this.SelectMemberType,
                    keywordSearch:this.keywordSearch,
                    SelectTypeCare:this.SelectTypeCare,
                    SelectLocation:this.SelectLocation
                }                
            }).then((response) => {
                this.loader = false;
                this.getProviders = response.data.getProviders;
                this.careProviders= response.data.providers.data;
                this.links= response.data.providers.links;
                this.ProvidersBiosDetals=response.data.ProvidersBios;
                this.careProvidersTotal = response.data.providers.total;
                this.current_page = response.data.providers.current_page;
                this.last_page = response.data.providers.last_page;
                this.per_page = response.data.providers.per_page;                
                this.error= response.data.error;
                this.BeforeMemberCheckCount= response.data.BeforeMemberCheckCount;
                this.prev_page_url = response.data.providers.prev_page_url;
                this.next_page_url = response.data.providers.next_page_url; 
            }).catch(error => {
            });
        },
        onClickPrevPage(current_page){
            this.loader = true;
            this.careProvidersTotal = '';
            axios.get(`/api/careProviders/list?page=${ current_page-1 }`, {
                params: {
                    SelectMemberType:this.SelectMemberType,
                    keywordSearch:this.keywordSearch,
                    SelectTypeCare:this.SelectTypeCare,
                    SelectLocation:this.SelectLocation
                }                
            }).then((response) => {
                this.loader = false;
                this.getProviders = response.data.getProviders;
                this.careProviders= response.data.providers.data;
                this.links= response.data.providers.links;
                this.ProvidersBiosDetals=response.data.ProvidersBios;
                this.careProvidersTotal = response.data.providers.total;
                this.current_page = response.data.providers.current_page;
                this.last_page = response.data.providers.last_page;
                this.per_page = response.data.providers.per_page;                
                this.error= response.data.error;
                this.BeforeMemberCheckCount= response.data.BeforeMemberCheckCount;
                this.prev_page_url = response.data.providers.prev_page_url;
                this.next_page_url = response.data.providers.next_page_url; 
            }).catch(error => {
            });
        },
        onClickNextPage(current_page){
            this.loader = true;
            this.careProvidersTotal = '';
            axios.get(`/api/careProviders/list?page=${ current_page+1 }`, {
                params: {
                    SelectMemberType:this.SelectMemberType,
                    keywordSearch:this.keywordSearch,
                    SelectTypeCare:this.SelectTypeCare,
                    SelectLocation:this.SelectLocation
                }                
            }).then((response) => {
                this.loader = false;
                this.getProviders = response.data.getProviders;
                this.careProviders= response.data.providers.data;
                this.links= response.data.providers.links;
                this.ProvidersBiosDetals=response.data.ProvidersBios;
                this.careProvidersTotal = response.data.providers.total;
                this.current_page = response.data.providers.current_page;
                this.last_page = response.data.providers.last_page;
                this.per_page = response.data.providers.per_page;                
                this.error= response.data.error;
                this.BeforeMemberCheckCount= response.data.BeforeMemberCheckCount;
                this.prev_page_url = response.data.providers.prev_page_url;
                this.next_page_url = response.data.providers.next_page_url; 
            }).catch(error => {
            });
        },
        gotoFristPage(from){
            this.loader = true;
            this.careProvidersTotal = '';
            axios.get(`/api/careProviders/list?page=${ from }`, {
                params: {
                    SelectMemberType:this.SelectMemberType,
                    keywordSearch:this.keywordSearch,
                    SelectTypeCare:this.SelectTypeCare,
                    SelectLocation:this.SelectLocation
                }                
            }).then((response) => {
                this.loader = false;
                this.getProviders = response.data.getProviders;
                this.careProviders= response.data.providers.data;
                this.links= response.data.providers.links;
                this.ProvidersBiosDetals=response.data.ProvidersBios;
                this.careProvidersTotal = response.data.providers.total;
                this.current_page = response.data.providers.current_page;
                this.last_page = response.data.providers.last_page;
                this.per_page = response.data.providers.per_page;                
                this.error= response.data.error;
                this.BeforeMemberCheckCount= response.data.BeforeMemberCheckCount;
                this.prev_page_url = response.data.providers.prev_page_url;
                this.next_page_url = response.data.providers.next_page_url; 
            }).catch(error => {
            });
        },
        gotoLastPage(last_page){
            this.loader = true;
            this.careProvidersTotal = '';
            axios.get(`/api/careProviders/list?page=${ last_page }`, {
                params: {
                    SelectMemberType:this.SelectMemberType,
                    keywordSearch:this.keywordSearch,
                    SelectTypeCare:this.SelectTypeCare,
                    SelectLocation:this.SelectLocation
                }                
            }).then((response) => {
                this.loader = false;
                this.getProviders = response.data.getProviders;
                this.careProviders= response.data.providers.data;
                this.links= response.data.providers.links;
                this.ProvidersBiosDetals=response.data.ProvidersBios;
                this.careProvidersTotal = response.data.providers.total;
                this.current_page = response.data.providers.current_page;
                this.last_page = response.data.providers.last_page;
                this.per_page = response.data.providers.per_page;                
                this.error= response.data.error;
                this.BeforeMemberCheckCount= response.data.BeforeMemberCheckCount;
                this.prev_page_url = response.data.providers.prev_page_url;
                this.next_page_url = response.data.providers.next_page_url; 
            }).catch(error => {
            });
        }       
    },
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
        setInterval(function () {
            $('#CheckMemberLogin').modal('show');
            $('#CheckMemberLogin').on('hide.bs.modal', function (e) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            });            
        }, 1000);       
        if (window.Laravel.user) {            
            this.SearchMembers();           
            this.id = window.Laravel.user.id,
            this.role = window.Laravel.user.role,
            this.memberType = window.Laravel.user.memberType,
            this.name = window.Laravel.user.name,
            this.email = window.Laravel.user.email,
            this.username = window.Laravel.user.username,
            this.firstName = window.Laravel.user.firstName,
            this.lastName = window.Laravel.user.lastName,
            this.address1 = window.Laravel.user.address1,
            this.address22 = window.Laravel.user.address2,
            this.address2 = window.Laravel.user.address2,
            this.stateProvince = window.Laravel.user.state,
            this.postalCode = window.Laravel.user.postal_code,
            this.phoneNumber = window.Laravel.user.mobile,
            this.profileImage = window.Laravel.user.profileImage,
            this.ProfileCover = window.Laravel.user.ProfileCover,
            this.facebookURL = window.Laravel.user.facebookURL,
            this.twitterURL = window.Laravel.user.twitterURL,
            this.instagramURL = window.Laravel.user.instagramURL,
            this.linkedinURL = window.Laravel.user.linkedinURL         
        }
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
        
    }
    // beforeRouteEnter(to, from, next) {
    //     if (!window.Laravel.isLoggedin) {
    //         window.location.href = "/member-search";
    //     }
    //  next();
    // }     
}
</script>
<style scoped>
.pagination{
    float: right;
}
.pagination-item button {
    border: 1px solid #333;
    padding-left: 5px;
    padding-right: 5px;
    margin-left: 5px;
}
.pagination-item .active {
  color: #fff;
  background-color: rgb(229, 142, 178);
  border: 1px solid rgb(229, 142, 178);
}

#link_0 {
    display: none;
}

</style>



