<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2007 Cool Dude 2k - http://intdb.sourceforge.net/
    Copyright 2004-2007 Game Maker 2k - http://upload.idb.s1.jcink.com/

    $FileInfo: topics.php - Last Update: 08/18/2007 SVN 87 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="topics.php"||$File3Name=="/topics.php") {
	require('index.php');
	exit(); }
$prequery = query("SELECT * FROM `".$Settings['sqltable']."forums` WHERE `id`=%i", array($_GET['id']));
$preresult=mysql_query($prequery);
$prenum=mysql_num_rows($preresult);
if($prenum==0) { redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false)); @mysql_free_result($preresult);
ob_clean(); @header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); }
if($prenum>=1) {
$ForumID=mysql_result($preresult,0,"id");
$ForumCatID=mysql_result($preresult,0,"CategoryID");
$ForumName=mysql_result($preresult,0,"Name");
$ForumType=mysql_result($preresult,0,"ForumType");
$RedirectURL=mysql_result($preresult,0,"RedirectURL");
$RedirectTimes=mysql_result($preresult,0,"Redirects");
$NumberViews=mysql_result($preresult,0,"NumViews");
$NumberPosts=mysql_result($preresult,0,"NumPosts");
$NumberTopics=mysql_result($preresult,0,"NumTopics");
$PostCountAdd=mysql_result($preresult,0,"PostCountAdd");
$CanHaveTopics=mysql_result($preresult,0,"CanHaveTopics");
@mysql_free_result($preresult);
$ForumType = strtolower($ForumType); $CanHaveTopics = strtolower($CanHaveTopics);
if($CanHaveTopics=="yes"&&$ForumType=="subforum") { 
if($_GET['act']=="create"||$_GET['act']=="maketopic"||
	$_POST['act']=="maketopics") { $ForumCheck = "skip"; } }
if(!isset($CatPermissionInfo['CanViewCategory'][$ForumCatID])) {
	$CatPermissionInfo['CanViewCategory'][$ForumCatID] = "no"; }
if($CatPermissionInfo['CanViewCategory'][$ForumCatID]=="no"||
	$CatPermissionInfo['CanViewCategory'][$ForumCatID]!="yes") {
redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false));
ob_clean(); @header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); }
if(!isset($PermissionInfo['CanViewForum'][$ForumID])) {
	$PermissionInfo['CanViewForum'][$ForumID] = "no"; }
if($PermissionInfo['CanViewForum'][$ForumID]=="no"||
	$PermissionInfo['CanViewForum'][$ForumID]!="yes") {
redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false));
ob_clean(); @header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); }
if($CatPermissionInfo['CanViewCategory'][$ForumCatID]=="yes"&&
	$PermissionInfo['CanViewForum'][$ForumID]=="yes") {
if($ForumType!="redirect") {
if($NumberViews==0||$NumberViews==null) { $NewNumberViews = 1; }
if($NumberViews!=0&&$NumberViews!=null) { $NewNumberViews = $NumberViews + 1; }
$viewup = query("UPDATE `".$Settings['sqltable']."forums` SET `NumViews`=%i WHERE `id`=%i", array($NewNumberViews,$_GET['id']));
mysql_query($viewup); }
if($ForumType=="redirect") {
if($RedirectTimes==0||$RedirectTimes==null) { $NewRedirTime = 1; }
if($RedirectTimes!=0&&$RedirectTimes!=null) { $NewRedirTime = $RedirectTimes + 1; }
$redirup = query("UPDATE `".$Settings['sqltable']."forums` SET `Redirects`=%i WHERE `id`=%i", array($NewRedirTime,$_GET['id']));
mysql_query($redirup);
if($RedirectURL!="http://"&&$RedirectURL!="") {
redirect("location",$RedirectURL,0,null,false); ob_clean();
@header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); }
if($RedirectURL=="http://"||$RedirectURL=="") {
redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false));
ob_clean(); @header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); } }
if($ForumCheck!="skip") {
if($ForumType=="subforum") {
redirect("location",$basedir.url_maker($exfile['subforum'],$Settings['file_ext'],"act=".$_GET['act']."&id=".$_GET['id'],$Settings['qstr'],$Settings['qsep'],$prexqstr['subforum'],$exqstr['subforum'],FALSE));
ob_clean(); @header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); } }
if($PermissionInfo['CanMakeTopics'][$ForumID]=="yes"&&$CanHaveTopics=="yes") {
?>
<table style="width: 100%;" class="Table2">
<tr>
 <td style="width: 0%; text-align: left;">&nbsp;</td>
 <td style="width: 100%; text-align: right;">
 <?php if($PermissionInfo['CanMakeTopics'][$ForumID]=="yes"&&$CanHaveTopics=="yes") { ?>
 <a href="<?php echo url_maker($exfile['forum'],$Settings['file_ext'],"act=create&id=".$ForumID,$Settings['qstr'],$Settings['qsep'],$prexqstr['forum'],$exqstr['forum']); ?>"><?php echo $ThemeSet['NewTopic']; ?></a>
 <?php } ?></td>
</tr>
</table>
<div>&nbsp;</div>
<?php }
if($_GET['act']=="view") {
$query = query("SELECT * FROM `".$Settings['sqltable']."topics` WHERE `ForumID`=%i ORDER BY `Pinned` DESC, `LastUpdate` DESC", array($_GET['id']));
$result=mysql_query($query);
$num=mysql_num_rows($result);
//Start Topic Page Code (Will be used at later time)
if(!isset($Settings['max_topics'])) { $Settings['max_topics'] = 10; }
if($_GET['page']==null) { $_GET['page'] = 1; } 
if($_GET['page']<=0) { $_GET['page'] = 1; }
$nums = $_GET['page'] * $Settings['max_topics'];
if($nums>$num) { $nums = $num; }
$numz = $nums - $Settings['max_topics'];
if($numz<=0) { $numz = 0; }
$i=$numz;
if($nums<$num) { $nextpage = $_GET['page'] + 1; }
if($nums>=$num) { $nextpage = $_GET['page']; }
if($numz>=$Settings['max_topics']) { $backpage = $_GET['page'] - 1; }
if($_GET['page']<=1) { $backpage = 1; }
$pnum = $num; $l = 1; $Pages = null;
while ($pnum>0) {
if($pnum>=$Settings['max_topics']) { 
	$pnum = $pnum - $Settings['max_topics']; 
	$Pages[$l] = $l; ++$l; }
if($pnum<$Settings['max_topics']&&$pnum>0) { 
	$pnum = $pnum - $pnum; 
	$Pages[$l] = $l; ++$l; } }
//End Topic Page Code (Its not used yet but its still good to have :P )
$i=0;
$pagenum=count($Pages);
$pagei=1; $pstring = "<div class=\"PageList\">Pages: ";
while ($pagei <= $pagenum) {
$pstring = $pstring."<a href=\"".url_maker($exfile[$ForumType],$Settings['file_ext'],"act=view&id=".$_GET['id']."&page=".$Pages[$pagei],$Settings['qstr'],$Settings['qsep'],$prexqstr[$ForumType],$exqstr[$ForumType])."\">".$Pages[$pagei]."</a> ";
	++$pagei; } $pstring = $pstring."</div>";
?>
<div class="Table1Border">
<table class="Table1" id="Forum<?php echo $ForumID; ?>">
<tr id="ForumStart<?php echo $ForumID; ?>" class="TableRow1">
<td class="TableRow1" colspan="6"><span style="float: left;">
<?php echo $ThemeSet['TitleIcon'] ?><a href="<?php echo url_maker($exfile['forum'],$Settings['file_ext'],"act=view&id=".$ForumID,$Settings['qstr'],$Settings['qsep'],$prexqstr['forum'],$exqstr['forum']); ?>#<?php echo $ForumID; ?>"><?php echo $ForumName; ?></a></span>
<?php echo "<span style=\"float: right;\">&nbsp;</span>"; ?></td>
</tr>
<tr id="TopicStatRow<?php echo $ForumID; ?>" class="TableRow2">
<th class="TableRow2" style="width: 4%;">State</th>
<th class="TableRow2" style="width: 36%;">Topic Name</th>
<th class="TableRow2" style="width: 15%;">Author</th>
<th class="TableRow2" style="width: 15%;">Time</th>
<th class="TableRow2" style="width: 5%;">Replys</th>
<th class="TableRow2" style="width: 25%;">Last Reply</th>
</tr>
<?php
while ($i < $num) {
$TopicID=mysql_result($result,$i,"id");
$UsersID=mysql_result($result,$i,"UserID");
$GuestName=mysql_result($result,$i,"GuestName");
$TheTime=mysql_result($result,$i,"TimeStamp");
$TheTime=GMTimeChange("F j, Y",$TheTime,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$NumReply=mysql_result($result,$i,"NumReply");
$TopicName=mysql_result($result,$i,"TopicName");
$TopicDescription=mysql_result($result,$i,"Description");
$PinnedTopic=mysql_result($result,$i,"Pinned");
$TopicStat=mysql_result($result,$i,"Closed");
$UsersName = GetUserName($UsersID,$Settings['sqltable']);
if($UsersName=="Guest") { $UsersName=$GuestName;
if($UsersName==null) { $UsersName="Guest"; } }
$glrquery = query("SELECT * FROM `".$Settings['sqltable']."posts` WHERE `ForumID`=%i AND `TopicID`=%i ORDER BY `TimeStamp` DESC", array($_GET['id'],$TopicID));
$glrresult=mysql_query($glrquery);
$glrnum=mysql_num_rows($glrresult);
if($glrnum>0){
$ReplyID1=mysql_result($glrresult,0,"id");
$UsersID1=mysql_result($glrresult,0,"UserID");
$GuestName1=mysql_result($glrresult,0,"GuestName");
$TimeStamp1=mysql_result($glrresult,0,"TimeStamp");
$TimeStamp1=GMTimeChange("F j, Y",$TimeStamp1,$_SESSION['UserTimeZone'],0,$_SESSION['UserDST']);
$UsersName1 = GetUserName($UsersID1,$Settings['sqltable']); }
if($UsersName1=="Guest") { $UsersName1=$GuestName1;
if($UsersName1==null) { $UsersName1="Guest"; } }
if($TimeStamp1!=null) { $lul = null;
if($UsersID1!="-1") {
$lul = url_maker($exfile['member'],$Settings['file_ext'],"act=view&id=".$UsersID1,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member']);
$luln = url_maker($exfile['topic'],$Settings['file_ext'],"act=view&id=".$TopicID,$Settings['qstr'],$Settings['qsep'],$prexqstr['topic'],$exqstr['topic'])."#post".$ReplyID1;
$LastReply = "User: <a href=\"".$lul."\">".$UsersName1."</a><br />\nTime: <a href=\"".$luln."\">".$TimeStamp1."</a>"; }
if($UsersID1=="-1") {
$lul = url_maker($exfile['member'],$Settings['file_ext'],"act=view&id=".$UsersID1,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member']);
$luln = url_maker($exfile['topic'],$Settings['file_ext'],"act=view&id=".$TopicID,$Settings['qstr'],$Settings['qsep'],$prexqstr['topic'],$exqstr['topic'])."#post".$ReplyID1;
$LastReply = "User: <span>".$UsersName1."</span><br />\nTime: <a href=\"".$luln."\">".$TimeStamp1."</a>"; } }
@mysql_free_result($glrresult);
if(!isset($TimeStamp1)) { $TimeStamp1 = null; } if(!isset($LastReply)) { $LastReply = null; }
if($TimeStamp1==null) { $LastReply = "&nbsp;<br />&nbsp;"; }
$PreTopic = $ThemeSet['TopicIcon'];
if ($PinnedTopic>1) { $PinnedTopic = 1; } 
if ($PinnedTopic<0) { $PinnedTopic = 0; }
if(!is_numeric($PinnedTopic)) { $PinnedTopic = 0; }
if ($TopicStat>1) { $TopicStat = 1; } 
if ($TopicStat<0) { $TopicStat = 0; }
if(!is_numeric($TopicStat)) { $TopicStat = 1; }
if ($PinnedTopic==1&&$TopicStat==0) {
	if($NumReply>=$Settings['hot_topic_num']) {
		$PreTopic=$ThemeSet['HotPinTopic']; }
	if($NumReply<$Settings['hot_topic_num']) {
		$PreTopic=$ThemeSet['PinTopic']; } }
if ($TopicStat==1&&$PinnedTopic==0) {
	if($NumReply>=$Settings['hot_topic_num']) {
		$PreTopic=$ThemeSet['HotClosedTopic']; }
	if($NumReply<$Settings['hot_topic_num']) {
		$PreTopic=$ThemeSet['ClosedTopic']; } }
if ($PinnedTopic==0&&$TopicStat==0) {
		if($NumReply>=$Settings['hot_topic_num']) {
			$PreTopic=$ThemeSet['HotTopic']; }
		if($NumReply<$Settings['hot_topic_num']) {
			$PreTopic=$ThemeSet['TopicIcon']; } }
if ($PinnedTopic==1&&$TopicStat==1) {
		if($NumReply>=$Settings['hot_topic_num']) {
			$PreTopic=$ThemeSet['HotPinClosedTopic']; }
		if($NumReply<$Settings['hot_topic_num']) {
			$PreTopic=$ThemeSet['PinClosedTopic']; } }
?>
<tr class="TableRow3" id="Topic<?php echo $TopicID; ?>">
<td class="TableRow3"><div class="topicstate">
<?php echo $PreTopic; ?></div></td>
<td class="TableRow3"><div class="topicname">
<a href="<?php echo url_maker($exfile['topic'],$Settings['file_ext'],"act=view&id=".$TopicID,$Settings['qstr'],$Settings['qsep'],$prexqstr['topic'],$exqstr['topic']); ?>"><?php echo $TopicName; ?></a></div>
<div class="topicdescription"><?php echo $TopicDescription; ?></div></td>
<td class="TableRow3" style="text-align: center;"><?php
if($UsersID!="-1") {
echo "<a href=\"";
echo url_maker($exfile['member'],$Settings['file_ext'],"act=view&id=".$UsersID,$Settings['qstr'],$Settings['qsep'],$prexqstr['member'],$exqstr['member']);
echo "\">".$UsersName."</a>"; }
if($UsersID=="-1") {
echo "<span>".$UsersName."</span>"; }
?></td>
<td class="TableRow3" style="text-align: center;"><?php echo $TheTime; ?></td>
<td class="TableRow3" style="text-align: center;"><?php echo $NumReply; ?></td>
<td class="TableRow3"><?php echo $LastReply; ?></td>
</tr>
<?php ++$i; } 
?>
<tr id="ForumEnd<?php echo $ForumID; ?>" class="TableRow4">
<td class="TableRow4" colspan="6">&nbsp;</td>
</tr>
</table></div>
<div>&nbsp;</div>
<?php
@mysql_free_result($result); }
if($_GET['act']=="create") {
if($PermissionInfo['CanMakeTopics'][$ForumID]=="no"||$CanHaveTopics=="no") { redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false));
ob_clean(); @header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); }
?>
<div class="Table1Border">
<table class="Table1" id="MakeTopic<?php echo $ForumID; ?>">
<tr class="TableRow1" id="TopicStart<?php echo $ForumID; ?>">
<td class="TableRow1" colspan="2"><span style="float: left;">
<?php echo $ThemeSet['TitleIcon'] ?><a href="<?php echo url_maker($exfile['forum'],$Settings['file_ext'],"act=view&id=".$ForumID,$Settings['qstr'],$Settings['qsep'],$prexqstr['forum'],$exqstr['forum']); ?>"><?php echo $ForumName; ?></a></span>
<?php echo "<span style=\"float: right;\">&nbsp;</span>"; ?></td>
</tr>
<tr id="MakeTopicRow<?php echo $ForumID; ?>" class="TableRow2">
<td class="TableRow2" colspan="2" style="width: 100%;">Making a Topic in <?php echo $ForumName; ?></td>
</tr>
<tr class="TableRow3" id="MkTopic<?php echo $ForumID; ?>">
<td class="TableRow3" style="width: 15%; vertical-align: middle; text-align: center;">
<div style="width: 100%; height: 160px; overflow: auto;"><?php
$renee_query=query("SELECT * FROM `".$Settings['sqltable']."smileys`", array(null));
$renee_result=mysql_query($renee_query);
$renee_num=mysql_num_rows($renee_result);
$renee_s=0; $SmileRow=1;
while ($renee_s < $renee_num) {
$FileName=mysql_result($renee_result,$renee_s,"FileName");
$SmileName=mysql_result($renee_result,$renee_s,"SmileName");
$SmileText=mysql_result($renee_result,$renee_s,"SmileText");
$SmileDirectory=mysql_result($renee_result,$renee_s,"Directory");
$ShowSmile=mysql_result($renee_result,$renee_s,"Show");
$ReplaceType=mysql_result($renee_result,$renee_s,"ReplaceCI");
if($SmileRow<5) { ?>
	<img src="<?php echo $SmileDirectory."".$FileName; ?>" style="vertical-align: middle; border: 0px; cursor: pointer;" title="<?php echo $SmileName; ?>" alt="<?php echo $SmileName; ?>" onclick="addsmiley('TopicPost','&nbsp;<?php echo htmlspecialchars($SmileText); ?>&nbsp;')" />&nbsp;&nbsp;
	<?php } if($SmileRow==5) { ?>
	<img src="<?php echo $SmileDirectory."".$FileName; ?>" style="vertical-align: middle; border: 0px; cursor: pointer;" title="<?php echo $SmileName; ?>" alt="<?php echo $SmileName; ?>" onclick="addsmiley('TopicPost','&nbsp;<?php echo htmlspecialchars($SmileText); ?>&nbsp;')" /><br />
	<?php $SmileRow=1; }
++$renee_s; ++$SmileRow; }
@mysql_free_result($renee_result);
?></div></td>
<td class="TableRow3" style="width: 85%;">
<form method="post" id="MkTopicForm" action="<?php echo url_maker($exfile['forum'],$Settings['file_ext'],"act=maketopic&id=".$ForumID,$Settings['qstr'],$Settings['qsep'],$prexqstr['forum'],$exqstr['forum']); ?>">
<table style="text-align: left;">
<tr style="text-align: left;">
	<td style="width: 50%;"><label class="TextBoxLabel" for="TopicName">Insert Topic Name:</label></td>
	<td style="width: 50%;"><input type="text" name="TopicName" class="TextBox" id="TopicName" size="20" /></td>
</tr><?php if($_SESSION['UserGroup']==$Settings['GuestGroup']) { ?><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="GuestName">Insert Guest Name:</label></td>
	<td style="width: 50%;"><input type="text" name="GuestName" class="TextBox" id="GuestName" size="20" /></td>
</tr><?php } ?><tr>
	<td style="width: 50%;"><label class="TextBoxLabel" for="TopicDesc">Insert Topic Description:</label></td>
	<td style="width: 50%;"><input type="text" name="TopicDesc" class="TextBox" id="TopicDesc" size="20" /></td>
</tr>
</table>
<table style="text-align: left;">
<tr style="text-align: left;">
<td style="width: 100%;">
<label class="TextBoxLabel" for="TopicPost">Insert Your Post:</label><br />
<textarea rows="10" name="TopicPost" id="TopicPost" cols="40" class="TextBox"></textarea><br />
<input type="hidden" name="act" value="maketopics" style="display: none;" />
<?php if($_SESSION['UserGroup']!=$Settings['GuestGroup']) { ?>
<input type="hidden" name="GuestName" value="null" style="display: none;" />
<?php } ?>
<input type="submit" class="Button" value="Make Topic" name="make_topic" />
<input type="reset" value="Reset Form" class="Button" name="Reset_Form" />
</td></tr></table>
</form></td></tr>
<tr id="MkTopicEnd<?php echo $ForumID; ?>" class="TableRow4">
<td class="TableRow4" colspan="5">&nbsp;</td>
</tr>
</table></div>
<div>&nbsp;</div>
<?php } if($_GET['act']=="maketopic"&&$_POST['act']=="maketopics") {
if($PermissionInfo['CanMakeTopics'][$ForumID]=="no"||$CanHaveTopics=="no") { redirect("location",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false));
ob_clean(); @header("Content-Type: text/plain; charset=".$Settings['charset']);
gzip_page($Settings['use_gzip'],$GZipEncode['Type']); @mysql_close(); die(); }
$MyUserID = $_SESSION['UserID']; if($MyUserID=="0"||$MyUserID==null) { $MyUserID = -1; }
$REFERERurl = parse_url($_SERVER['HTTP_REFERER']);
$URL['REFERER'] = $REFERERurl['host'];
$URL['HOST'] = $_SERVER["SERVER_NAME"];
$REFERERurl = null; unset($REFERERurl);
if(!isset($_POST['TopicName'])) { $_POST['TopicName'] = null; }
if(!isset($_POST['TopicDesc'])) { $_POST['TopicDesc'] = null; }
if(!isset($_POST['TopicPost'])) { $_POST['TopicPost'] = null; }
if(!isset($_POST['GuestName'])) { $_POST['GuestName'] = null; }
?>
<div class="Table1Border">
<table class="Table1">
<tr class="TableRow1">
<td class="TableRow1"><span style="float: left;">
<?php echo $ThemeSet['TitleIcon'] ?><a href="<?php echo url_maker($exfile['forum'],$Settings['file_ext'],"act=view&id=".$ForumID,$Settings['qstr'],$Settings['qsep'],$prexqstr['forum'],$exqstr['forum']); ?>"><?php echo $ForumName; ?></a></span>
<?php echo "<span style=\"float: right;\">&nbsp;</span>"; ?></td>
</tr>
<tr class="TableRow2">
<th class="TableRow2" style="width: 100%; text-align: left;">&nbsp;Make Topic Message: </th>
</tr>
<?php if (strlen($_POST['TopicName'])=="30") { $Error="Yes";  ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />Your Topic Name is too big.<br />
	</span></td>
</tr>
<?php } if (strlen($_POST['TopicDesc'])=="30") { $Error="Yes";  ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />Your Topic Description is too big.<br />
	</span></td>
</tr>
<?php } if($_SESSION['UserGroup']==$Settings['GuestGroup']&&
	strlen($_POST['GuestName'])=="25") { $Error="Yes"; ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />You Guest Name is too big.<br />
	</span></td>
</tr>
<?php } if ($Settings['TestReferer']==true) {
	if ($URL['HOST']!=$URL['REFERER']) { $Error="Yes";  ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />Sorry the referering url dose not match our host name.<br />
	</span></td>
</tr>
<?php } }
$_POST['TopicName'] = stripcslashes(htmlspecialchars($_POST['TopicName'], ENT_QUOTES));
$_POST['TopicName'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['TopicName']);
$_POST['TopicName'] = @remove_spaces($_POST['TopicName']);
$_POST['TopicDesc'] = stripcslashes(htmlspecialchars($_POST['TopicDesc'], ENT_QUOTES));
$_POST['TopicDesc'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['TopicDesc']);
$_POST['TopicDesc'] = @remove_spaces($_POST['TopicDesc']);
$_POST['GuestName'] = stripcslashes(htmlspecialchars($_POST['GuestName'], ENT_QUOTES));
//$_POST['GuestName'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['GuestName']);
$_POST['GuestName'] = @remove_spaces($_POST['GuestName']);
$_POST['TopicPost'] = stripcslashes(htmlspecialchars($_POST['TopicPost'], ENT_QUOTES));
$_POST['TopicPost'] = preg_replace("/&amp;#(x[a-f0-9]+|[0-9]+);/i", "&#$1;", $_POST['TopicPost']);
$_POST['TopicPost'] = remove_bad_entities($_POST['TopicPost']);
//$_POST['TopicPost'] = @remove_spaces($_POST['TopicPost']);
if ($_POST['TopicName']==null) { $Error="Yes"; ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />You need to enter a Topic Name.<br />
	</span></td>
</tr>
<?php } if ($_POST['TopicDesc']==null) { $Error="Yes"; ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />You need to enter a Topic Description.<br />
	</span></td>
</tr>
<?php } if($_SESSION['UserGroup']==$Settings['GuestGroup']&&
	$_POST['GuestName']==null) { $Error="Yes"; ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />You need to enter a Guest Name.<br />
	</span></td>
</tr>
<?php } if($PermissionInfo['CanMakeTopics'][$ForumID]=="no"||$CanHaveTopics=="no") { $Error="Yes"; ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />You do not have permission to make a topic here.<br />
	</span></td>
</tr>
<?php } if ($_POST['TopicPost']==null) { $Error="Yes"; ?>
<tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage">
	<br />You need to enter a Topic Post.<br />
	</span></td>
</tr>
<?php } if ($Error=="Yes") {
@redirect("refresh",$basedir.url_maker($exfile['index'],$Settings['file_ext'],"act=view",$Settings['qstr'],$Settings['qsep'],$prexqstr['index'],$exqstr['index'],false),"4"); }
if ($Error!="Yes") { $LastActive = GMTimeStamp();
$topicid = getnextid($Settings['sqltable'],"topics");
$postid = getnextid($Settings['sqltable'],"posts");
$requery = query("SELECT * FROM `".$Settings['sqltable']."members` WHERE `id`=%i", array($MyUserID));
$reresult=mysql_query($requery);
$renum=mysql_num_rows($reresult);
$rei=0;
while ($rei < $renum) {
$User1ID=$MyUserID;
$User1Name=mysql_result($reresult,$rei,"Name");
if($_SESSION['UserGroup']==$Settings['GuestGroup']) { $User1Name = $_POST['GuestName']; }
$User1Email=mysql_result($reresult,$rei,"Email");
$User1Title=mysql_result($reresult,$rei,"Title");
$User1GroupID=mysql_result($reresult,$rei,"GroupID");
$PostCount=mysql_result($reresult,$rei,"PostCount");
if($PostCountAdd=="on") { $NewPostCount = $PostCount + 1; }
if(!isset($NewPostCount)) { $NewPostCount = $PostCount; }
$gquery = query("SELECT * FROM `".$Settings['sqltable']."groups` WHERE `id`=%i", array($User1GroupID));
$gresult=mysql_query($gquery);
$User1Group=mysql_result($gresult,0,"Name");
@mysql_free_result($gresult);
$User1IP=$_SERVER['REMOTE_ADDR'];
++$rei; } @mysql_free_result($reresult);
$query = query("INSERT INTO `".$Settings['sqltable']."topics` VALUES (".$topicid.",%i,%i,%i,'%s',%i,%i,'%s','%s',0,0,0,0)", array($ForumID,$ForumCatID,$User1ID,$User1Name,$LastActive,$LastActive,$_POST['TopicName'],$_POST['TopicDesc']));
mysql_query($query);
$query = query("INSERT INTO `".$Settings['sqltable']."posts` VALUES (".$postid.",".$topicid.",%i,%i,%i,'%s',%i,%i,0,'%s','%s','%s','0')", array($ForumID,$ForumCatID,$User1ID,$User1Name,$LastActive,$LastActive,$_POST['TopicPost'],$_POST['TopicDesc'],$User1IP));
mysql_query($query);
if($User1ID!=0&&$User1ID!=-1) {
$queryupd = query("UPDATE `".$Settings['sqltable']."members` SET `LastActive`=%i,`IP`='%s',`PostCount`=%i WHERE `id`=%i", array($LastActive,$User1IP,$NewPostCount,$User1ID));
mysql_query($queryupd); }
$NewNumPosts = $NumberPosts + 1; $NewNumTopics = $NumberTopics + 1;
$queryupd = query("UPDATE `".$Settings['sqltable']."forums` SET `NumPosts`=%i,`NumTopics`=%i WHERE `id`=%i", array($NewNumPosts,$NewNumTopics,$ForumID));
mysql_query($queryupd);
@redirect("refresh",$basedir.url_maker($exfile['topic'],$Settings['file_ext'],"act=view&id=".$topicid,$Settings['qstr'],$Settings['qsep'],$prexqstr['topic'],$exqstr['topic'],FALSE),"3");
?><tr style="text-align: center;">
	<td style="text-align: center;"><span class="TableMessage"><br />
	Topic <?php echo $_POST['TopicName']; ?> was started.<br />
	Click <a href="<?php echo url_maker($exfile['topic'],$Settings['file_ext'],"act=view&id=".$topicid,$Settings['qstr'],$Settings['qsep'],$prexqstr['topic'],$exqstr['topic']); ?>">here</a> to continue to topic.<br />&nbsp;
	</span><br /></td>
</tr>
<?php } ?>
<tr class="TableRow4">
<td class="TableRow4">&nbsp;</td>
</tr>
</table></div>
<div>&nbsp;</div>
<?php }
if($PermissionInfo['CanMakeTopics'][$ForumID]=="yes"&&$CanHaveTopics=="yes") { ?>
<div>&nbsp;</div>
<table class="Table2" style="width: 100%;">
<tr>
 <td style="width: 0%; text-align: left;">&nbsp;</td>
 <td style="width: 100%; text-align: right;">
 <?php if($PermissionInfo['CanMakeTopics'][$ForumID]=="yes"&&$CanHaveTopics=="yes") { ?>
 <a href="<?php echo url_maker($exfile['forum'],$Settings['file_ext'],"act=create&id=".$ForumID,$Settings['qstr'],$Settings['qsep'],$prexqstr['forum'],$exqstr['forum']); ?>"><?php echo $ThemeSet['NewTopic']; ?></a>
 <?php } ?></td>
</tr>
</table>
<div>&nbsp;</div>
<?php } } } ?>