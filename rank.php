<?php
// $Id: index.php,v 1.2 2003/01/25 22:52:08 onokazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
include "../../mainfile.php";
include "../../header.php";

	$db =& Database::getInstance();


	echo "<br><h4 style='text-align:center;'>Member Rank</h4><br><br>

	<table width='100%' class='head' cellpadding='4' cellspacing='1'>
	<tr align='center'>
	<td><font color=#666666>Rank</font></td>
	<td><font color=#666666>Minimum Post</td>
	<td><font color=#666666>Maximum Post</font></td>
	<td><font color=#666666>Image</font></td></tr>";
	$result = $db->query("SELECT * FROM ".$db->prefix("ranks")." where rank_special=0 ORDER BY rank_id");
	$count = 0;
	while ( $rank = $db->fetchArray($result) ) {
		if ($count % 2 == 0) {
			$class = 'odd';
		} else {
			$class = 'even';
		}
		echo "<tr class='$class' align='center'>
		<td>".$rank['rank_title']."</td>
		<td>".$rank['rank_min']."</td>
		<td>".$rank['rank_max']."</td>
		<td>";
		if ( $rank['rank_image'] ) {
			echo '<img src="'.XOOPS_URL.'/uploads/'.$rank['rank_image'].'" alt="" ></td>';
		} else {
			echo '&nbsp;';
		}
		echo"</tr>";
		$count++;
    }
    echo '</table><br><br>';

include_once XOOPS_ROOT_PATH."/footer.php";
?>

