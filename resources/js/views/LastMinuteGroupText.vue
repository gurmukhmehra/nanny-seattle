<template>
    <main>
        <section class="sec-padding of-head">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-lg-7">
                        <h2 class="text-center" style="font-size: 24px;line-height: 1.4em;letter-spacing: 0.3px;">Little one home sick? Daycare closed today? Need child care NOW?</h2>
                        <h3 class="text-center" style="font-size:18px;line-height:1.4em;letter-spacing:0.3px;font-weight: 600;">Find a last minute nanny or babysitter instantly using our Last Minute Childcare Service.</h3>
                        <p class="text-center" style="text-decoration: underline;">FOR PARENTS/AGENCY REPS</p>
                        <p>If you need last minute childcare now, later today, or in the next couple of days, <strong><a title="simply fill out the form below" href="/last-minute-group-text#requestlastminutechildcare">simply fill out the form below</a></strong>. Within a few minutes, the details of your child care need will be sent via text message to all subscribed care providers. Interested care providers can fill your child care need by sending you a text message or by calling you directly.</p>
                        <p>Make sure you check out <a title="some great tips on using our Last Minute Care Text Service" href="https://blog.nannyparentconnection.com/verified-vs-last-minute-care/">this article for some great tips on using our Last Minute Childcare Service!</a></p>
                        <p class="text-center" style="text-decoration: underline;">FOR CARE PROVIDERS</p>
                        <p>Enter your name and mobile number on the <strong><a title="form below and click Subscribe" href="/last-minute-group-text#requestlastminutechildcare">form below and click Subscribe</a></strong>. When a parent has a last minute childcare need, we will send the details of the opportunity to you via text message along with the parent’s phone number. You can then text or call them if you would like to offer your services.</p>
                        <p class="text-left">Questions? Email us at <a title="Mail Us On" href="mailto:info@nannyparentconnection.com">info@nannyparentconnection.com</a> or call/text <a title="Call Us On" href="tel:(425) 243-7032">(425) 243-7032.</a></p>
                    </div>
                    <div class="col-md-5 col-lg-5"><img src="/public/assets/images/headech.JPG" class="img-style"></div>
                    <p class="text-center">Note: Due to the costs associated with this service, only members may access this system.</p>
                </div>
            </div>
        </section>
        
        <div class="container">
            <div class="row text-center">                    
                <div class="col-md-3"></div>
                    <div class="col-md-6">                            
                        <span class="text-center"><i class="fa fa-heart" style="font-size:80px;color:#e58eb2;" aria-hidden="true"></i></span>
                        <h3 style="color:#000;">CARE PROVIDERS</h3>
                        <p style="text-align: center; font-size: 18px; margin-bottom: 0px;"><strong >Sign up below to begin receiving test message alerts:</strong></p>
                    </div>                        
                <div class="col-md-3"></div>               
                                                    
            </div>
            <div class="row mt-4" v-if="isLoggedIn && memberType === 'care_provider_member'">                
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h3 class="text-center">Please subscribe for SMS updates</h3>
                        <div class="form-group mt-3">
                            <label for="names" class="font-weight-bold">Enter your name:</label>
                            <input type="text" class="form-control" v-model="subscriberName" placeholder="" id="names">
                        </div>
                        <div class="form-group">
                            <label for="names" class="font-weight-bold">Enter your mobile number:</label>
                            <input type="text" class="form-control" v-model="subscriberMobileNumber" placeholder="" id="names">
                        </div>
                        <button type="submit" v-on:click="subscribeSave" class="btn btn-pink w-100">
                            <span v-if="subscribeloader" class="spinner-border spinner-border-sm" role="status"></span> Submit
                        </button>
                        <div class="form-group">
                            <ul>
                                <div v-for="(errorArray, idx) in error_inputs" :key="idx">
                                    <div v-for="(allErrors, idx) in errorArray" :key="idx">
                                        <li><span class="text-danger">{{ allErrors}} </span></li>
                                    </div>
                                </div>
                            </ul> 
                            <p class="text-success">{{ subscriberSuccessMsg }}</p>                   
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                    <p class="mt-4 text-center">Once successfully subscribed, you will receive a confirmation text message. To unsubscribe from the system, send a text message with the word <i>leave to 1 (206) 207-8404. Carrier message and data rates may apply.</i></p>
                    <p class="text-center">To temporarily mute messages sent by this system, <a title="click here if you use an Iphone" href="https://www.imore.com/how-mute-block-and-report-imessage-spam-iphone-and-ipad#muteconvo" target="_blank">click here if you use an Iphone</a> or <a title="here if you use an Android device" href="https://www.wikihow.com/Mute-a-Group-Text-on-Android" target="_blank">here if you use an Android device</a>.<strong></strong></p>
            </div>
            <div class="row text-center" v-else>
                <h6 style="text-align: center; border-radius: 14px; border-color: rgba(229, 142, 167, 0.83); padding: 0.4em; line-height: 1.4em;margin-top: 10px;">
                    <strong><span style="color: #999999;">Subscribing to receive text messages is only available to Care Provider members. If you are a member,</span> 
                        <router-link to="/login" title="log in here">log in here</router-link>. 
                        <span style="color: #ff0000;">
                            <span style="color: #999999;">Don’t have a membership yet? It’s FREE!</span> 
                            <router-link to="/sign-care-provider" title="Sign up here">Sign up here!</router-link>
                        </span>
                    </strong>
                </h6>
            </div>                
        </div>

        <div class="container">            
            <div class="row text-center mt-5"> 
                <p><i class="fa fa-users" style="font-size:80px;color:#e58eb2;" aria-hidden="true"></i></p>
                <h3>PARENTS/AGENCY REPS</h3>
                <strong>Request last minute childcare help below!</strong>
                <p class="mt-3">This system is active from 6:00am to 11:00pm each day. If you request last minute childcare after 11:00pm or before 6:00am, the request will be sent at 6:00am.</p>
                <p>Before you submit your request, a quick word about pay rates for last minute child care:</p>
                Most nannies will charge a higher hourly rate for last minute care or care for a sick child. Helping a family out with child care on short notice might mean the care provider has to cancel or reschedule plans for the day. Caring for a sick child carries the risk that the care provider may become sick themselves and potentially miss out on working at their regular job. Nannies have shared that the pay needs to be worth this additional risk for anything beyond a minor cold.
                <p>We strongly encourage you to use our Pay Rate Worksheet in order to determine a suitable pay rate range before submitting your Last Minute Care Request.</p>
                <p class="mt-4"><router-link to="/pay-rate-worksheet" class="custom_yellow_btn">Use Pay Rate Worksheet</router-link></p>
            </div>
        </div>
        
        <!-- <section class="sec-padding bio-sec">
            <div class="container">
                <div class="row">
					<div class="col-md-12 col-lg-12">
						<h2 class="sec-heading text-center">The Difference</h2>
						<p style="text-align:center; color: #ffffff;">There are many background check options available to you. This is what separates us from the rest.</p>
					</div>
				 </div>
                <div class="row" style="margin-top: 20px;">
					<div class="col-md-6 col-lg-6">
						<div class="diff-text">
							<span class="text-center"><i class="fa fa-heart" style="font-size:80px;color:#fff;" aria-hidden="true"></i></span>
							<div class="bio-text">
								<h3>CARE PROVIDERS</h3>
								<strong>Sign up below to begin receiving test message alerts:</strong>
								<p>Subscribing to receive text messages is only available to Care Provider members. If you are a member, <router-link to="/login" title="log in here">log in here</router-link>. Don’t have a membership yet? It’s FREE! <router-link to="/sign-care-provider" title="Sign up here">Sign up here!</router-link></p>
							</div>							
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="diff-text">
							<i class="fa fa-users" style="font-size:80px;color:#fff;" aria-hidden="true"></i>
							<div class="bio-text">
								<h3>PARENTS/AGENCY REPS</h3>
								<strong>Request last minute childcare help below!</strong>
								<p>This system is active from 6:00am to 11:00pm each day. If you request last minute childcare after 11:00pm or before 6:00am, the request will be sent at 6:00am.</p>
                                <p>Before you submit your request, a quick word about pay rates for last minute child care:</p>
								<p>Most nannies will charge a higher hourly rate for last minute care or care for a sick child. Helping a family out with child care on short notice might mean the care provider has to cancel or reschedule plans for the day. Caring for a sick child carries the risk that the care provider may become sick themselves and potentially miss out on working at their regular job. Nannies have shared that the pay needs to be worth this additional risk for anything beyond a minor cold.</p>
                                <p>For last minute childcare requests for one child, plan to offer a rate in the $20 to $25/hour range. For two children, I suggest offering $25 to $30/hour. If the child (or children) is sick, the likelihood the request will be fulfilled will increase if the rate is on the higher end.</p>
							</div>
						</div>
					</div>
				 </div>                 
            </div>
        </section> -->

        <section class="sec-padding palette-primary">
            <div class="container w-100">
                <div class="row" id="requestlastminutechildcare">
                    <div class="col-md-12 col-lg-12">                       
                                <div class="nf-before-form-content">
                                    <div class="nf-form-fields-required">Fields marked with an <span class="ninja-forms-req-symbol">*</span> are required</div>
                                </div>                               
                                <div class="nf-mp-body">                                    
                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-156_2-container" class="nf-field-container listselect-container  label-above desc-none  list-container">
                                                <div class="nf-field">
                                                    <div id="nf-field-156_2-wrap" class="field-wrap listselect-wrap list-wrap list-select-wrap" data-field-id="156_2">
                                                        <div class="nf-field-label"><label for="nf-field-156_2" id="nf-label-field-156_2" class="">When do you need child care? <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <select id="nf-field-156_2" v-model="YouNeedChildCare" aria-invalid="false" aria-describedby="nf-error-156_2" class="ninja-forms-field nf-element" aria-labelledby="nf-label-field-156_2" required="">
                                                                <option value="I need care now!" selected="selected">I need care now!</option>
                                                                <option value="I need care later today">I need care later today</option>
                                                                <option value="I need care tomorrow">I need care tomorrow</option>
                                                                <option value="I need care the day after tomorrow">I need care the day after tomorrow</option>
                                                                <option value="I need care in the coming days (please specify the day in Additional Information below)">I need care in the coming days (please specify the day in Additional Information below)</option>
                                                            </select>                                                            
                                                        </div>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-157_2-container" class="nf-field-container number-container  label-above desc-none ">
                                                <div class="nf-field">
                                                    <div id="nf-field-157_2-wrap" class="field-wrap number-wrap" data-field-id="157_2">
                                                        <div class="nf-field-label">
                                                            <label for="nf-field-157_2" id="nf-label-field-157_2" class="">For how many children? <span class="ninja-forms-req-symbol">*</span> </label>
                                                        </div>
                                                        <div class="nf-field-element">
                                                            <input type="number" min="1" class="form-control" v-model="HowManyChildren" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-158_2-container" class="nf-field-container textbox-container  label-above desc-none ">
                                                <div class="nf-field">
                                                    <div id="nf-field-158_2-wrap" class="field-wrap textbox-wrap" data-field-id="158_2">
                                                        <div class="nf-field-label">
                                                            <label for="nf-field-158_2" id="nf-label-field-158_2" class="">What age(s) are the child or children that need care? <span class="ninja-forms-req-symbol">*</span> </label>
                                                        </div>
                                                        <div class="nf-field-element">
                                                            <input type="text" v-model="AgeChildNeedCare" class="ninja-forms-field nf-element" id="nf-field-158_2" aria-invalid="false" aria-describedby="nf-error-158_2" aria-labelledby="nf-label-field-158_2" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <nf-cells>
                                            <div class="nf-cell" style="width: 100%;">        
                                                <div id="nf-field-159_2-container" class="nf-field-container listcheckbox-container  label-above desc-none  list-container">
                                                    <div class="nf-field">
                                                        <div id="nf-field-159_2-wrap" class="field-wrap listcheckbox-wrap list-wrap list-checkbox-wrap nf-pass" data-field-id="159_2">
                                                            <div class="nf-field-label">
                                                                <label for="nf-field-158_2" id="nf-label-field-158_2" class="">Is the child or children that need care currently sick? <span class="ninja-forms-req-symbol">*</span> </label>
                                                            </div>                                                            		
                                                            <div class="nf-field-element">
                                                                <ul aria-describedby="nf-error-159_2">     
                                                                    <li>
                                                                        <input type="radio" id="nf-field-159_2-0" v-model="NeedCareSick" class="ninja-forms-field nf-element" value="Yes" required="">
                                                                        <label for="nf-field-159_2-0" class="ml-2">Yes</label>
                                                                    </li>    
                                                                    <li>
                                                                        <input type="radio" id="nf-field-159_2-1" v-model="NeedCareSick" class="ninja-forms-field nf-element" value="No" required="">
                                                                        <label for="nf-field-159_2-1" class="ml-2">No</label>
                                                                    </li>
                                                                </ul>
                                                                <small class="text-danger">{{ NeedCareSick_error }} </small>
                                                            </div>	
                                                        </div>
                                                    </div>        
                                                </div>
                                            </div>    
                                        </nf-cells>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-160_2-container" class="nf-field-container textbox-container  label-above desc-after_everything ">
                                                <div class="nf-field">
                                                    <div id="nf-field-160_2-wrap" class="field-wrap textbox-wrap" data-field-id="160_2">
                                                        <div class="nf-field-label"><label for="nf-field-160_2" id="nf-label-field-160_2" class="">What neighborhood do you live in? <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <input type="text" v-model="NeighborHoodYouLive" class="ninja-forms-field nf-element" id="nf-field-160_2" aria-invalid="false" aria-describedby="nf-error-160_2" aria-labelledby="nf-label-field-160_2" required="">
                                                            <small class="text-danger">{{ NeighborHoodYouLive_error }} </small>
                                                        </div>
                                                        <div class="nf-field-description">Example: Shoreline, West Seattle, Burien, near Magnuson Park, etc.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-161_2-container" class="nf-field-container textbox-container  label-above desc-after_everything ">
                                                <div class="nf-field">
                                                    <div id="nf-field-161_2-wrap" class="field-wrap textbox-wrap" data-field-id="161_2">
                                                        <div class="nf-field-label"><label for="nf-field-161_2" id="nf-label-field-161_2" class="">Desired start time? <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <input type="text" v-model="DesiredStartTime" class="ninja-forms-field nf-element" id="nf-field-161_2" aria-invalid="false" aria-describedby="nf-error-161_2" aria-labelledby="nf-label-field-161_2" required="">
                                                            <small class="text-danger">{{ DesiredStartTime_error }} </small>
                                                        </div>
                                                        <div class="nf-field-description">Example: ASAP, 9:00am, around 11am</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-162_2-container" class="nf-field-container textbox-container  label-above desc-none ">
                                                <div class="nf-field">
                                                    <div id="nf-field-162_2-wrap" class="field-wrap textbox-wrap" data-field-id="162_2">
                                                        <div class="nf-field-label"><label for="nf-field-162_2" id="nf-label-field-162_2" class="">Desired end time? <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <input type="text" v-model="DesiredEndTime" class="ninja-forms-field nf-element" id="nf-field-162_2" aria-invalid="false" aria-describedby="nf-error-162_2" aria-labelledby="nf-label-field-162_2" required="">
                                                            <small class="text-danger">{{ DesiredEndTime_error }} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-row">
                                            <div class="nf-cell" style="width: 100%;">
                                                <div id="nf-field-163_2-container" class="nf-field-container textbox-container  label-above desc-after_everything ">
                                                    <div class="nf-field">
                                                        <div id="nf-field-163_2-wrap" class="field-wrap textbox-wrap" data-field-id="163_2">
                                                            <div class="nf-field-label"><label for="nf-field-163_2" id="nf-label-field-163_2" class="">Pay rate?  </label></div>
                                                            <div class="nf-field-element">
                                                                <input type="text" v-model="PayRate" class="ninja-forms-field nf-element" id="nf-field-163_2" aria-invalid="false" aria-describedby="nf-error-163_2" aria-labelledby="nf-label-field-163_2">
                                                                <small class="text-danger">{{ PayRate_error }} </small>
                                                            </div>
                                                            <div class="nf-field-description">Example: $20/hour, $20 to $22/hour, Pay depending on experience</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-164_2-container" class="nf-field-container textarea-container  label-above desc-after_everything ">
                                                <div class="nf-field">
                                                    <div id="nf-field-164_2-wrap" class="field-wrap textarea-wrap" data-field-id="164_2">
                                                        <div class="nf-field-label"><label for="nf-field-164_2" id="nf-label-field-164_2" class="">Additional Information  </label></div>
                                                        <div class="nf-field-description">Is transportation of the child/children required? If a care provider has another child they are caring for, is it okay for them to bring that child? Do you have pets? Any allergies or special needs?</div>
                                                        <div class="nf-field-element">
                                                            <textarea id="nf-field-164_2" v-model="AdditionalInformation" aria-invalid="false" aria-describedby="nf-error-164_2" class="ninja-forms-field nf-element" aria-labelledby="nf-label-field-164_2"></textarea>
                                                        </div>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-165_2-container" class="nf-field-container textbox-container  label-above desc-none ">
                                                <div class="nf-field">
                                                    <div id="nf-field-165_2-wrap" class="field-wrap textbox-wrap" data-field-id="165_2">
                                                        <div class="nf-field-label"><label for="nf-field-165_2" id="nf-label-field-165_2" class="">Enter your first name: <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <input type="text" v-model="FirstName" class="ninja-forms-field nf-element" id="nf-field-165_2" aria-invalid="false" aria-describedby="nf-error-165_2" aria-labelledby="nf-label-field-165_2" required="">
                                                            <small class="text-danger">{{ FirstName_error }} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-166_2-container" class="nf-field-container lastname-container  label-above desc-none ">
                                                <div class="nf-field">
                                                    <div id="nf-field-166_2-wrap" class="field-wrap lastname-wrap" data-field-id="166_2">
                                                        <div class="nf-field-label"><label for="nf-field-166_2" id="nf-label-field-166_2" class="">Enter your last name: <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <input type="text" v-model="LastName" class="ninja-forms-field nf-element" id="nf-field-166_2" name="lname" autocomplete="family-name" aria-invalid="false" aria-describedby="nf-error-166_2" aria-labelledby="nf-label-field-166_2" required="">
                                                            <small class="text-danger">{{ LastName_error }} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-166_2-container" class="nf-field-container email-container  label-above desc-none ">
                                                <div class="nf-field">
                                                    <div id="nf-field-166_2-wrap" class="field-wrap email-wrap" data-field-id="166_2">
                                                        <div class="nf-field-label"><label for="nf-field-166_2" id="nf-label-field-166_2" class="">What is your email address?: <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <input type="email" v-model="emails" class="ninja-forms-field nf-element" id="nf-field-166_2" name="emails" autocomplete="" aria-invalid="false" aria-describedby="nf-error-166_2" aria-labelledby="nf-label-field-166_2" required="">
                                                            <small class="text-danger">{{ emails_error }} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="nf-row">
                                        <div class="nf-cell" style="width: 100%;">
                                            <div id="nf-field-168_2-container" class="nf-field-container phone-container  label-above desc-none  textbox-container">
                                                <div class="nf-field">
                                                    <div id="nf-field-168_2-wrap" class="field-wrap phone-wrap textbox-wrap" data-field-id="168_2">
                                                        <div class="nf-field-label"><label for="nf-field-168_2" id="nf-label-field-168_2" class="">What phone number would you like care providers to respond to? <span class="ninja-forms-req-symbol">*</span> </label></div>
                                                        <div class="nf-field-element">
                                                            <input type="text" class="custom-input" v-model="PhoneNumber" @input="formatPhoneNumber" placeholder="(000) 000-0000" />
                                                            <small class="text-danger">{{ PhoneNumber_error }} </small>                                                                                                                         
                                                        </div>
                                                    </div>                                                  

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <button v-if="memberType == 'family_parent_member' || memberType == 'agency_member'" v-on:click="submitForm()" class="w-100 custom_yellow_btn">
                                <span v-if="Messageloader" class="spinner-border spinner-border-sm" role="status"></span> Submit
                            </button> 
                            <h6 v-else style="text-align:center;border-style:solid;border-radius:14px;border-color:rgba(229,142,167,.83);padding:.4em;line-height:1.4em;" class="nitro-offscreen">
                                <strong>
                                    <span style="color:#999;">
                                        Oops. This service is only available to logged in Family/Parent and Agency members. If you are a member,
                                    </span>
                                    <router-link to="/login" title="log in here">log in here</router-link>. 
                                    <span style="color:#f00;"><span style="color:#999;">Don’t have a membership yet?</span> 
                                        <router-link to="/sign-up-chooser" title="Sign up here">Sign up here!</router-link>
                                    </span>&nbsp;
                                </strong>
                            </h6>                            
                            <div class="form-group">
                                <p class="text-success" v-if="responseStatus">Form Submited Successfully.</p>
                                <ul>
                                    <div v-for="(errorArray, idx) in inputs_empty_error" :key="idx">
                                        <div v-for="(allErrors, idx) in errorArray" :key="idx">
                                            <li><span class="text-danger">{{ allErrors}} </span></li>
                                        </div>
                                    </div>
                                </ul> 
                                <p class="text-success">{{ subscriberSuccessMsg }}</p>                   
                            </div>                   
                       </div>
                </div>
            </div>
        </section>

    </main>
</template>
<script>   
    export default {
        name:'last-minute-group-text',        
        data() {
            return {
                isLoggedIn: false,
                Messageloader: false,
                responseStatus : false,
                YouNeedChildCare : 'I need care now!',
                HowManyChildren : '1',
                AgeChildNeedCare : '',
                NeedCareSick : '',
                NeighborHoodYouLive : '',
                DesiredStartTime : '',
                DesiredEndTime : '',
                PayRate : '',
                AdditionalInformation : '',
                FirstName : '',
                LastName : '',
                emails:'',
                PhoneNumberTsst : '',
                PhoneNumber : '',

                YouNeedChildCare_error : '',
                HowManyChildren_error : '',
                AgeChildNeedCare_error : '',
                NeedCareSick_error : '',
                NeighborHoodYouLive_error : '',
                DesiredStartTime_error : '',
                DesiredEndTime_error : '',
                PayRate_error : '',
                FirstName_error : '',
                LastName_error : '',
                emails_error : '',
                PhoneNumber_error : '',

                inputs_empty_error: '',

                subscribeloader:false,
                subscriberName : '',
                subscriberMobileNumber : '',
                error_inputs: "",
                subscriberSuccessMsg: '',
                pageName : 'LastMinuteGroupText'
                // pageTitle : 'Last Minute Childcare System | Nanny Parent Connection',
                // pageMetaDescription : 'Daycare closed today? Need a Seattle nanny or a babysitter on short notice? Find last minute childcare FAST using our Last Minute...',
                // pageMetaKeywords : ''
            }
        },
        methods:{
            formatPhoneNumber(event) {
                this.PhoneNumberTsst = event.target.value;
                this.PhoneNumber = this.formatAsPhoneNumber(this.PhoneNumberTsst);
            },
            formatAsPhoneNumber(value) {
                value = value.replace(/\D/g, '');
                if (value.length > 10) {
                    value = value.slice(0, 10);
                }
                value = '('+ value.slice(0, 3)+')' + ' ' + value.slice(3, 6) + '-' + value.slice(6);
                return value;
            },
            submitForm(){
                this.Messageloader = true;
                axios.post(`/api/SaveLastMinuteGroupTextForm`, {
                    YouNeedChildCare:this.YouNeedChildCare,
                    HowManyChildren:this.HowManyChildren,
                    AgeChildNeedCare:this.AgeChildNeedCare,
                    NeedCareSick:this.NeedCareSick,
                    NeighborHoodYouLive:this.NeighborHoodYouLive,
                    DesiredStartTime:this.DesiredStartTime,
                    DesiredEndTime:this.DesiredEndTime,
                    PayRate:this.PayRate,
                    AdditionalInformation:this.AdditionalInformation,
                    FirstName:this.FirstName,
                    LastName:this.LastName,
                    emails:this.emails,
                    PhoneNumber:this.PhoneNumber,                    
                }).then((response) => {
                    this.YouNeedChildCare = '';
                    this.HowManyChildren = '';
                    this.AgeChildNeedCare = '';
                    this.NeedCareSick = '';
                    this.NeighborHoodYouLive = '';
                    this.DesiredStartTime = '';
                    this.DesiredEndTime = '';
                    this.PayRate = '';
                    this.AdditionalInformation = '';
                    this.FirstName = '';
                    this.LastName = '';
                    this.emails = '';
                    this.PhoneNumber = '';
                    this.responseStatus = true;
                    this.Messageloader = false;
                    setTimeout(() => this.responseStatus = '', 1000);
                }).catch(error => {
                    this.Messageloader = false;
                    this.inputs_empty_error = error.response.data.error;
                    setTimeout(() => this.inputs_empty_error = '', 5000);
                });
            },
            subscribeSave(){
                this.subscribeloader = true;
                axios.post(`/api/subscriberSave`, {
                    yourName:this.subscriberName,
                    mobileNumber:this.subscriberMobileNumber
                }).then((response) => {
                    this.subscribeloader = false;
                    this.subscriberSuccessMsg = response.data.subscriberSuccessMsg;
                    this.subscriberName = '';
                    this.subscriberMobileNumber = '';
                    setTimeout(() => this.subscriberSuccessMsg = '', 5000);
                }).catch(error => {
                    this.subscribeloader = false;
                    this.error_inputs = error.response.data.error;
                    setTimeout(() => this.error_inputs = '', 5000);
                });
            }
        },
        mounted(){	
            axios.get(`/api/get-seo-page`).then((response) => {
                var getData = response.data.page_seo_data.find((employee) => employee.page_Name == this.pageName);					
                document.title = getData.seo_Title;
                document.getElementsByTagName('meta')["description"].content = ""+getData.meta_description+"";
                document.getElementsByTagName('meta')["keywords"].content = ""+getData.meta_tags+"";					
            }).catch((err) => console.error(err));		
        },
        created() {
            window.scrollTo(0,0); 
            if (window.Laravel.user) {
                this.id = window.Laravel.user.id,
                this.memberType = window.Laravel.user.memberType
            }
            if (window.Laravel.isLoggedin) {
                this.isLoggedIn = true
            }
        }
    }
</script>