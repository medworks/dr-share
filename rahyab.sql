-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2014 at 10:44 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rahyab`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(3, 'اخبار و تازه ها'),
(4, 'مقالات'),
(5, 'دوره های آموزشی'),
(6, 'گالری تصاویر');

-- --------------------------------------------------------

--
-- Table structure for table `menues`
--

CREATE TABLE IF NOT EXISTS `menues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `pos` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `menues`
--

INSERT INTO `menues` (`id`, `name`, `pos`) VALUES
(1, 'اخلاق', 1),
(3, 'مرام ', 2),
(4, 'منش', 3);

-- --------------------------------------------------------

--
-- Table structure for table `menusubjects`
--

CREATE TABLE IF NOT EXISTS `menusubjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `smid` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `picid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `menusubjects`
--

INSERT INTO `menusubjects` (`id`, `mid`, `smid`, `subject`, `text`, `picid`) VALUES
(1, 1, 4, '', '', 0),
(2, 3, 2, '', '', 0),
(3, 4, 3, '', '', 0),
(4, 1, 4, '', '', 0),
(5, 1, 4, '', '', 0),
(6, 1, 4, '', '', 0),
(7, 0, 0, '', '\r\n                                         <input type="hidden" name="edtsubject" id="edtsubject">\r\n                                        ', 0),
(8, 1, 4, '', 'gjhgjhgjhgjjh<input type="hidden" name="edtsubject" id="edtsubject">', 0),
(9, 3, 2, '', '', 0),
(10, 1, 4, '', 'test<div>gjhgggj</div><div>hjgjgj</div><div>hjkj</div>', 0),
(11, 4, 3, '', 'testttghjhgjgjhgjhgjhgjhgjhhgkj', 0),
(12, 1, 4, '', '4654654464644645664654446اتناتناننتاتن', 0),
(13, 1, 4, '', 'انتانتاننتتاناتناناانتانت', 0),
(14, 1, 4, '', 'انتانتاننتتاناتناناانتانت', 0),
(15, 1, 4, '', 'انتانتاننتتاناتناناانتانت', 0),
(16, 1, 4, '', 'jkljkljljjkljkl', 0),
(17, 3, 2, '', 'l;l;l;jklhk', 0),
(18, 1, 0, '', 'gbjhgjhghgj', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pics`
--

CREATE TABLE IF NOT EXISTS `pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `itype` varchar(25) NOT NULL,
  `img` blob NOT NULL,
  `iname` varchar(50) NOT NULL,
  `isize` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pics`
--

INSERT INTO `pics` (`id`, `tid`, `sid`, `itype`, `img`, `iname`, `isize`) VALUES
(1, 1, 0, 'image/jpeg', 0x5265736f7572636520696420233135, 'image_081-96x96.jpg', '0'),
(2, 1, 0, 'image/jpeg', 0x5265736f7572636520696420233135, 'image_081-96x96.jpg', '0'),
(3, 1, 17, 'image/jpeg', 0x5265736f7572636520696420233135, 'image_081-96x96.jpg', '0'),
(4, 1, 18, 'image/jpeg', 0x5265736f7572636520696420233135, 'image_081-96x96.jpg', 'width="96" height="96"');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(30) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`) VALUES
(1, 'Site_Theme_Name', 'default'),
(2, 'About_System', 'گروه بازرگانی ایرانا با هدف ارائه رهيافت‌های جامع و خدمات تخصصی در زمينه شبكه های رايانه ای ، طراحی سایت ، اعطاء نمایندگی پیشرفته ترین پنل ارسال اس ام اس ، ارائه امنیت شبکه ، ويدئو کنفرانس Polycom ،  بر مبنای متدولوژی‌های نوين انفورماتيك در سال 1388 تأسيس شد. مبنای فعاليت شركت  بر پايه استفاده از متخصصين مجرب و تجهيزات مدرن در انجام پروژه‌های  كامپيوتری استوار است و بر همين اساس با دريافت نمايندگی رسمی از شركتهای معتبر توليد كننده تجهيزات ، به تدريج در سالهاي اوليه فعاليت خود، به پايگاهی مطمئن در ارائه محصولات معتبر و متنوع شبكه های كامپيوتری تبديل گرديد.\r\nهمچنين با عنايت به اعتقاد مديريت شركت مبنی بر استفاده از نيروهای متخصص، كليه كارشناسان اين شركت  در واحدهای فنی  و مهندسی فروش موفق به دريافت مدارك بین المللی مرتبط با راهکارهای مورد استفاده گردیده اند.\r\nگروه بازرگانی ایرانا در سال 1389 با دریافت نمایندگی رسمی فروش، تمدید و شارژ اینترنت مخابرات بر آن شد تا تمام نیاز های مشترکین مخابرات در این حوزه را برآورده نماید که ارتباط ، پاسخ سریع و ارائه راهکارهای نوین گویای این مطلب میباشد.'),
(3, 'Site_Title', 'گروه بازرگانی ایرانا'),
(4, 'Site_KeyWords', 'اینترنت,مخابرات,صبانت,مودم،اس ام اس،رایگان،تخفیف،پول،شارژ،2020،ir،www.ir2020.ir ،شارژ اینترنت مخابرات خراسان رضوی،'),
(5, 'Site_Describtion', 'گروه بازرگانی ایرانا نماینده رسمی تمدید و ثبت محصولات اینترنت مخابرات'),
(6, 'Admin_Email', 'admin@mediateq.ir'),
(7, 'News_Email', 'news@mediateq.ir'),
(8, 'Contact_Email', 'info@ir2020.ir'),
(9, 'Max_Page_Number', '5'),
(10, 'Max_Post_Number', '3'),
(11, 'FaceBook_Add', 'facebook.com'),
(12, 'Twitter_Add', 'twitter.com'),
(13, 'Rss_Add', '127.0.01/media/rssfeed.php'),
(14, 'YouTube_Add', 'youtube.com'),
(15, 'Tell_Number', '38555560'),
(16, 'Fax_Number', '38555560'),
(17, 'Address', 'مشهد- چهارراه لشکر-مجتمع تجاری اداری آسیا-واحد203\r\n'),
(18, 'Is_Smtp_Active', 'yes'),
(19, 'Smtp_Host', 'smtp.gmail.com'),
(20, 'Smtp_User_Name', 'hatami4510@gmail.com'),
(21, 'Smtp_Pass_Word', '12345'),
(22, 'Smtp_Port', '465'),
(23, 'Email_Sender_Name', 'گروه مدیاتک'),
(24, 'WellCome_Title', ''),
(25, 'WellCome_Body', ''),
(26, 'Gplus_Add', 'www.googleplus.com'),
(27, 'About_Pic_Name', 'about_pic.jpg'),
(28, 'Percent_Off', '5'),
(29, 'Extra_Tax', '0'),
(30, 'SmsUserName', 'ir2020'),
(31, 'SmsPassWord', '123456'),
(32, 'SmsText', 'آقا/خانم {user} به شماره خط {tel} سفارش شما با مشخصات {order_info} ثبت و اعمال شد.\r\nبا تشکر\r\nگروه بازرگانی ایرانا\r\n051-38555560\r\n\r\n'),
(33, 'SmsLineNumber', '+98100009'),
(34, 'Bank_Terminal_ID', '1144896'),
(35, 'Bank_User_Name', 'irana'),
(36, 'Bank_Pass_Word', '41833070'),
(37, 'Email_Text', '<p style="direction:rtl;">\r\nبا سلام\r\n<br/>\r\nآقا/خانم {user} ، به شماره خط {tel}  و همراه {mobile} \r\n<br/>\r\nدرخواست شما با مشخصات {order_info} \r\n<br/>\r\nدر مورخه {date} با موفقیت ثبت شد.\r\n<br/>\r\n************************************\r\n<br/>\r\nمشخصات پرداخت به شرح ذیل می باشند :\r\n<br/>\r\nبانک : درگاه پرداخت الکترونیک بانک ملت\r\n<br/>\r\nکد پیگیری : {payment_code}\r\n<br/>\r\nتاریخ پرداخت : {date}\r\n<br/>\r\n************************************\r\n<br/>\r\n با تشکر از اعتماد شما - گروه بازرگانی ایرانا\r\n051-38555560\r\n<br/>\r\n</p>'),
(38, 'Is_Send_Order_Sms_For_Admin', '1'),
(39, 'Admin_Mobile_Number', ''),
(40, 'Admin_Sms_Text', '');

-- --------------------------------------------------------

--
-- Table structure for table `submenues`
--

CREATE TABLE IF NOT EXISTS `submenues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `submenues`
--

INSERT INTO `submenues` (`id`, `mid`, `pid`, `name`, `level`) VALUES
(1, 1, 0, 'اخلاق 1', 0),
(2, 3, 0, 'مرام 1', 0),
(3, 4, 0, 'منش 1', 0),
(4, 1, 1, 'اخلاق 2-1', 2),
(5, 1, 4, 'اخلاق 3-1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `family` varchar(50) NOT NULL,
  `image` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `family`, `image`, `email`, `username`, `password`, `type`) VALUES
(1, 'Media', 'Teq', '', 'admin@mediateq.ir', 'php', '05098a2bd8c52e8c912e02d7cbfaf9e9', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
