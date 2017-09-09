<?php
!defined('EMLOG_ROOT') && exit('access deined!');
function plugin_setting_view() {
$DB=Database::getInstance();
}
?>
<div class="heading-bg  card-views">
<ul class="breadcrumbs">
 <li><a href="./"><i class="fa fa-home"></i> <?php echo langs('home') ?></a></li>
<li class="active">来访记录</li>
 </ul>
</div>
<style>
#bot{width:100%}
#bot li{width:50%; float: left;display: block;}
</style>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">
<div class="panel-body"> 
<div class="form-group text-center">
<div id="bot">
<?php
$mode = "/(cpu)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)/";
$string=shell_exec("more /proc/stat");
preg_match_all($mode,$string,$arr);
//print_r($arr);
$total1=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[5][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
$time1=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
sleep(1);
$string=shell_exec("more /proc/stat");
preg_match_all($mode,$string,$arr);
$total2=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[5][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
$time2=$arr[2][0]+$arr[3][0]+$arr[4][0]+$arr[6][0]+$arr[7][0]+$arr[8][0]+$arr[9][0];
$time=$time2-$time1;
$total=$total2-$total1;
echo "<li>CPU总量: ".$num;
$str=shell_exec("more /proc/meminfo");
$mode="/(.+):\s*([0-9]+)/";
preg_match_all($mode,$str,$arr);
$pr=bcdiv($arr[2][1],$arr[2][0],3);
$pr=1-$pr;
$pr=$pr*100;
echo $pr."%";
$percent=bcdiv($time,$total,3);
$percent=$percent*100;
echo "</li><li>CPU占用: ".$percent."% </li>";
?></div>
</div>
</div>
</div>
</div>
</div>    
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">	
<div class="table-wrap ">
<div class="table-responsive">		
<table  class="table table-striped table-bordered mb-0">
<thead>
<tr>
<?php
$DB=Database::getInstance();
$sql="select `botname` from " . DB_PREFIX . "bot where `botname`='Baidu' or `botname`='Google'  or `botname`='Sogou' or `botname`='Yahoo' or `botname`='Youdao' or `botname`='360' or `botname`='MSN' or `botname`='Bing' or `botname`='Ahrefs' or `botname`='Yandex' or `botname`='Yisou' group by `botname` ASC";
$result= $DB->query($sql);
 if($row=$DB->num_rows($result)!=0){
while($row=$DB->fetch_array($result)){
?>
<?php if($row['botname']=="Baidu"){ ?> 
<th width="50" class="tdcenter"><b>Baidu</b></th>
<?php }elseif($row['botname']=="Google"){ ?> 
<th width="50" class="tdcenter"><b>Google</b></th>
<?php }elseif($row['botname']=="Sogou"){ ?> 
<th width="50" class="tdcenter"><b>sogou</b></th>
<?php }elseif($row['botname']=="Yahoo"){ ?> 
<th width="50" class="tdcenter"><b>Yahoo</b></th>
<?php }elseif($row['botname']=="Youdao"){ ?> 
<th width="50" class="tdcenter"><b>Youdao</b></th>
<?php }elseif($row['botname']=="360"){ ?> 
<th width="50" class="tdcenter"><b>360</b></th>
<?php }elseif($row['botname']=="MSN"){ ?> 
<th width="50" class="tdcenter"><b>MSN</b></th>
<?php }elseif($row['botname']=="Bing"){ ?> 
<th width="50" class="tdcenter"><b>Bing</b></th>
<?php }elseif($row['botname']=="Yandex"){ ?> 
<th width="50" class="tdcenter"><b>Yandex</b></th>
<?php }elseif($row['botname']=="Ahrefs"){ ?> 
<th width="50" class="tdcenter"><b>Ahrefs</b></th>
<?php }elseif($row['botname']=="Yisou"){ ?> 
<th width="50" class="tdcenter"><b>Yisou</b></th>
<?php } }?>
</tr>
</thead>
<tr>
<?php
$DB=Database::getInstance();
$sql="select `botname`,count(`botname`) as count from " . DB_PREFIX . "bot where `botname`='Baidu' or `botname`='Google'  or `botname`='Sogou' or `botname`='Yahoo' or `botname`='Youdao' or `botname`='360' or `botname`='MSN' or `botname`='Bing'  or `botname`='Ahrefs' or `botname`='Yandex' or `botname`='Yisou' group by `botname` ASC ";
$result= $DB->query($sql);
while($row=$DB->fetch_array($result)){
?>
<?php if($row['botname']=="Baidu"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Google"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Sogou"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Yahoo"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Youdao"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="360"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="MSN"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Bing"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Yandex"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Ahrefs"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Yisou"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php } ?>
<?php  } ?>
<?php }else{ ?>
<td class="tdcenter">暂无记录,请耐心等待一段时间再来查询！</td>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
<h6 class="panel-title txt-dark">区域统计</h6>
</div>
<div class="pull-right">
<a href="#" class="pull-left inline-block full-screen mr-15">
<i class="zmdi zmdi-fullscreen"></i>
</a>
<a href="#" class="pull-left inline-block close-panel" data-effect="fadeOut">
<i class="zmdi zmdi-close"></i>
</a>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<div id="world_map" style="height: 300px"></div>
</div>
</div>
</div>
</div>
</div>
 <div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="pull-left">
<h6 class="panel-title txt-dark">浏览器统计</h6>
</div>
<div class="pull-right">
<a href="#" class="pull-left inline-block close-panel" data-effect="fadeOut">
<i class="zmdi zmdi-close"></i>
</a>
</div>
<div class="clearfix"></div>
</div>
<div class="panel-wrapper collapse in">
<div class="panel-body">
<?php
$DB=Database::getInstance();
$sql="select `id`,`name`,count(`name`) as count from " . DB_PREFIX . "tourist group by `name`";
$result= $DB->query($sql);
while($row=$DB->fetch_array($result)){
$input = array('label-success', 'label-primary', 'label-danger', 'label-warning');
$color=array_rand($input);
?>
<span class="pull-left inline-block capitalize-font txt-dark">
<?php echo $row['name'] ?>
</span>
<span class="label <?php echo $input[$color] ?> pull-right"><?php echo $row['count'] / 100 ?> %</span>
<div class="clearfix"></div>
<hr class="light-grey-hr row mt-10 mb-10">
<?php }  ?>
</div>
</div>	
</div>
 <div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">
<div class="panel-wrapper collapse in">
<div class="panel-body sm-data-box-1">
<span class="uppercase-font weight-500 font-14 block text-center txt-dark">距离三千目标</span>
<?php
$DB=Database::getInstance();
$hope=$DB->query("select count(*) as num from `".DB_PREFIX."bot`");	
$r = $DB->fetch_array($hope);
$num = $r["num"];
$yest=$DB->query("select count(*) as yes from `".DB_PREFIX."bot` WHERE TO_DAYS(NOW()) - `date`= 1");	
$y = $DB->fetch_array($yest);
$yesterday=$y["yes"];
$now=$DB->query("select count(*) as now from `".DB_PREFIX."bot` WHERE TO_DAYS(NOW())");	
$n = $DB->fetch_array($now);
$nows=$n["now"];
?>
<div class="cus-sat-stat weight-500 txt-success text-center mt-5">
<span class="counter-anim"><?php echo $num ?></span><span>%</span>
</div>
<div class="progress-anim mt-20">
<div class="progress">
<div class="progress-bar progress-bar-success wow animated progress-animated" role="progressbar" aria-valuenow="<?php echo $num ?>" aria-valuemin="0" aria-valuemax="3000"></div>
</div>
</div>
<ul class="flex-stat mt-5">
<li class="half-width">
<span class="block">以前</span>
<span class="block txt-dark weight-500 font-15">
<i class="zmdi zmdi-trending-up txt-success font-20 mr-10"></i><?php echo $yesterday ?>
</span>
</li>
<li class="half-width">
<span class="block">今天</span>
<span class="block txt-dark weight-500 font-15">+<?php echo $nows ?></span>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">
<div class="panel-body">  
<div style="color:red">温馨提示:</div>
以下蜘蛛当数据达到3000条将自动初始化,当然你们也可以手动初始化
</div>
<div class="form-group" style="padding-top:6px">
<a href="../content/plugins/spider-bot-master/spider-bot-do.php?reset=reset&token=<?php echo LoginAuth::genToken(); ?>" class="btn btn-info">初始化</a>
</div>
</div>
</div>
</div>    
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">	
<div class="table-wrap ">
<div class="table-responsive">		
<table id="adm_link_list"  class="table table-striped table-bordered mb-0">
<thead>
<tr>
<th width="50" class="tdcenter"><b>序号</b></th>
<th width="80"><b>蜘蛛名称</b></th>
<th width="240"><b>查看抓取</b></th>
<th width="100" class="tdcenter"><b>来路</b></th>
<th width="80"><b>来访时间</b></th>
<th width="50" class="tdcenter"><b>操作</b></th>
</tr>
</thead>
<tbody>
<?php
       $DB=Database::getInstance();
	$page=max(1,intval($_GET['page']));
	$pagenum=20;
	$count=$DB->once_fetch_array("select count(*) as num from `".DB_PREFIX."bot` ");	
	$query=$DB->query("select * from `".DB_PREFIX."bot` order by date desc limit ".(($page-1)*$pagenum).",$pagenum");
	$pageurl =  pagination($count['num'],$pagenum,$page,"plugin.php?plugin=spider-bot-master&page=");
if($count['num']){
$i=($page-1)*$pagenum;
while($data=$DB->fetch_array($query)){
$i++;
if($i >="3000"){
$DB->query("TRUNCATE TABLE ". DB_PREFIX ."bot");
$DB->query("TRUNCATE TABLE ". DB_PREFIX ."tourist");
$CACHE->updateCache();
}
?>  
<tr>
<td class="tdcenter"><?php echo $i;?></td>
<td><?php echo $data['botname'];?></td>
<td class="tdcenter"><a href="<?php echo $data['botlasturl'];?>" target="_blank"><img src="./views/images/vlog.gif" align="absbottom" border="0" /></a></td>
<td class="tdcenter">
<?php echo $data['serverip'] ?>
</td>
<td>
<?php echo date("Y-m-d h:i",$data['date']);?>
</td>
<td class="tdcenter">
<a href="../content/plugins/spider-bot-master/spider-bot-do.php?dele=<?php echo $data['id'];?>&token=<?php echo LoginAuth::genToken(); ?>">删除</a>
</td>
</tr>
<?php
}
}else{
echo '<tr class="tdcenter"><td colspan="6">暂无记录,请耐心等待一段时间再来查询！</td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php if(!empty($pageurl)){ ?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default card-view">
<div class="panel-heading">
<div class="form-group text-center">
 <div id="pagenav">
 <?php echo $pageurl; ?>
</div>
</div>
</div>
</div>			
</div>
</div>
<?php }?>
<link href="../content/plugins/spider-bot-master/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css">
<script src="../content/plugins/spider-bot-master/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../content/plugins/spider-bot-master/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script>
      $(function() {
	"use strict";
	if( $('#world_map').length > 0 ){
$('#world_map').vectorMap(
		{
			map: 'world_mill_en',
			backgroundColor: 'transparent',
			borderColor: '#fff',
			borderOpacity: 0.25,
			borderWidth: 0,
			color: '#e6e6e6',
			regionStyle : {
				initial : {
				  fill : 'rgba(86,111,201,.4)'
				}
			  },

			markerStyle: {
			  initial: {
							r: 10,
							'fill': '#fff',
							'fill-opacity':1,
							'stroke': '#000',
							'stroke-width' : 1,
							'stroke-opacity': 0.4
						},
				},
		   

      markers : [
      	<?php
$DB=Database::getInstance();
$sql="select `serverip`,count(`serverip`) as count from " . DB_PREFIX . "tourist where `serverip` ='US' or `serverip` ='CN' or `serverip` ='RU' or `serverip` ='JP' or `serverip` ='ZA'  or `serverip` ='CA' or `serverip` ='TW' or `serverip` ='GL' or `serverip` ='BR'  or `serverip` ='AU' or `serverip` ='AE' or `serverip` ='IN' or `serverip` ='MX'  or `serverip` ='DE'  or `serverip` ='TR' or `serverip` ='ES' or `serverip` ='IT' or `serverip` ='MM' or `serverip` ='PL'  or `serverip` ='RO' or `serverip` ='SG' or `serverip` ='IE'   or `serverip` ='KR' or `serverip` ='DZ'   or `serverip` ='MY' or `serverip` ='GB' group by `serverip`";
$result= $DB->query($sql);
while($row=$DB->fetch_array($result)){
?>
{
<?php if($row['serverip']=="US"){ ?> 
latLng : [40.77, -109.41],
name : '美国 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="CN"){ ?> 
latLng : [32.21,103.55],
name : '中国 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="RU"){ ?> 
latLng : [65.75,107.62],
name : '俄罗斯 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="JP"){ ?> 
latLng : [35.36,138.72],
name : '日本 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="ZA"){ ?> 
latLng : [-24.45,27.55],
name : '奥莱夫 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="CA"){ ?> 
latLng : [61.54,-104.104],
name : '加拿大 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="TW"){ ?> 
latLng : [25.10,121.59],
name : '台湾 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="GL"){ ?> 
latLng : [60.91,-46.05],
name : '格陵兰 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="BR"){ ?> 
latLng : [-18.59,-48.55],
name : '巴西 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="AU"){ ?> 
latLng : [-38.54,143.97],
name : '澳大利亚 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="AE"){ ?> 
latLng : [23.27,53.29],
name : '联合酋长国 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="IN"){ ?> 
latLng : [23.98,77.70],
name : '印度: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="MX"){ ?> 
latLng : [19.43,-99.202],
name : '墨西哥: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="DE"){ ?> 
latLng : [50.36,7.58],
name : '德国: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="TR"){ ?> 
latLng : [38.02,30.93],
name : '土耳其: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="ES"){ ?> 
latLng : [40.49,-3.88],
name : '西班牙: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="IT"){ ?> 
latLng : [41.89,12.44],
name : '意大利: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="MM"){ ?> 
latLng : [20.36,93.27],
name : '缅甸: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="PL"){ ?> 
latLng : [51.27,19.03],
name : '波兰: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="RO"){ ?> 
latLng : [45.16,25.63],
name : '罗马尼亚: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="SG"){ ?> 
latLng : [1.29,103.85],
name : '新加坡: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="IE"){ ?> 
latLng : [53.35,-6.25],
name : '爱尔兰: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="KR"){ ?> 
latLng : [35.12,129.09],
name : '韩国: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="DZ"){ ?> 
latLng : [26.45,7.42],
name : '阿尔及利亚: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="MY"){ ?> 
latLng : [4.34,118.56],
name : '马来西亚: <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="GB"){ ?> 
latLng : [53.75,-0.31],
name : '联合王国: <?php echo $row['count']?>'

<?php }?>
},
<?php }?>
],
series: {
regions: [{
values: {
"US": '#469408',
"CN": '#e69a2a',
"RU": '#177ec1',
"JP": '#dc4666',
"CA": '#ea6c41',
"ZA": '#ga6c41',
"TW": '#177ec1',
"GL": '#A52A2A	',
"BR": '#1E90FF',
"AU": '#4169E1	',
"AE": '#8B008B	',
"IN": '#ea6c41',
"MX": '#00ffbf',
"DE": '#ff0000',
"TR": '#0000ff',
"ES": '#ffff00',
"PL": '#708090',
"IT": '#4B0082',
"MM": '#F4A460',
"NI": '#DC143C',
"RO": '#A52A2A',
"KR": '#800000',
"IE": '#2F4F4F',
"MA":'#D2691E',
"CY":'#000000',
"DZ":'#3D9970',
"MY":'#B10DC9',
"GB":'#39CCCC',
},
attribute: 'fill'
}]
},
			hoverOpacity: null,
			normalizeFunction: 'linear',
			zoomOnScroll: false,
			scaleColors: ['#000000', '#000000'],
			selectedColor: '#000000',
			selectedRegions: [],
			enableZoom: false,
			hoverColor: '#fff',
		});
	}
      });
$("#menu_mg").addClass('active');
$("#spider-bot").addClass('active-page');
setTimeout(hideActived,2600);
</script>
<?php
function plugin_setting() {

}
?>