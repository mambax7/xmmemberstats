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

include_once "../../../mainfile.php";

	set_time_limit(86400);
	ini_set('max_execution_time', 86400);
	ob_end_flush();
	ob_start();
	flush();
   ob_flush();
      flush();
   ob_flush();
      flush();
   ob_flush();
function install_header(){
?>
<html>
<head>
  <title>XM-Memberstats 2.0e Installer</title>
  <meta http-equiv="Content-Type" content="text/html;" >
  <style type="text/css" media="all"><!-- @import url(../../../xoops.css); --></style>
  <link rel="stylesheet" type="text/css" media="all" href="style.css" >
</head>
<body style="margin: 0; padding: 0;">
<form action='index.php' method='post' name ='frm'>
<table width="778" align="center" cellpadding="0" cellspacing="0" background="img/bg_table.gif">
  <tr>
    <td width="150"><img src="img/hbar_left.gif" width="100%" height="23" alt="" ></td>
    <td width="478" background="img/hbar_middle.gif">&nbsp;</td>
    <td width="150"><img src="img/hbar_right.gif" width="100%" height="23" alt="" ></td>
  </tr>
  <tr>
    <td width="150"><a href="index.php"><img src="img/logo.gif" width="150" height="80" alt="" ></a></td>
    <td width="478" background="img/bg_darkblue.gif">&nbsp;</td>
    <td width="150"><img src="img/xoops2.gif" width="100%" height="80"></td>
  </tr>
  <tr>
    <td width="150"><img src="img/hbar_left.gif" width="100%" height="23" alt="" ></td>
    <td width="478" background="img/hbar_middle.gif">&nbsp;</td>
    <td width="150"><img src="img/hbar_right.gif" width="100%" height="23" alt="" ></td>
  </tr>
</table>

<table width="778" align="center" cellspacing="0" cellpadding="0" background="img/bg_table.gif"
  <tr>
    <td width='5%'>&nbsp;</td>
    <td align="center"><h4 style="margin-top: 10px; margin-bottom: 5px; padding: 10px;">XM-Memberstats Installer</h4><div style="padding: 10px; text-align:left;">
<?php
}

function install_footer(){
?>

    <td width='5%'>&nbsp;</td>
  </tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>XM-Memberstats Installer by <a href='http://www.xoopsmalaysia.org'>SMD</a> and <a href='http://www.xoopsmalaysia.org'>ComFlash2</a><br ><br ><a href='http://www.xoopsmalaysia.org/' target='_blank'><img src='img/mini-ms.gif' alt='XOOPS' border='0' ></a></strong></div><br >
	</td>
  </tr>
</table>

<table width="778" cellspacing="0" cellpadding="0" align="center" background="img/bg_table.gif">
  <tr>
    <td width="150"><img src="img/hbar_left.gif" width="100%" height="23" alt="" ></td>
    <td width="478" background="img/hbar_middle.gif">&nbsp;</td>
    <td width="150"><img src="img/hbar_right.gif" width="100%" height="23" alt="" ></td>
  </tr>
</table>
</form>
</body>
</html>
<?php
}

if (isset($_POST['action']))
{
$action=$_POST['action'];
}
if ( !isset($action) || $action == "" ) {
	$action = "message";
}

if ( $action == "message" ) {
	install_header();
	echo "
	<table width='100%' border='0'><tr><td colspan='2'>This script is use to convert ip-to-country cvs into mysql database. </td></tr>
	<tr><td>-</td><td><span style='color:#ff0000;font-weight:bold;'>Make sure you have install the module before run this script.</span></td></tr>
	<tr>
    <td colspan='2' align='center'><br><br><input type='hidden' name='action' value='step1'><input type='submit' name='submit' value='Proceed'></td>
    </tr>
  	</table>
	";
	install_footer();
	exit();
}

if ( $action == "step1" ) {
	install_header();
	echo "Clearing Database ... <br><br>";
	$query = $xoopsDB->queryF("DROP TABLE IF EXISTS ".$xoopsDB->prefix("iptoc"));

	if (!$query) {
		echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/no.gif'></td><td colspan='2'>Can't clear table !</td></tr></table>";
	} else {
		echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/yes.gif'></td><td colspan='2'>Table Dropped !</td></tr></table>";
	}

	$query = $xoopsDB->queryF("CREATE TABLE ".$xoopsDB->prefix("iptoc")." ( id int(25) NOT NULL default '0', ipfrom double(15,0) NOT NULL default '0', ipto double(15,0) NOT NULL default '0', country2 char(2) NOT NULL default '', country3 char(3) NOT NULL default '', country varchar(35) NOT NULL default '') TYPE=MyISAM");

	if (!$query) {
		echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/no.gif'></td><td colspan='2'>Can't create table !</td></tr></table>";
	} else {
		echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/yes.gif'></td><td colspan='2'>Table Re-Created !</td></tr></table>";
	}
	echo "<br><span style='color:#ff0000;font-weight:bold;'>Next step, database will be filled with the data. Press PROCEED.</span>";
    echo "<br><br><center><input type='hidden' name='file' value='1'><input type='hidden' name='action' value='install'><input type='submit' name='submit' value='Proceed'></center>";

install_footer();
}



if ( $action == "install" ) {
$file=$_POST['file'];
$max=$_POST['max'];
$query=0;
	install_header();
		flush();
	   ob_flush();
	      flush();
	   ob_flush();
	      flush();
   	   ob_flush();
	$processPerCycle=500;
	$autoSubmit=0;
	if ( !isset($file) || $file == "" ) {
		$file = "1";
	}
	if ( !isset($max) || $max == "" ) {
		$max = "1";
	}

//	echo "INSTALL <br>";
//	echo "./ip-to-country".$file.".csv";
//	$handle = fopen ("./ip-to-country".$file.".csv","r");
//		while ($data = fgetcsv($handle, 1000, ",")) {
//		$xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("iptoc")."(`id`, `ipfrom`, `ipto`, `country2`, `country3`, `country`) VALUES('".$row."', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."')");
//	}
	$row = 1;
	$handle = fopen ("ip-to-country.csv","r");
	$autoSubmit=0;
	if (!$handle) {
		echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/no.gif'></td><td colspan='2'>Not Found - CVS file doesn't exist.</td></tr></table>";
	} else {
		echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/yes.gif'></td><td colspan='2'>Found - CVS file exist.</td></tr></table>";

		while ($data = fgetcsv($handle, 1000, ",")) {
		if ($row >= $file && $row < ($file + $processPerCycle))
		{
			$query = $xoopsDB->queryF("INSERT INTO ".$xoopsDB->prefix("iptoc")."(`id`, `ipfrom`, `ipto`, `country2`, `country3`, `country`) VALUES('".$row."', '".$data[0]."', '".$data[1]."', '".$data[2]."', '".$data[3]."', '".$data[4]."')");
			$autoSubmit=1;
		}
		if ($file!=1)
		{
			if($row >= ($file + $processPerCycle))
			{
				break;
			}
		}

		$row++;
		}
		fclose ($handle);

		if (!$query && $autoSubmit==1) {
			echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/no.gif'></td><td colspan='2'>Failed - Table doesn't exist.</td></tr></table>";
		} else {
			echo "<table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/yes.gif'></td><td colspan='2'>Succeed.. continue with next data.</td></tr></table>";

		}
	}
	$row--;
	if ($max < $row)$max=$row;
	echo "<p style='text-align: center'>\n";
	$percent=round((($file-1)/$max)*20);
	$percent2=round((($file-1)/$max)*100);
	for ($i=0;$i<20;$i++)
	{
		if($i <= $percent)
		{

			echo "<img border='0' src='img/yes.gif' width='6' height='12'>";
		}else
		{
			echo "<img border='0' src='img/no.gif' width='6' height='12'>";
		}
	}
	echo " ".$percent2."%";
	echo "</p>";
	if ($autoSubmit==0) {
		echo "<center><span style='color:#00dd00;font-weight:bold;'>FINISHED !!</span></center>";
        echo "<br><table width='100%' border='0'><tr><td width='30%' align='right'><img src='img/yes.gif'></td><td colspan='2'>- Please delete this folder from your server.</td></tr></table>";

	}else
	{
		echo "<center><span style='color:#ff0000;font-weight:bold;'>Progress : [".$file."/".$max."]</span></center>";
	}
	$file=$file+$processPerCycle;
    echo "<br><br><center><input type='hidden' name='max' value='".$max."'><input type='hidden' name='file' value='".$file."'><input type='hidden' name='action' value='install'></center>";


echo "
    <td width='5%'>&nbsp;</td>
  </tr>
    <td colspan='3'>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='3' align='center'><strong>XM-Memberstats Installer by <a href='http://www.xoopsmalaysia.org'>SMD</a> and <a href='http://www.xoopsmalaysia.org'>ComFlash2</a><br ><br ><a href='http://www.xoopsmalaysia.org/' target='_blank'><img src='img/mini-ms.gif' alt='XOOPS' border='0' ></a></strong></div><br >
	</td>
  </tr>
</table>

<table width='778' cellspacing='0' cellpadding='0' align='center' background='img/bg_table.gif'>
  <tr>
    <td width='150'><img src='img/hbar_left.gif' width='100%' height='23' alt='' ></td>
    <td width='478' background='img/hbar_middle.gif'>&nbsp;</td>
    <td width='150'><img src='img/hbar_right.gif' width='100%' height='23' alt='' ></td>
  </tr>
</table>
</form>
<script language='JavaScript' type='text/javascript'>";

if ($autoSubmit==1) {
	echo "document.frm.submit()";
}

echo "
</script>
</body>
</html>";

	flush();
   ob_flush();
      flush();
   ob_flush();
      flush();
   ob_flush();
ob_end_flush();
}

