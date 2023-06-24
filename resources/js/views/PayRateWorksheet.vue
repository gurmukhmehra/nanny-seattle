<template>
    <main>
        <section class="sec-padding of-head">
<div class="container">
	<div class="row">
		<div class="col-md-12 col-lg-12">
			<h4 class="text-left">How Much Should I Pay My Nanny or Sitter?</h4>
			<P>Instructions: Our Pay Rate Worksheet allows you to easily determine what pay rate you should target paying for childcare based on your answers to several questions. As you fill out the worksheet, our system will compare your answers to the results of our most recent Pay Rate Survey and other information to provide you with a pay rate range you should consider.</P>
			<p>You will find the results at the bottom of this worksheet.</p>
			<p>Note: Nanny Parent Connection does not establish pay rates for care providers in our community. Some providers charge more or less than the industry average. Nanny Parent Connection does not guarantee that you will find a care provider who is willing to work with your family within the pay rate range suggested by this worksheet.</p>
		</div>
		<div class="col-md-12 col-lg-12">
			<form>
				<p>All fields marked with an * are required.</p>
				 <div class="col-sm-10">
				 	<label class="heading_info">What type of child care you are looking for?<span class="text-danger">*</span></label>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
				        <label class="form-check-label" for="gridRadios1">
				         Full Time (more than 35 hours/week)
				        </label>
				      </div>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">
				          Part Time (less than 35 hours/week)
				        </label>
				      </div>
				      <div class="form-check disabled">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
				        <label class="form-check-label" for="gridRadios3">
				          Temporary/Last Minute
				        </label>
				      </div>
				   </div>
				   <div class="col-sm-10">
				 	<label class="heading_info">How long do you expect this care provider to work with your family?<span class="text-danger">*</span></label>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
				        <label class="form-check-label" for="gridRadios1">
				         Long Term (more than a year)
				        </label>
				      </div>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">
				         Short Term (less than a year)
				        </label>
				      </div>
				   </div>
				   <div class="col-sm-10">
				 	<label class="heading_info">How many children need care?<span class="text-danger">*</span></label>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
				        <label class="form-check-label" for="gridRadios1">1</label>
				      </div>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">2</label>
				      </div>
				        <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">3</label>
				      </div>
				       <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">4</label>
				      </div>
				   </div>
				    <div class="col-sm-10">
				 	<label class="heading_info">Do you require a provider with five years or more of experience?<span class="text-danger">*</span></label>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
				        <label class="form-check-label" for="gridRadios1">Yes</label>
				      </div>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">No</label>
				      </div>
				   </div>
				   <div class="col-sm-10">
				 	<label class="heading_info">Do you expect your provider to complete normal child care duties such as washing bottles, daily tidying, children's meal prep and children's laundry?<span class="text-danger">*</span></label>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
				        <label class="form-check-label" for="gridRadios1">Yes</label>
				      </div>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">No, I need help with additional duties</label>
				        <div class="clearer">
				        	<span class="uh">If you expect your care provider to complete additional household duties such as family laundry, grocery shopping, running errands, walking the dog, family meal prep, etc., please select No.</span>
				    	</div>
				      </div>
				   </div>
				   <div class="col-sm-10">
				 	<label class="heading_info">Will the child care occur in a major metropolitan city?<span class="text-danger">*</span></label>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
				        <label class="form-check-label" for="gridRadios1">Yes</label>
				      </div>
				      <div class="form-check">
				        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
				        <label class="form-check-label" for="gridRadios2">No</label>
				      </div>
				   </div>
				   <div class="col-sm-10">
				   		<label for="fieldname1_1" class="form-label heading_info">Based on your responses and current pay rate information, we would suggest offering a pay rate range of:</label>
				   		<input id="fieldname1_1" name="fieldname1_1" readonly="" class="codepeople form-control" type="text"  aria-invalid="false">
				   		<div class="clearer">
				   			<span class="uh">If you have any questions about this result, please email us at info@nannyparentconnection.com.</span>
				   		</div>
				   </div>
				   						
			</form>
		</div>
	</div>
</div>
</section>

    </main>
</template>
<script>
    export default {
        name:'pay-rate-worksheet',
        data() {
            return {
				pageTitle : 'Pay Rate Worksheet - Nanny Parent Connection',
                pageMetaDescription : '',
                pageMetaKeywords : ''
			}
        },
        methods:{},
		mounted(){	
			document.title = this.pageTitle;
			document.getElementsByTagName('meta')["description"].content = ""+this.pageMetaDescription+"";
			document.getElementsByTagName('meta')["keywords"].content = ""+this.pageMetaKeywords+"";	
		},
        created() {
            window.scrollTo(0,0); 
        }
    }
</script>