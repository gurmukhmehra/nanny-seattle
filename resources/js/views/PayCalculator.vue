<template>
    <main>
        <section class="of-head" style="background-color: #e58eb2;padding: 20px 0px 20px 0px;">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                    <h6 class="text-white" style="text-align: center; font-size: 22px;">
                        Over 5,000 parents and nannies are active daily in our community!
                    </h6>
                </div>
            </div>
        </section>
        <section class="sec-padding of-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6">
                        <h1 class="sec-heading text-center">Pay Calculator</h1>
                        <p>Parents – tired of figuring out withholding taxes for your nanny, babysitter or tutor by hand? Use our Pay Calculator to determine how much to pay your care provider, how much to withhold, and what you owe in employer taxes.</p>
                        <p>Care Providers – want to confirm or estimate your paycheck? Simply fill out the below fields below and then check out the summary.</p>
                        <p>The calculator also works great for paying nanny share and “learning pod” providers as you can input hourly pay and hours worked for up to five children.</p>
                        <p>Need help using the Pay Calculator? Email us <a href="mailto:support@nannyparentconnection.com">by clicking here.</a></p>
                    </div>
                    <div class="col-md-6 col-xs-12 col-sm-12 col-lg-6"><img src="/public/assets/images/Mom-using-Pay-Calculator-scaled.JPG" class="img-style"></div>
                </div>
            </div>
        </section>
        <section class="sec-padding" style="padding-top: 0 !important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <h6 class="text-blue">The below is a preview of our Pay Calculator. In order to access all of the Pay Calculator features, please <router-link to="/login">LOGIN</router-link> if you are a member or <router-link to="/sign-up-chooser">SIGN UP</router-link> if you don't have an active membership.</h6>
                        <div class="nf-form-layout twoColumnForm">
                            <!----------- Step 1 ------------>
                            <div class="step step1 activeStep">
                                <div class="nf-form-fields mt-5">Note: All fields marked with <sup class="text-danger">*</sup> are required. </div>
                                <h2 class="mt-2 mb-4">Page 1 of 2</h2>
                                <div class="nf-mp-body">
                                    <div class="field-wrap form-group">	
                                        <label>Household Employer Name <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label>Household Employer Address </label>
                                        <input type="text" value="" class="forms-field">                                        
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label>Household Employer EIN #</label>
                                        <input type="email" value="" placeholder="Enter E-mail Address.." class="forms-field">
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label>Care Provider Name  <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="tel" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Paycheck Date <sup class="text-danger" style="font-size: 15px;">*</sup> <span class="dformat">(mm/dd/yyyy)</span></label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                    </div>
                                    <div class="field-wrap hidden">&nbsp;</div>
                                    <div class="section_breaks">
                                        <label><strong>PAYROLL SUMMARY</strong></label>
                                    </div>                                    
                                    <div class="field-wrap form-group">	
                                        <label>How many children did this provider care for during the payroll period? <sup class="text-danger" style="font-size: 15px;">*</sup></label>
                                        <select>
                                            <option class="depItem" value="1">1</option>
                                            <option class="depItem" value="2">2</option>
                                            <option class="depItem" value="3">3</option>
                                            <option class="depItem" value="4">4</option>
                                            <option class="depItem" value="5">5</option>
                                        </select>
                                    </div>                                    
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Child Name #1 <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                    </div>                                    
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Child #1 - Hourly Rate <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                    </div>
                                
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Child #1 - Hours Worked this Pay Period <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                    </div>                            
                                    
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Are you reimbursing your care provider for mileage? <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <select required>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Mileage is not generally considered taxable income. Check http://www.IRS.gov for more information.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">TOTAL GROSS PAY </label>
                                        <input type="text" value="" class="forms-field" readonly>
                                        <div class="text-danger error-message"></div>
                                    </div>
                                    <div class="field-wrap hidden">&nbsp;</div>
                                    <div class="section_breaks">
                                        <label><strong>EMPLOYEE WITHHOLDING TAXES</strong></label>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Filing Status <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <select required>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Married, but withhold at higher Single rate">Married, but withhold at higher Single rate</option>
                                        </select>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Found in Step 1(c) of the care provider's W-4 form.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Income Tax Withholding $</label>
                                        <input type="text" value="" class="forms-field">
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Use the IRS Income Tax Withholding Assistant found at https://www.irs.gov/businesses/small-businesses-self-employed/income-tax-withholding-assistant-for-employers to calculate withholding.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Additional Amount Withheld $</label>
                                        <input type="text" value="" class="forms-field">
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Found in Step 4(c) of the care provider's W-4 form.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Medicare Withholding Rate % <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Current rate for 2022 is 1.45%. Check http://www.IRS.gov for most current rate.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Social Security Withholding Rate % <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Current rate for 2022 is 6.2%. Check http://www.IRS.gov for most current rate.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Washington State Paid Family and Medical Leave Withholding % <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Employers with fewer than 50 employees are not required to pay the employer portion of the premium but must withhold the employee's premium beginning January 1, 2019. The employee's premium for 2022 is 0.6% of gross pay. The employer can choose to pay this premium on behalf of the employee at their discretion. Check https://paidleave.wa.gov for more information.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Has your provider opted out of the Washington Cares Fund payroll tax? <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <select required>
                                            <option value="Yes">Yes</option>
                                            <option selected="" value="No">No</option>
                                        </select>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">If your provider has provided you with an exemption approval letter from the Employment Security Department or if this is not applicable, select Yes. Otherwise, select No. The provider is responsible for this payroll tax, not the employer. More info here: https://wacaresfund.wa.gov/</span>
                                    </div>
                                    <div class="field-wrap hidden">&nbsp;</div>
                                    <div class="section_breaks">
                                        <label><strong>EMPLOYER TAXES AND CONTRIBUTIONS</strong></label>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Federal Unemployment (FUTA) % <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Enter the applicable FUTA tax rate. For 2022, the FUTA tax rate is 6.0%. The tax applies to the first $7,000 you pay to each employee as wages during the year. The $7,000 is the federal wage base. Your state wage base may be different. Generally, you can take a credit against your FUTA tax for amounts you paid into state unemployment funds. The credit may be as much as 5.4% of FUTA taxable wages. If you’re entitled to the maximum 5.4% credit, the FUTA tax rate after credit is 0.6%. You’re entitled to the maximum credit if you paid your state unemployment taxes in full, on time, and on all the same wages as are subject to FUTA tax, and as long as the state isn't determined to be a credit reduction state. See the Instructions for IRS Form 940 to determine the credit.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">State Unemployment % <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Enter the applicable State Unemployment rate reported to you by your state. Traditionally, you receive a rate notice when you register for State Unemployment Insurance.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Medicare Withholding Rate % <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Current rate for 2022 is 1.45% for employers. Check http://www.IRS.gov for most current rate.</span>
                                    </div>
                                    <div class="field-wrap form-group">	
                                        <label for="fieldname4_1_date">Social Security Withholding Rate % <sup class="text-danger" style="font-size: 15px;">*</sup> </label>
                                        <input type="text" value="" class="forms-field" required>
                                        <div class="text-danger error-message"></div>
                                        <span class="uh">Current rate for 2022 is 6.2% for employers. Check http://www.IRS.gov for most current rate.</span>
                                    </div>
                                    <div class="field-submit" style="text-align: right;">
                                        <button class="custom_yellow_btn next action-button" data-step-index="2" v-on:click="buttonHandle">Next</button>
                                    </div>
                                </div>
                            </div>
                            <!----------- Step 1 ------------>
                            <!----------- Step 2 ------------>
                            <div class="step step2">
                                <h2 class="mt-2 mb-4">Page 2 of 2</h2>
                                <div class="row">
                                    <div class="field-wrap col-md-6">	
                                        <label for="fieldname4_1_date">TOTAL GROSS PAY</label>
                                        <input type="text" value="" class="forms-field" readonly>
                                        <span class="uh">Including mileage reimbursement (if any).</span>
                                    </div>

                                    <div class="field-wrap col-md-6">	
                                        <label for="fieldname4_1_date">TOTAL FEDERAL TAXES TO WITHHOLD</label>
                                        <input type="text" value="" class="forms-field" readonly>
                                        <span class="uh">Includes income, Medicare, and Social Security withholdings. Does not include mileage reimbursement as generally not taxable.</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="field-wrap col-md-6">	
                                        <label for="fieldname4_1_date">TOTAL PAID FAMILY & MEDICAL LEAVE PREMIUM TO WITHHOLD</label>
                                        <input type="text" value="" class="forms-field" readonly>
                                        <span class="uh">Check https://paidleave.wa.gov for more information on how to report and pay premiums.</span>
                                    </div>
                                    <div class="field-wrap col-md-6">	
                                        <label for="fieldname4_1_date">TOTAL WASHINGTON CARES FUND TAX TO WITHHOLD</label>
                                        <input type="text" value="" class="forms-field" readonly>
                                        <span class="uh">Check https://esd.wa.gov/ for more information on how to report and pay this tax.</span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="field-wrap col-md-6">	
                                        <label for="fieldname4_1_date">TOTAL NET PAY</label>
                                        <input type="text" value="" class="forms-field" readonly>
                                        <span class="uh">Pay your employee this amount for this pay period. Includes mileage reimbursement (if any).</span>
                                    </div>
                                    <div class="field-wrap col-md-6">	
                                        <label for="fieldname4_1_date">TOTAL EMPLOYER TAXES & CONTRIBUTIONS</label>
                                        <input type="text" value="" class="forms-field" readonly>                                        
                                    </div>
                                </div>

                                <div class="form-group  mt-3"> 
                                    <button class="custom_yellow_btn mr-3 prew action-button" data-step-index="1" v-on:click="buttonHandle">Prew</button>
                                    <button class="custom_yellow_btn"  v-on:click="buttonHandle">Submit</button>   
                                </div> 
                            </div>
                            <!----------- Step 2 ------------>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
    export default {
        name:'pay-calculator',
        data() {
            return {
                pageName : 'PayCalculator'
                // pageTitle : 'Nanny Pay Calculator | Nanny Parent Connection',
                // pageMetaDescription : '',
                // pageMetaKeywords : ''
            }
        },
        methods: {
            async buttonHandle(e) {
                const el = e.target;
                let stepIsValid = true
                const requiredFields = el.closest('.step').querySelectorAll('[required]')
                await requiredFields.forEach(field => {
                    const errorMessage = field.closest('.form-group').querySelector(`.error-message`)
                    if(field.validationMessage != "") stepIsValid = false
                    if(errorMessage) errorMessage.innerText = field.validationMessage
                });

                if(stepIsValid) {
                    document.querySelector('.activeStep').classList.remove('activeStep')
                    document.querySelector('.step' + el.dataset.stepIndex).classList.add('activeStep')
                }
            }
        },
        mounted(){
            axios.get(`/api/get-seo-page`).then((response) => {
				var getData = response.data.page_seo_data.find((employee) => employee.page_Name == this.pageName);					
				document.title = getData.seo_Title;
				document.getElementsByTagName('meta')["description"].content = ""+getData.meta_description+"";
				document.getElementsByTagName('meta')["keywords"].content = ""+getData.meta_tags+"";					
			}).catch((err) => console.error(err));	
            // document.title = this.pageTitle;
            // document.getElementsByTagName('meta')["description"].content = ""+this.pageMetaDescription+"";
            // document.getElementsByTagName('meta')["keywords"].content = ""+this.pageMetaKeywords+"";	
        },
        created() { 
            window.scrollTo(0,0);
        }		
    }
</script>
<style>
    .step {
        display: none;
    }
    .activeStep {
        display: block;
    }
</style>