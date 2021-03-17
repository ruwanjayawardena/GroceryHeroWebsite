<?php

include '../models/user.php';

$ctrl = new User();
if (array_key_exists("action", $_POST)) {

	if ($_POST['action'] == 'signupUsers') {
		$ctrl->setUsr_username($_POST['usr_username']);
		$ctrl->setUsr_phone($_POST['usr_phone']);
		$ctrl->setUsr_pass($_POST['usr_pass']);
		$ctrl->setUsr_email($_POST['usr_email']);		
		$ctrl->setUsr_cat_id($_POST['usr_cat_id']);
		$ctrl->setUsr_first_name($_POST['usr_first_name']);
		$ctrl->setUsr_last_name($_POST['usr_last_name']);		
		$ctrl->setPro_lat($_POST['pro_lat']);
		$ctrl->setPro_lng($_POST['pro_lng']);
		$ctrl->setPro_location($_POST['pro_location']);
		$ctrl->setPro_map_status($_POST['pro_map_status']);
		$ctrl->frontSignup($_POST['usr_signup_method']);
	} 
	else if ($_POST['action'] == "tblReceivedScorePointByUser") {
		$ctrl->tblReceivedScorePointByUser();
	} 
	else if ($_POST['action'] == "getLoggedUserStatus") {
		$ctrl->getLoggedUserStatus();
	} 
	else if ($_POST['action'] == "tblReferenceUsersByUser") {
		$ctrl->tblReferenceUsersByUser();
	} else if ($_POST['action'] == 'profileUpdate') {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->setPro_country($_POST['pro_country']);
		$ctrl->setPro_state($_POST['pro_state']);
		$ctrl->setPro_gender($_POST['pro_gender']);
		$ctrl->setPro_fname($_POST['pro_fname']);
		$ctrl->setPro_lname($_POST['pro_lname']);
		$ctrl->setPro_city($_POST['pro_city']);
		$ctrl->setPro_age($_POST['pro_age']);
		$ctrl->setPro_dob($_POST['pro_dob']);
		$ctrl->setPro_paypal_email($_POST['pro_paypal_email']);
		$ctrl->setPro_address($_POST['pro_address']);
		$ctrl->setPro_zip($_POST['pro_zip']);
		$ctrl->setPro_taxpayid($_POST['pro_taxpayid']);
		$ctrl->profileUpdate();
	} 
	//NEED
	else if ($_POST['action'] == 'profileUpdateFront') {	
		$ctrl->setUsr_first_name($_POST['usr_first_name']);
		$ctrl->setUsr_last_name($_POST['usr_last_name']);
		$ctrl->setUsr_phone($_POST['usr_phone']);		
		$ctrl->setUsr_email($_POST['usr_email']);
		$ctrl->setUsr_id($_POST['usr_id']);	
		$ctrl->profileUpdateFront();
	}
	//END NEED
	else if ($_POST['action'] == 'userProfileActivation') {
//		$ctrl->setPro_country($_POST['pro_country']);
//		$ctrl->setPro_state($_POST['pro_state']);
//		$ctrl->setPro_gender($_POST['pro_gender']);
		$ctrl->setPro_fname($_POST['pro_fname']);
		$ctrl->setPro_lname($_POST['pro_lname']);
//		$ctrl->setPro_city($_POST['pro_city']);
//		$ctrl->setPro_age($_POST['pro_age']);
//		$ctrl->setPro_dob($_POST['pro_dob']);
//		$ctrl->setPro_address($_POST['pro_address']);
//		$ctrl->setPro_zip($_POST['pro_zip']);
		$ctrl->setUsr_name($_POST['usr_name']);
		$ctrl->setUsr_email($_POST['usr_email']);
		$ctrl->setUsr_phone($_POST['usr_phone']);
//		$ctrl->setUsr_verify_id_type($_POST['usr_verify_id_type']);	
//		$ctrl->setUsr_verify_id_type($_POST['usr_verify_id_type']);	
		$ctrl->setUsr_confirm_code($_POST['usr_confirm_code']);
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->setUaf_ref_have($_POST['uaf_ref_have']);
		$ctrl->userProfileActivation($_POST['usr_refusr_email']);
	} else if ($_POST['action'] == 'activateUserAccount') {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->setUsr_confirm_code($_POST['usr_confirm_code']);
		$ctrl->activateUserAccount();
	}
	//NEED
	else if ($_POST['action'] == "logout") {
		$ctrl->logout();
	}
	//END NEED
	//NEED
	else if ($_POST['action'] == "navigateDashboard") {
		echo $_SESSION['usr_cat_id'];		
	}
	//END NEED
	else if ($_POST['action'] == "setcookieagreement") {
		$ctrl->setcookieagreement();
	} else if ($_POST['action'] == "checkcookieagreement") {
		$ctrl->checkcookieagreement();
	} else if ($_POST['action'] == "cmbUserCategory") {
		$ctrl->cmbUserCategory();
	} else if ($_POST['action'] == "cmbUserByCategory") {
		$ctrl->setUsr_cat_id($_POST['usr_cat_id']);
		$ctrl->cmbUserByCategory();
	} else if ($_POST['action'] == "userTable") {
		$ctrl->userTable();
	} 
	//NEEED
	else if ($_POST['action'] == "userTableByCatID") {
		$ctrl->setUsr_cat_id($_POST['usr_cat_id']);
		$ctrl->userTableByCatID();
	}
	//END NEED
	//NEED
	else if ($_POST['action'] == "getUserByID") {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->getUserByID();
	} 
	//END NEED
	//NEED
	else if ($_POST['action'] == "getUserInfoBySessionID") {		
		$ctrl->getUserInfoBySessionID();
	} 
	//END NEED
	
	else if ($_POST['action'] == "userPointDisplay") {
		$ctrl->userPointDisplay();
	} else if ($_POST['action'] == "getUserProfileInfoByID") {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->getUserProfileInfoByID();
	}
	//NEED
	else if ($_POST['action'] == "getUserProfileInfo") {
		$ctrl->getUserProfileInfo();
	} 
	//END NEED
	else if ($_POST['action'] == "deleteUserByID") {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->deleteUserByID();
	}
	//NEED
	else if ($_POST['action'] == "passwordChangeByRecovery") {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->setUsr_pass($_POST['usr_pass']);
		$ctrl->passwordChangeByRecovery();
	} 
	//END NEED
	
	else if ($_POST['action'] == "profilePasswordChange") {
		$ctrl->setUsr_pass($_POST['usr_pass']);
		$ctrl->profilePasswordChange();
	}
	//NEEED
	else if ($_POST['action'] == "addUser") {
		$ctrl->setUsr_pass($_POST['usr_pass']);
		$ctrl->setUsr_first_name($_POST['usr_first_name']);
		$ctrl->setUsr_last_name($_POST['usr_last_name']);
		$ctrl->setUsr_email($_POST['usr_email']);
		$ctrl->setUsr_phone($_POST['usr_phone']);
		$ctrl->setUsr_cat_id($_POST['usr_cat_id']);
		$ctrl->setUsr_username($_POST['usr_username']);
		$ctrl->addUser();
	} 
	//END NEED
	else if ($_POST['action'] == "addUserModel") {
		$ctrl->setUsr_pass($_POST['usr_pass']);
		$ctrl->setUsr_name($_POST['usr_name']);
		$ctrl->setUsr_email($_POST['usr_email']);
		$ctrl->setUsr_phone($_POST['usr_phone']);
		$ctrl->setUsr_cat_id($_POST['usr_cat_id']);
		$ctrl->setUsr_username($_POST['usr_username']);
		$ctrl->addUserModel();
	} 
	//NEED
	else if ($_POST['action'] == 'updateUser') {
		$ctrl->setUsr_first_name($_POST['usr_first_name']);
		$ctrl->setUsr_last_name($_POST['usr_last_name']);
		$ctrl->setUsr_phone($_POST['usr_phone']);
		$ctrl->setUsr_username($_POST['usr_username']);
		$ctrl->setUsr_email($_POST['usr_email']);
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->updateUser();
	} 
	//END NEED
	else if ($_POST['action'] == "autopassowrdreset") {
		$ctrl->setUsr_email($_POST['usr_email']);
		$ctrl->autopassowrdreset();
	}

	//NEED
	else if ($_POST['action'] == 'login') {
		$ctrl->setUsr_pass($_POST['usr_pass']);
		$ctrl->setUsr_username($_POST['usr_username']);
		$ctrl->login();
	}
	//END NEED
	//NEED
	else if ($_POST['action'] == 'facebookLogin') {
		$ctrl->setUsr_email($_POST['usr_email']);		
		$ctrl->facebookLogin();
	}
	//END NEED
	else if ($_POST['action'] == "resetPassword") {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->setUsr_pass($_POST['usr_pass']);
		$ctrl->setUsr_confirm_code($_POST['usr_autoresetpass']);
		$ctrl->resetPassword();
	}
	else if ($_POST['action'] == "autosignin") {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->autosignin();
	} 
	else if ($_POST['action'] == "checkUserActivation") {
		$ctrl->setUsr_id($_POST['usr_id']);
		$ctrl->checkUserActivation();
	} 
	else if ($_POST['action'] == 'userProfileImageByID') {
		$directory = "../../asset_imageuploader/userprofileimages/" . $_POST['usr_id'] . "/";
		$files = scandir($directory);
		$files = array_diff($files, ['.', '..', 'thumbnail']);
		$files = array_values(array_filter($files));
		echo $files[0];
	} else if ($_POST['action'] == "phoneVerifiedChecker") {
		$ctrl->phoneVerifiedChecker();
	} else if ($_POST['action'] == "viewUserProfileVerifyID") {
		$ctrl->viewUserProfileVerifyID();
	} else if ($_POST['action'] == "phoneVerificationCodeSend") {
		$ctrl->setUsr_phone($_POST['usr_phone']);
		$ctrl->phoneVerificationCodeSend();
	} else if ($_POST['action'] == "verifyPhoneCode") {
		$ctrl->setUsr_phone($_POST['usr_phone']);
		$ctrl->verifyPhoneCode();
	}
}

