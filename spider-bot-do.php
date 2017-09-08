<?php
require_once('../../../init.php');
$DB = Database::getInstance();
if ($_GET['dele']) {
       LoginAuth::checkToken();
   $id = isset($_GET['dele']) ? intval($_GET['dele']) : '';
	$DB->query("DELETE FROM " . DB_PREFIX . "bot WHERE id = {$id} ");
	$CACHE->updateCache();
	echo "<script>alert('删除成功');location.href = document.referrer;</script>";
}   

if ($_GET['reset']) {
LoginAuth::checkToken();
$DB->query("TRUNCATE TABLE ". DB_PREFIX ."bot");
$DB->query("TRUNCATE TABLE ". DB_PREFIX ."tourist");
$CACHE->updateCache();
echo "<script>alert('初始化成功');location.href = document.referrer;</script>";
}

?>

