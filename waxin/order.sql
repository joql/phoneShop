-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2017 年 02 月 19 日 14:34
-- 服务器版本: 5.5.38
-- PHP 版本: 5.4.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `demo`
--

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(30) NOT NULL,
  `trade_no` varchar(150) DEFAULT NULL COMMENT '交易号',
  `order_money` decimal(10,2) DEFAULT '0.00',
  `unit_name` varchar(10) NOT NULL,
  `pay_type` varchar(20) DEFAULT NULL COMMENT '支付方式',
  `state` int(2) NOT NULL DEFAULT '0',
  `addtime` int(10) NOT NULL,
  `update_time` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`id`, `order_no`, `trade_no`, `order_money`, `unit_name`, `pay_type`, `state`, `addtime`, `update_time`) VALUES
(1, 'GA109944622883d', '44039519SW368205C', '0.10', '$', 'instant', 1, 1476099446, 1476659453),
(2, 'GA133696492545d', '8LR1273403091490M', '0.10', '$', 'instant', 1, 1476336964, 1477870955),
(3, 'GA133737876677d', '', '0.10', '$', '', 1, 1476337378, 0),
(4, 'GA133773472693d', '', '0.10', '$', '', 0, 1476337734, 0),
(5, 'GA133778547605d', '', '0.10', '$', '', 0, 1476337785, 0),
(6, 'GA133818702592d', '', '0.10', '$', '', 0, 1476338187, 0),
(7, 'GA133818934898d', '', '0.10', '$', '', 0, 1476338189, 0),
(8, 'GA133826893949d', '', '0.10', '$', '', 0, 1476338268, 0),
(9, 'GA133827353471d', '', '0.10', '$', '', 0, 1476338273, 0),
(10, 'GA133827932985d', '', '0.10', '$', '', 0, 1476338279, 0),
(11, 'GA133855809954d', '', '0.10', '$', '', 0, 1476338558, 0),
(12, 'GA133867130725d', '', '0.10', '$', '', 0, 1476338671, 0),
(13, 'GA133906958635d', '', '0.10', '$', '', 0, 1476339069, 0),
(14, 'GA150110818075d', '', '0.10', '$', '', 0, 1476501108, 0),
(15, 'GA150258326650d', '', '0.10', '€', '', 0, 1476502583, 0),
(16, 'GA150272498881d', '', '0.10', '€', '', 0, 1476502724, 0),
(17, 'GA150298329372d', '', '0.10', '$', '', 0, 1476502983, 0),
(18, 'GA150320293455d', '', '0.10', '$', '', 0, 1476503202, 0),
(19, 'GA150324984038d', '', '0.10', '$', '', 0, 1476503249, 0),
(20, 'GA150336097138d', '', '0.10', '$', '', 0, 1476503360, 0),
(21, 'GA150341283431d', '', '0.10', '$', '', 0, 1476503412, 0),
(22, 'GA150364920463d', '', '0.10', '$', '', 0, 1476503649, 0),
(23, 'GA150366566165d', '', '0.10', '$', '', 0, 1476503665, 0),
(24, 'GA150379026304d', '', '0.10', '$', '', 0, 1476503790, 0),
(25, 'GA150712033047d', '', '0.10', '€', '', 0, 1476507120, 0),
(26, 'GA150728165966d', '', '0.10', '€', '', 0, 1476507281, 0),
(27, 'GA150751282708d', '', '0.10', '€', '', 0, 1476507512, 0),
(28, 'GA150812013906d', '', '0.10', '€', '', 0, 1476508120, 0),
(29, 'GA150812243871d', '', '0.10', '€', '', 0, 1476508122, 0),
(30, 'GA150852015078d', '', '0.10', '€', '', 0, 1476508520, 0),
(31, 'GA150864917673d', '', '0.10', '€', '', 0, 1476508649, 0),
(32, 'GA151117464346d', '', '0.10', '$', '', 0, 1476511174, 0),
(33, 'GA151177466530d', '', '0.10', '$', '', 0, 1476511774, 0),
(34, 'GA168744012213d', '', '0.10', '€', '', 0, 1476587440, 0),
(35, 'GA168746008645d', '', '0.10', '€', '', 0, 1476587460, 0),
(36, '1', '1', '1.00', '$', 'weixin', 0, 13, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;