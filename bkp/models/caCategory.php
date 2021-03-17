<?php

/**
 * @author Ruwan Jayawardena
 */
include '../dbconfig/connectDB.php';

class CaCategory extends ConnectDB {

	private $flag = false;
	private $cat_id;
	private $cat_name;

	public function getFlag() {
		return $this->flag;
	}

	public function getCat_id() {
		return $this->cat_id;
	}

	public function getCat_name() {
		return $this->cat_name;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
		return $this;
	}

	public function setCat_id($cat_id) {
		$this->cat_id = $cat_id;
		return $this;
	}

	public function setCat_name($cat_name) {
		$this->cat_name = $cat_name;
		return $this;
	}

	public function allCategory() {
		$data = array();
		$sql = "SELECT
cv_errand_category.cat_id,
cv_errand_category.cat_name
FROM
cv_errand_category
ORDER BY
cv_errand_category.cat_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->execute();
			$i = 0;
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[$i] = $row;
				$directory = "../../asset_imageuploader/caCategory/" . $row['cat_id'] . "/";
				$files = scandir($directory);
				$files = array_diff($files, ['.', '..', 'thumbnail']);
				$files = array_values(array_filter($files));
				if ($files[0] == NULL) {
					$data[$i]['cat_img'] = "#";
				} else {
					$data[$i]['cat_img'] = $files[0];
				}
				$i++;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function tblCategory() {
		$data = array();
		$sql = "SELECT
cv_errand_category.cat_id,
cv_errand_category.cat_name
FROM
cv_errand_category
ORDER BY
cv_errand_category.cat_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->execute();
			$i = 0;
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[$i] = $row;
				$directory = "../../asset_imageuploader/caCategory/" . $row['cat_id'] . "/";
				$files = scandir($directory);
				$files = array_diff($files, ['.', '..', 'thumbnail']);
				$files = array_values(array_filter($files));
				if ($files[0] == NULL) {
					$data[$i]['cat_img'] = "#";
				} else {
					$data[$i]['cat_img'] = $files[0];
				}
				$i++;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbCategory() {
		$data = array();
		$sql = "SELECT
cv_errand_category.cat_id,
cv_errand_category.cat_name
FROM
cv_errand_category
ORDER BY
cv_errand_category.cat_name ASC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->execute();
			$i = 0;
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[$i] = $row;
				$directory = "../../asset_imageuploader/caCategory/" . $row['cat_id'] . "/";
				$files = scandir($directory);
				$files = array_diff($files, ['.', '..', 'thumbnail']);
				$files = array_values(array_filter($files));
				if ($files[0] == NULL) {
					$data[$i]['cat_img'] = "#";
				} else {
					$data[$i]['cat_img'] = $files[0];
				}
				$i++;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getCategoryByID() {
		$data = array();
		$sql = "SELECT
cv_errand_category.cat_id,
cv_errand_category.cat_name
FROM
cv_errand_category
WHERE
cv_errand_category.cat_id = :cat_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':cat_id', $this->getCat_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}
	
	public function getCategoryIDByName() {
		$cat_id = 0;
		$sql = "SELECT
cv_errand_category.cat_id
FROM
cv_errand_category
WHERE
cv_errand_category.cat_name = :cat_name";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':cat_name', $this->getCat_name(), PDO::PARAM_STR);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
				$cat_id = $row->cat_id;
			}
			echo $cat_id;
		} catch (Exception $exc) {
			echo $cat_id;
		}
	}

	public function addCategory() {
		$sql = "INSERT INTO `cv_errand_category` (`cat_name`) VALUES (:cat_name);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':cat_name', $this->getCat_name(), PDO::PARAM_STR);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Saved"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! Saving Failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function editCategory() {
		$sql = "UPDATE `cv_errand_category` SET  `cat_name`=:cat_name WHERE (`cat_id` = :cat_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':cat_name', $this->getCat_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':cat_id', $this->getCat_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! Updating Failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function removeCategory() {
		$sql = "DELETE FROM `cv_errand_category` WHERE (`cat_id` = :cat_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':cat_id', $this->getCat_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! Deleting Failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

}
