<template>
    <div class="modal zoomIn" v-if="popupShow" id="CheckMemberLogin" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">                                             
                <div class="modal-body"> 
                    <p v-on:click="hideModel" class="text-right mb-0 text-danger" style="font-size: 18px;font-weight: bold;cursor: pointer;">
                        <span aria-hidden="true">×</span>
                    </p>
                    <p class="text-center"> 
                        Dec 2021: Updated WA State/City of Seattle minimum wage law information. 
                        Updated IRS mileage reimbursement rate. Updated COVID-19 Safety section
                    </p>  
                    <p class="text-center">
                        Jan 2021: Updated WA State/City of Seattle minimum wage law information. 
                        Updated IRS mileage reimbursement rate
                    </p>  
                    <p class="text-center">
                        Jul 2020: Added gender inclusive pronouns to all contracts
                    </p> 
                    <p class="text-center">
                        Jul 2020: Added a "COVID-19 Safety" section to all contracts
                    </p>
                    <p class="text-center">
                        Dec 2019: Added additional language on utilizing WA State Paid Family and Medical Leave
                    </p>                                                  
                </div>	        
            </div>
        </div>
    </div> 
</template>

<script>

    export default {
        name:'nanny-share-contract-model',
        data: () => {
            return {
                popupShow :true,
            }
        },
        methods: {            
            hideModel(){                
                $("#CheckMemberLogin").modal('hide'); 
                this.popupShow = false;     
            },            
        },    
        created() { 
            setInterval(function () { 
				$("#CheckMemberLogin").modal('show');                 
			}, 5000);                             
        }
    }
</script>