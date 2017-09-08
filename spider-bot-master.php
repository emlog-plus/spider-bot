<?php
/*
Plugin Name: 来访记录
Version: 1.3
ForEmlog:6.0+
Plugin URL:https://crazyus.ga
Description: 本插件可以实时对搜索引擎来访进行统计，指导站长的运营，来访的蜘蛛类型和访问的页面都能在后台一目了然！
Author: Flyer
Author URL: https://crazyus.ga
Author Email: gao.eison@gmail.com
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function ailab_spider(){
	 echo '<li><a href="./plugin.php?plugin=spider-bot-master" id="spider-bot">来访记录</a></li>';
}

function sider_stat(){
       $DB = Database::getInstance();
	$QueryString = $_SERVER["QUERY_STRING"]  ;  
	$domain=$_SERVER['HTTP_HOST'];
	$url=$_SERVER['REQUEST_URI'];
	$ip=getIp();
	$date=time();
	$ip_data = @json_decode
(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

 $result = $ip_data->geoplugin_countryCode;
 //$results = $ip_data->geoplugin_city;

  $user_OSagent = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($user_OSagent, "Maxthon") && strpos($user_OSagent, "MSIE")) {
        $visitor_browser = "Maxthon(Microsoft IE)";
    } elseif (strpos($user_OSagent, "Maxthon 2.0")) {
        $visitor_browser = "Maxthon 2.0";
    } elseif (strpos($user_OSagent, "Maxthon")) {
        $visitor_browser = "Maxthon";
    } elseif (strpos($user_OSagent, "Edge")) {
        $visitor_browser = "Edge";
    } elseif (strpos($user_OSagent, "Trident")) {
        $visitor_browser = "IE";
    } elseif (strpos($user_OSagent, "MSIE")) {
        $visitor_browser = "IE";
    } elseif (strpos($user_OSagent, "MSIE")) {
        $visitor_browser = "MSIE 较高版本";
    } elseif (strpos($user_OSagent, "NetCaptor")) {
        $visitor_browser = "NetCaptor";
    } elseif (strpos($user_OSagent, "Netscape")) {
        $visitor_browser = "Netscape";
    } elseif (strpos($user_OSagent, "Chrome")) {
        $visitor_browser = "Chrome";
    } elseif (strpos($user_OSagent, "Lynx")) {
        $visitor_browser = "Lynx";
    } elseif (strpos($user_OSagent, "Opera")) {
        $visitor_browser = "Opera";
    } elseif (strpos($user_OSagent, "Safari")) {
        $visitor_browser = "Safari";
    } elseif (strpos($user_OSagent, "Konqueror")) {
        $visitor_browser = "Konqueror";
    } elseif (strpos($user_OSagent, "Mozilla/5.0")) {
        $visitor_browser = "Mozilla";
    } elseif (strpos($user_OSagent, "Firefox")) {
        $visitor_browser = "Firefox";
    } elseif (strpos($user_OSagent, "U")) {
        $visitor_browser = "Firefox";
    } else {
        $visitor_browser = "其它";
    }
	
	
	if($QueryString !=""){
	$url=$url."?".$QueryString  ; 
	}      
	$GetLocationURL='http://'.$domain.$url;
      	$agent1=$_SERVER['HTTP_USER_AGENT'];
	$agent=strtolower($agent1);
	$Bot ="";
       if (strpos($agent,"bot")>-1)
	{
		$Bot = "Other Crawler";
	}
	if (strpos($agent,"googlebot")>-1)
	{
		$Bot = "Google";
	}           
       if (strpos($agent,"mediapartners-google")>-1)
	{
		$Bot = "Google Adsense";
	}
	if (strpos($agent,"baiduspider")>-1)
	{
		$Bot = "Baidu";
	}
	if (strpos($agent,"sogou spider")>-1)
	{
		$Bot = "Sogou";
	}
	if (strpos($agent,"yahoo")>-1)
	{
		$Bot = "Yahoo";
	}
	if (strpos($agent,"msn")>-1)
	{
		$Bot = "MSN";
	}
	if (strpos($agent,"ia_archiver")>-1)
	{
		$Bot = "Alexa";
	}
	if (strpos($agent,"iaarchiver")>-1)
	{
		$Bot = "Alexa";
	}
	if (strpos($agent,"GotSiteMonitor")>-1)
	{
		$Bot = "GotSite";
	}
	if (strpos($agent,"sqworm")>-1) 
	{
		$Bot = "AOL";
	}
	if (strpos($agent,"yodaoBot")>-1)
	{
		$Bot = "Yodao";
	}
	if (strpos($agent,"iaskspider")>-1)
	{
		$Bot = "Iask";
	}
	if (strpos($agent,"360Spider")>-1)
	{
		$Bot = "360";
	}
	if (strpos($agent,"Sosospider")>-1)
	{
		$Bot = "Soso";
	}
	if (strpos($agent,"lycos")>-1)
	{
		$Bot = "Lycos";
	}
	if (strpos($agent,"bingbot")>-1)
	{
		$Bot = "Bing";
	}
	if (strpos($agent,"robozilla")>-1)
	{
		$Bot = "Robozilla";
	}
	if (strpos($agent,"rambler")>-1)
	{
		$Bot = "Rambler";
	}
	if (strpos($agent,"abachobOT")>-1)
	{
		$Bot = "AbachoBOT";
	}
	if (strpos($agent,"accoona")>-1)
	{
		$Bot = "Accoona";
	}
	if (strpos($agent,"accoona")>-1)
	{
		$Bot = "Accoona";
	}
	if (strpos($agent,"AcoiRobot")>-1)
	{
		$Bot = "AcoiRobot";
	}
	if (strpos($agent,"ASPSeek")>-1)
	{
		$Bot = "ASPSeek";
	}
	if (strpos($agent,"Dumbot")>-1)
	{
		$Bot = "Dumbot";
	}
	if (strpos($agent,"Facebook")>-1)
	{
		$Bot = "Facebook";
	}
	if (strpos($agent,"CrocCrawler")>-1)
	{
		$Bot = "CrocCrawler";
	}
	if (strpos($agent,"FAST-WebCrawler")>-1)
	{
		$Bot = "FAST-WebCrawler";
	}
	if (strpos($agent,"YisouSpider")>-1)
	{
		$Bot = "YisouSpider";
	}
	if (strpos($agent,"AppBeat")>-1)
	{
		$Bot = "AppBeat";
	}
	if (strpos($agent,"PritTorrent")>-1)
	{
		$Bot = "PritTorrent";
	}
	if (strpos($agent,"Anturis Agent")>-1)
	{
		$Bot = "Anturis";
	}
	if (strpos($agent,"AhrefsBot")>-1)
	{
		$Bot = "Ahrefs";
	}
		if (strpos($agent,"yandex")>-1)
	{
		$Bot = "Yandex";
	}
if($GetLocationURL&&$Bot){
$DB->query("insert into `".DB_PREFIX . "bot` (`botname`,`date`,`botlasturl`,`serverip`,`brower`) values ('$Bot','$date','$GetLocationURL',' $result','$visitor_browser')"); 
}else{
$DB->query("insert into `".DB_PREFIX . "tourist` (`name`,`date`,`serverip`) values ('$visitor_browser','$date','$result')"); 
}
return '';
}

addAction('adm_sidebar_ext','ailab_spider');
addAction('index_footer','sider_stat');

?>