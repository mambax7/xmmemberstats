<?php
// $Id: index.php,v 1.2 2003/01/25 22:52:08 onokazu Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
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
//  ------------------------------------------------------------------------ //
//  Modified by : Mohd Hilmi Bin Ngah (ComFlash2)                            //
//  Compatible with : XOOPS 2.0.x                                            //
//  Tested With: XOOPS 2.0.13.1                                              //
//               PHP 4.3.0                                                   //
//               Apache 1.3.27                                               //
//                                                                           //
//  ComFlash Technology                                                      //
//  330-18-13 Taman Gambir,                                                  //
//  Jalan Bukit Gambir,                                                      //
//  11700 Sungai Dua,                                                        //
//  Pulau Pinang,                                                            //
//  Malaysia.                                                                //
//                                                                           //
//  (+6)012-7413082                                                          //
//                                                                           //
//  * We design Custom PCB, Microcontroller Design, Firmware Programming,    //
//  Software Development (VB6, C++, C, JAVA, Delphi) in Windows/Linux,       //
//  PHP, PERL, Circuit Simulation / Debug.                                   //
//  ------------------------------------------------------------------------ //




include "../../mainfile.php";
//include "../../header.php";
function alpha() {
	global $sortby, $xoopsConfig;
	$alphabet = array (_ML_ALL, "A","B","C","D","E","F","G","H","I","J","K","L","M",
                            "N","O","P","Q","R","S","T","U","V","W","X","Y","Z",_ML_OTHER);
        $num = count($alphabet) - 1;
        echo "<div align='center'>[ "; // start of HTML
        $counter = 0;
        while (list(, $ltr) = each($alphabet)) {
            	echo "<a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$ltr."&sortby=".$sortby."'>".$ltr."</a>";
            	if ( $counter == round($num/2) ) {
                	echo " ]\n<br />\n[ ";
            	} elseif ( $counter != $num ) {
                	echo "&nbsp;|&nbsp;\n";
            	}
            	$counter++;
        }
        echo " ]\n</div>\n<br />\n";
}

if ( $xoopsConfig['startpage'] == "xmmemberstats" ) {
	$xoopsOption['show_rblock'] =1;
	include(XOOPS_ROOT_PATH."/header.php");
	make_cblock();
	echo "<br />";
} else {
	$xoopsOption['show_rblock'] =1;
	include(XOOPS_ROOT_PATH."/header.php");
	echo "<br />";
}
//$sortby= $_GET['sortby'];
//echo $sortby;


if(isset($_GET['letter']))
{
$letter= $_GET['letter'];
}

if(isset($_GET['sortby']))
{
$sortby= $_GET['sortby'];
}

if(isset($_GET['orderby']))
{
$orderby= $_GET['orderby'];
}

if(isset($_GET['page']))
{
	$page= $_GET['page'];
}

if(isset($_GET['query']))
{
$query= $_GET['query'];
}

if(isset($_POST['query']))
{
$query= $_POST['query'];
}


//echo $query;

//$query="2003";
$pagesize = 10;

if ( !isset($letter) ) { $letter = _ML_ALL; }
if ( !isset($sortby) ) { $sortby = "uid"; }
if ( !isset($orderby) ) { $orderby = "ASC"; }
if ( !isset($page) ) { $page = 1; }

if ( isset($query) ) {
        $where = "  WHERE ".$xoopsDB->prefix("users").".level >0 AND (".$xoopsDB->prefix("users").".uname LIKE '%$query%' OR ".$xoopsDB->prefix("users").".name LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_icq LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_from LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_sig LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_aim LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_yim LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_msnm LIKE '%$query%'";
	if ( $xoopsUser ) {
        	if ( $xoopsUser->isAdmin() ) {
        		$where .= " OR ".$xoopsDB->prefix("users").".email LIKE '%$query%'";
		}
        }
	$where .= ") ";
} else {
    	$where = " WHERE ".$xoopsDB->prefix("users").".level >0";
}
//echo "SELECT ".$xoopsDB->prefix("users").".uid, ".$xoopsDB->prefix("users").".uname FROM ".$xoopsDB->prefix("users")." ".$where." ORDER BY ".$xoopsDB->prefix("users").".uid DESC";
$result = $xoopsDB->query("SELECT ".$xoopsDB->prefix("users").".uid, ".$xoopsDB->prefix("users").".uname FROM ".$xoopsDB->prefix("users")." ".$where." ORDER BY ".$xoopsDB->prefix("users").".uid DESC",1,0);
list($lastuid, $lastuser) = $xoopsDB->fetchRow($result);

//$result = $xoopsDB->query("SELECT * FROM ".$xoopsDB->prefix("users")." $ ORDER BY profileid DESC",1,0);
//list($lastuid, $lastuser) = $xoopsDB->fetchRow($result);


echo "<div align='center'><b>";
printf(_ML_WELCOMETO,$xoopsConfig['sitename']);
echo "</b><br /><br />\n";
echo _ML_GREETINGS." <a href='".XOOPS_URL."/userinfo.php?uid=".$lastuid."'>".$lastuser."</a></div>\n";
if (isset($query) && trim($query) != "") {
        $where = " WHERE ".$xoopsDB->prefix("users").".level >0 AND (".$xoopsDB->prefix("users").".uname LIKE '%$query%' OR ".$xoopsDB->prefix("users").".name LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_icq LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_from LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_sig LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_aim LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_yim LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_msnm LIKE '%$query%'";

        if ( $xoopsUser ) {
		if ( $xoopsUser->isAdmin() ) {
        		$where .= " OR ".$xoopsDB->prefix("users").".email LIKE '%$query%'";
        	}
	}
	$where .= ") ";
} else {
    	$where = " WHERE ".$xoopsDB->prefix("users").".level >0";
}

//echo "SELECT COUNT(*) FROM ".$xoopsDB->prefix("users")." ".$where;
list($numrows) = $xoopsDB->fetchRow($xoopsDB->query("SELECT COUNT(*) FROM ".$xoopsDB->prefix("users")." ".$where));

echo "<div align='center'>";
echo "</div><br /><br />";

echo "<table align='center'><tr><td align='right' width=58%><form action='".XOOPS_URL."/modules/xmmemberstats/index.php' method='post'>";
if ( isset($query) ) {
    	echo "<input type='text' size='30' name='query' value='$query' />";
} else {
    	echo "<input type='text' size='30' name='query' />";
}
echo "<input type='submit' value='"._ML_SEARCH."' /></form></td><td>";

echo "<form action='".XOOPS_URL."/modules/xmmemberstats/index.php' method='post'>";
echo "<input type='submit' value='" ._ML_RESETSEARCH."' />";
echo "</form></td></tr></table>";
alpha();

$min = $pagesize * ($page - 1);
$max = $pagesize;

/*
SELECT field1, field2, field3
FROM first_table
INNER JOIN second_table
ON first_table.keyfield = second_table.foreign_keyfield
*/


$count = "SELECT COUNT(".$xoopsDB->prefix("users").".uid) AS total FROM ".$xoopsDB->prefix("users"); // Count all the users in the db..
$select = "SELECT * FROM ".$xoopsDB->prefix("users");
if ( ( $letter != _ML_OTHER ) AND ( $letter != _ML_ALL ) ) {
	$where = " WHERE ".$xoopsDB->prefix("users").".level >0 AND ".$xoopsDB->prefix("users").".uname LIKE '".$letter."%' ";
} else if ( ( $letter == _ML_OTHER ) AND ( $letter != _ML_ALL ) ) {
        $where = " WHERE ".$xoopsDB->prefix("users").".level >0 AND ".$xoopsDB->prefix("users").".uname REGEXP '^\[1-9]' ";
} else {
        $where = " WHERE ".$xoopsDB->prefix("users").".level >0 ";
}

//echo $sortby;
$sortby2=$sortby;
if ($sortby == "uid") $sortby=$xoopsDB->prefix("users").".uid";
if ($sortby == "user_avatar") $sortby=$xoopsDB->prefix("users").".user_avatar";
if ($sortby == "uname") $sortby=$xoopsDB->prefix("users").".uname";
if ($sortby == "user_regdate") $sortby=$xoopsDB->prefix("users").".user_regdate";
if ($sortby == "url") $sortby=$xoopsDB->prefix("users").".url";
if ($sortby == "email") $sortby=$xoopsDB->prefix("users").".email";

$sort = "order by $sortby $orderby";


if ( isset($query) ) {
        $where = " WHERE ".$xoopsDB->prefix("users").".level >0 AND (".$xoopsDB->prefix("users").".uname LIKE '%$query%' OR ".$xoopsDB->prefix("users").".name LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_icq LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_from LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_sig LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_aim LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_yim LIKE '%$query%'";
        $where .= " OR ".$xoopsDB->prefix("users").".user_msnm LIKE '%$query%'";
    	if ( $xoopsUser ) {
		if ( $xoopsUser->isAdmin() ) {
        		$where .= " OR ".$xoopsDB->prefix("users").".email LIKE '%$query%'";
		}
        }
	$where .= ") ";
}

//echo $count." ++ ".$where;
$count_result = $xoopsDB->query($count.$where);
list($num_rows_per_order) = $xoopsDB->fetchRow($count_result);
echo $num_rows_per_order." records found";
//echo $min;
//echo $select.$where.$sort;
$result = $xoopsDB->query($select.$where.$sort,$max,$min) or die($xoopsDB->error() ); // Now lets do it !!

echo "<br />";
if ( $letter != "front" ) {
		 $orderby2=$orderby;
	if ( $orderby == "ASC" ) {
		$orderby = "DESC";
	} else {
		$orderby = "ASC";
	}
	if ( !isset($query) ) {
		$query = "";
	}
	echo "<table border='0' cellpadding='0' cellspacing='0' valign='top' width='100%' class='head'><tr><td>\n";
	echo "<table width='100%' border='0' cellspacing='1' cellpadding='4'><tr>\n";
	echo "<td align='center'><span ><b><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=user_avatar&orderby=".$orderby."&query=".$query."'>"._ML_AVATAR."</a></b></span></td>\n";
        echo "<td align='center'><span ><b><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=uname&orderby=".$orderby."&query=".$query."'>"._ML_NICKNAME."</a></b></span></td>\n";

	echo "<td align='center'><span ><b><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=user_regdate&orderby=".$orderby."&query=".$query."'>"._ML_REGDATE."</a></b></span></td>\n";
        echo "<td align='center'><span ><b><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=email&orderby=".$orderby."&query=".$query."'>"._ML_EMAIL."</a></b></span></td>\n";
	echo "<td align='center'><span ><b><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=email&orderby=".$orderby."&query=".$query."'>"._ML_PM."</a></b></span></td>\n";
        echo "<td align='center'><span ><b><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=url&orderby=".$orderby."&query=".$query."'>"._ML_URL."</a></b></span></td>\n";
        $cols = 7;
        if ( $xoopsUser ) {
		if ( $xoopsUser->isAdmin() ) {
                	$cols = 8;
                	echo "<td align='center'><span ><b><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=email&orderby=".$orderby."&query=".$query."'>"._ML_FUNCTIONS."</a></b></span></td>\n";
		}
        }
        echo "</tr>";
        $a = 0;
        $dcolor_A = "odd";
        $dcolor_B = "even";

        $num_users = $xoopsDB->getRowsNum($result); //number of users per sorted and limit query
        if ( $num_rows_per_order > 0  ) {
                while ( $userinfo = $xoopsDB->fetchArray($result) ) {
			$userinfo = new XoopsUser($userinfo['uid']);
                    	$dcolor = ($a == 0 ? $dcolor_A : $dcolor_B);
                    	echo "<tr class='".$dcolor."'>\n";
			echo "<td align='center'><img src='".XOOPS_URL."/uploads/".$userinfo->user_avatar()."' alt='' width='64' height='64' />&nbsp;</td>\n";
			echo "<td align='center'><a href='".XOOPS_URL."/userinfo.php?uid=".$userinfo->uid()."'>".$userinfo->uname("E")."</a>&nbsp;</td>\n";
                    	echo "\n";
			echo "<td align='center'>".formatTimeStamp($userinfo->user_regdate(),"m")."&nbsp;</td>\n";
			$showmail = 0;
			if ( $userinfo->user_viewemail() ) {
				$showmail = 1;
			} else {
				if ( $xoopsUser ) {
					if ( $xoopsUser->isAdmin() ) {
						$showmail = 1;
					}
				}

			}
			if ( $showmail ){
				echo "<td align='center'><a href='mailto:".$userinfo->email("E")."'><img src='".XOOPS_URL."/images/icons/email.gif' border='0' alt='";
				printf(_SENDEMAILTO,$userinfo->uname("E"));
				echo "' /></a></td>\n";
			} else {
				echo "<td>&nbsp;</td>\n";
			}
			echo "<td align='center'>";
			if ( $xoopsUser ) {
				echo "<a href='javascript:openWithSelfMain(\"".XOOPS_URL."/pmlite.php?send2=1&to_userid=".$userinfo->uid()."\",\"pmlite\",450,370);'>";
				echo "<img src='".XOOPS_URL."/images/icons/pm.gif' border='0' alt='";
				printf(_SENDPMTO,$userinfo->uname("E"));
				echo "' /></a>";
			} else {
				echo "&nbsp;";
			}
			echo "</td>\n";

			if ( $userinfo->url("E") ) {
                    		echo "<td align='center'><a href='".$userinfo->url("E")."' target=new><img src='".XOOPS_URL."/images/icons/www.gif' border='0' alt='"._VISITWEBSITE."' /></a></td>\n";
			} else {
				echo "<td>&nbsp;</td>\n";
			}

                    	if ( $xoopsUser ) {
				if ( $xoopsUser->isAdmin() ) {
                        		echo "<td align='center'>[ <a href='".XOOPS_URL."/modules/system/admin.php?fct=users&op=reactivate&uid=".$userinfo->uid()."&op=modifyUser'>"._ML_EDIT."</a> | \n";
                        		echo "<a href='".XOOPS_URL."/modules/system/admin.php?fct=users&op=delUser&uid=".$userinfo->uid()."'>"._ML_DELETE."</a> ]</td>\n";
				}
                    	}
                    	echo "</tr>";
                    	$a = ($dcolor == $dcolor_A ? 1 : 0);
                } // end while ()
		echo "</table></td></tr></table>";
                // start of next/prev/row links.
		echo "<br /><br />";

                echo "\n<table height='20' width='100%' cellspacing='0' cellpadding='0' border='0' ><tr><td class='bg1'>";

				if ($query != "")
				{
					$isQuery="&query=".$query;
				}else
				{
					$isQuery="";
				}
                if ( $num_rows_per_order > $pagesize ) {
                    	$total_pages = ceil($num_rows_per_order / $pagesize); // How many pages are we dealing with here ??
                    	$prev_page = $page - 1;

                    	if ( $prev_page > 0 ) {
                        	echo "<td align='left' width='15%'><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=".$sortby2."&page=".$prev_page.$isQuery."'>";
                        	echo "<<($prev_page)</a></td>";
                    	} else {
                        	echo "<td width='15%'>&nbsp;</td>\n";
                    	}

                    	echo "<td align='center' width='70%'>";



                    	echo "</td>";

                    	$next_page = $page + 1;
                    	if ( $next_page <= $total_pages ) {
                        	echo "<td align='right' width='15%'><a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=".$sortby2."&page=".$next_page."&orderby=".$orderby2.$isQuery."'>";
                        	echo "(".$next_page.")>></a></td>";
                    	} else {
                        	echo "<td width='15%'>&nbsp;</td>\n";
                    	}
    /* Added a numbered page list, only shows up to 50 pages. */

                        echo "</tr><tr><td colspan='3' align='center'>";
                        echo " <small>[ </small>";

                        for ( $n = 1; $n < $total_pages; $n++ ) {
                            	if ( $n == $page ) {
					echo "<small><b>$n</b></small></a>";
                            	} else {
					echo "<a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=".$sortby2."&page=".$n."&orderby=".$orderby2.$isQuery."'>";
					echo "<small>$n</small></a>";
			    	}
                            	if ( $n >= 50 ) {  // if more than 50 pages are required, break it at 50.
                                	$break = true;
                                	break;
                            	} else {  // guess not.
                                	echo "<small> | </small>";
                            	}
                        }

                        if(!isset($break)) { // are we sopposed to break ?
			    	if ( $n == $page ) {
                        		echo "<small><b>$n</b></small></a>";
			    	} else {
                        		echo "<a href='".XOOPS_URL."/modules/xmmemberstats/index.php?letter=".$letter."&sortby=".$sortby2."&page=".$total_pages."&orderby=".$orderby2.$isQuery."'>";
                        		echo "<small>$n</small></a>";
			    	}
                        }
                        echo " <small>]</small> ";
                        echo "</td></td></tr>";

                }else{
                    	echo "<td align='center'>";

                    	echo "</td></td></tr>";

		}

                echo "</table>\n";

                // end of next/prev/row links

	} else {
                echo "<tr><td class='bg3' colspan='".$cols."' align='center'><br />\n";
		echo "<b>";
		printf(_ML_NOUSERFOUND,$letter);
                echo "</b>\n";
                echo "<br /></td></tr>\n";
            	echo "</table></td></tr></table><br />\n";
        }
}

include(XOOPS_ROOT_PATH."/footer.php");

?>