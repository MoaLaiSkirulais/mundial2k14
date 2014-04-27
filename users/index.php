<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/system/SysController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/sites/mundial2k10/users/UserCtr.php');

$sysController=new SysController();
$sysController->start();

$ctr=new UserCtr();
$ctr->control();

$sysController->sysLayout->header();
$sysController->ui->display();
$sysController->sysLayout->footer();

$sysController->end();

?>
