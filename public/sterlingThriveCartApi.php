<?php 
/*if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //fetch RAW input
	$json = file_get_contents('php://input');	
	$fp = file_put_contents('response.log', $json.'\r\n', FILE_APPEND);
	$obj = json_decode($json);
	 
	//expecting valid json
	if (json_last_error() !== JSON_ERROR_NONE) {
		die(header('HTTP/1.0 415 Unsupported Media Type'));
	}

	if(isset($obj->thrivecart_secret) && ($obj->thrivecart_secret!="")){
		$customerId = $obj->customer_id;
		$id_ebi = $obj->customer_id.time();
		
		$firstname_ebi = trim($obj->customer->first_name); 		
		$lastname_ebi = trim($obj->customer->last_name); 
		$email_ebi = $obj->customer->email; 
		$requestCustomer = $firstname_ebi.' '.$lastname_ebi;

		$candidate_firstname_ebi =  trim($obj->customer->custom_fields->candidatefirst); 
		$candidate_lastname_ebi = trim($obj->customer->custom_fields->candidatelast); 
		$candidate_email_ebi = trim($obj->customer->custom_fields->candidateemail); 
		
		$package_ebi =  $obj->base_product_name;
		
		if($package_ebi=="Standard Background Check"){
			
			if($obj->order->charges[0]->item_type == "product"){
				$package_ebi = "Standard Package";
				
			}elseif($obj->order->charges[0]->item_type == "upsell"){
				$package_ebi = "Premium Plus Package";
				
			}elseif($obj->order->charges[0]->item_type == "downsells"){
				$package_ebi = "Premium Package";
			}
			
		}
		   
		
		if($package_ebi=="Premium Background Check"){
			
			if($obj->order->charges[0]->item_type == "product"){
				$package_ebi = "Premium Package";
				
			}elseif($obj->order->charges[0]->item_type == "upsell"){
				$package_ebi = "Premium Plus Package";
				
			} 
			
		}
		
		
		
		if($package_ebi=="Premium Plus Background Check"){
			
			$package_ebi = "Premium Plus Package";
		}
		
		if($package_ebi=="Premium Plus Background Check with Member Discount"){
			
			$package_ebi = "Premium Plus Package";
		}
		
		
		if($package_ebi=="Premium Background Check with Member Discount"){			
			 
			if($obj->order->charges[0]->item_type == "product"){
				$package_ebi = "Premium Package";
				
			}elseif($obj->order->charges[0]->item_type == "upsell"){
				$package_ebi = "Premium Plus Package";
				
			} 
		}
		
		
		if($package_ebi=="Standard Background Check with Member Discount"){ 
		
			 
			if($obj->order->charges[0]->item_type == "product"){
				$package_ebi = "Standard Package";
				
			}elseif($obj->order->charges[0]->item_type == "upsell"){
				$package_ebi = "Premium Plus Package";
				
			}elseif($obj->order->charges[0]->item_type == "downsells"){
				$package_ebi = "Premium Package";
			}
		}
		
		if($package_ebi=="NannyNow - Premium Plus Background Check"){
			
			$package_ebi = "Premium Plus Package";  
			//$candidate_firstname_ebi =  $obj->customer->first_name; 
			//$candidate_lastname_ebi = $obj-> customer->last_name; 
			//$candidate_email_ebi = $obj->customer->email; 
		}
		
		if($package_ebi=="EngineHire - Gold Background Check"){
			
			$package_ebi = "Gold";  
			 
		}
		if($package_ebi=="EngineHire - Platinum Background Check"){
			
			$package_ebi = "Platinum";  
			 
		}
		/* if($package_ebi=="Ravinder Test - Premium Plus Background Check"){
			
			$package_ebi = "Standard Package";
		} */
		
/*	
		$placeNum_ebi = date("Ymdhis");

			
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/oauth',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic QXBpVXNlck5hbm55UGFyZW50Q29ubmVjdGlvbjpMakU4cWFhNkAyblYzU2M=',
		    'Content-Type: application/x-www-form-urlencoded'
		  ),
		));

		$resOauth = curl_exec($curl);
		curl_close($curl);
		$Oauth = json_decode($resOauth);
		

		$curl = curl_init();
	    curl_setopt_array($curl, array(
	      CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/packages',
	      CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => '',
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => 0,
	      CURLOPT_FOLLOWLOCATION => true,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => 'GET',
	      CURLOPT_HTTPHEADER => array(
	        'Authorization: Bearer '.$Oauth->access_token
	      ),
	    ));

	    $resPackages = curl_exec($curl);
	    curl_close($curl);
	    $Packages = json_decode($resPackages, true); 
    	$slotIndex = array_search($package_ebi, array_column($Packages, 'title'));
   		$packageId = $Packages[$slotIndex]['id'];

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/candidates',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
		  	  "clientReferenceId": "'.$id_ebi.'",
			  "givenName": "'.$candidate_firstname_ebi.'",
			  "familyName": "'.$candidate_lastname_ebi.'",
			  "email": "'.$candidate_email_ebi.'"
			}',
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Bearer '.$Oauth->access_token,
		    'Content-Type: application/json'
		  ),
		));
		$resCandidate  = curl_exec($curl);
		curl_close($curl);
		$Candidate  = json_decode($resCandidate);
		$fp = file_put_contents('./logs/candidates.log', $resCandidate.' '.$customerId.'\r\n', FILE_APPEND);

		$curl = curl_init();
	    curl_setopt_array($curl, array(
	      CURLOPT_URL => 'https://api.us.sterlingcheck.app/v2/screenings',
	      CURLOPT_RETURNTRANSFER => true,
	      CURLOPT_ENCODING => '',
	      CURLOPT_MAXREDIRS => 10,
	      CURLOPT_TIMEOUT => 0,
	      CURLOPT_FOLLOWLOCATION => true,
	      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	      CURLOPT_CUSTOMREQUEST => 'POST',
	      CURLOPT_POSTFIELDS =>'{
	        "packageId": "'.$packageId.'", 
	        "candidateId": "'.$Candidate->id.'",
	        "invite": {
	          "method": "email"
	        }, 
	        "jobPosition" : "Standard Employee",
	        "billCode": "'.$requestCustomer.'"
	      }',
	      CURLOPT_HTTPHEADER => array(
	        'Authorization: Bearer '.$Oauth->access_token,
	         'Content-Type: application/json'
	      ),
	    ));
	    $resScreening = curl_exec($curl);
	    curl_close($curl);
	    $fp = file_put_contents('./logs/screening.log', $resScreening.' '.$customerId.'\r\n', FILE_APPEND);
	} 
}
*/
?>
