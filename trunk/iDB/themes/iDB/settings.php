<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the Revised BSD License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    Revised BSD License for more details.

    Copyright 2004-2006 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2006 Game Maker 2k - http://upload.idb.s1.jcink.com/

    $FileInfo: settings.php - Last Update: 04/07/2007 SVN 37 - Author: cooldude2k $
*/
$ThemeSet = array();
$ThemeSet['ThemeName'] = "iDB Theme";
$ThemeSet['ThemeMaker'] = "Cool Dude 2k";
$ThemeSet['ThemeVersion'] = "0.1.4";
$ThemeSet['ThemeVersionType'] = "Pre-Alpha";
$ThemeSet['ThemeSubVersion'] = "SVN 36";
$ThemeSet['MakerURL'] = "http://upload.idb.s1.jcink.com/";
$ThemeSet['CSS'] = "themes/iDB/css.css";
$ThemeSet['CSSType'] = "include";
$ThemeSet['FavIcon'] = "themes/iDB/favicon.ico";
$ThemeSet['PreLogo'] = "<div style=\"text-align: center;\">";
$ThemeSet['Logo'] = "<img alt=\"".$Settings['board_name']."\" src=\"themes/iDB/logo.png\" />";
$ThemeSet['SubLogo'] = "</div>";
$ThemeSet['CopyRight'] = $ThemeSet['ThemeName']." Theme was made by <a href=\"".$ThemeSet['MakerURL']."\" title=\"".$ThemeSet['ThemeMaker']."\">".$ThemeSet['ThemeMaker']."</a>";
$ThemeSet['Toggle'] = "[&#35;]";
$ThemeSet['ToggleExt'] = null;
$ThemeSet['TopicIcon'] = "<div style=\"text-align: center;\" title=\"Topic!\">[T]</div>";
$ThemeSet['HotTopic'] = "<div style=\"text-align: center; font-weight: bold;\" title=\"Hot Topic!\">[T]</div>";
$ThemeSet['PinTopic'] = "<div style=\"text-align: center;\" title=\"Pinned Topic!\">[P]</div>";
$ThemeSet['HotPinTopic'] = "<div style=\"text-align: center; font-weight: bold;\" title=\"Hot Pinned Topic!\">[P]</div>";
$ThemeSet['ClosedTopic'] = "<div style=\"text-align: center; text-decoration: line-through;\" title=\"Closed Topic!\">[T]</div>";
$ThemeSet['HotClosedTopic'] = "<div style=\"text-align: center; text-decoration: line-through; font-weight: bold;\" title=\"Hot Closed Topic!\">[T]</div>";
$ThemeSet['PinClosedTopic'] = "<div style=\"text-align: center; text-decoration: line-through;\" title=\"Closed Pinned Topic!\">[P]</div>";
$ThemeSet['HotPinClosedTopic'] = "<div style=\"text-align: center; text-decoration: line-through; font-weight: bold;\" title=\"Hot Closed Pinned Topic!\">[P]</div>";
$ThemeSet['MessageRead'] = "<div style=\"text-align: center;\" title=\"Message!\">[M]</div>";
$ThemeSet['MessageUnread'] = "<div style=\"text-align: center; font-weight: bold;\" title=\"New Message!\">[M]</div>";
$ThemeSet['Profile'] = "Profile";
$ThemeSet['WWW'] = "WWW";
$ThemeSet['PM'] = "PM";
$ThemeSet['TopicLayout'] = "Type 1";
$ThemeSet['AddReply'] = "<span style=\"color: white; font-size: 25px;\" title=\"Add Reply\">Add Reply</span>";
$ThemeSet['FastReply'] = "<span style=\"color: white; font-size: 25px;\" title=\"Fast Reply\">Fast Reply</span>";
$ThemeSet['NewTopic'] = "<span style=\"color: white; font-size: 25px;\" title=\"New Topic\">New Topic</span>";
$ThemeSet['QuoteReply'] = "Quote Reply";
$ThemeSet['Report'] = "Report";
$ThemeSet['LineDivider'] = "&nbsp;|&nbsp;";
$ThemeSet['LineDividerTopic'] = "&nbsp;|&nbsp;";
$ThemeSet['TitleDivider'] = "-&gt;";
$ThemeSet['ForumIcon'] = "<div style=\"text-align: center;\" title=\"Forum\">(F)</div>";
$ThemeSet['SubForumIcon'] = "<div style=\"text-align: center;\" title=\"SubForum\">(SF)</div>";
$ThemeSet['RedirectIcon'] = "<div style=\"text-align: center;\" title=\"Redirect Forum\">(RF)</div>";
$ThemeSet['TitleIcon'] = null;
$ThemeSet['StatsIcon'] = null;
$ThemeSet['NoAvatar'] = "themes/iDB/noavatar.png";
$ThemeSet['NoAvatarSize'] = "100x100";
?>