<template>
    <main>            
        <div class="owl-carousel owl-theme listing-crsl">                        
            <div v-for="(matches, index) in SuggestedMatches" :key="SuggestedMatches.id" :index="index" class="list-item" style="display:block;padding:10px;height:100%;">
                <router-link :to="{name: 'members-about', 
                    params: { 
                        username: matches.MembersInfo.username
                    } 
                }" style="text-decoration:none;">                                
                    <img v-if="matches.MembersInfo.profileImage" :src="'/public/uploads/profileImage/'+matches.MembersInfo.profileImage"/>
                    <img v-else src="https://cdn.pixabay.com/photo/2015/03/04/22/35/avatar-659652__340.png"/>
                </router-link>
                <p class="mt-2 mb-0">
                    <router-link :to="{name: 'members-about', 
                        params: { 
                            username: matches.MembersInfo.username
                        }
                        }" style="text-decoration:none;">
                        {{matches.MembersInfo.name}}
                    </router-link>
                </p>
                <p class="mt-0 mb-0">@{{matches.MembersInfo.username}}</p>                               
                <p class="mt-0 mb-0" v-if="matches.minRange !==''"><b style="font-size: 13px;">Desired Pay Range:</b> ${{matches.minRange}}-${{matches.maxRange}}/hr </p>
                <p class="mt-0 mb-0" v-else><b style="font-size: 13px;">Desired Pay Range:</b> $00-$00/hr </p>
                <p class="mt-0 mb-0"><b style="font-size: 13px;">Experience Level:</b> {{matches.providerExperience}} </p>
                <p class="mt-0 mb-0"><b style="font-size: 13px;">Location:</b> {{CareOpportunitiesLocation[index]}} </p>
            </div>                      
        </div>  
    </main>
</template>
    
<script>
    import 'owl.carousel2/dist/owl.carousel'; 
    export default {
        name:'SuggestedMatched',
        data() {
            return { 
                loader: true,          
                SuggestedMatchesCount:'',
                SuggestedMatches:[],
                CareOpportunitiesLocation:[]
            }
        },
        methods: {
            getSuggstedMatch(){
                axios.get(`/api/MemberTypeDetail`).then((response) => { 
                    this.loader = false;                              
                    this.SuggestedMatchesCount = response.data.careProvidersTotal;
                    this.SuggestedMatches= response.data.SuggestedProviders;  
                    this.CareOpportunitiesLocation = response.data.CareOpportunitiesArray;             
                }).catch((err) => console.error(err));
            }
        }
        ,
        async created() {
            window.scrollTo(0,0);            
            this.getSuggstedMatch();
        } ,
        updated(){            
            ItemsCarousel()
        },
        beforeUnmount() {
			$('.owl-carousel').owlCarousel('destroy');
		},
                 
    }
    function ItemsCarousel()
    {        
        var owl = $('.owl-carousel');
              owl.owlCarousel({
                loop: true,
                nav: false,
                dots: true,
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
                margin: 10,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 3,
					      nav: false,
                  },
                  960: {
                    items: 4
                  },
                  1200: {
                    items: 4
                  }
                }
              });
              owl.on('mousewheel', '.owl-stage', function(e) {
                if (e.deltaY > 0) {
                  owl.trigger('next.owl');
                } else {
                  owl.trigger('prev.owl');
                }
                e.preventDefault();
              });
      
    }        
</script>
    