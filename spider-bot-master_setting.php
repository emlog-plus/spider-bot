<?php
!defined('EMLOG_ROOT') && exit('access deined!');
function plugin_setting_view() {

}
?>
<div class="heading-bg  card-views">
<ul class="breadcrumbs">
 <li><a href="./"><i class="fa fa-home"></i> <?php echo langs('home') ?></a></li>
<li class="active">蜘蛛来访记录</li>
 </ul>
</div>
<div class="row">
<div class="col-md-12">
<div class="panel panel-default card-view">
<div class="panel-body"> 
<div style="color:red">温馨提示:</div>
当蜘蛛达到3000条将自动初始化,当然你们也可以手动初始化
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
$DB=Database::getInstance();
$data = $DB->once_fetch_array("SELECT COUNT(*) AS baidu FROM " . DB_PREFIX . "bot WHERE botname ='Baidu'");
$baidu = $data['baidu'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS google FROM " . DB_PREFIX . "bot WHERE botname ='Google'");
$google = $data['google'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS sogou FROM " . DB_PREFIX . "bot WHERE botname ='Sogou'");
$sogou = $data['sogou'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS yahoo FROM " . DB_PREFIX . "bot WHERE botname ='Yahoo!'");
$yahoo = $data['yahoo'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS youdao FROM " . DB_PREFIX . "bot WHERE botname ='Youdao'");
$youdao = $data['youdao'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS sanll FROM " . DB_PREFIX . "bot WHERE botname ='360spider'");
$sanll = $data['sanll'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS msn FROM " . DB_PREFIX . "bot WHERE botname ='MSN'");
$msn = $data['msn'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS bing FROM " . DB_PREFIX . "bot WHERE botname ='Bing'");
$bing = $data['bing'];
$data = $DB->once_fetch_array("SELECT COUNT(*) AS other FROM " . DB_PREFIX . "bot WHERE botname ='Other Crawler'");
$other = $data['other'];
?>
<th width="50" class="tdcenter"><b>百度</b></th>
<th width="50" class="tdcenter"><b>谷歌</b></th>
<th width="50" class="tdcenter"><b>搜狗</b></th>
<th width="50" class="tdcenter"><b>雅虎</b></th>
<th width="50" class="tdcenter"><b>有道</b></th>
<th width="50" class="tdcenter"><b>360</b></th>
<th width="50" class="tdcenter"><b>MSN</b></th>
<th width="50" class="tdcenter"><b>Bing</b></th>
<th width="50" class="tdcenter"><b>其他</b></th>
</tr>
</thead>
<tr>
<td class="tdcenter"><?php echo $baidu;?></td>
<td class="tdcenter"><?php echo $google;?></td>
<td class="tdcenter"><?php echo $sogou;?></td>
<td class="tdcenter"><?php echo $yahoo;?></td>
<td class="tdcenter"><?php echo $youdao;?></td>
<td class="tdcenter"><?php echo $sanll;?></td>
<td class="tdcenter"><?php echo $msn;?></td>
<td class="tdcenter"><?php echo $bing;?></td>
<td class="tdcenter"><?php echo $other;?></td>
</tr>
</tbody>
</table>
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
<th width="50" class="tdcenter"><b>序号</b></th>
<th width="80"><b>蜘蛛名称</b></th>
<th width="240"><b>抓取链接</b></th>
<th width="100" class="tdcenter"><b>来路IP</b></th>
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
$CACHE->updateCache();
}
?>  
<tr>
<td class="tdcenter"><?php echo $i;?></td>
<td><?php echo $data['botname'];?></td>
<td><a href="<?php echo $data['botlasturl'];?>" target="_blank"><?php echo $data['botlasturl'];?></a></td>
<td class="tdcenter">
<?php  $details = json_decode(file_get_contents("http://ipinfo.io/{$data['serverip']}"));
echo $details->country;?>
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
<div class="form-group" style="padding-top:10px">
<a href="../content/plugins/spider-bot-master/spider-bot-do.php?reset=reset&token=<?php echo LoginAuth::genToken(); ?>" class="btn btn-info">初始化</a>
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
<script>
$("#menu_mg").addClass('active');
$("#spider-bot").addClass('active-page');
setTimeout(hideActived,2600);
</script>
<?php
function plugin_setting() {

}
?>