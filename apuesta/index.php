<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/system/SysController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/apuesta/ApuestaCtr.php');

$sysController=new SysController();
$sysController->start();

$ctr=new ApuestaCtr();
$ctr->control();

$sysController->sysLayout->header();
$sysController->ui->display();
$sysController->sysLayout->footer();

$sysController->end();
?>
