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

if(!empty($_POST['action']) && $_POST['action'] == 'listSpec') {
	$inventory->getSpecList();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getInventoryList') {
	$inventory->getInventoryList();
}

if(!empty($_POST['action']) && $_POST['action'] == 'getExpireList') {
	$inventory->getExpireList();
}