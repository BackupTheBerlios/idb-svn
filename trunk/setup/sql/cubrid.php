<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2011 iDB Support - http://idb.berlios.de/
    Copyright 2004-2011 Game Maker 2k - http://gamemaker2k.org/
    iDB Installer made by Game Maker 2k - http://idb.berlios.net/

    $FileInfo: cubrid.php - Last Update: 06/28/2011 SVN 685 - Author: cooldude2k $
*/
$File3Name = basename($_SERVER['SCRIPT_NAME']);
if ($File3Name=="cubrid.php"||$File3Name=="/cubrid.php") {
	require('index.php');
	exit(); }
if(!isset($SetupDir['setup'])) { $SetupDir['setup'] = "setup/"; }
if(!isset($SetupDir['convert'])) { $SetupDir['convert'] = "setup/convert/"; }
//$query=sql_pre_query("ALTER DATABASE \"".$_POST['DatabaseName']."\" DEFAULT CHARACTER SET ".$Settings['sql_charset']." COLLATE ".$Settings['sql_collate'].";", array(null));
//sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."categories\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"OrderID\" integer NOT NULL default '0',\n".
"  \"Name\" varchar(150) NOT NULL default '',\n".
"  \"ShowCategory\" varchar(5) NOT NULL default '',\n".
"  \"CategoryType\" varchar(15) NOT NULL default '',\n".
"  \"SubShowForums\" varchar(5) NOT NULL default '',\n".
"  \"InSubCategory\" integer NOT NULL default '0',\n".
"  \"PostCountView\" integer NOT NULL default '0',\n".
"  \"KarmaCountView\" integer NOT NULL default '0',\n".
"  \"Description\" varchar(65535) NOT NULL\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."categories\" (\"OrderID\", \"Name\", \"ShowCategory\", \"CategoryType\", \"SubShowForums\", \"InSubCategory\", \"PostCountView\", \"KarmaCountView\", \"Description\")\n". 
"VALUES (1, 'A Test Category', 'yes', 'category', 'yes', 0, 0, 0, 'A test category that may be removed at any time.');", array(null));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."catpermissions\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"PermissionID\" integer NOT NULL default '0',\n".
"  \"Name\" varchar(150) NOT NULL default '',\n".
"  \"CategoryID\" integer NOT NULL default '0',\n".
"  \"CanViewCategory\" varchar(5) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."catpermissions\" (\"PermissionID\", \"Name\", \"CategoryID\", \"CanViewCategory\") VALUES\n".
"(1, 'Admin', 1, 'yes'),\n".
"(2, 'Moderator', 1, 'yes'),\n".
"(3, 'Member', 1, 'yes'),\n".
"(4, 'Guest', 1, 'yes'),\n".
"(5, 'Banned', 1, 'no'),\n".
"(6, 'Validate', 1, 'yes');", array(null)); 
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."events\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"UserID\" integer NOT NULL default '0',\n".
"  \"GuestName\" varchar(150) NOT NULL default '',\n".
"  \"EventName\" varchar(150) NOT NULL default '',\n".
"  \"EventText\" varchar(65535) NOT NULL,\n".
"  \"TimeStamp\" integer NOT NULL default '0',\n".
"  \"TimeStampEnd\" integer NOT NULL default '0',\n".
"  \"EventMonth\" integer NOT NULL default '0',\n".
"  \"EventMonthEnd\" integer NOT NULL default '0',\n".
"  \"EventDay\" integer NOT NULL default '0',\n".
"  \"EventDayEnd\" integer NOT NULL default '0',\n".
"  \"EventYear\" integer NOT NULL default '0',\n".
"  \"EventYearEnd\" integer NOT NULL default '0',\n".
"  \"IP\" varchar(50) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."events\" (\"UserID\", \"GuestName\", \"EventName\", \"EventText\", \"TimeStamp\", \"TimeStampEnd\", \"EventMonth\", \"EventMonthEnd\", \"EventDay\", \"EventDayEnd\", \"EventYear\", \"EventYearEnd\", \"IP\") VALUES\n".
"(-1, '".$iDB_Author."', 'iDB Install', 'This is the start date of your board. ^_^', %i, %i, %i, %i, %i, %i, %i, %i, '127.0.0.1');", array($YourDate,$YourDateEnd,$EventMonth,$EventMonthEnd,$EventDay,$EventDayEnd,$EventYear,$EventYearEnd));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."forums\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"CategoryID\" integer NOT NULL default '0',\n".
"  \"OrderID\" integer NOT NULL default '0',\n".
"  \"Name\" varchar(150) NOT NULL default '',\n".
"  \"ShowForum\" varchar(5) NOT NULL default '',\n".
"  \"ForumType\" varchar(15) NOT NULL default '',\n".
"  \"InSubForum\" integer NOT NULL default '0',\n".
"  \"RedirectURL\" varchar(65535) NOT NULL,\n".
"  \"Redirects\" integer NOT NULL default '0',\n".
"  \"NumViews\" integer NOT NULL default '0',\n".
"  \"Description\" varchar(65535) NOT NULL,\n".
"  \"PostCountAdd\" varchar(15) NOT NULL default '',\n".
"  \"PostCountView\" integer NOT NULL default '0',\n".
"  \"KarmaCountView\" integer NOT NULL default '0',\n".
"  \"CanHaveTopics\" varchar(5) NOT NULL default '',\n".
"  \"HotTopicPosts\" integer NOT NULL default '0',\n".
"  \"NumPosts\" integer NOT NULL default '0',\n".
"  \"NumTopics\" integer NOT NULL default '0'\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."forums\" (\"CategoryID\", \"OrderID\", \"Name\", \"ShowForum\", \"ForumType\", \"InSubForum\", \"RedirectURL\", \"Redirects\", \"NumViews\", \"Description\", \"PostCountAdd\", \"PostCountView\", \"KarmaCountView\", \"CanHaveTopics\", \"HotTopicPosts\", \"NumPosts\", \"NumTopics\") VALUES\n".
"(1, 1, 'A Test Forum', 'yes', 'forum', 0, 'http://', 0, 0, 'A test forum that may be removed at any time.', 'off', 0, 0, 'yes', 15, 1, 1);", array(null));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."groups\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"Name\" varchar(150) NOT NULL default '' UNIQUE,\n".
"  \"PermissionID\" integer NOT NULL default '0',\n".
"  \"NamePrefix\" varchar(150) NOT NULL default '',\n".
"  \"NameSuffix\" varchar(150) NOT NULL default '',\n".
"  \"CanViewBoard\" varchar(5) NOT NULL default '',\n".
"  \"CanViewOffLine\" varchar(5) NOT NULL default '',\n".
"  \"CanEditProfile\" varchar(5) NOT NULL default '',\n".
"  \"CanAddEvents\" varchar(5) NOT NULL default '',\n".
"  \"CanPM\" varchar(5) NOT NULL default '',\n".
"  \"CanSearch\" varchar(5) NOT NULL default '',\n".
"  \"CanExecPHP\" varchar(5) NOT NULL default '',\n".
"  \"CanDoHTML\" varchar(5) NOT NULL default '',\n".
"  \"CanUseBBags\" varchar(5) NOT NULL default '',\n".
"  \"CanModForum\" varchar(5) NOT NULL default '',\n".
"  \"FloodControl\" integer NOT NULL default '0',\n".
"  \"SearchFlood\" integer NOT NULL default '0',\n".
"  \"PromoteTo\" integer NOT NULL default '0',\n".
"  \"PromotePosts\" integer NOT NULL default '0',\n".
"  \"PromoteKarma\" integer NOT NULL default '0',\n".
"  \"HasModCP\" varchar(5) NOT NULL default '',\n".
"  \"HasAdminCP\" varchar(5) NOT NULL default '',\n".
"  \"ViewDBInfo\" varchar(5) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."groups\" (\"Name\", \"PermissionID\", \"NamePrefix\", \"NameSuffix\", \"CanViewBoard\", \"CanViewOffLine\", \"CanEditProfile\", \"CanAddEvents\", \"CanPM\", \"CanSearch\", \"CanExecPHP\", \"CanDoHTML\", \"CanUseBBags\", \"CanModForum\", \"FloodControl\", \"SearchFlood\", \"PromoteTo\", \"PromotePosts\", \"PromoteKarma\", \"HasModCP\", \"HasAdminCP\", \"ViewDBInfo\") VALUES\n".
"('Admin', 1, '', '', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 30, 30, 0, 0, 0, 'yes', 'yes', 'yes'),\n".
"('Moderator', 2, '', '', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'no', 'yes', 'yes', 30, 30, 0, 0, 0, 'yes', 'no', 'no'),\n".
"('Member', 3, '', '', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'no', 'no', 'yes', 'no', 30, 30, 0, 0, 0, 'no', 'no', 'no'),\n".
"('Guest', 4, '', '', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 30, 30, 0, 0, 0, 'no', 'no', 'no'),\n".
"('Banned', 5, '', '', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 30, 30, 0, 0, 0, 'no', 'no', 'no'),\n".
"('Validate', 6, '', '', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 30, 30, 0, 0, 0, 'no', 'no', 'no');", array(null)); 
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."members\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"Name\" varchar(150) NOT NULL default '' UNIQUE,\n".
"  \"UserPassword\" varchar(250) NOT NULL default '',\n".
"  \"HashType\" varchar(50) NOT NULL default '',\n".
"  \"Email\" varchar(256) NOT NULL default '' UNIQUE,\n".
"  \"GroupID\" integer NOT NULL default '0',\n".
"  \"Validated\" varchar(20) NOT NULL default '',\n".
"  \"HiddenMember\" varchar(20) NOT NULL default '',\n".
"  \"WarnLevel\" integer NOT NULL default '0',\n".
"  \"Interests\" varchar(150) NOT NULL default '',\n".
"  \"Title\" varchar(150) NOT NULL default '',\n".
"  \"Joined\" integer NOT NULL default '0',\n".
"  \"LastActive\" integer NOT NULL default '0',\n".
"  \"LastPostTime\" integer NOT NULL default '0',\n".
"  \"BanTime\" integer NOT NULL default '0',\n".
"  \"BirthDay\" integer NOT NULL default '0',\n".
"  \"BirthMonth\" integer NOT NULL default '0',\n".
"  \"BirthYear\" integer NOT NULL default '0',\n".
"  \"Signature\" varchar(65535) NOT NULL,\n".
"  \"Notes\" varchar(65535) NOT NULL,\n".
"  \"Avatar\" varchar(150) NOT NULL default '',\n".
"  \"AvatarSize\" varchar(10) NOT NULL default '',\n".
"  \"Website\" varchar(150) NOT NULL default '',\n".
"  \"Gender\" varchar(15) NOT NULL default '',\n".
"  \"PostCount\" integer NOT NULL default '0',\n".
"  \"Karma\" integer NOT NULL default '0',\n".
"  \"KarmaUpdate\" integer NOT NULL default '0',\n".
"  \"RepliesPerPage\" integer NOT NULL default '0',\n".
"  \"TopicsPerPage\" integer NOT NULL default '0',\n".
"  \"MessagesPerPage\" integer NOT NULL default '0',\n".
"  \"TimeZone\" varchar(5) NOT NULL default '0',\n".
"  \"DST\" varchar(5) NOT NULL default '0',\n".
"  \"UseTheme\" varchar(32) NOT NULL default '0',\n".
"  \"IP\" varchar(50) NOT NULL default '',\n".
"  \"Salt\" varchar(50) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."members\" (\"id\", \"Name\", \"UserPassword\", \"HashType\", \"Email\", \"GroupID\", \"Validated\", \"HiddenMember\", \"WarnLevel\", \"Interests\", \"Title\", \"Joined\", \"LastActive\", \"LastPostTime\", \"BanTime\", \"BirthDay\", \"BirthMonth\", \"BirthYear\", \"Signature\", \"Notes\", \"Avatar\", \"AvatarSize\", \"Website\", \"Gender\", \"PostCount\", \"Karma\", \"KarmaUpdate\", \"RepliesPerPage\", \"TopicsPerPage\", \"MessagesPerPage\", \"TimeZone\", \"DST\", \"UseTheme\", \"IP\", \"Salt\") VALUES\n".
"(-1, 'Guest', '%s', '".$iDBHashType."', '%s', 4, 'no', 'yes', 0, 'Guest Account', 'Guest', %i, %i, '0', '0', '0', '0', '0', '[B]Test[/B] :)', 'Your Notes', 'http://', '100x100', '%s', 'UnKnow', 1, 0, 0, 10, 10, 10, '%s', '%s', '".$_POST['DefaultTheme']."', '127.0.0.1', '%s'),\n".
"(1, '%s', '%s', '".$iDBHashType."', '%s', 1, 'yes', 'no', 0, '%s', 'Admin', %i, %i, '0', '0', '0', '0', '0', '%s', 'Your Notes', '%s', '100x100', '%s', 'UnKnow', 0, 0, 0, 10, 10, 10, '%s', '%s', '".$_POST['DefaultTheme']."', '%s', '%s');", array($GuestPassword,$GEmail,$YourDate,$YourDate,$YourWebsite,$AdminTime,$AdminDST,$GSalt,$_POST['AdminUser'],$NewPassword,$_POST['AdminEmail'],$Interests,$YourDate,$YourDate,$NewSignature,$Avatar,$YourWebsite,$AdminTime,$AdminDST,$UserIP,$YourSalt));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."mempermissions\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"CanViewBoard\" varchar(5) NOT NULL default '',\n".
"  \"CanViewOffLine\" varchar(5) NOT NULL default '',\n".
"  \"CanEditProfile\" varchar(5) NOT NULL default '',\n".
"  \"CanAddEvents\" varchar(5) NOT NULL default '',\n".
"  \"CanPM\" varchar(5) NOT NULL default '',\n".
"  \"CanSearch\" varchar(5) NOT NULL default '',\n".
"  \"CanExecPHP\" varchar(5) NOT NULL default '',\n".
"  \"CanDoHTML\" varchar(5) NOT NULL default '',\n".
"  \"CanUseBBags\" varchar(5) NOT NULL default '',\n".
"  \"CanModForum\" varchar(5) NOT NULL default '',\n".
"  \"FloodControl\" integer NOT NULL default '0',\n".
"  \"SearchFlood\" integer NOT NULL default '0',\n".
"  \"HasModCP\" varchar(5) NOT NULL default '',\n".
"  \"HasAdminCP\" varchar(5) NOT NULL default '',\n".
"  \"ViewDBInfo\" varchar(5) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."mempermissions\" (\"id\", \"CanViewBoard\", \"CanViewOffLine\", \"CanEditProfile\", \"CanAddEvents\", \"CanPM\", \"CanSearch\", \"CanExecPHP\", \"CanDoHTML\", \"CanUseBBags\", \"CanModForum\", \"FloodControl\", \"SearchFlood\", \"HasModCP\", \"HasAdminCP\", \"ViewDBInfo\") VALUES\n".
"(-1, 'group', 'group', 'group', 'group', 'group', 'group', 'group', 'group', 'group', 'group', -1, -1, 'group', 'group', 'group'),\n".
"(1, 'group', 'group', 'group', 'group', 'group', 'group', 'group', 'group', 'group', 'group', -1, -1, 'group', 'group', 'group');", array(null));
//"(-1, 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 30, 30, 'no', 'no', 'no'),\n".
//"(1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 30, 30, 'yes', 'yes', 'yes');", array(null));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."messenger\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"SenderID\" integer NOT NULL default '0',\n".
"  \"ReciverID\" integer NOT NULL default '0',\n".
"  \"GuestName\" varchar(150) NOT NULL default '',\n".
"  \"MessageTitle\" varchar(150) NOT NULL default '',\n".
"  \"MessageText\" varchar(65535) NOT NULL,\n".
"  \"Description\" varchar(65535) NOT NULL,\n".
"  \"DateSend\" integer NOT NULL default '0',\n".
"  \"Read\" integer NOT NULL default '0',\n".
"  \"IP\" varchar(50) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."messenger\" (\"SenderID\", \"ReciverID\", \"GuestName\", \"MessageTitle\", \"MessageText\", \"Description\", \"DateSend\", \"Read\", \"IP\") VALUES\n".
"(-1, 1, '".$iDB_Author."', 'Welcome', 'Welcome to your new Internet Discussion Board! :)\r\nThis is a Test PM. :P ', 'Welcome %s', %i, 0, '127.0.0.1');", array($_POST['AdminUser'],$YourDate));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."permissions\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"PermissionID\" integer NOT NULL default '0',\n".
"  \"Name\" varchar(150) NOT NULL default '',\n".
"  \"ForumID\" integer NOT NULL default '0',\n".
"  \"CanViewForum\" varchar(5) NOT NULL default '',\n".
"  \"CanMakePolls\" varchar(5) NOT NULL default '',\n".
"  \"CanMakeTopics\" varchar(5) NOT NULL default '',\n".
"  \"CanMakeReplys\" varchar(5) NOT NULL default '',\n".
"  \"CanMakeReplysCT\" varchar(5) NOT NULL default '',\n".
"  \"CanEditTopics\" varchar(5) NOT NULL default '',\n".
"  \"CanEditTopicsCT\" varchar(5) NOT NULL default '',\n".
"  \"CanEditReplys\" varchar(5) NOT NULL default '',\n".
"  \"CanEditReplysCT\" varchar(5) NOT NULL default '',\n".
"  \"CanDeleteTopics\" varchar(5) NOT NULL default '',\n".
"  \"CanDeleteTopicsCT\" varchar(5) NOT NULL default '',\n".
"  \"CanDeleteReplys\" varchar(5) NOT NULL default '',\n".
"  \"CanDeleteReplysCT\" varchar(5) NOT NULL default '',\n".
"  \"CanCloseTopics\" varchar(5) NOT NULL default '',\n".
"  \"CanPinTopics\" varchar(5) NOT NULL default '',\n".
"  \"CanExecPHP\" varchar(5) NOT NULL default '',\n".
"  \"CanDoHTML\" varchar(5) NOT NULL default '',\n".
"  \"CanUseBBags\" varchar(5) NOT NULL default '',\n".
"  \"CanModForum\" varchar(5) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."permissions\" (\"PermissionID\", \"Name\", \"ForumID\", \"CanViewForum\", \"CanMakePolls\", \"CanMakeTopics\", \"CanMakeReplys\", \"CanMakeReplysCT\", \"CanEditTopics\", \"CanEditTopicsCT\", \"CanEditReplys\", \"CanEditReplysCT\", \"CanDeleteTopics\", \"CanDeleteTopicsCT\", \"CanDeleteReplys\", \"CanDeleteReplysCT\", \"CanCloseTopics\", \"CanPinTopics\", \"CanExecPHP\", \"CanDoHTML\", \"CanUseBBags\", \"CanModForum\") VALUES\n".
"(1, 'Admin', 1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),\n".
"(2, 'Moderator', 1, 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'no', 'yes', 'yes'),\n".
"(3, 'Member', 1, 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'no', 'yes', 'no', 'yes', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'yes', 'no'),\n".
"(4, 'Guest', 1, 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'),\n".
"(5, 'Banned', 1, 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no'),\n".
"(6, 'Validate', 1, 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no');", array(null)); 
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."polls\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"UserID\" integer NOT NULL default '0',\n".
"  \"GuestName\" varchar(150) NOT NULL default '',\n".
"  \"PollValues\" varchar(65535) NOT NULL,\n".
"  \"Description\" varchar(65535) NOT NULL,\n".
"  \"UsersVoted\" varchar(65535) NOT NULL,\n".
"  \"IP\" varchar(50) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."posts\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"TopicID\" integer NOT NULL default '0',\n".
"  \"ForumID\" integer NOT NULL default '0',\n".
"  \"CategoryID\" integer NOT NULL default '0',\n".
"  \"UserID\" integer NOT NULL default '0',\n".
"  \"GuestName\" varchar(150) NOT NULL default '',\n".
"  \"TimeStamp\" integer NOT NULL default '0',\n".
"  \"LastUpdate\" integer NOT NULL default '0',\n".
"  \"EditUser\" integer NOT NULL default '0',\n".
"  \"EditUserName\" varchar(150) NOT NULL default '',\n".
"  \"Post\" varchar(65535) NOT NULL,\n".
"  \"Description\" varchar(65535) NOT NULL,\n".
"  \"IP\" varchar(50) NOT NULL default '',\n".
"  \"EditIP\" varchar(50) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."posts\" (\"TopicID\", \"ForumID\", \"CategoryID\", \"UserID\", \"GuestName\", \"TimeStamp\", \"LastUpdate\", \"EditUser\", \"EditUserName\", \"Post\", \"Description\", \"IP\", \"EditIP\") VALUES\n".
"(1, 1, 1, -1, '".$iDB_Author."', %i, %i, 1, '".$_POST['AdminUser']."', 'Welcome to your new Internet Discussion Board! :) ', 'Welcome %s', '127.0.0.1', '127.0.0.1');", array($YourDate,$YourEditDate,$_POST['AdminUser'])); 
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."restrictedwords\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"Word\" varchar(65535) NOT NULL,\n".
"  \"RestrictedUserName\" varchar(5) NOT NULL default '',\n".
"  \"RestrictedTopicName\" varchar(5) NOT NULL default '',\n".
"  \"RestrictedEventName\" varchar(5) NOT NULL default '',\n".
"  \"RestrictedMessageName\" varchar(5) NOT NULL default '',\n".
"  \"CaseInsensitive\" varchar(5) NOT NULL default '',\n".
"  \"WholeWord\" varchar(5) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."sessions\" (\n".
"  \"session_id\" VARCHAR(250) NOT NULL default '' PRIMARY KEY,\n".
"  \"session_data\" varchar(65535) NOT NULL,\n".
"  \"user_agent\" varchar(65535) NOT NULL,\n".
"  \"ip_address\" varchar(20) NOT NULL default '',\n".
"  \"expires\" integer NOT NULL default '0'\n".
");", array(null));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."smileys\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"FileName\" varchar(65535) NOT NULL,\n".
"  \"SmileName\" varchar(65535) NOT NULL,\n".
"  \"SmileText\" varchar(65535) NOT NULL,\n".
"  \"Directory\" varchar(65535) NOT NULL,\n".
"  \"Display\" varchar(5) NOT NULL default '',\n".
"  \"ReplaceCI\" varchar(5) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."smileys\" (\"FileName\", \"SmileName\", \"SmileText\", \"Directory\", \"Display\", \"ReplaceCI\") VALUES\n".
"('angry.png', 'Angry', ':angry:', 'smileys/', 'yes', 'yes'),\n".
"('closedeyes.png', 'Sleep', 'v_v', 'smileys/', 'yes', 'no'),\n".
"('cool.png', 'Cool', 'B)', 'smileys/', 'yes', 'no'),\n".
"('glare.png', 'Hmph', ':hmph:', 'smileys/', 'yes', 'yes'),\n".
"('happy.png', 'Happy', '^_^', 'smileys/', 'yes', 'no'),\n".
"('hmm.png', 'Hmm', ':unsure:', 'smileys/', 'yes', 'yes'),\n".
"('huh.png', 'Huh', ':huh:', 'smileys/', 'yes', 'yes'),\n".
"('laugh.png', 'lol', ':laugh:', 'smileys/', 'yes', 'yes'),\n".
"('lol.png', 'lol', ':lol:', 'smileys/', 'yes', 'yes'),\n".
"('mad.png', 'Mad', ':mad:', 'smileys/', 'yes', 'yes'),\n".
"('ninja.png', 'Ninja', ':ninja:', 'smileys/', 'yes', 'yes'),\n".
"('ohno.png', 'ohno', ':ohno:', 'smileys/', 'yes', 'yes'),\n".
"('ohmy.png', 'ohmy', ':o', 'smileys/', 'yes', 'yes'),\n".
"('sad.png', 'Sad', ':(', 'smileys/', 'yes', 'no'),\n".
"('sleep.png', 'Sleep', '-_-', 'smileys/', 'yes', 'no'),\n".
"('smile.png', 'Happy', ':)', 'smileys/', 'yes', 'no'),\n".
"('sweat.png', 'Sweat', ':sweat:', 'smileys/', 'yes', 'yes'),\n".
"('tongue.png', 'Tongue', ':P', 'smileys/', 'yes', 'no'),\n".
"('wub.png', 'Wub', ':wub:', 'smileys/', 'yes', 'yes'),\n".
"('x.png', 'X', ':x:', 'smileys/', 'yes', 'yes');", array(null));
sql_query($query,$SQLStat);
/*
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."tagboard\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"UserID\" integer NOT NULL default '0',\n".
"  \"GuestName\" varchar(150) NOT NULL default '',\n".
"  \"TimeStamp\" integer NOT NULL default '0',\n".
"  \"Post\" varchar(65535) NOT NULL,\n".
"  \"IP\" varchar(50) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."tagboard\" VALUES (1,-1,'".$iDB_Author."',".$YourDate.",'Welcome to Your New Tag Board. ^_^','127.0.0.1'), array(null)); 
sql_query($query,$SQLStat);
*/
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."themes\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"Name\" varchar(32) NOT NULL default '' UNIQUE,\n".
"  \"ThemeName\" varchar(150) NOT NULL default '',\n".
"  \"ThemeMaker\" varchar(150) NOT NULL default '',\n".
"  \"ThemeVersion\" varchar(150) NOT NULL default '',\n".
"  \"ThemeVersionType\" varchar(150) NOT NULL default '',\n".
"  \"ThemeSubVersion\" varchar(150) NOT NULL default '',\n".
"  \"MakerURL\" varchar(150) NOT NULL default '',\n".
"  \"CopyRight\" varchar(150) NOT NULL default '',\n".
"  \"CSS\" varchar(65535) NOT NULL,\n".
"  \"CSSType\" varchar(150) NOT NULL default '',\n".
"  \"FavIcon\" varchar(150) NOT NULL default '',\n".
"  \"TableStyle\" varchar(150) NOT NULL default '',\n".
"  \"MiniPageAltStyle\" varchar(150) NOT NULL default '',\n".
"  \"PreLogo\" varchar(150) NOT NULL default '',\n".
"  \"Logo\" varchar(150) NOT NULL default '',\n".
"  \"LogoStyle\" varchar(150) NOT NULL default '',\n".
"  \"SubLogo\" varchar(150) NOT NULL default '',\n".
"  \"TopicIcon\" varchar(150) NOT NULL default '',\n".
"  \"MovedTopicIcon\" varchar(150) NOT NULL default '',\n".
"  \"HotTopic\" varchar(150) NOT NULL default '',\n".
"  \"MovedHotTopic\" varchar(150) NOT NULL default '',\n".
"  \"PinTopic\" varchar(150) NOT NULL default '',\n".
"  \"AnnouncementTopic\" varchar(150) NOT NULL default '',\n".
"  \"MovedPinTopic\" varchar(150) NOT NULL default '',\n".
"  \"HotPinTopic\" varchar(150) NOT NULL default '',\n".
"  \"MovedHotPinTopic\" varchar(150) NOT NULL default '',\n".
"  \"ClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"MovedClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"HotClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"MovedHotClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"PinClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"MovedPinClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"HotPinClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"MovedHotPinClosedTopic\" varchar(150) NOT NULL default '',\n".
"  \"MessageRead\" varchar(150) NOT NULL default '',\n".
"  \"MessageUnread\" varchar(150) NOT NULL default '',\n".
"  \"Profile\" varchar(150) NOT NULL default '',\n".
"  \"WWW\" varchar(150) NOT NULL default '',\n".
"  \"PM\" varchar(150) NOT NULL default '',\n".
"  \"TopicLayout\" varchar(150) NOT NULL default '',\n".
"  \"AddReply\" varchar(150) NOT NULL default '',\n".
"  \"FastReply\" varchar(150) NOT NULL default '',\n".
"  \"NewTopic\" varchar(150) NOT NULL default '',\n".
"  \"QuoteReply\" varchar(150) NOT NULL default '',\n".
"  \"EditReply\" varchar(150) NOT NULL default '',\n".
"  \"DeleteReply\" varchar(150) NOT NULL default '',\n".
"  \"Report\" varchar(150) NOT NULL default '',\n".
"  \"LineDivider\" varchar(150) NOT NULL default '',\n".
"  \"ButtonDivider\" varchar(150) NOT NULL default '',\n".
"  \"LineDividerTopic\" varchar(150) NOT NULL default '',\n".
"  \"TitleDivider\" varchar(150) NOT NULL default '',\n".
"  \"ForumStyle\" varchar(150) NOT NULL default '',\n".
"  \"ForumIcon\" varchar(150) NOT NULL default '',\n".
"  \"SubForumIcon\" varchar(150) NOT NULL default '',\n".
"  \"RedirectIcon\" varchar(150) NOT NULL default '',\n".
"  \"TitleIcon\" varchar(150) NOT NULL default '',\n".
"  \"NavLinkIcon\" varchar(150) NOT NULL default '',\n".
"  \"NavLinkDivider\" varchar(150) NOT NULL default '',\n".
"  \"StatsIcon\" varchar(150) NOT NULL default '',\n".
"  \"NoAvatar\" varchar(150) NOT NULL default '',\n".
"  \"NoAvatarSize\" varchar(150) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."topics\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"PollID\" integer NOT NULL default '0',\n".
"  \"ForumID\" integer NOT NULL default '0',\n".
"  \"CategoryID\" integer NOT NULL default '0',\n".
"  \"OldForumID\" integer NOT NULL default '0',\n".
"  \"OldCategoryID\" integer NOT NULL default '0',\n".
"  \"UserID\" integer NOT NULL default '0',\n".
"  \"GuestName\" varchar(150) NOT NULL default '',\n".
"  \"TimeStamp\" integer NOT NULL default '0',\n".
"  \"LastUpdate\" integer NOT NULL default '0',\n".
"  \"TopicName\" varchar(150) NOT NULL default '',\n".
"  \"Description\" varchar(65535) NOT NULL,\n".
"  \"NumReply\" integer NOT NULL default '0',\n".
"  \"NumViews\" integer NOT NULL default '0',\n".
"  \"Pinned\" integer NOT NULL default '0',\n".
"  \"Closed\" integer NOT NULL default '0'\n".
");", array(null));
sql_query($query,$SQLStat);
$query = sql_pre_query("INSERT INTO \"".$_POST['tableprefix']."topics\" (\"PollID\", \"ForumID\", \"CategoryID\", \"OldForumID\", \"OldCategoryID\", \"UserID\", \"GuestName\", \"TimeStamp\", \"LastUpdate\", \"TopicName\", \"Description\", \"NumReply\", \"NumViews\", \"Pinned\", \"Closed\") VALUES\n".
"(0, 1, 1, 1, 1, -1, '".$iDB_Author."', %i, %i, 'Welcome', 'Welcome %s', 0, 0, 1, 1);", array($YourDate,$YourDate,$_POST['AdminUser']));
sql_query($query,$SQLStat);
$query=sql_pre_query("CREATE TABLE \"".$_POST['tableprefix']."wordfilter\" (\n".
"  \"id\" integer AUTO_INCREMENT PRIMARY KEY,\n".
"  \"FilterWord\" varchar(65535) NOT NULL,\n".
"  \"Replacement\" varchar(65535) NOT NULL,\n".
"  \"CaseInsensitive\" varchar(5) NOT NULL default '',\n".
"  \"WholeWord\" varchar(5) NOT NULL default ''\n".
");", array(null));
sql_query($query,$SQLStat);
/*
$TableChCk = array("categories", "catpermissions", "events", "forums", "groups", "members", "mempermissions", "messenger", "permissions", "polls", "posts", "restrictedwords", "sessions", "smileys", "topics", "wordfilter");
$TablePreFix = $_POST['tableprefix'];
function add_prefix($tarray) {
global $TablePreFix;
return $TablePreFix.$tarray; }
$TableChCk = array_map("add_prefix",$TableChCk);
$tcount = count($TableChCk); $ti = 0;
while ($ti < $tcount) {
$OptimizeTea = sql_query(sql_pre_query("OPTIMIZE TABLE \"".$TableChCk[$ti]."\"", array(null)),$SQLStat);
++$ti; }
*/
?>