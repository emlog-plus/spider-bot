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
<?php if(isset($_GET['active_del'])):?>
<div class="actived alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
 <?php echo langs('deleted_ok') ?>
</div>
<?php endif;?>
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
<th width="255"><b>抓取链接</b></th>
<th width="80" class="tdcenter"><b>来路IP</b></th>
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
?>  
<tr>
<td class="tdcenter"><?php echo $i;?></td>
<td><?php echo $data['botname'];?></td>
<td><a href="<?php echo $data['botlasturl'];?>" target="_blank"><?php echo $data['botlasturl'];?></a></td>
<td class="tdcenter">
<?php  $details = json_decode(file_get_contents("http://ipinfo.io/{$data['serverip']}"));
echo $details->country;?>
</td>
<td class="tdcenter">
<?php echo date("Y-m-d h:i",$data['date']);?>
</td>
<td class="tdcenter">
<a href="../content/plugins/spider-bot-master/spider-bot-do.php?dele=<?php echo $data['id'];?>&token=<?php echo LoginAuth::genToken(); ?>">删除</a>
</td>
</tr>
<?php
}
}else{
echo '<tr><td colspan="6">暂无记录,请耐心等待一段时间再来查询！</td></tr>';
}
?>
</tbody>
</table>
</div>
</div>
</div>
<div class="form-group">
<a href="../content/plugins/spider-bot-master/spider-bot-do.php?reset=reset&token=<?php echo LoginAuth::genToken(); ?>">初始化</a>
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