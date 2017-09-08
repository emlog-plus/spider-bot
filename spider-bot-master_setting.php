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
<div class="col-md-12">
<div class="panel panel-default card-view">
<div class="panel-body"> 
<div class="form-group text-center">
<div id="bot"><?php
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
<div class="col-sm-12">
<div class="panel panel-default card-view">	
<div class="table-wrap ">
<div class="table-responsive">		
<table id="adm_link_list"  class="table table-striped table-bordered mb-0">
<thead>
<tr>
<?php
$sql="select `botname` from " . DB_PREFIX . "bot where `botname`='Baidu' or `botname`='Google'  or `botname`='Sogou' or `botname`='Yahoo' or `botname`='Youdao' or `botname`='360spider' or `botname`='MSN' or `botname`='Bing' or `botname`='Other Crawler' group by `botname`";
$result= $DB->query($sql);
while($row=$DB->fetch_array($result)){
?>
<?php if($row['botname']=="Baidu"){ ?> 
<th width="50" class="tdcenter"><b>百度</b></th>
<?php }elseif($row['botname']=="Google"){ ?> 
<th width="50" class="tdcenter"><b>谷歌</b></th>
<?php }elseif($row['botname']=="Sogou"){ ?> 
<th width="50" class="tdcenter"><b>搜狗</b></th>
<?php }elseif($row['botname']=="Yahoo"){ ?> 
<th width="50" class="tdcenter"><b>雅虎</b></th>
<?php }elseif($row['botname']=="Youdao"){ ?> 
<th width="50" class="tdcenter"><b>有道</b></th>
<?php }elseif($row['botname']=="360spider"){ ?> 
<th width="50" class="tdcenter"><b>360</b></th>
<?php }elseif($row['botname']=="MSN"){ ?> 
<th width="50" class="tdcenter"><b>MSN</b></th>
<?php }elseif($row['botname']=="Bing"){ ?> 
<th width="50" class="tdcenter"><b>Bing</b></th>
<?php }elseif($row['botname']=="Other Crawler"){ ?> 
<th width="50" class="tdcenter"><b>其他</b></th>
<?php } }?>
</tr>
</thead>
<tr>
<?php
$sql="select `botname`,count(`botname`) as count from " . DB_PREFIX . "bot where `botname`='Baidu' or `botname`='Google'  or `botname`='Sogou' or `botname`='Yahoo' or `botname`='Youdao' or `botname`='360spider' or `botname`='MSN' or `botname`='Bing' or `botname`='Other Crawler' group by `botname`";
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
<?php }elseif($row['botname']=="360spider"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="MSN"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Bing"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php }elseif($row['botname']=="Other Crawler"){ ?> 
<td class="tdcenter"><?php echo $row['count'] ?></td>
<?php } ?>
<?php  } ?>
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
<div class="col-md-12">
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
<div class="col-md-12">
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
<div class="col-sm-12">
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
<div class="col-sm-12">
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
$sql="select `serverip`,count(`serverip`) as count from " . DB_PREFIX . "tourist where `serverip` ='US' or `serverip` ='CN' or `serverip` ='RU' or `serverip` ='JP' or `serverip` ='ZA'  or `serverip` ='CA' or `serverip` ='TW' or `serverip` ='GL' or `serverip` ='BR'  or `serverip` ='AU' group by `serverip`";
$result= $DB->query($sql);
while($row=$DB->fetch_array($result)){
?>

      {
<?php if($row['serverip']=="US"){ ?> 
latLng : [36.77, -119.41],
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
latLng : [-27.59,-48.55],
name : '巴西 : <?php echo $row['count']?>'
<?php }elseif($row['serverip']=="AU"){ ?> 
latLng : [47.33,11.18],
name : '澳大利亚 : <?php echo $row['count']?>'
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
"AU": '#8B008B	',
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