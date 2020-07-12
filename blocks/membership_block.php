<?php
//  Author: SMD & ComFlash2
//  URL: http://www.xoopsmalaysia.org
//  E-Mail: webmaster@xoopsmalaysia.org

function show_membership_block($options) {
global $xoopsConfig, $xoopsUser, $xoopsModule, $HTTP_SERVER_VARS, $REMOTE_ADDR, $xoopsDB;
// ML Hack by SMD
	  $myts =& MyTextSanitizer::getInstance();
// End of ML Hack by SMD

$online_handler =& xoops_gethandler('online');

	mt_srand((double)microtime()*1000000);
	// set gc probabillity to 10% for now..
	if (mt_rand(1, 100) < 11) {
		$online_handler->gc(300);
	}

if (is_object($xoopsUser)) {
		$uid = $xoopsUser->getVar('uid');
		$uname = $xoopsUser->getVar('uname');
} else {
		$uid = 0;
		$uname = '';
}

if (is_object($xoopsModule)) {
		$online_handler->write($uid, $uname, time(), $xoopsModule->getVar('mid'), $HTTP_SERVER_VARS['REMOTE_ADDR']);
	} else {
		$online_handler->write($uid, $uname, time(), 0, $HTTP_SERVER_VARS['REMOTE_ADDR']);
}

// status online

$onlines =& $online_handler->getAll();
	if (false != $onlines ) {
		$total = count($onlines);
		$block = array();
		$guests = 0;
		$guess = '';
		$bil = 1;
		$members = '';

// papar senarai ahli yg online dengan country dan kedudukan
		if ($options[0] == 1 ) {

		for ($i = 0; $i < $total; $i++) {

		$onlineUsers[$i]['ip'] = $onlines[$i]['online_ip'];
		if ($onlines[$i]['online_uid'] > 0) {
				$module_handler =& xoops_gethandler('module');
				$modules =& $module_handler->getList(new Criteria('isactive', 1));
				$onlineUsers[$i]['module'] = ($onlines[$i]['online_module'] > 0) ? $myts->makeTareaData4Show($modules[$onlines[$i]['online_module']]) : '';
			$ip = $onlines[$i]['online_ip'];
			$numbers=explode (".",$ip);
			$code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);
			$country_query  = $xoopsDB->query("SELECT country2,country FROM ".$xoopsDB->prefix("iptoc")." WHERE IPFROM<=$code"." AND IPTO>=$code");
			list($domain,$country) = $xoopsDB->fetchRow($country_query);
			if($domain=='') $domain='-';
			$members .= '<table class="outer" cellspacing="0"><tr><td class="even" width="40%"><a href="'.XOOPS_URL.'/userinfo.php?uid='.$onlines[$i]['online_uid'].'">'.$onlines[$i]['online_uname'].'</td><td class="odd" align="center">'.$onlineUsers[$i]['module'].'</td><td class="even" align="center" width="10%"><img src="'.XOOPS_URL.'/modules/xmmemberstats/images/flags/'.$domain.'.gif" alt="'.$country.'"></td></tr></table>';
			$bil++;

// papar senarai pelawat dengan censored ip

		} else {
			$module_handler =& xoops_gethandler('module');
			$modules =& $module_handler->getList(new Criteria('isactive', 1));
			$onlineUsers[$i]['module'] = ($onlines[$i]['online_module'] > 0) ? $myts->makeTareaData4Show($modules[$onlines[$i]['online_module']]) : '';
			$ip = $onlines[$i]['online_ip'];
			$numbers=explode (".",$ip);
			$code=($numbers[0] * 16777216) + ($numbers[1] * 65536) + ($numbers[2] * 256) + ($numbers[3]);
			$country_query  = $xoopsDB->query("SELECT country2,country FROM ".$xoopsDB->prefix("iptoc")." WHERE IPFROM<=$code"." AND IPTO>=$code");
			list($domain,$country) = $xoopsDB->fetchRow($country_query);

			$ipadd= explode(".",$onlines[$i]['online_ip']);
			$add1 = ($numbers[0]);
			$add2 = ($numbers[1]);
			$add3 = ($numbers[2]);
			$add4 = ($numbers[3]);
			$censored = "$add1.$add2.$add3.***";
			if($domain=='') $domain='-';

			$guess .= '<table class="outer" cellspacing="0"><tr><td class="even" colspan="2">'.$censored.'</td><td width="10%" align="center" class="odd"><img src="'.XOOPS_URL.'/modules/xmmemberstats/images/flags/'.$domain.'.gif" alt="'.$country.'"></td></tr></table>';
			$guests++;
			}
		}
		}

		$block['online_total'] = sprintf(_ONLINEPHRASE, $total);
		if (is_object($xoopsModule)) {
			$mytotal = $online_handler->getCount(new Criteria('online_module', $xoopsModule->getVar('mid')));
			$block['online_total'] .= ' ('.sprintf(_ONLINEPHRASEX, $mytotal, $xoopsModule->getVar('name')).')';
		}

// statistik keahlian
		$member_handler =& xoops_gethandler('member');
		$hari_ini = formatTimestamp(time());
		$total_active_users = $member_handler->getUserCount(new Criteria('level', 0, '>'));
		$users_reg_today = $member_handler->getUserCount(new Criteria('user_regdate', mktime(0,0,0), '>='));
		$users_reg2_today = $member_handler->getUserCount(new Criteria('user_regdate', (mktime(0,0,0)-(24*3600)), '>='));
		$criteria = new CriteriaCompo(new Criteria('level', 0, '>'));
		$limit = (!empty($options[0])) ? $options[0] : 10;
		$criteria->setOrder('DESC');
		$criteria->setSort('user_regdate');
		$criteria->setLimit($limit);
		$lastmembers =& $member_handler->getUsers($criteria);
		$lastname = $lastmembers[0]->getVar('uname');
		$lastid = $lastmembers[0]->getVar('uid');

// penerimaan data
		$block['activeusers'] = $total_active_users;
		$block['todayreg'] = $users_reg_today;
		$block['yesterdayreg'] = $users_reg2_today - $users_reg_today;
		$block['online_names'] = $members;
		$block['online_guest'] = $guess;
		$block['online_members'] = $total - $guests;
		$block['online_guests'] = $guests;
		$block['total_online'] = $total;
		$block['latest'] = $lastname;
		$block['latest_id'] = $lastid;

// definisi bahasa
		$block['membership_lang'] = _MB_MEMBERSHIP;
		$block['today_lang'] = _MB_TODAY;
		$block['yesterday_lang'] = _MB_YESTERDAY;
		$block['overall_lang'] = _MB_OVERALL;
		$block['online_lang'] = _MB_ONLINE;
		$block['guests_lang'] = _MB_GUESTS;
		$block['members_lang'] = _MB_MEMBERS;
		$block['total_lang'] = _MB_TOTAL;
		$block['list_lang'] = _MB_LIST;
		$block['popup_lang'] = _MB_POPUP;
		$block['latest_lang'] = _MB_LATEST;
		return $block;
	} else {
		return false;
	}
}

function membership_edit($options) {
	$form = _MB_MEMBERSHIP_LIST."&nbsp;";
	if ( $options[0] == 1 ) {
		$chk = " checked='checked'";
	}
	$form .= "<input type='radio' name='options[]' value='1'".$chk.">&nbsp;"._YES."";
	$chk = "";
	if ( $options[0] == 0 ) {
		$chk = " checked='checked'";
	}
	$form .= "&nbsp;<input type='radio' name='options[]' value='0'".$chk.">"._NO."<br>";
	return $form;
}

?>