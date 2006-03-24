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
*/
require('Preindex.php'); ?>

<title> <?php echo $Settings['board_name']." (Powered by ".$iDB.")"; ?> </title>
</head>
<body>
<?php
require('inc/navbar.php');
if($_SESSION['UserGroup']==$Settings['GuestGroup']) {
header('Location: index.php'); }
?>
<div>&nbsp;</div>
<table style="width: 100%; vertical-align: top;">
<tr style="width: 100%; vertical-align: top;">
	<td style="width: 15%; vertical-align: top;">
	<table class="Table1" style="width: 100%; float: left; vertical-align: top;">
<tr class="TableRow1">
<td class="TableRow1">Profile Settings</td>
</tr><tr class="TableRow2">
<td class="TableRow2">&nbsp;</td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="Messenger.php#Edit%20Profile">Edit Profile</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="Messenger.php#Edit%20Signature">Edit Signature</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="Messenger.php#Edit%20Avatar">Edit Avatar</a></td>
</tr><tr class="TableRow4">
<td class="TableRow4">&nbsp;</td>
</tr></table><div>&nbsp;</div>
<table class="Table1" style="width: 100%; float: left; vertical-align: top;">
<tr class="TableRow1">
<td class="TableRow1">Board Settings</td>
</tr><tr class="TableRow2">
<td class="TableRow2">&nbsp;</td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="Messenger.php#Edit%20Skin">Change Skin</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="Messenger.php#Edit%20Other">Other Settings</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="Messenger.php#Edit%20Password">Change Password</a></td>
</tr><tr class="TableRow3">
<td class="TableRow3"><a href="Messenger.php#Edit%20Email">Change Email</a></td>
</tr><tr class="TableRow4">
<td class="TableRow4">&nbsp;</td>
</tr></table>
</td>
	<td style="width: 85%; vertical-align: top;">
<?php
if($_GET['act']==null)
{ $_GET['act']="View"; }
if($_GET['act']=="View")
{ require('inc/profilemain.php'); }
?>
</td></tr>
</table>
<ins><br /></ins>
<?php
require('inc/endpage.php'); ?>
</body>
</html>
<?php
fix_amp(null);
?>