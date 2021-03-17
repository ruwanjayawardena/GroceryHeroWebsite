<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';
require '../twilioSMS/vendor/autoload.php';

use Twilio\Rest\Client;

/**
 * @author Ruwan Jayawardena
 */
class User extends ConnectDB {

	const TBL_USER = 'df_user';
	const TBL_PROFILE = 'df_profile';

	private $flag = false;
	private $usr_id;
	private $usr_pass;
	private $usr_first_name;
	private $usr_last_name;
	private $usr_age;
	private $usr_email;
	private $usr_phone;
	private $usr_status;
	private $usr_cat_id;
	private $usr_username;
	private $usr_confirm_code;
	private $usr_create_date;
	private $usr_create_time;
	private $usr_notification_send;
	private $usr_notification_media;
	private $usr_verified;
	private $usr_verified_media;
	private $pro_id;
	private $pro_usr_id;
	private $pro_paypal_email;
	private $pro_dob;
	private $pro_address;
	private $pro_country;
	private $pro_city;
	private $pro_state;
	private $pro_zip;
	private $pro_map_status;
	private $pro_location;
	private $pro_lng;
	private $pro_lat;

	public function getPro_map_status() {
		return $this->pro_map_status;
	}

	public function getPro_location() {
		return $this->pro_location;
	}

	public function getPro_lng() {
		return $this->pro_lng;
	}

	public function getPro_lat() {
		return $this->pro_lat;
	}

	public function setPro_map_status($pro_map_status) {
		$this->pro_map_status = $pro_map_status;
		return $this;
	}

	public function setPro_location($pro_location) {
		$this->pro_location = $pro_location;
		return $this;
	}

	public function setPro_lng($pro_lng) {
		$this->pro_lng = $pro_lng;
		return $this;
	}

	public function setPro_lat($pro_lat) {
		$this->pro_lat = $pro_lat;
		return $this;
	}

	public function getUsr_pass() {
		return $this->usr_pass;
	}

	public function getUsr_username() {
		return $this->usr_username;
	}

	public function getFlag() {
		return $this->flag;
	}

	public function getUsr_id() {
		return $this->usr_id;
	}

	public function getUsr_first_name() {
		return $this->usr_first_name;
	}

	public function getUsr_last_name() {
		return $this->usr_last_name;
	}

	public function getUsr_age() {
		return $this->usr_age;
	}

	public function getUsr_email() {
		return $this->usr_email;
	}

	public function getUsr_phone() {
		return $this->usr_phone;
	}

	public function getUsr_status() {
		return $this->usr_status;
	}

	public function getUsr_cat_id() {
		return $this->usr_cat_id;
	}

	public function getUsr_confirm_code() {
		return $this->usr_confirm_code;
	}

	public function getUsr_notification_send() {
		return $this->usr_notification_send;
	}

	public function getUsr_notification_media() {
		return $this->usr_notification_media;
	}

	public function getUsr_verified() {
		return $this->usr_verified;
	}

	public function getUsr_verified_media() {
		return $this->usr_verified_media;
	}

	public function getPro_id() {
		return $this->pro_id;
	}

	public function getPro_usr_id() {
		return $this->pro_usr_id;
	}

	public function getPro_paypal_email() {
		return $this->pro_paypal_email;
	}

	public function getPro_dob() {
		return $this->pro_dob;
	}

	public function getPro_address() {
		return $this->pro_address;
	}

	public function getPro_country() {
		return $this->pro_country;
	}

	public function getPro_city() {
		return $this->pro_city;
	}

	public function getPro_state() {
		return $this->pro_state;
	}

	public function getPro_zip() {
		return $this->pro_zip;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
		return $this;
	}

	public function setUsr_id($usr_id) {
		$this->usr_id = $usr_id;
		return $this;
	}

	public function setUsr_first_name($usr_first_name) {
		$this->usr_first_name = $usr_first_name;
		return $this;
	}

	public function setUsr_last_name($usr_last_name) {
		$this->usr_last_name = $usr_last_name;
		return $this;
	}

	public function setUsr_age($usr_age) {
		$this->usr_age = $usr_age;
		return $this;
	}

	public function setUsr_email($usr_email) {
		$this->usr_email = $usr_email;
		return $this;
	}

	public function setUsr_phone($usr_phone) {
		$this->usr_phone = $usr_phone;
		return $this;
	}

	public function setUsr_status($usr_status) {
		$this->usr_status = $usr_status;
		return $this;
	}

	public function setUsr_cat_id($usr_cat_id) {
		$this->usr_cat_id = $usr_cat_id;
		return $this;
	}

	public function setUsr_confirm_code($usr_confirm_code) {
		$this->usr_confirm_code = $usr_confirm_code;
		return $this;
	}

	public function setUsr_notification_send($usr_notification_send) {
		$this->usr_notification_send = $usr_notification_send;
		return $this;
	}

	public function setUsr_notification_media($usr_notification_media) {
		$this->usr_notification_media = $usr_notification_media;
		return $this;
	}

	public function setUsr_verified($usr_verified) {
		$this->usr_verified = $usr_verified;
		return $this;
	}

	public function setUsr_verified_media($usr_verified_media) {
		$this->usr_verified_media = $usr_verified_media;
		return $this;
	}

	public function setPro_id($pro_id) {
		$this->pro_id = $pro_id;
		return $this;
	}

	public function setPro_usr_id($pro_usr_id) {
		$this->pro_usr_id = $pro_usr_id;
		return $this;
	}

	public function setPro_paypal_email($pro_paypal_email) {
		$this->pro_paypal_email = $pro_paypal_email;
		return $this;
	}

	public function setPro_dob($pro_dob) {
		$this->pro_dob = $pro_dob;
		return $this;
	}

	public function setPro_address($pro_address) {
		$this->pro_address = $pro_address;
		return $this;
	}

	public function setPro_country($pro_country) {
		$this->pro_country = $pro_country;
		return $this;
	}

	public function setPro_city($pro_city) {
		$this->pro_city = $pro_city;
		return $this;
	}

	public function setPro_state($pro_state) {
		$this->pro_state = $pro_state;
		return $this;
	}

	public function setPro_zip($pro_zip) {
		$this->pro_zip = $pro_zip;
		return $this;
	}

	public function getUsr_create_date() {
		$this->usr_create_date = date("Y-m-d");
		return $this->usr_create_date;
	}

	public function getUsr_create_time() {
		$this->usr_create_time = date("H:i:s");
		return $this->usr_create_time;
	}

	public function setUsr_pass($usr_pass) {
//hash password
		$salt = 'ruwanj510*';
		$hashed = hash('sha256', $usr_pass . $salt);
		$this->usr_pass = $hashed;
	}

	public function setUsr_username($usr_username) {
		$this->usr_username = strtolower(preg_replace('/\s/', '', $usr_username));
	}

	public function getNextAutoIncrementID($table) {
		$nextid = 0;
		$sql = "SHOW TABLE STATUS LIKE '" . $table . "'";
		$readstmt = $this->con->prepare($sql);
		$readstmt->execute();
		while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
			$nextid = $row->Auto_increment;
		}
		return $nextid;
	}

	public function getNextAutoIncrementUserID() {
		$nextid = 0;
		$sql = "SHOW TABLE STATUS LIKE 'df_user'";
		$readstmt = $this->con->prepare($sql);
		$readstmt->execute();
		while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
			$nextid = $row->Auto_increment;
		}
		$this->setUsr_id($nextid);
	}

	public function getRandomConfirmationCode() {
		$this->usr_confirm_code = rand(10000, 99999);
		return $this->usr_confirm_code;
	}

	public function frontSignup($usr_signup_method) {
		$usr_confirm_code = rand(10000, 99999);
		$this->getNextAutoIncrementUserID();
		if ($usr_signup_method == 1) {
			//email
			$sql_usr_table = "INSERT INTO `df_user` (`usr_pass`, `usr_first_name`, `usr_last_name`,`usr_email`, `usr_phone`, `usr_status`, `usr_cat_id`, `usr_username`, `usr_confirm_code`, `usr_create_date`, `usr_create_time`, `usr_notification_send`, `usr_notification_media`, `usr_verified`, `usr_verified_media`) VALUES ( :usr_pass,:usr_first_name,:usr_last_name,:usr_email,:usr_phone,'0',:usr_cat_id,:usr_username,:usr_confirm_code,:usr_create_date,:usr_create_time,'1', '2', '0', '1');";
			$sql_profile_table = "INSERT INTO `df_profile` (`pro_usr_id`, `pro_lat`, `pro_lng`, `pro_location`, `pro_map_status`) VALUES (:pro_usr_id, :pro_lat, :pro_lng, :pro_location, :pro_map_status);";
			try {
				$this->getCon()->beginTransaction();
				$saveUser = $this->getCon()->prepare($sql_usr_table);
				$saveUser->bindParam(':usr_pass', $this->getUsr_pass(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_first_name', $this->getUsr_first_name(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_last_name', $this->getUsr_last_name(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_cat_id', $this->getUsr_cat_id(), PDO::PARAM_INT);
				$saveUser->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_confirm_code', $usr_confirm_code, PDO::PARAM_STR);
				$saveUser->bindParam(':usr_create_date', $this->getUsr_create_date(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_create_time', $this->getUsr_create_time(), PDO::PARAM_STR);
				if ($saveUser->execute()) {
					$profileUser = $this->getCon()->prepare($sql_profile_table);
					$profileUser->bindParam(':pro_usr_id', $this->getUsr_id(), PDO::PARAM_INT);
					$profileUser->bindParam(':pro_lat', $this->getPro_lat(), PDO::PARAM_STR);
					$profileUser->bindParam(':pro_lng', $this->getPro_lng(), PDO::PARAM_STR);
					$profileUser->bindParam(':pro_location', $this->getPro_location(), PDO::PARAM_STR);
					$profileUser->bindParam(':pro_map_status', $this->getPro_map_status(), PDO::PARAM_INT);
					if ($profileUser->execute()) {
						//session create for login
						$_SESSION['usr_id'] = $this->getUsr_id();
						$_SESSION['usr_first_name'] = $this->getUsr_first_name();
						$_SESSION['usr_username'] = $this->getUsr_username();
						$_SESSION['usr_cat_id'] = $this->getUsr_cat_id();
						//end session create for login
						$to = $this->getUsr_email();
						//EMAIL
						$from_name = "groceryhero";
						$from_mail = "admin@groceryhero.com";
						$mail_subject = 'GroceryHero Account Activation';
						$encoding = "utf-8";
						$subject_preferences = array(
							"input-charset" => $encoding,
							"output-charset" => $encoding,
							"line-length" => 76,
							"line-break-chars" => "\r\n"
						);
						$header = "Content-type: text/html; charset=" . $encoding . " \r\n";
						$header .= "From: " . $from_name . " <" . $from_mail . "> \r\n";
						$header .= "MIME-Version: 1.0 \r\n";
						$header .= "Content-Transfer-Encoding: 8bit \r\n";
						$header .= "Date: " . date("r (T)") . " \r\n";
						$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
						$message = '<html>';
						$message .= '<body>';
						$message .= '<h2>GroceryHero Account Activation</h2><br>';
						$message .= '<p>Please activate your account using this link : <a href="http://covidhelpapp.ruwanjayawardena.com/useractivation.php?usr_id=' . $this->getUsr_id() . '&usr_confirm_code=' . $usr_confirm_code . '">Activate Now</a></p>';
						$message .= '</body>';
						$message .= '</html>';
						if (mail($to, $mail_subject, $message, $header)) {
							$this->getCon()->commit();
							echo json_encode(array("msgType" => 1, "msg" => "You have successfully signed up with us.Please check your email (​" . $this->getUsr_email() . ") and activate your account", "usr_id" => $this->getUsr_id(), "usr_cat_id" => $this->getUsr_cat_id()));
						} else {
							$this->getCon()->rollBack();
							echo json_encode(array("msgType" => 2, "msg" => "Sorry Signed up Failed,Becasue of activation email sending failed.Please check your email whether correct or wrong"));
						}
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 2, "msg" => "Sorry! Sign up failed.Please Try again later"));
					}
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! Sign up failed.Please Try again later"));
				}
			} catch (Exception $exc) {
				if ($exc->getCode() == "23000") {
					echo json_encode(array("msgType" => 2, "msg" => "Duplicate Error ! This User already avalable on our system.Please try again with another email,phone or username"));
				} else {
					echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
				}
			}
		} else if ($usr_signup_method == 2) {
			//facebook
			$sql_usr_table = "INSERT INTO `df_user` (`usr_pass`, `usr_first_name`, `usr_last_name`,`usr_email`, `usr_phone`, `usr_cat_id`, `usr_username`, `usr_create_date`, `usr_create_time`, `usr_notification_send`, `usr_notification_media`, `usr_verified`, `usr_verified_media`) VALUES ( :usr_pass,:usr_first_name,:usr_last_name,:usr_email,:usr_phone,:usr_cat_id,:usr_username,:usr_create_date,:usr_create_time,'1', '2', '1', '3');";
			$sql_profile_table = "INSERT INTO `df_profile` (`pro_usr_id`, `pro_lat`, `pro_lng`, `pro_location`, `pro_map_status`) VALUES (:pro_usr_id, :pro_lat, :pro_lng, :pro_location, :pro_map_status);";
			try {
				$this->getCon()->beginTransaction();
				$saveUser = $this->getCon()->prepare($sql_usr_table);
				$saveUser->bindParam(':usr_pass', $this->getUsr_pass(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_first_name', $this->getUsr_first_name(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_last_name', $this->getUsr_last_name(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_cat_id', $this->getUsr_cat_id(), PDO::PARAM_INT);
				$saveUser->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_create_date', $this->getUsr_create_date(), PDO::PARAM_STR);
				$saveUser->bindParam(':usr_create_time', $this->getUsr_create_time(), PDO::PARAM_STR);
				if ($saveUser->execute()) {
					$profileUser = $this->getCon()->prepare($sql_profile_table);
					$profileUser->bindParam(':pro_usr_id', $this->getUsr_id(), PDO::PARAM_INT);
					$profileUser->bindParam(':pro_lat', $this->getPro_lat(), PDO::PARAM_STR);
					$profileUser->bindParam(':pro_lng', $this->getPro_lng(), PDO::PARAM_STR);
					$profileUser->bindParam(':pro_location', $this->getPro_location(), PDO::PARAM_STR);
					$profileUser->bindParam(':pro_map_status', $this->getPro_map_status(), PDO::PARAM_INT);
					if ($profileUser->execute()) {
						$this->getCon()->commit();
						$_SESSION['usr_id'] = $this->getUsr_id();
						$_SESSION['usr_first_name'] = $this->getUsr_first_name();
						$_SESSION['usr_username'] = $this->getUsr_username();
						$_SESSION['usr_cat_id'] = $this->getUsr_cat_id();
						echo json_encode(array("msgType" => 1, "msg" => "You have successfully signed up and activated your account using facebook authenatication.", "usr_id" => $this->getUsr_id(), "usr_cat_id" => $this->getUsr_cat_id()));
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 2, "msg" => "Sorry!Sign up failed.Please Try again later"));
					}
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry!Sign up failed.Please Try again later"));
				}
			} catch (Exception $exc) {
				if ($exc->getCode() == "23000") {
					echo json_encode(array("msgType" => 2, "msg" => "Duplicate Error!This User already avalable on our system.Please try again with another email, phone or username"));
				} else {
					echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
				}
			}
		}
	}

	public function getUserRefUserIDByEmail($email) {
		$usr_id = 0;
		$sql = "SELECT
			df_user.usr_id
			FROM
			df_user
			WHERE
			df_user.usr_email = :usr_email";
		$readstmt = $this->con->prepare($sql);
		$readstmt->bindParam(':usr_email', $email, PDO::PARAM_STR);
		$readstmt->execute();
		while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
			$usr_id = $row->usr_id;
		}
		return $usr_id;
	}

	public function activateUserAccount() {
		$usr_cat_id = 0;
		$data = array();
		$user_search_sql = "SELECT
df_user.usr_id,
df_user.usr_email,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_first_name
FROM
df_user
WHERE
df_user.usr_id = :usr_id AND
df_user.usr_confirm_code = :usr_confirm_code AND
df_user.usr_status = 0";
		$user_update_sql = "UPDATE `df_user` SET `usr_status`='1', `usr_verified` ='1', usr_confirm_code = '#' WHERE (`usr_id`=:usr_id);";
		try {
			$this->getCon()->beginTransaction();
			$readUserStmt = $this->getCon()->prepare($user_search_sql);
			$readUserStmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			$readUserStmt->bindParam(':usr_confirm_code', $this->getUsr_confirm_code(), PDO::PARAM_STR);
			$readUserStmt->execute();
			$count = $readUserStmt->rowCount();
			if ($count == 0) {
				echo json_encode(array("msgType" => 3, "msg" => "Failed Activation,Try Again"));
			} else {
				$createstmt = $this->getCon()->prepare($user_update_sql);
				$createstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
				if ($createstmt->execute()) {
					while ($row = $readUserStmt->fetch(PDO::FETCH_OBJ)) {
						$usr_cat_id = $row->usr_cat_id;
						$this->setFlag(true);
					}
					if ($this->getFlag()) {
						$this->getCon()->commit();
						echo json_encode(array("msgType" => 1, "msg" => "Successfully activated your Account.Please wait for navigate to dashboard...", "usr_cat_id" => $usr_cat_id));
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 2, "msg" => "Successfully activated your Account.Now you can access your account"));
					}
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 3, "msg" => "Failed Activation,Try Again"));
				}
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 3, "msg" => $exc->getMessage()));
		}
	}

//NEED
	public function logout() {
		$sql = "SELECT
df_user.usr_verified_media
FROM
df_user
WHERE
df_user.usr_id = :usr_id";
		try {
			$readUserInfo = $this->getCon()->prepare($sql);
			$readUserInfo->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readUserInfo->execute();
			while ($row = $readUserInfo->fetch(PDO::FETCH_OBJ)) {
				//1 - Email, 2 - Mobile, 3 - Facebook, 4 - By System
				if (isset($_SESSION) && !empty($_SESSION)) {
					unset($_SESSION['usr_id']);
					unset($_SESSION['usr_first_name']);
					unset($_SESSION['usr_username']);
					unset($_SESSION['usr_cat_id']);
				}
				if (!isset($_SESSION['usr_id'])) {
					if ($row->usr_verified_media == 3) {
						echo json_encode(array("msgType" => 1, "msg" => "Successfully Signed out", "logout_type" => 'fb'));
					} else {
						echo json_encode(array("msgType" => 1, "msg" => "Successfully Signed out", "logout_type" => 'normal'));
					}
				} else {
					echo json_encode(array("msgType" => 2, "msg" => "Sorry ! Sign out failed"));
				}
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 3, "msg" => $exc->getMessage()));
		}
	}

//END NEED

	public function setcookieagreement() {
		$cookie_name = "adult";
		$cookie_value = "agreed";
//		setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
		setcookie($cookie_name, $cookie_value, time() + (60 * 60), "/"); // 60 = 1 min
		echo 1;
	}

	public function checkcookieagreement() {
//		unset($_COOKIE['user']);
		$cookie_name = "adult";
		if (isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == "agreed") {
			echo 1;
		} else {
			echo 0;
		}
	}

	public function cmbUserCategory() {
		$data = array();
		$sql = "SELECT
df_usercategory.usr_cat_id,
df_usercategory.usr_cat_name
FROM
df_usercategory
WHERE
df_usercategory.usr_cat_id <> 1
ORDER BY
df_usercategory.usr_cat_name ASC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbUserByCategory() {
		$data = array();
		$sql = "SELECT
df_user.usr_name,
df_user.usr_id
FROM
df_user
WHERE
df_user.usr_cat_id = :usr_cat_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(":usr_cat_id", $this->getUsr_cat_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function userTable() {
		$data = array();
		$sql = "SELECT
df_usercategory.usr_cat_name,
df_user.usr_id,
df_user.usr_pass,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_name,
df_user.usr_create_date,
DATE_FORMAT(df_user.usr_create_time,'%h:%i %p') AS usr_create_time
FROM
df_user
INNER JOIN df_usercategory ON df_user.usr_cat_id = df_usercategory.usr_cat_id
WHERE
df_user.usr_status = 1 AND
df_user.usr_cat_id <> 1
ORDER BY
df_user.usr_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

//NEED
	public function userTableByCatID() {
		$data = array();
		$sql = "SELECT
df_usercategory.usr_cat_name,
DATE_FORMAT(df_user.usr_create_time,'%h:%i %p') AS usr_create_time,
df_user.usr_id,
df_user.usr_pass,
df_user.usr_first_name,
df_user.usr_last_name,
df_user.usr_age,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_confirm_code,
df_user.usr_create_date,
df_user.usr_create_time,
df_user.usr_notification_send,
df_user.usr_notification_media,
df_user.usr_verified,
df_user.usr_verified_media
FROM
df_user
INNER JOIN df_usercategory ON df_user.usr_cat_id = df_usercategory.usr_cat_id
WHERE
df_user.usr_status = 1 AND
df_user.usr_cat_id = :usr_cat_id
ORDER BY
df_user.usr_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(":usr_cat_id", $this->getUsr_cat_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

//END NEED

	public function getUserByID() {
		$data = array();
		$sql = "SELECT
df_user.usr_id,
df_user.usr_pass,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_usercategory.usr_cat_name,
df_user.usr_username,
df_user.usr_create_date,
DATE_FORMAT(df_user.usr_create_time,'%h:%i %p') AS usr_create_time,
df_user.usr_create_time,
df_user.usr_first_name,
df_user.usr_last_name,
df_user.usr_age
FROM
df_user
INNER JOIN df_usercategory ON df_user.usr_cat_id = df_usercategory.usr_cat_id
WHERE
df_user.usr_id = :usr_id AND
df_user.usr_cat_id <> 1";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

//NEED
	public function getUserInfoBySessionID() {
		$data = array();
		$sql = "SELECT
df_user.usr_first_name,
df_user.usr_last_name,
df_user.usr_phone,
df_user.usr_email,
df_profile.pro_lat,
df_profile.pro_lng,
df_profile.pro_location,
df_profile.pro_map_status
FROM
df_user
INNER JOIN df_profile ON df_profile.pro_usr_id = df_user.usr_id
WHERE
df_user.usr_id = :usr_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

//END NEED

	public function userPointDisplay() {
		$data = 0;
		$sql = "SELECT
df_user.usr_points
FROM
df_user
WHERE
df_user.usr_id = :usr_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
				$data = $row->usr_points;
			}
			echo $data;
		} catch (Exception $exc) {
			echo $data;
		}
	}

//NEED
	public function getUserProfileInfo() {
		$data = array();
		$sql = "SELECT
df_usercategory.usr_cat_name,
df_user.usr_id,
df_user.usr_pass,
df_user.usr_first_name,
df_user.usr_last_name,
df_user.usr_age,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_confirm_code,
df_user.usr_create_date,
df_user.usr_create_time,
df_user.usr_notification_send,
df_user.usr_notification_media,
df_user.usr_verified,
df_user.usr_verified_media,
df_profile.pro_id,
df_profile.pro_usr_id,
df_profile.pro_paypal_email,
df_profile.pro_dob,
df_profile.pro_address,
df_profile.pro_country,
df_profile.pro_city,
df_profile.pro_state,
df_profile.pro_zip
FROM
df_user
INNER JOIN df_usercategory ON df_user.usr_cat_id = df_usercategory.usr_cat_id
INNER JOIN df_profile ON df_profile.pro_usr_id = df_user.usr_id
WHERE
df_user.usr_id = :usr_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

//END NEED

	public function getUserProfileInfoByID() {
		$data = array();
		$sql = "SELECT
df_user.usr_id,
df_user.usr_pass,
df_user.usr_name,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_confirm_code,
df_user.usr_create_date,
df_user.usr_create_time,
df_user.usr_notify,
df_user.usr_notify_media,
df_profile.pro_id,
df_profile.pro_usr_id,
df_profile.pro_fname,
df_profile.pro_lname,
df_profile.pro_gender,
df_profile.pro_age,
df_profile.pro_paypal_email,
df_profile.pro_dob,
df_profile.pro_address,
df_profile.pro_country,
df_profile.pro_city,
df_profile.pro_state,
df_profile.pro_zip,
df_user.usr_phone_verified,
df_user.usr_verify_id_type
FROM
df_user
INNER JOIN df_profile ON df_profile.pro_usr_id = df_user.usr_id
WHERE
df_user.usr_id =:usr_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function tblReceivedScorePointByUser() {
		$data = array();
		$sql = "SELECT
kn_affiliate_points_earn.rec_id,
kn_affiliate_points_earn.rec_user,
(SELECT
df_user.usr_name
FROM
df_user
WHERE
df_user.usr_id = kn_affiliate_points_earn.rec_user) AS point_received_to,
kn_affiliate_points_earn.rec_description,
kn_affiliate_points_earn.rec_points,
kn_affiliate_points_earn.rec_from,
kn_affiliate_points_earn.rec_relate_ref_user,
if(ISNULL(kn_affiliate_points_earn.rec_relate_ref_user),'System',(SELECT
df_user.usr_name
FROM
df_user
WHERE
df_user.usr_id = kn_affiliate_points_earn.rec_relate_ref_user)) AS point_received_from,
if(ISNULL(kn_affiliate_points_earn.rec_relate_ref_user),1,IF(ISNULL((SELECT
df_user.usr_name
FROM
df_user
WHERE
df_user.usr_id = kn_affiliate_points_earn.rec_relate_ref_user AND
df_user.usr_status = 1)),IFNULL((SELECT
df_user.usr_name
FROM
df_user
WHERE
df_user.usr_id = kn_affiliate_points_earn.rec_relate_ref_user AND
df_user.usr_status = 1),0),1)) AS point_received_from_usr_acc_active
FROM
kn_affiliate_points_earn
WHERE
kn_affiliate_points_earn.rec_user = :rec_user
ORDER BY
kn_affiliate_points_earn.rec_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':rec_user', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function tblReferenceUsersByUser() {
		$data = array();
		$sql = "SELECT
kn_affiliate_points_earn.rec_relate_ref_user,
df_user.usr_name,
df_user.usr_email,
df_user.usr_phone,
kn_affiliate_level.alvl_name
FROM
kn_affiliate_points_earn
INNER JOIN df_user ON kn_affiliate_points_earn.rec_relate_ref_user = df_user.usr_id
INNER JOIN kn_affiliate_user_reference ON kn_affiliate_user_reference.uaf_user = df_user.usr_id
INNER JOIN kn_affiliate_level ON kn_affiliate_user_reference.uaf_level = kn_affiliate_level.alvl_id
WHERE
kn_affiliate_points_earn.rec_user = :rec_user AND
kn_affiliate_points_earn.rec_relate_ref_user IS NOT NULL AND
df_user.usr_status = 1
GROUP BY
kn_affiliate_points_earn.rec_relate_ref_user
ORDER BY
kn_affiliate_points_earn.rec_relate_ref_user ASC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':rec_user', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getLoggedUserStatus() {
		$data = array();
		$sql = "SELECT
df_user.usr_status,
df_user.usr_email,
df_user.usr_last_name,
df_user.usr_first_name,
df_user.usr_id,
df_user.usr_cat_id
FROM
df_user
WHERE
df_user.usr_id = :usr_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
				$usr_email = $row->usr_email;
				$usr_status = $row->usr_status;
				if (isset($_SESSION['usr_status']) && isset($_SESSION['usr_email'])) {
					unset($_SESSION['usr_status']);
					unset($_SESSION['usr_email']);
				}
			}
			$_SESSION['usr_status'] = $usr_status;
			$_SESSION['usr_email'] = $usr_email;
			echo json_encode(array("usr_status" => $usr_status, "usr_email" => $usr_email));
		} catch (Exception $exc) {
			echo $exc->getMessage();
		}
	}

	public function deleteUserByID() {

		$sql = "DELETE FROM `df_user` WHERE (`usr_id`=:usr_id);";
		try {
			$delstmt = $this->con->prepare($sql);
			$delstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			if ($delstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "User delete success"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry ! User delete failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//NEED
	public function passwordChangeByRecovery() {
		$sql = "UPDATE `df_user` SET `usr_pass`= :usr_pass WHERE (`usr_id`=:usr_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':usr_pass', $this->getUsr_pass(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Password changed success"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry ! password change failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//END NEED

	public function profilePasswordChange() {
		$sql = "UPDATE `df_user` SET `usr_pass`= :usr_pass WHERE (`usr_id`=:usr_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':usr_pass', $this->getUsr_pass(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Password changed success"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry ! password change failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//NEED
	public function addUser() {
		$usr_id = $this->getNextAutoIncrementID($this::TBL_USER);
		$sql = "INSERT INTO `df_user` (`usr_pass`, `usr_first_name`, `usr_last_name`, `usr_email`,`usr_phone`, `usr_cat_id`, `usr_username`, `usr_create_date`, `usr_create_time`) VALUES (:usr_pass, :usr_first_name, :usr_last_name, :usr_email,:usr_phone,:usr_cat_id,:usr_username,:usr_create_date,:usr_create_time);";
		$sql_profile = "INSERT INTO `df_profile` (`pro_usr_id`) VALUES (:pro_usr_id);";
		try {
			$this->getCon()->beginTransaction();
			$createstmt = $this->getCon()->prepare($sql);
			$createstmt->bindParam(':usr_pass', $this->getUsr_pass(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_first_name', $this->getUsr_first_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_last_name', $this->getUsr_last_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_cat_id', $this->getUsr_cat_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_create_date', $this->getUsr_create_date(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_create_time', $this->getUsr_create_time(), PDO::PARAM_STR);
			if ($createstmt->execute()) {
				$createstmt2 = $this->getCon()->prepare($sql_profile);
				$createstmt2->bindParam(':pro_usr_id', $usr_id, PDO::PARAM_INT);
				if ($createstmt2->execute()) {
					$this->getCon()->commit();
					echo json_encode(array("msgType" => 1, "msg" => "User saved success", "usr_id" => $usr_id));
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! User save failed"));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! User save failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == "23000") {
				echo json_encode(array("msgType" => 2, "msg" => "Alert! entered value duplicate.change data"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

//END NEED

	public function addUserModel() {
		$usr_id = $this->getNextAutoIncrementID($this::TBL_USER);

		$sql = "INSERT INTO `df_user` (`usr_pass`, `usr_name`, `usr_email`,`usr_phone`, `usr_cat_id`, `usr_username`, `usr_create_date`, `usr_create_time`) VALUES (:usr_pass, :usr_name, :usr_email,:usr_phone,:usr_cat_id,:usr_username,:usr_create_date,:usr_create_time);";
		$sql_profile = "INSERT INTO `df_profile` (`pro_usr_id`) VALUES (:pro_usr_id);";
		$sql_model = "INSERT INTO `ts_models` (`mo_usr_id`) VALUES (:mo_usr_id);";
		try {
			$this->getCon()->beginTransaction();
			$createstmt = $this->getCon()->prepare($sql);
			$createstmt->bindParam(':usr_pass', $this->getUsr_pass(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_name', $this->getUsr_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_cat_id', $this->getUsr_cat_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_create_date', $this->getUsr_create_date(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_create_time', $this->getUsr_create_time(), PDO::PARAM_STR);
			if ($createstmt->execute()) {
				$createstmt2 = $this->getCon()->prepare($sql_profile);
				$createstmt2->bindParam(':pro_usr_id', $usr_id, PDO::PARAM_INT);
				if ($createstmt2->execute()) {
					$createstmt3 = $this->getCon()->prepare($sql_model);
					$createstmt3->bindParam(':mo_usr_id', $usr_id, PDO::PARAM_INT);
					if ($createstmt3->execute()) {
						$this->getCon()->commit();
						echo json_encode(array("msgType" => 1, "msg" => "User saved success", "usr_id" => $usr_id));
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 2, "msg" => "Sorry! User save failed"));
					}
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! User save failed"));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! User save failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//NEED
	public function updateUser() {
		$sql = "UPDATE `df_user` SET `usr_first_name`=:usr_first_name, `usr_last_name`= :usr_last_name, `usr_phone`=:usr_phone, `usr_email` =:usr_email, `usr_username`=:usr_username WHERE `usr_id`=:usr_id;";
		try {
			$createstmt = $this->getCon()->prepare($sql);
			$createstmt->bindParam(':usr_first_name', $this->getUsr_first_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_last_name', $this->getUsr_last_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "User update success"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! User update failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//END NEED

	public function profileUpdate() {
		$profile_sql = "UPDATE `df_profile` SET `pro_fname`=:pro_fname, `pro_lname`=:pro_lname, `pro_gender`=:pro_gender, `pro_age`=:pro_age, `pro_paypal_email`=:pro_paypal_email, `pro_dob`=:pro_dob, `pro_address`=:pro_address, `pro_country`=:pro_country, `pro_city`=:pro_city, `pro_state`=:pro_state, `pro_zip`=:pro_zip, `pro_taxpayid`=:pro_taxpayid WHERE (`pro_usr_id`=:usr_id);
";
		try {
//update profile
			$this->getCon()->beginTransaction();
			$creatprofiletbl = $this->getCon()->prepare($profile_sql);
			$creatprofiletbl->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			$creatprofiletbl->bindParam(':pro_fname', $this->getPro_fname(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_lname', $this->getPro_lname(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_gender', $this->getPro_gender(), PDO::PARAM_INT);
			$creatprofiletbl->bindParam(':pro_age', $this->getPro_age(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_paypal_email', $this->getPro_paypal_email(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_dob', $this->getPro_dob(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_address', $this->getPro_address(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_country', $this->getPro_country(), PDO::PARAM_INT);
			$creatprofiletbl->bindParam(':pro_city', $this->getPro_city(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_state', $this->getPro_state(), PDO::PARAM_INT);
			$creatprofiletbl->bindParam(':pro_zip', $this->getPro_zip(), PDO::PARAM_STR);
			$creatprofiletbl->bindParam(':pro_taxpayid', $this->getPro_taxpayid(), PDO::PARAM_STR);
			if ($creatprofiletbl->execute()) {
				$this->getCon()->commit();
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Edited"));
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry ! Model update failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//NEED
	public function profileUpdateFront() {
		$sql = "UPDATE `df_user` SET `usr_first_name`=:usr_first_name, `usr_last_name`= :usr_last_name, `usr_phone`=:usr_phone, `usr_email` =:usr_email WHERE `usr_id`=:usr_id;";
		try {
			$createstmt = $this->getCon()->prepare($sql);
			$createstmt->bindParam(':usr_first_name', $this->getUsr_first_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_last_name', $this->getUsr_last_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Profile Updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry ! Unable to update profile"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//END NEED

	public function ImageAvailability($dir) {
		$file_availability = false;
		$ar = glob("$dir/*");
		$i = 0;
		foreach ($ar as $arv) {
			if ("$dir/thumbnail" != $arv) {
				$i++;
			}
		}
		if ($i != 0) {
			$file_availability = true;
		}
		return $file_availability;
	}

	public function userProfileActivation($usr_refusr_email) {
		$data = array();
		$profile_sql = "UPDATE `df_profile` SET `pro_fname`=:pro_fname, `pro_lname`=:pro_lname WHERE (`pro_usr_id`=:usr_id);";
		$user_sql = "UPDATE `df_user` SET `usr_name`=:usr_name, `usr_email`= :usr_email, `usr_phone`=:usr_phone, `usr_status`='1', usr_confirm_code = '#', `usr_phone_verified`='0' WHERE (`usr_id`= :usr_id)";
		$user_search_sql = "SELECT
df_user.usr_id,
df_user.usr_email,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_name
FROM
df_user
WHERE
df_user.usr_id = :usr_id AND
df_user.usr_confirm_code = :usr_confirm_code AND
df_user.usr_status = 0";
		try {
			$readUserStmt = $this->getCon()->prepare($user_search_sql);
			$readUserStmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			$readUserStmt->bindParam(':usr_confirm_code', $this->getUsr_confirm_code(), PDO::PARAM_STR);
			$readUserStmt->execute();
			$count = $readUserStmt->rowCount();
			if ($count == 0) {
				echo json_encode(array("msgType" => 2, "msg" => "Failed Activation,Try Again"));
			} else {

				$this->getCon()->beginTransaction();
				$creatprofiletbl = $this->getCon()->prepare($profile_sql);
				$creatprofiletbl->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
				$creatprofiletbl->bindParam(':pro_fname', $this->getPro_fname(), PDO::PARAM_STR);
				$creatprofiletbl->bindParam(':pro_lname', $this->getPro_lname(), PDO::PARAM_STR);
//					$creatprofiletbl->bindParam(':pro_gender', $this->getPro_gender(), PDO::PARAM_INT);
//					$creatprofiletbl->bindParam(':pro_age', $this->getPro_age(), PDO::PARAM_STR);
//					$creatprofiletbl->bindParam(':pro_dob', $this->getPro_dob(), PDO::PARAM_STR);
//					$creatprofiletbl->bindParam(':pro_address', $this->getPro_address(), PDO::PARAM_STR);
//					$creatprofiletbl->bindParam(':pro_country', $this->getPro_country(), PDO::PARAM_INT);
//					$creatprofiletbl->bindParam(':pro_city', $this->getPro_city(), PDO::PARAM_STR);
//					$creatprofiletbl->bindParam(':pro_state', $this->getPro_state(), PDO::PARAM_INT);
//					$creatprofiletbl->bindParam(':pro_zip', $this->getPro_zip(), PDO::PARAM_STR);
				if ($creatprofiletbl->execute()) {
					$creatuser = $this->getCon()->prepare($user_sql);
					$creatuser->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
//						$creatuser->bindParam(':usr_verify_id_type', $this->getUsr_verify_id_type(), PDO::PARAM_INT);
					$creatuser->bindParam(':usr_name', $this->getUsr_name(), PDO::PARAM_STR);
					$creatuser->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
					$creatuser->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
					if ($creatuser->execute()) {
						$this->getCon()->commit();
						while ($row = $readUserStmt->fetch(PDO::FETCH_OBJ)) {
							$_SESSION['usr_id'] = $row->usr_id;
							$_SESSION['usr_name'] = $row->usr_name;
							$_SESSION['usr_username'] = $row->usr_username;
							$_SESSION['usr_email'] = $row->usr_email;
							$_SESSION['usr_cat_id'] = $row->usr_cat_id;
							$this->setFlag(true);
						}
						if ($this->getFlag()) {
							echo json_encode(array("msgType" => 1, "msg" => "Successfully activated your Account.Please wait for navigate to dashboard..."));
						} else {
							echo json_encode(array("msgType" => 2, "msg" => "Successfully activated your Account.Now you can access your account"));
						}
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 3, "msg" => "Failed Activation,Please Contact Us.."));
					}
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 3, "msg" => "Failed Activation,Please Contact Us.."));
				}
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 3, "msg" => $exc->getMessage()));
		}
//		} else {
//			echo json_encode(array("msgType" => 3, "msg" => "ID Verification Failed !,Please Upload your relevent ID card for verification"));
//		}
	}

	public function autopassowrdreset() {
		$count = 0;
		$sql = "SELECT
df_user.usr_id,
df_user.usr_pass,
df_user.usr_first_name,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_create_date,
df_user.usr_create_time
FROM
df_user
WHERE
df_user.usr_email = :usr_email";
		$passResetSql = "UPDATE `df_user` SET `usr_confirm_code`= :usr_autoresetpass, `usr_pass` = :usr_pass WHERE (`usr_id`= :usr_id);";
		try {
			$readstmt = $this->getCon()->prepare($sql);
			$readstmt->bindParam(":usr_email", $this->getUsr_email(), PDO::PARAM_STR);
			$readstmt->execute();
			$count = $readstmt->rowCount();
			if ($count == 0) {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry user not available.Please recheck your email address"));
			} else {
				while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
					$to = $row->usr_email;
					$pass = "reset" . $row->usr_id . "dot" . mt_rand(1000, 9999);
					$this->setUsr_pass($pass);
					$this->getCon()->beginTransaction();
					$resetStmt = $this->getCon()->prepare($passResetSql);
					$resetStmt->bindParam(":usr_id", $row->usr_id, PDO::PARAM_INT);
					$resetStmt->bindParam(":usr_autoresetpass", $pass, PDO::PARAM_STR);
					$resetStmt->bindParam(":usr_pass", $this->getUsr_pass(), PDO::PARAM_STR);
					if ($resetStmt->execute()) {
						$from_name = "groceryhero";
						$from_mail = "admin@groceryhero.com";
						$mail_subject = 'GroceryHero Reset password request';
						$encoding = "utf-8";
						$subject_preferences = array(
							"input-charset" => $encoding,
							"output-charset" => $encoding,
							"line-length" => 76,
							"line-break-chars" => "\r\n"
						);
						$header = "Content-type: text/html; charset=" . $encoding . " \r\n";
						$header .= "From: " . $from_name . " <" . $from_mail . "> \r\n";
						$header .= "MIME-Version: 1.0 \r\n";
						$header .= "Content-Transfer-Encoding: 8bit \r\n";
						$header .= "Date: " . date("r (T)") . " \r\n";
						$header .= iconv_mime_encode("Subject", $mail_subject, $subject_preferences);
						$message = '<html>';
						$message .= '<body>';
						$message .= '<h2>GroceryHero Reset password request</h2><br>';
						$message .= '<p>Click this link to reset your password of  GroceryHero <a href="https://covidhelpapp.ruwanjayawardena.com/resetpass.php?usr_id=' . $row->usr_id . '&usr_autoresetpass=' . $pass . '">Reset Password</a></p>';
						$message .= '</body>';
						$message .= '</html>';
						if (mail($to, $mail_subject, $message, $header)) {
							$this->getCon()->commit();
							echo json_encode(array("msgType" => 1, "msg" => "Password reset request sent.Please check your email", "usr_id" => $row->usr_id, "pass" => pass));
						} else {
							$this->getCon()->rollBack();
							echo json_encode(array("msgType" => 2, "msg" => "Password reset request failed.Please contact us"));
						}
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 2, "msg" => "Sorry, you can not reset your password"));
					}
				}
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//NEED
	public function facebookLogin() {
		try {
			$readstmt = $this->con->prepare("SELECT
df_user.usr_id,
df_user.usr_first_name,
df_user.usr_cat_id,
df_user.usr_username
FROM
df_user
WHERE
df_user.usr_status = 1 AND
df_user.usr_email = :usr_email");
			$readstmt->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
				if ($this->getUsr_pass() == $row->usr_pass) {
					$_SESSION['usr_id'] = $row->usr_id;
					$_SESSION['usr_first_name'] = $row->usr_first_name;
					$_SESSION['usr_username'] = $row->usr_username;
					$_SESSION['usr_cat_id'] = $row->usr_cat_id;
					$this->setUsr_cat_id($row->usr_cat_id);
					$this->setFlag(true);
				}
			}
			if ($this->getFlag()) {
				echo json_encode(array("msgType" => 1, "msg" => "Welcome, Login Successfull!", "usr_cat_id" => $this->getUsr_cat_id()));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Inavalid login ! Please check your username/password"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function login() {
		try {
			$readstmt = $this->con->prepare("SELECT
df_user.usr_id,
df_user.usr_pass,
df_user.usr_first_name,
df_user.usr_username,
df_user.usr_cat_id
FROM
df_user
WHERE
(df_user.usr_username = :usr_username)");
			$readstmt->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
				if ($this->getUsr_pass() == $row->usr_pass) {
					$_SESSION['usr_id'] = $row->usr_id;
					$_SESSION['usr_first_name'] = $row->usr_first_name;
					$_SESSION['usr_username'] = $row->usr_username;
					$_SESSION['usr_cat_id'] = $row->usr_cat_id;
					$this->setUsr_cat_id($row->usr_cat_id);
					$this->setFlag(true);
				}
			}
			if ($this->getFlag()) {
				echo json_encode(array("msgType" => 1, "msg" => "Welcome, Login Successfull!", "usr_cat_id" => $this->getUsr_cat_id()));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Inavalid login ! Please check your username/password"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

//END NEED


	public function resetPassword() {
		$sql = "UPDATE `df_user` SET `usr_pass`= :usr_pass, `usr_confirm_code` = '#' WHERE (`usr_id`=:usr_id AND `usr_confirm_code` = :usr_autoresetpass);";
		try {
			$this->getCon()->beginTransaction();
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':usr_autoresetpass', $this->getUsr_confirm_code(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_pass', $this->getUsr_pass(), PDO::PARAM_STR);
			$createstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				try {
					$readstmt = $this->con->prepare("SELECT
df_user.usr_id,
df_user.usr_pass,
df_user.usr_first_name,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username
FROM
df_user
WHERE
df_user.usr_status = 1 AND df_user.usr_id = :usr_id");
					$readstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
					$readstmt->execute();
					while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
						$_SESSION['usr_id'] = $row->usr_id;
						$_SESSION['usr_first_name'] = $row->usr_first_name;
						$_SESSION['usr_username'] = $row->usr_username;
						$_SESSION['usr_cat_id'] = $row->usr_cat_id;
						$usr_cat_id = $row->usr_cat_id;
						$this->setFlag(true);
					}
					if ($this->getFlag()) {
						$this->getCon()->commit();
						echo json_encode(array("msgType" => 1, "msg" => "Password successfully recovered", "usr_cat_id" => $usr_cat_id));
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 2, "msg" => "Sorry, Password couldn't recover"));
					}
				} catch (Exception $exc) {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry, Password recovery process failed."));
			}
		} catch (Exception $exc) {
			$this->getCon()->rollBack();
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function autosignin() {
		try {
			$readstmt = $this->con->prepare("SELECT
df_user.usr_id,
df_user.usr_pass,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_first_name,
df_user.usr_create_date,
df_user.usr_create_time
FROM
df_user
WHERE
df_user.usr_status = 1 AND df_user.usr_id = :usr_id");
			$readstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
				$_SESSION['usr_id'] = $row->usr_id;
				$_SESSION['usr_first_name'] = $row->usr_first_name;
				$_SESSION['usr_username'] = $row->usr_username;
				$_SESSION['usr_cat_id'] = $row->usr_cat_id;
				$this->setFlag(true);
			}
			if ($this->getFlag()) {
				echo "1";
			} else {
				echo "0";
			}
		} catch (Exception $exc) {
			echo "0";
		}
	}

	public function checkUserActivation() {
		try {
			$readstmt = $this->con->prepare("SELECT
df_user.usr_id,
df_user.usr_pass,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_status,
df_user.usr_cat_id,
df_user.usr_username,
df_user.usr_first_name,
df_user.usr_create_date,
df_user.usr_create_time
FROM
df_user
WHERE df_user.usr_id = :usr_id");
			$readstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
			$readstmt->execute();
			$count = $readstmt->rowCount();
			if ($count) {
				while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
					if ($row->usr_status == 1) {
						echo json_encode(array("activeStatus" => 1, "usr_email" => $row->usr_email));
					} else if ($row->usr_status == 0) {
						echo json_encode(array("activeStatus" => 0, "usr_email" => $row->usr_email));
					}
				}
			} else {
				echo json_encode(array("activeStatus" => 99));
			}
		} catch (Exception $exc) {
			echo json_encode(array("activeStatus" => 99));
		}
	}

	public function phoneVerifiedChecker() {
		try {
			$sql = "SELECT
df_user.usr_phone,
df_user.usr_phone_verified
FROM
df_user
WHERE
df_user.usr_id = :usr_id";
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
				$usr_phone = $row->usr_phone;
				$usr_phone_verified = $row->usr_phone_verified;
			}
			echo json_encode(array("usr_phone_verified" => $usr_phone_verified, "usr_phone" => $usr_phone));
		} catch (Exception $exc) {
			echo $exc->getMessage();
		}
	}

	public function viewUserProfileVerifyID() {
		$directory = "../../asset_imageuploader/IDVerify/" . $_SESSION['usr_id'] . "/";
		$files = scandir($directory);
		$files = array_diff($files, ['.', '..', 'thumbnail']);
		$files = array_values(array_filter($files));
		if ($files[0] == NULL) {
			echo "#";
		} else {
			echo $files[0];
		}
	}

	public function phoneVerificationCodeSend() {
		try {
			$usr_phone = $this->getUsr_phone();
			$usr_confirm_code = mt_rand(1000, 9999); //phone
			$sid = 'AC4d31d4dc2488e599884e2c4592c414f1';
			$token = '848f6e20427598ba2e4f3ddc6b63087f';
			$client = new Client($sid, $token);
			$twilio_number = "+14159961226";
			$response = $client->messages->create("'" . $usr_phone . "'", array('from' => $twilio_number, 'body' => 'tsxxxads.com.com - your phone verification code is ' . $usr_confirm_code));
//print_r($response);
			if ($response) {
				echo json_encode(array("msgType" => 1, "msg" => "Your Activation code Sent to " . $usr_phone . ".Please enter your verification code for verify phone number", "usr_confirm_code" => $usr_confirm_code));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Your Activation code sending failed.Please check your phone number and try again"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => "Your Activation code sending failed.Please check your phone number and try again"));
		}
	}

	public function verifyPhoneCode() {
		$sql = "UPDATE `df_user` SET `usr_phone`= :usr_phone, `usr_phone_verified`='1' WHERE (`usr_id`=:usr_id);";
		try {
			$creatstmt = $this->getCon()->prepare($sql);
			$creatstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
			$creatstmt->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
			if ($creatstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Verified"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry ! Verification Process Failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

}
