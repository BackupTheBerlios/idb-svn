<?php
/*
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    Copyright 2004-2006 Cool Dude 2k - http://idb.berlios.de/
    Copyright 2004-2006 Game Maker 2k - http://cooldude2k.co.funpic.org/
    Emoticons made by Jcink http://tfbb.jcink.com/
*/
if($urlvars==null) {
if($_SERVER['PATH_INFO']==null) {
	if(getenv('PATH_INFO')!=null) {
$_SERVER['PATH_INFO'] = getenv('PATH_INFO'); } }
if($_SERVER['PATH_INFO']!=null) {
$urlvars = explode("/",$_SERVER['PATH_INFO']); } }
if($_SERVER['PATH_INFO']!=null) {
if($_GET['act']==null&&$urlvars[1]!=null) {
	$_GET['act']=$urlvars[1]; } }
if($_GET['act']==null)
{ $_GET['act']="BoardFeed"; }
if($_GET['act']=="BoardFeed")
{	require('inc/rss/rss1.php'); $Feed['Feed']="Done"; }
if($_GET['act']=="CategoryFeed")
{	require('inc/rss/rss3.php'); $Feed['Feed']="Done"; }
if($_GET['act']=="TopicFeed")
{	require('inc/rss/rss2.php'); $Feed['Feed']="Done"; }
if($_GET['act']=="EventFeed")
{	require('inc/rss/rss4.php'); $Feed['Feed']="Done"; }
if($Feed['Feed']!="Done")
{	require('inc/rss/rss1.php'); $Feed['Feed']="Done"; }
?>