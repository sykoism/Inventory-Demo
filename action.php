<?php
session_start();
include 'function.php';
$inventory = new Inventory();

if(!empty($_GET['action']) && $_GET['action'] == 'logout') {
	session_unset();
	session_destroy();
	header("Location:index.php");
}

if(!empty($_POST['action']) && $_POST['action'] == 'getSupplierList') {
	$inventory->getSupplierList();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getSpecList') {
	$inventory->getSpecList();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getInventoryList') {
	$inventory->getInventoryList();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getExpireList') {
	$inventory->getExpireList();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getExamList') {
	$inventory->getExamList();
}

if(!empty($_POST['btn_action']) && $_POST['btn_action'] == 'newExamForm') {
	$inventory->newExamForm();
}

if(!empty($_POST['btn_action']) && $_POST['btn_action'] == 'updateExamInfo') {
	$inventory->updateExamInfo();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getExamInfo') {
	$inventory->getExamInfo();
}