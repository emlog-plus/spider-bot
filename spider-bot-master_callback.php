<?php
!defined('EMLOG_ROOT') && exit('fuck♂you');
//插件激活
function callback_init() {
	$sql ="
create table if not exists `".DB_PREFIX."tourist` (
`id` int(10) unsigned NOT NULL auto_increment,
`name` varchar(100) NOT NULL default '',
`date` int(10) NOT NULL default '0',
`serverip` varchar(200) NOT NULL default '',
UNIQUE KEY `id` (`id`),
KEY `tourist` (`name`)
)ENGINE=MyISAM;";
$sql2=" 
create table if not exists `".DB_PREFIX."bot` (`id` int(10) unsigned NOT NULL auto_increment,
`botname` varchar(100) NOT NULL default '',
`date` int(10) NOT NULL default '0',
`botlasturl` varchar(250) NOT NULL default '',
`serverip` varchar(200) NOT NULL default '',
`brower` varchar(250) NOT NULL default '',
UNIQUE KEY `id` (`id`),
KEY `bot` (`botname`)
) ENGINE=MyISAM;";
	$DB = Database::getInstance();
	$DB->query($sql);
	$DB->query($sql2);
}
//插件禁用事件
function callback_rm(){
$DB = Database::getInstance();
$query = $DB->query("DROP TABLE IF EXISTS ".DB_PREFIX."tourist");
$queryII = $DB->query("DROP TABLE IF EXISTS ".DB_PREFIX."bot");
}
?>