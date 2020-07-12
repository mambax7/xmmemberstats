# phpMyAdmin SQL Dump
# version 2.5.6
# http://www.phpmyadmin.net
#
# Host: localhost
# Generation Time: Nov 09, 2004 at 05:28 PM
# Server version: 4.1.1
# PHP Version: 4.3.5
# 
# Database : `test`
# 

# --------------------------------------------------------

#
# Table structure for table `iptoc`
#

CREATE TABLE iptoc (
  id int(25) NOT NULL default '0',
  ipfrom double(15,0) NOT NULL default '0',
  ipto double(15,0) NOT NULL default '0',
  country2 char(2) NOT NULL default '',
  country3 char(3) NOT NULL default '',
  country varchar(35) NOT NULL default ''
) TYPE=MyISAM;
