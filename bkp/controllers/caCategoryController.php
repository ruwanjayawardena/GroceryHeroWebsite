<?php

/**
 * @author Ruwan Jayawardena
 */
include '../models/caCategory.php';

$ctrl = new CaCategory();
if (array_key_exists("action", $_POST)) {
	if ($_POST['action'] == "addCategory") {
		$ctrl->setCat_name($_POST['cat_name']);
		$ctrl->addCategory();
	} else if ($_POST['action'] == "editCategory") {
		$ctrl->setCat_name($_POST['cat_name']);
		$ctrl->setCat_id($_POST['cat_id']);
		$ctrl->editCategory();
	} else if ($_POST['action'] == "removeCategory") {
		$ctrl->setCat_id($_POST['cat_id']);
		$ctrl->removeCategory();
	} else if ($_POST['action'] == "allCategory") {
		$ctrl->allCategory();
	} else if ($_POST['action'] == "cmbCategory") {
		$ctrl->cmbCategory();
	} else if ($_POST['action'] == "tblCategory") {
		$ctrl->tblCategory();
	} else if ($_POST['action'] == "getCategoryByID") {
		$ctrl->setCat_id($_POST['cat_id']);
		$ctrl->getCategoryByID();
	} else if ($_POST['action'] == "getCategoryIDByName") {
		$ctrl->setCat_name($_POST['cat_name']);
		$ctrl->getCategoryIDByName();
	}
}
