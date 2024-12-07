-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 01:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `cl_app_config`
--

CREATE TABLE `cl_app_config` (
  `setting` char(26) NOT NULL,
  `value` varchar(12000) NOT NULL,
  `sortorder` int(5) DEFAULT NULL,
  `category` varchar(25) NOT NULL,
  `type` varchar(15) NOT NULL,
  `description` varchar(140) DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_app_config`
--

INSERT INTO `cl_app_config` (`setting`, `value`, `sortorder`, `category`, `type`, `description`, `required`) VALUES
('active_email', 'Your new account is now active! Click this link to log in!', 1, 'Messages', 'text', 'Email message when account is verified', 1),
('active_msg', 'Your account has been verified!', 2, 'Messages', 'text', 'Display message when account is verified', 1),
('admin_email', 'admin@sincetech.co.uk', 3, 'Website', 'text', 'Site administrator email address', 1),
('admin_verify', 'false', 4, 'Security', 'boolean', 'Require admin verification', 1),
('allowed_file_types', 'jpeg; jpg; png; pdf', 5, 'Upload', 'text', 'Allowed file types', 1),
('avatar_dir', '/views/user/img/avatars', 6, 'Website', 'text', 'Directory where user avatars should be stored inside of base site directory. Do not include base_dir path.', 1),
('base_dir', 'D:\\xampp\\htdocs\\Dropbox\\www\\Projects\\connect', 7, 'Website', 'hidden', 'Base directory of website in filesystem. \"C:...\" in windows, \"/...\" in unix systems', 1),
('base_url', 'https://localhost/Dropbox/www/Projects/connect', 8, 'Website', 'url', 'Base URL of website. Example: \"http://sitename.com\"', 1),
('contract_manager_email', 'm.whitaker@crestchic.co.uk', 9, 'Notifications', 'email', 'Contract Manager', 1),
('cookie_expire_seconds', '2592000', 10, 'Security', 'number', 'Cookie expiration (in seconds)', 1),
('curl_enabled', 'true', 11, 'Website', 'boolean', 'Enable curl for various processes such as background email sending', 1),
('debug_email', 'admin@sincetech.co.uk', 12, 'Notifications', 'email', 'Debug Emails', 1),
('default_avatar', 'default_avatar.jpg', 13, 'Website', 'text', 'This is the filename of the default user image.', 1),
('default_bg', 'default_bg.png', 14, 'Website', 'text', 'This is the filename of the default background image.', 1),
('design_office_email', 'design@crestchic.co.uk', 15, 'Notifications', 'email', 'Design Office', 1),
('dev_url', 'https://linktr.ee/iamrc', 16, 'Website', 'url', 'Developer\'s URL.', 1),
('email_working', 'false', 17, 'Mailer', 'hidden', 'Indicates if email settings are correct and can connect to a mail server', 1),
('file_dir', '/console/connect/files', 18, 'Website', 'text', 'Directory where user avatars should be stored inside of base site directory. Do not include base_dir path.', 1),
('from_email', 'NO-REPLY@MyCRESTCHIC.COM', 19, 'Mailer', 'email', 'From email address. Should typically be the same as \"mail_user\" email.', 1),
('from_name', 'MyCrestchic', 20, 'Mailer', 'text', 'Name that shows up in \"from\" field of emails', 1),
('htmlhead', '<!DOCTYPE html>\r\n<html lang=\"en\">\r\n<head>\r\n    <meta charset=\"UTF-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">', 21, 'Website', 'textarea', 'Main HTML header of website (without login-specific includes and script tags). Do not close <html> tag! Will break application functionality', 1),
('jwt_secret', 'php-login', 22, 'Security', 'text', 'Secret for JWT for tokens (Can be anything)', 1),
('login_timeout', '300', 23, 'Security', 'number', 'Cooloff time for too many failed logins (in seconds)', 1),
('mail_port', '587', 24, 'Mailer', 'number', 'Mail port. Common settings are 465 for ssl, 587 for tls, 25 for other', 1),
('mail_pw', 'ffigdqgdwrjxhbcm', 25, 'Mailer', 'password', 'Email password to authenticate mailer', 1),
('mail_security', 'tls', 26, 'Mailer', 'text', 'Mail security type. Possible values are \"ssl\", \"tls\" or leave blank', 1),
('mail_server', 'smtp.gmail.com', 27, 'Mailer', 'text', 'Mail server address. Example: \"smtp.email.com\"', 1),
('mail_server_type', 'smtp', 28, 'Mailer', 'text', 'Type of email server. SMTP is most typical. Other server types untested.', 1),
('mail_user', 'sincetechltd@gmail.com', 29, 'Mailer', 'email', 'Email user', 1),
('mainlogo', '', 30, 'Website', 'url', 'URL of main site logo. Example \"http://sitename.com/logo.jpg\"', 1),
('max_attempts', '5', 31, 'Security', 'number', 'Maximum login attempts', 1),
('max_upload_size', '2097152', 32, 'Upload', 'number', 'Max upload size in kb', 1),
('password_min_length', '6', 33, 'Security', 'number', 'Minimum password length if \"password_policy_enforce\" is set to true', 1),
('password_policy_enforce', 'true', 34, 'Security', 'boolean', 'Require a mixture of upper and lowercase letters and minimum password length (set by \"password_min_length\")', 1),
('profile_bg_dir', '/console/modules/user/img/profile_bgs', 35, 'Website', 'text', 'Directory where user profile backgrounds should be stored inside of base site directory. Do not include base_dir path.', 1),
('reset_email', 'Click the link below to reset your password', 36, 'Messages', 'text', 'Email message when user wants to reset their password', 1),
('reset_pwd_email', 'Your password has been successfully reset. ', 37, 'Messages', 'text', 'An email sent with a temporary password when a user\'s password has been reset.', 1),
('service_team_email', 'portal.admin@crestchic.co.uk', 38, 'Notifications', 'email', 'Service Team', 1),
('signup_requires_admin', 'Thank you for signing up! Before you can login, your account needs to be activated by an administrator.', 39, 'Messages', 'text', 'Message displayed when user signs up, but requires admin approval', 1),
('signup_thanks', 'Thank you for signing up! You will receive an email shortly confirming the verification of your account.', 40, 'Messages', 'text', 'Message displayed wehn user signs up and can verify themselves via email', 1),
('site_name', 'MyCrestchic', 41, 'Website', 'text', 'Website name', 1),
('timezone', 'Europe/London', 42, 'Website', 'timezone', 'Server time zone', 1),
('token_validity', '24', 43, 'Security', 'number', 'Token validity in Hours (default 24 hours)', 1),
('verify_email_admin', 'Thank you for signing up! Your account will be reviewed by an admin shortly', 44, 'Messages', 'text', 'Email message when account requires admin verification', 1),
('verify_email_noadmin', 'Click this link to verify your new account!', 45, 'Messages', 'text', 'Email message when user can verify themselves', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cl_companies`
--

CREATE TABLE `cl_companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `address_line_3` varchar(255) NOT NULL,
  `address_line_4` varchar(255) NOT NULL,
  `address_line_5` varchar(255) NOT NULL,
  `address_line_6` varchar(255) NOT NULL,
  `i_address_line_1` varchar(255) NOT NULL,
  `i_address_line_2` varchar(255) NOT NULL,
  `i_address_line_3` varchar(255) NOT NULL,
  `i_address_line_4` varchar(255) NOT NULL,
  `i_address_line_5` varchar(255) NOT NULL,
  `i_address_line_6` varchar(255) NOT NULL,
  `contact_tel` varchar(255) NOT NULL,
  `contact_fax` varchar(255) NOT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_companies`
--

INSERT INTO `cl_companies` (`company_id`, `company_name`, `contact_name`, `email`, `address_line_1`, `address_line_2`, `address_line_3`, `address_line_4`, `address_line_5`, `address_line_6`, `i_address_line_1`, `i_address_line_2`, `i_address_line_3`, `i_address_line_4`, `i_address_line_5`, `i_address_line_6`, `contact_tel`, `contact_fax`, `added`) VALUES
(1, 'CRESTCHIC LTD TEST', 'CRESTCHIC LTD', 'hireit@crestchic.co.uk', 'Crestchic Ltd', 'Second Avenue', '', 'Centrum One Hundred, Burton-on-Trent', 'DE142WF', 'United Kingdom', 'Crestchic Ltd', 'Second Avenue', '', 'Centrum One Hundred, Burton-on-Trent', 'DE142WF', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(2, 'SDMO', 'PHILIPPE MORGANT', 'PHILIPPE.MORGANT@SDMO.COM', '270 RUE DE KERERVERN', 'CS40047', '29801 BREST CEDEX 9', '', '29801', 'France', '270 RUE DE KERERVERN', 'CS40047', '29801 BREST CEDEX 9', '', '29801', 'France', '', '', '2023-07-01 13:32:27'),
(3, 'SIEMENS ENGINES S.A.U', 'CLAUDIO GALAN', 'CLAUDIO.GALAN@SIEMENS.COM', 'BARRIO DE OOIKIA 44', '20759 ZUMAIA ( GIPUZKOA', '', '', 'SPAIN', 'Spain', 'BARRIO DE OOIKIA 44', '20759 ZUMAIA ( GIPUZKOA', '', '', 'SPAIN', 'Spain', '', '', '2023-07-01 13:32:27'),
(4, 'SATEMA MOELV AS', 'MORTEN FROHAUG', 'MORTEN.FROHAUG@SATEMA.NO', 'INDUSTRIEVEIEN 15', '2390 MOELV', '', '', '2390 MOELV', 'Norway', 'POSTBOKS 4', '2391 MOELV', '', '', '2391 MOELV', 'Norway', '', '', '2023-07-01 13:32:27'),
(5, 'AVK-SEG UK LTD', 'TERRY CATLIN', 'TERRY.CATLIN@AVK-SEG.CO.UK', 'POWER SYSTEMS HOUSE', 'MALVERN ROAD', 'MAIDENHEAD', 'BERKS', 'SL6 7RE', 'United Kingdom', 'POWER SYSTEMS HOUSE', 'MALVERN ROAD', 'MAIDENHEAD', 'BERKSHIRE', 'SL6 7QY', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(6, 'INTERNAL STOCK PRODUCTION', 'CRESTCHIC', 'N.W@CRESTCHIC.CO.UK', '2ND AVENUE', '', '', '', 'DE14 2WF', 'United Kingdom', '2ND AVENUE', '', '', '', 'DE14 2WF', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(7, 'CRESTCHIC RENTAL', 'CRESTCHIC RENTAL', 'HIRES@CRESTCHIC.CO.UK', '3RD AVENUE', '', '', 'CENTRUM 100', 'DE14 2WD', 'United Kingdom', '3RD AVENUE', '', '', 'CENTRUM 100', 'DE14 2WD', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(8, 'NETWORK RAIL', 'JANE HILTON', 'Jane.Hinton@networkrail.co.uk', 'NETWORK RAIL', 'ACCOUNTS PAYABLE', 'PO BOX 4145', 'MANCHESTER', 'M60 7WZ', 'United Kingdom', 'NETWORK RAIL', 'ACCOUNTS PAYABLE', 'PO BOX 4145', 'MANCHESTER', 'M60 7WZ', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(9, 'KONINKLIJKE VAN TWIST DIESEL', 'JOHAN VAN DER ENDE', 'jvanderende@kvt.nl', 'Koninklijke Van Twist B.V.', 'Keerweer 62', '3316 KA  Dordrecht', '', '3316', 'Netherlands', 'Koninklijke Van Twist B.V.', 'PO BOX 156', '3300 AD  Dordrecht', '', '3300', 'Netherlands', '', '', '2023-07-01 13:32:27'),
(10, 'DIESELEC THISTLE GENERATORS', 'BILLY MYERS', 'BILLY.MYERS@DTGEN.CO.UK', 'DIESELEC THISTLE GENERATORS', 'CADDER HOUSE', '160 CLOBER ROAD', 'MILNGAVIE', 'G62 7LW', 'United Kingdom', 'DIESELEC THISTLE GENERATORS', 'CADDER HOUSE', '160 CLOBER ROAD', 'MILNGAVIE', 'G62 7LW', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(11, 'PIP ELECTRICS LTD', 'MARK FRETWELL', 'MARK.FRETWELL@PIP.UK.COM', 'PIP ELECTRICS LTD', 'FENTON HOUSE', 'FENTON WAY', 'SOUTHFIELDS BUSINESS PARK. BASILDON', 'SS15 6TD', 'United Kingdom', 'PIP ELECTRICS LTD', 'FENTON HOUSE', 'FENTON WAY', 'SOUTHFIELDS BUSINESS PARK. BASILDON', 'SS15 6TD', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(12, 'ZWART TECHNIEK B.V', 'TJEERD JOUSTRA', 'TJOUSTRA@ZWARTTECHNIEK.COM', 'ZWART TECHNIEK B.V', 'PO BOX 546', '1970 AM IJMUIDEN', '', 'NETHERLANDS', 'Netherlands', 'ZWART TECHNIEK B.V', 'PO BOX 546', '1970 AM IJMUIDEN', '', 'NETHERLANDS', 'Netherlands', '', '', '2023-07-01 13:32:27'),
(13, 'MERCURY ENGINEERING B.V', 'CHRISTINE FETHERSTON', 'CHRISTINE.FETHERSTON@MERCURYENG.COM', 'MERCURY ENGINEERING B.V', 'C/O KINGSFORDWEG 151', '1043 GR AMSTERDAM', '', 'NETHERLANDS', 'Netherlands', 'MERCURY ENGINEERING B.V', 'C/O KINGSFORDWEG 151', '1043 GR AMSTERDAM', '', 'NETHERLANDS', 'Netherlands', '', '', '2023-07-01 13:32:27'),
(14, 'TECHNICAL TRADE THONE GMBH', 'MANFRED THONE', 'sekretariat@ttt-aggregate.de', 'IM KLEINEN LOH 25', 'D-34376', '', '', 'IMMENHAUSEN', 'Germany', 'IM KLEINEN LOH 25', 'D-34376', '', '', 'IMMENHAUSEN', 'Germany', '', '', '2023-07-01 13:32:27'),
(15, 'CSL POWER SYSTEMS LTD', 'KURT GOZZETT', 'KURT@CSLPOWER.CO.UK', 'CSL POWER SYSTEMS LTD', 'POWER HOUSE', 'APEX BUSINESS PARK', 'QUEENS FARM ROAD. LOWER SHORNE KENT', 'DA12 3HU', 'United Kingdom', 'CSL POWER SYSTEMS LTD', 'POWER HOUSE', 'APEX BUSINESS PARK', 'QUEENS FARM ROAD. LOWER SHORNE KENT', 'DA12 3HU', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(16, 'UNIVERSAL GLOBAL CORP LTD', 'FPEREIRA', 'fpereira@uecorp.com', 'UNIT C', 'ISLAND ROAD', 'READING', '', 'RG2 0RP', 'United Kingdom', 'UNIT C', 'ISLAND ROAD', 'READING', '', 'RG2 0RP', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(17, 'CRESTCHIC STOCK', 'MARK WHITAKER', 'M.WHITAKER2@CRESTCHIC.CO.UK', 'CRESTCHIC SALES', '2ND AVENUE', 'CENTRUM 100', 'BURTON', 'DE14 2WF', 'United Kingdom', 'CRESTCHIC SALES', '2ND AVENUE', 'CENTRUM 100', 'BURTON', 'DE14 2WF', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(18, 'JOSE PERETO', 'JOSE PERETO', 'JOSEPERETO@PERETO.ES', 'PARTIDA MADRIGUERES AUD A-61', '3700', 'DELIA ALICANTE', '', 'SPAIN', 'Spain', 'PARTIDA MADRIGUERES AUD A-61', '3700', 'DELIA ALICANTE', '', 'SPAIN', 'Spain', '', '', '2023-07-01 13:32:27'),
(19, 'CRESTCHIC ASIA PACIFIC PTE LTD', 'ADRIAN YAP', 'ADRIANYAP@CRESTCHIC.COM', 'NO 5 TUAS AVENUE 13', 'SINGAPORE', '', '', '638977', 'Singapore', 'NO 5 TUAS AVENUE 13', 'SINGAPORE', '', '', '638977', 'Singapore', '', '', '2023-07-01 13:32:27'),
(20, 'ALKHORAYEF GROUP CO', 'DOMNICK V DSOUZA', 'vdsouza@alkohrayef.com', 'PO BOX 46813', 'FAHAHEEL 64019', '', '', 'KUWAIT', 'Kuwait', 'PO BOX 46813', 'FAHAHEEL 64019', '', '', 'KUWAIT', 'Kuwait', '', '', '2023-07-01 13:32:27'),
(21, 'GENESIS POWER CO LTD', 'FARIS ALOBIADI', 'info@genesis-power.com', '62ND STREET ', 'AL-WEHDA DISTRICT', 'BAGHDAD', '', 'IRAQ', 'Iraq', '62ND STREET ', 'AL-WEHDA DISTRICT', 'BAGHDAD', '', 'IRAQ', 'Iraq', '', '', '2023-07-01 13:32:27'),
(22, 'SLR ELECTRICAL SYSTEMS LTD', 'STEPHEN LEDGER', 'stephen.ledger@slresl.com', 'UNIT 205 TEDCO BUSINESS CENTRE', 'VIKING INDUSTRIAL PARK', 'JARROW', 'TYNE & WEAR', 'NE32 3DT', 'United Kingdom', 'UNIT 205 TEDCO BUSINESS CENTRE', 'VIKING INDUSTRIAL PARK', 'JARROW', 'TYNE & WEAR', 'NE32 3DT', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(23, 'AGGREKO UK LTD HIRE DIVISION', 'KIRSTY MANSELL', 'Kirsty.Mansell@aggreko.co.uk', 'AGGREKO UK LTD', 'HIRE DIVISION', 'AGGREKO HOUSE, ORBITAL 2', 'VOYAGER DRIVE. CANNOCK', 'WS11 8XP', 'United Kingdom', 'AGGREKO UK LTD', 'ACCOUNTS PAYABLE', 'OVERBURN AVENUE', 'DUMBARTON', 'G82 2RL', 'United Kingdom', '', '', '2023-07-01 13:32:27'),
(24, 'MEHTA ELECTRICALS LTD', 'ALLAN ASUNDA', 'allan@mehta.co.ke', 'PO BOX 39977-00623', '', '', '', 'NAIROBI', 'Kenya', 'PO BOX 39977-00623', '', '', '', 'NAIROBI', 'Kenya', '', '', '2023-07-01 13:32:27'),
(25, 'MT MILAN TRACTOR S.P.A', 'LIDDIA MAGGIO', 'maggio@milantractor.it', 'VIA PASUBIO 2-20067 ', 'TRIBIANO', '', '', 'MILAN', 'Italy', 'VIA PASUBIO 2-20067 ', 'TRIBIANO', '', '', 'MILAN', 'Italy', '', '', '2023-07-01 13:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `cl_company_contracts`
--

CREATE TABLE `cl_company_contracts` (
  `company_id` int(255) NOT NULL,
  `contract_id` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_company_members`
--

CREATE TABLE `cl_company_members` (
  `id` int(11) NOT NULL,
  `member_id` char(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_contracts`
--

CREATE TABLE `cl_contracts` (
  `contract_id` char(255) NOT NULL,
  `contract_no` int(24) NOT NULL,
  `contract_type` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `quote_no` varchar(255) NOT NULL,
  `quote_date` date NOT NULL,
  `order_no` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `required_date` date NOT NULL,
  `job_no` int(11) NOT NULL,
  `sales_order_no` int(11) NOT NULL,
  `paymentTM` varchar(255) NOT NULL,
  `commissioning` varchar(255) NOT NULL,
  `service_notified` varchar(255) NOT NULL,
  `penalty_clause` varchar(255) NOT NULL,
  `salesperson_id` varchar(255) NOT NULL,
  `d_address_line_1` varchar(255) NOT NULL,
  `d_address_line_2` varchar(255) NOT NULL,
  `d_address_line_3` varchar(255) NOT NULL,
  `d_address_line_4` varchar(255) NOT NULL,
  `d_address_line_5` varchar(255) NOT NULL,
  `d_address_line_6` varchar(255) NOT NULL,
  `site_address_line_1` blob NOT NULL,
  `site_address_line_2` blob NOT NULL,
  `site_address_line_3` blob NOT NULL,
  `site_address_line_4` blob NOT NULL,
  `site_address_line_5` blob NOT NULL,
  `site_address_line_6` blob NOT NULL,
  `site_address_line_7` varchar(255) NOT NULL,
  `current_flow` varchar(255) NOT NULL,
  `load_type` varchar(255) NOT NULL,
  `config` varchar(255) NOT NULL,
  `usage_frequency` varchar(255) NOT NULL,
  `mainKW` varchar(255) NOT NULL,
  `mainKVA` varchar(255) NOT NULL,
  `mainPF` varchar(255) NOT NULL,
  `mainAMPS` varchar(255) NOT NULL,
  `mainKWSD` varchar(255) NOT NULL,
  `mainKVASD` varchar(255) NOT NULL,
  `mainPFSD` varchar(255) NOT NULL,
  `mainAMPSSD` varchar(255) NOT NULL,
  `supplyV` varchar(255) NOT NULL,
  `supplyVSD` varchar(255) NOT NULL,
  `supplyVD1` varchar(255) NOT NULL,
  `supplyVD2` varchar(255) NOT NULL,
  `supplyHz` varchar(255) NOT NULL,
  `supplyHzSD` varchar(255) NOT NULL,
  `supplyPH` varchar(255) NOT NULL,
  `supplyW` varchar(255) NOT NULL,
  `auxInfo` varchar(255) NOT NULL,
  `auxSV` varchar(255) NOT NULL,
  `auxSHz` varchar(255) NOT NULL,
  `auxSPH` varchar(255) NOT NULL,
  `auxSW` varchar(255) NOT NULL,
  `intExt` varchar(255) NOT NULL,
  `range_temp_C` varchar(255) NOT NULL,
  `extendable` varchar(255) NOT NULL,
  `leads` varchar(255) NOT NULL,
  `ioInfo` varchar(255) NOT NULL,
  `coolingType` varchar(255) NOT NULL,
  `txPRating` varchar(255) NOT NULL,
  `txSRating` varchar(255) NOT NULL,
  `fanRotation` varchar(255) NOT NULL,
  `sgPRating` varchar(255) NOT NULL,
  `sgSRating` varchar(255) NOT NULL,
  `relayType` varchar(255) NOT NULL,
  `enclosure` varchar(255) NOT NULL,
  `encStyle` varchar(255) NOT NULL,
  `encSize` varchar(255) NOT NULL,
  `encBase` varchar(255) NOT NULL,
  `encLifting` varchar(255) NOT NULL,
  `encHeight` varchar(255) NOT NULL,
  `encSpecial` varchar(255) NOT NULL,
  `enc_finish` varchar(255) NOT NULL,
  `encFinDefaultApplied` varchar(255) NOT NULL,
  `assWeight` varchar(255) NOT NULL,
  `otherInfo` varchar(255) NOT NULL,
  `dataTags` varchar(255) NOT NULL,
  `dataDown` int(11) NOT NULL,
  `underMods` tinyint(1) NOT NULL,
  `pendingQuery` blob NOT NULL,
  `onHold` tinyint(1) NOT NULL,
  `checkS` tinyint(1) NOT NULL,
  `checkEng` tinyint(1) NOT NULL,
  `finalNotify` tinyint(1) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `warrantyDate` date NOT NULL,
  `notified` tinyint(1) NOT NULL,
  `eid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_contracts`
--

INSERT INTO `cl_contracts` (`contract_id`, `contract_no`, `contract_type`, `company_id`, `quote_no`, `quote_date`, `order_no`, `order_date`, `quantity`, `required_date`, `job_no`, `sales_order_no`, `paymentTM`, `commissioning`, `service_notified`, `penalty_clause`, `salesperson_id`, `d_address_line_1`, `d_address_line_2`, `d_address_line_3`, `d_address_line_4`, `d_address_line_5`, `d_address_line_6`, `site_address_line_1`, `site_address_line_2`, `site_address_line_3`, `site_address_line_4`, `site_address_line_5`, `site_address_line_6`, `site_address_line_7`, `current_flow`, `load_type`, `config`, `usage_frequency`, `mainKW`, `mainKVA`, `mainPF`, `mainAMPS`, `mainKWSD`, `mainKVASD`, `mainPFSD`, `mainAMPSSD`, `supplyV`, `supplyVSD`, `supplyVD1`, `supplyVD2`, `supplyHz`, `supplyHzSD`, `supplyPH`, `supplyW`, `auxInfo`, `auxSV`, `auxSHz`, `auxSPH`, `auxSW`, `intExt`, `range_temp_C`, `extendable`, `leads`, `ioInfo`, `coolingType`, `txPRating`, `txSRating`, `fanRotation`, `sgPRating`, `sgSRating`, `relayType`, `enclosure`, `encStyle`, `encSize`, `encBase`, `encLifting`, `encHeight`, `encSpecial`, `enc_finish`, `encFinDefaultApplied`, `assWeight`, `otherInfo`, `dataTags`, `dataDown`, `underMods`, `pendingQuery`, `onHold`, `checkS`, `checkEng`, `finalNotify`, `completed`, `warrantyDate`, `notified`, `eid`) VALUES
('00197b40-8404-48a9-9c6d-4c9e98c5eea3', 6130, 'Single Unit', 1, 'INTERCO', '2018-12-06', 'INTERCO', '2018-12-06', 1, '2018-12-06', 9992, 2841, 'INTERCO', 'N', 'n', 'N', '670231963612a0998bde97', 'CRESTHIC INC', '', '', '', '', 'United States', '', '', '', '', '', '', '', 'AC', 'Resistive/Reactive', 'Star', 'Periodically', '500', '625', '0.8', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '480', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '', 'Internal, External, Switched', '380/480', '50/60', '3', '3-- 4', '', '-20 to 40', '', '', 'Eclipse303,TransView210', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable / Trailer Mounted', '600kW', 'Channel', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '3775 kg', 'Repeat of C6032 (Damien to source trailer)\r\nUse UL Compliant Components\r\nAnti-Condensation Heating Control and Contactor Sections \r\nIncreased ventilation for reactor and control sections.\r\nCam-Loks', 'C6130 Manual', 1, 0, '', 0, 1, 1, 1, 1, '2020-03-30', 0, 10),
('003130a4-b035-4d61-b08a-05a7cd4c8742', 5925, 'Single Unit', 2, 'QUO-02804 R5 DR2403', '2017-11-02', 'YZ17K325', '2017-11-27', 1, '2018-03-23', 5072, 1734, '60 days from receipt of shipping docs', 'No', 'No', 'No', '670231963612a0998bde97', 'CIF JEBEL ALI PORT DUBAI', '', '', '', '', 'United Arab Emirates', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '160', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '440', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '3-- 4', 'Internal, External, Switched', '440', '50', '3', '3-- 4', '', '-20 to 40', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Fixed', '300kW', 'Channel', 'Standard', '', 'N/A', 'RAL - 9010 Pure White', 'N/A', '280kg', 'Anti-Condensation Heater\r\nIndication Lamps – Running and Fault\r\nStainless Steel 316 Rating Plate\r\nDesign at 480V', 'C5925 Manual_DNV', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('003c59cf-241d-409d-bf4b-d0b75e6493f6', 6314, 'Single Unit', 3, 'EMAIL 12.09.19', '0019-09-12', 'PO6127', '0000-00-00', 1, '0000-00-00', 13783, 3778, '30/70', 'N', 'N', 'N', '670231963612a0998bde97', 'FOB BURTON ON TRENT', '', '', '', 'FOB', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '500', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '480', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '4', 'N/A', '0', '50', '1', '2', '', '-20 to 40', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Fixed', '600kW', 'Channel', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', '', '600kg', 'PVC COVER', 'OP6314', 1, 0, '', 0, 1, 1, 1, 1, '2020-12-06', 0, 10),
('004f8417-ab95-48b3-9680-17953aae386d', 6239, 'Single Unit', 4, 'q370180319rojdf', '0000-00-00', '52507', '0000-00-00', 1, '0000-00-00', 12063, 3370, '45 DAYS', 'N', 'N', 'N', '670231963612a0998bde97', 'EXW', '', '', '', 'EXW', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '1000', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '400', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '3', 'N/A', '400', '50', '3', '3', '', '-20 to 40', '', '', '', 'N/A', '', '', 'N/A', '', '', 'N/A', 'Vertical', 'Fixed', '1000kW (3 fan)', 'Channel', 'Standard', '', 'N/A', 'RAL - 7035 Pale Grey', '', '1215kg', 'TRAKKER TO BE USED TO LIMIT EXPORT RATHER THAN AS CONVENTIONAL GENERATOR SUPPORT', 'C6239 Manual', 1, 0, '', 0, 1, 1, 1, 1, '2020-08-12', 0, 11),
('00566a02-49bb-4136-ada8-417b0d239c38', 6210, 'Single Unit', 5, 'EMAIL', '2023-08-14', '706961', '2023-08-14', 2, '2023-08-14', 11377, 3200, '20/80', 'N', 'N', 'N', '670231963612a0998bde97', '', '', '', '', '', 'Afghanistan', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '400', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '400', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal,External,Switched', '400', '50', '3', '4', '', '-20 to 40', '', '5', '', 'N/A', '', '', 'N/A', '', '', 'N/A                            ', 'enc_dnVxPl6CFg7YuBcyb5fe', '--SELECT AN OPTION--', '--SELECT AN OPTION--', '--SELECT AN OPTION--', 'Standard', '', 'N/A', 'BS 4800 - 00 E 55 Gloss White', '', '570 kg', '5 X 80kW STEPS AS PER DRAWING CL15934 .  C4728', 'C6210-1 Manual', 1, 0, '', 0, 1, 1, 1, 0, '0000-00-00', 0, 11),
('006b55e1-9a07-48a4-9381-a7c762998955', 5773, 'Single Unit', 6, 'Q02795/r3/JDF', '2017-03-31', '4500008033', '2017-03-31', 1, '2017-06-23', 2694, 1126, 'No', 'Yes', 'Yes', 'No', '670231963612a0998bde97', 'Bilston Road', 'Wolverhampton', '', '', 'WV1 3RE', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '2000', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '415', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '3', 'External, Switched', '415', '50', '3', '3', '', '-20 to 40', '', '1x10m PC Lead', 'CrestCom3_120,Eclipse303', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Vertical', 'Fixed', '2000kW (5 fan)', '--SELECT AN OPTION--', 'Standard', '', 'N/A', 'RAL - 6005 Light Moss Green', 'N/A', '2300kg', 'Provide 3200A, 3 Pole Fixed Pattern, non withdrawable ACB within the end mounted cable connection box.\r\nUSE FAN324 WOODS', 'C5773 Manual', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('016b6109-7278-4e20-a0ca-e42177071caa', 6082, 'Single Unit', 7, 'Q188-260718/R0/JDF & EMAIL 20/9/18', '2018-09-20', 'P3310-2759-KG', '2018-09-19', 2, '2018-11-30', 9017, 2618, '30% ON ORDER 70% PRIOR COLLECTION', 'No', 'No', 'No', '670231963612a0998bde97', 'EXW', '', '', '', '', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '200', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '440', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '4', 'Internal, External, Switched', '440', '60', '3', '4', '', '-20 to 40', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '300kW', 'Channel', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '260kg', 'LOAD BANK START INHIBIT CONNECTIONS VOLT FREE\r\nUNIT IS TO BE PUT ON A TRAILER BY CUSTOMER.', 'op6082-2', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('019e54be-c626-46db-a61c-cb279695a79d', 5776, 'Single Unit', 8, 'Q02171/ ALH/240117', '2017-01-24', 'I17002478', '2017-04-05', 1, '2017-07-07', 2700, 1130, '30 days credit invoice date', 'Yes', 'No', 'No', '670231963612a0998bde97', 'Datacenter Interaction Frankfurt', 'Weismullerstrase 40, 60314.', 'Frankfurt am Main', '', '', 'Germany', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '2400', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '440', 'N/A', 'N/A', 'N/A', '50/60', 'N/A', '3', '4', 'External', '400', '50', '3', '4', '', '-20 to 40', '', '1x100m Ext Lead, 1x10m PC Lead, 1x10m HHT Lead', 'Eclipse303,TransView210', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Container', 'N/A', '10FT Container', 'N/A', 'Standard', '', 'N/A', 'RAL - 7035 Pale Grey', 'N/A', '3400kg', 'Drawing supplied by Paul Shuttleworth (autocad) amended and included by Zwart file name: FRA11 Loadbank Structural.pdf.  Still waiting approval', 'C5776 Manual', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('0201e9c8-4986-4f43-8885-c1a68400a809', 5920, 'Single Unit', 9, 'QYR901117', '2017-11-03', '78686', '2017-11-14', 1, '2018-02-23', 4859, 1694, '100% at 60days to Crestchic-France.', 'No', 'No', 'No', '670231963612a0998bde97', 'ANTWERPEN', 'BOOMSESTEENWEG 56/2', '2630 AARTSELAAR   BE', '', '', 'Belgium', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '300', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '400', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '3', 'Internal, External, Switched', '400', '50', '3', '3', '', '-20 to 40', '', '1x10m KCS100HM Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable / Trailer Mounted', '300kW', '--SELECT AN OPTION--', 'Standard', '', 'N/A', 'BS 4800 - 00 E 55 Gloss White', 'N/A', '510kg', '-	Included delivery to the End Customer Address and YR to be informed \r\n-	To be delivered with French user manual\r\n-	Expected delivery on site by the 28/02/2018', 'C5920FRA Manual Iss C', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('0209a5d5-6ab1-46e2-ac51-3fd04219825b', 6797, 'Single Unit', 10, 'Q1076230421r4jdf', '2021-07-26', 'EU16052166', '2021-08-20', 48, '2021-11-30', 25557, 6130, 'N/A', 'TRAINNG', 'Yes', 'No', '670231963612a0998bde97', 'DDP', 'AMAZON DATA SERVICES  IRELAND LTD', 'CRUISERATH ROAD', 'DUBLIN D15', '', 'Ireland', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '150', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '415', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal, External, Switched', '230', '50', '1', '2', '', '-20 to 40', '', '1x5m Comms Lead, 1x10m Comms Lead, 4x10m KCS100HM Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '300kW', 'Crash Pack', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '', 'Powersafe for test supply, 1 per phase +1N + 1E\r\nAUX VIA CEEFORM SOCKET.\r\nKCS100HM & 10M LDs X 4 JOB NUMBER:25558 & 25559\r\n10M COMMS LEAD X 1 JOB NUMBER:  25560', '', 0, 0, '', 0, 0, 0, 0, 0, '0000-00-00', 0, 34),
('0244e66f-e345-4d36-9ed6-808ec01794ea', 6581, 'Single Unit', 11, 'QLP GBP', '2020-10-19', 'BP01', '2020-10-19', 1, '2021-02-12', 20040, 5133, '30 DAYS', 'No', 'No', 'No', '670231963612a0998bde97', 'OAKLEY HOUSE', 'HOGWOOD LANE', 'FINCHAMPSTEAD', 'BERKS', 'RG40 4QW', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '40', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '415', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal, External, Switched', '230', '50', '1', '2', '', '-20 to 40', '', '1x10m KCS100HM Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '100kW', 'Castors', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '', '40kW, 3ph, 50Hz needs the ability to operate up to circa 12kW at 230V, 1ph, 50Hz', '', 0, 0, '', 0, 0, 0, 0, 0, '0000-00-00', 0, 34),
('0263f057-8fe9-4799-97f7-9b5f3fa6df2e', 5675, 'Single Unit', 12, 'PRICE LIST & PB DISC', '2016-08-01', '0116/6l2898-B', '2016-11-23', 1, '2017-02-10', 1866, 861, 'No', 'No', 'No', 'No', '670231963612a0998bde97', 'IM KLEINEN LOH 25', 'D-34376 IMMENHAUSEN', '', '', '', 'Germany', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '700', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '400', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'N/A', '400', '50', '3', '4', '', '-20 to 45', '', '1x10m System Extend Lead, 1x10m Comms Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Vertical', 'Transportable', '1000kW (3 fan)', 'Castors', 'Standard', '', 'N/A', 'BS 4800 - 00 E 55 Gloss White', 'N/A', '570 kg', 'USUAL TECHNICAL TRADE REQUIREMENTS.\r\nMANUAL AND LABELS IN GERMAN\r\n', 'op5675ger', 1, 0, '', 0, 1, 1, 1, 1, '2018-02-10', 0, 34),
('02c85e8b-5546-405c-b9a1-7936fa398256', 6553, 'Single Unit', 13, 'Stock', '2020-01-01', 'STOCK C/CALDWELL', '2020-09-10', 1, '2021-02-26', 19516, 5033, 'STOCK', 'No', 'No', 'No', '670231963612a0998bde97', 'DAP', '', '', '', '', 'United States', '', '', '', '', '', '', '', 'AC', 'Resistive/Reactive', 'Star', 'Periodically', '2640', '3300', '0.8', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '600', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '', 'Internal, External, Switched', '480-600', '60', '3', '3-- 4', '', '-20 to 40', '', '1x5m PC Lead, 1x15m Comms Lead, 1x50m Ext Reel, 1x5m LC80 Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Container', 'N/A', '10FT Container', 'N/A', 'Standard', '', 'N/A', 'RAL - 7046 Telegrey 2', 'N/A', '', 'MUST BE ABLE TO TEST AT LOW VOLTAGES 208V 3Ph, 416V, 480V\r\n\r\nPLEASE USE THE ADE CONTAINER IN STOCK AND A NEW DOOR WILL BE REQUIRED FOR THE KCS\r\n\r\nCSA FUSES & CIRCUIT BREAKERS', '', 0, 0, '', 0, 0, 0, 0, 0, '0000-00-00', 0, 34),
('030bc99f-d85e-4066-8a89-798fba69dbf2', 6675, 'Single Unit', 14, 'PRICE LIST LESS DISC', '2020-01-01', 'HPS558JF', '2021-02-19', 1, '2021-06-18', 22007, 5523, '60', 'N', 'n', 'N', '670231963612a0998bde97', 'FCA', '', '', '', '', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive/Reactive', 'Star', 'Periodically', '1500', '1875', '0.8', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '480', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '', 'Internal, External, Switched', '480', '60', '3', '3-- 4', '', '-20 to 40', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Container', 'N/A', '6FT Container', 'N/A', 'Standard', 'STANDARD', 'N/A', 'RAL - 7046 Telegrey 2', 'N/A', '', '7FT CONTAINER\r\nCAMLOCS ON AUX SUPPLY', '', 0, 0, '', 0, 0, 0, 0, 0, '0000-00-00', 0, 10),
('03286074-dba2-4a4f-801e-c22591aba5af', 6433, 'Single Unit', 15, 'No N°', '2020-02-07', 'EMAIL/30% PAYMENT', '2020-02-07', 1, '2020-04-10', 15989, 4309, '30/70', 'No', 'No', 'No', '670231963612a0998bde97', 'FCA UK PORT', '', '', '', '', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '100', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '220', 'N/A', 'N/A', 'N/A', '50/60', 'N/A', '3', '4', 'Internal, External, Switched', '240', '50/60', '3', '2-- 4', '', '-20 to 40', '', '1x10m LC60 Lead, 1x10m Comms Lead', 'Eclipse303,TransView210', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '100kW', 'Castors', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '235kg', 'AUXILIARY SUPPLY DERIVED INTERNALLY WITH THE INTERNAL/EXTERNAL SWITCH THEY WANT THE OPTION TO SUPPLY EXTERNAL 1PH 240V AUX SUPPLY.', 'C6433 Manual', 1, 0, '', 0, 1, 1, 1, 1, '2022-07-31', 0, 34),
('035b9561-12bf-4a4c-8461-6d742f517c2c', 6724, 'Single Unit', 16, 'QLP GBP EMAIL ', '2021-04-28', '2550', '2021-04-30', 1, '2021-08-20', 23482, 5814, '30/70', 'N', 'N ', 'n', '670231963612a0998bde97', 'EXW', '', '', '', '', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '600', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '415', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal, External, Switched', '415', '50', '3', '4', '', '-20 to 40', '', '1x10m KCS100HM Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '600kW', 'Channel', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '', 'PVC COVER. POWER SAFE CONNECTORS. \r\nUNIT IS TO BE FITTED BY CUSTOMER TO TRAILER.\r\n2 per phase + 1N + 1E, these are panel mounted drain type power safe connectors', '', 0, 0, '', 0, 0, 0, 0, 0, '0000-00-00', 0, 10),
('03ab7d58-3e0d-48ae-b438-4b7901f339ef', 6547, 'Single Unit', 17, 'PRICE LIST', '2020-01-01', 'HPS541JF', '2020-09-10', 1, '2021-01-29', 19481, 5024, '60', 'N', 'N', 'N', '670231963612a0998bde97', 'FCA', '', '', '', '', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive/Reactive', 'Star', 'Periodically', '2640', '3300', '0.8', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '480', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '3, 4', 'Internal, External, Switched', '480', '60', '3', '3, 4', '', '-20 to 40', '', '1x5m PC Lead', 'Eclipse303', 'N/A', '', '', 'N/A', '', '', 'N/A', 'Container', 'N/A', '10FT Container', 'N/A', 'Standard', 'STANDARD', 'N/A', 'RAL - 7046 Telegrey 2', '0', '9400kg', 'CAMLOCS AUX ONLY', 'C6547 Manual', 1, 1, '', 0, 1, 1, 1, 1, '2022-03-27', 0, 10),
('03fd0726-7e7c-497e-bc5c-a609a733b4e7', 5803, 'Single Unit', 18, 'Quo02781DR1003', '2017-05-09', '43195', '2017-05-10', 1, '2017-08-11', 3055, 1226, '10% On order, 30% prior collection, 30% on shipping arrive, 30% 30 days from shipping', 'Yes', 'Yes', 'No', '670231963612a0998bde97', 'EXWORKS', '', '', '', '', 'Brazil', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '500', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '380', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '4', 'Internal, External, Switched', '380', '60', '3', '4', '', '-20 to 40', '', '1x10m PC Lead', 'Eclipse303,TransView210', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Fixed', '600kW', 'Channel', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '750kg', 'VERTICAL BLOW', 'C5803 Manual', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('041077b9-1fdc-4347-a8d4-d43d7de2454b', 6323, 'Single Unit', 19, 'PRICE LIST & 2% DISC', '0000-00-00', '0919/6L3236-C', '0000-00-00', 1, '0000-00-00', 14029, 3839, '45 DAYS', 'N', 'N', 'N', '670231963612a0998bde97', 'FCA', '', '', '', 'FCA', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '700', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '400', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal, External, Switched', '400', '50', '3', '4', '', '-20 to 40', '', '1x10m KCS100HM, 1x50m EXT REEL', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '600kW', 'Castors', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', '', '650kg ', 'USUAL TECH TRADE DOCS & LABELLING\r\nDRAWING CL18874 1/2 SENT TO CUSTOMER\r\nPOTENTIAL FREE CONTACT FOR SWITHC OFF IN CASE OF EMERGENCY DUTY AT MAINS FAILURE WITH LINK', 'C6323GER Manual', 1, 0, '', 0, 1, 1, 1, 1, '2021-01-30', 0, 10),
('042fcc04-9146-4f2e-8b20-7c25de889e32', 6746, 'Single Unit', 20, 'PRICE LIST', '2021-01-01', '28019', '2021-06-04', 3, '2021-10-29', 24231, 5934, '30 DAYS', 'N', 'N', 'N', '670231963612a0998bde97', 'FCA', '', '', '', '', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '60', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '415', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal, External, Switched', '240', '50', '1', '2', '', '-20 to 40', '', '1x10m KCS100HM Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '100kW', 'Castors', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '', '', '', 0, 0, '', 0, 0, 0, 0, 0, '0000-00-00', 0, 10),
('04eabdb2-a536-4861-8f1d-b10c08b274d6', 6291, 'Single Unit', 21, 'q0374090719DR', '0000-00-00', 'EG-08-01', '0000-00-00', 1, '0000-00-00', 13060, 3622, '30/70', 'N', 'N', 'N', '670231963612a0998bde97', 'FCA', '', '', '', 'FCA', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '1250', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '400', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal, External, Switched', '400', '50', '3', '4', '', '-20 to 40', '', '', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Vertical', 'Transportable', '1200kW (3 fan)', 'Fork Base', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', '', '1500kg', 'ANTI CONDENSATION HEATER. OVER VOLTAGE PROTECTION', 'C6291 Manual', 1, 0, '', 0, 0, 1, 0, 0, '0000-00-00', 0, 10),
('056a8f2e-8b0a-47fd-8ba5-7546f87ff6b4', 6765, 'Single Unit', 22, 'PRICE LIST', '2021-01-01', 'HPS575JF', '2021-06-10', 1, '2021-10-11', 24363, 5961, '60', 'n', 'N', 'N', '670231963612a0998bde97', 'FCA', '', '', '', '', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive/Reactive', 'Star', 'Periodically', '1500', '1875', '0.8', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '480', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '', 'Internal, External, Switched', '480', '60', '3', '4', '', '-20 to 40', '', '1xN System extend Advanced', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Container', 'N/A', '7FT Container', 'N/A', 'Standard', 'STANDARD', 'N/A', 'RAL - 7046 Telegrey 2', 'N/A', '', 'TEST SUPPLY LIVE BEACON\r\nDOOR OPEN ALARM\r\nCAMLOCKS AUX ONLY', '', 0, 0, '', 0, 0, 0, 0, 0, '0000-00-00', 0, 10),
('057186f4-4990-4df7-b40c-3fb805c98bc4', 6055, 'Single Unit', 23, 'N/A', '2018-08-06', 'INTERCO', '2018-08-06', 1, '2018-09-06', 8240, 2449, 'INTERCO', 'No', 'No', 'No', '670231963612a0998bde97', 'Ex works', '', '', '', '', 'United States', '', '', '', '', '', '', '', 'AC', 'Resistive/Reactive', 'Star', 'Periodically', '240', '300', '0.8', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '277/480', 'N/A', 'N/A', 'N/A', '60', 'N/A', '3', '', 'Internal, External, Switched', '380/480', '50/60', '3', '3', '', '-20 to 40', '', '1x10m PC Lead', 'Eclipse303,TransView210', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Transportable', '300kW', 'Fork Base with Castors', 'Standard', '', 'N/A', 'RAL - 9002 Grey White', 'N/A', '1740 kg', 'Star / Delta Configuration\r\nUse UL Compliant Components', 'C6055 Manual', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('058d67c9-91cd-4ac5-8d00-055f94de89ce', 5936, 'Single Unit', 24, 'Price list', '2017-01-02', '1117/6L3057', '2017-12-14', 1, '2018-03-16', 5266, 1778, '45 DAYS', 'No', 'No', 'No', '670231963612a0998bde97', 'EXW', '', '', '', '', 'Germany', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '500', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '400', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '4', 'Internal, External, Switched', '400', '50', '3', '4', '', '-20 to 40', '', '1x20m KCS100HM Lead', '', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'enc_dnVxPl6CFg7YuBcyb5fe', 'Fixed', '600kW', 'Channel', 'Standard', '', 'N/A', 'Other - Other', 'N/A', '570 kg', 'USUAL TECH TRADE DOCUMENTATION AND LABELLING\r\n\r\nPOWER LOCKS FOR 150mm2 COPPER CABLE 3xPHASE,1xN & 1xE INLET SIDE AUXILIARY SUPPLY CONNECTOR', 'C5936GER Manual', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34),
('05c81d49-7624-459d-b960-1a84beba0bc8', 5832, 'Single Unit', 25, 'Q02858/R2/JDF', '2017-07-06', 'PO002591', '2017-07-07', 1, '2017-09-27', 3406, 1334, '10% 14/7, 10% 4/8. 30% prior delivery. 40% 30 days from delivery. 10% 60 days from delivery', 'Yes', 'Yes', 'No', '670231963612a0998bde97', 'Wickham Market', 'Haceston', 'Woodbridge', 'Suffolk', 'IP13 9ND', 'United Kingdom', '', '', '', '', '', '', '', 'AC', 'Resistive', 'Star', 'Periodically', '2000', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', '434', 'N/A', 'N/A', 'N/A', '50', 'N/A', '3', '3', 'External, Switched', '415', '50', '3', '3', '', '-20 to 40', '', '1x10m PC Lead', 'CrestCom3_120,Eclipse303', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'Container', 'N/A', '10FT Container', 'N/A', 'Standard', '', 'N/A', 'RAL - 6005 Light Moss Green', 'N/A', '5110kg', 'Provide 3200A, 3 Pole Fixed Pattern, non withdrawable ACB within the end mounted cable connection box. ELE346 Elements only. Separate 220-240v 50Hz 1Phase Supply for the control system. Rob Warwick to undertake software to limit to 2000kW (2050kW) USE FAN', 'C5832 Manual', 1, 0, '', 0, 0, 1, 1, 0, '0000-00-00', 0, 34);

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_assignees`
--

CREATE TABLE `cl_contract_assignees` (
  `contract_id` char(255) NOT NULL,
  `engineer_id` char(23) DEFAULT NULL,
  `engineer_date_assigned` date NOT NULL,
  `comments` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_change_log`
--

CREATE TABLE `cl_contract_change_log` (
  `contract_id` char(255) NOT NULL,
  `added_by_id` char(23) NOT NULL,
  `date_added` datetime NOT NULL,
  `edited_by_id` char(23) DEFAULT NULL,
  `date_edited` date NOT NULL,
  `comments` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_contract_change_log`
--

INSERT INTO `cl_contract_change_log` (`contract_id`, `added_by_id`, `date_added`, `edited_by_id`, `date_edited`, `comments`) VALUES
('00197b40-8404-48a9-9c6d-4c9e98c5eea3', '324317917612a0998de88b', '2021-06-09 00:00:00', '', '0000-00-00', ''),
('003130a4-b035-4d61-b08a-05a7cd4c8742', '324317917612a0998de88b', '2021-07-07 00:00:00', '', '0000-00-00', ''),
('003c59cf-241d-409d-bf4b-d0b75e6493f6', '324317917612a0998de88b', '2021-02-18 00:00:00', '', '0000-00-00', ''),
('004f8417-ab95-48b3-9680-17953aae386d', '324317917612a0998de88b', '2021-02-18 00:00:00', '', '0000-00-00', ''),
('00566a02-49bb-4136-ada8-417b0d239c38', '324317917612a0998de88b', '2021-02-18 00:00:00', '', '0000-00-00', ''),
('006b55e1-9a07-48a4-9381-a7c762998955', '324317917612a0998de88b', '2021-06-28 00:00:00', '', '0000-00-00', ''),
('016b6109-7278-4e20-a0ca-e42177071caa', '324317917612a0998de88b', '2021-06-23 00:00:00', '', '0000-00-00', ''),
('019e54be-c626-46db-a61c-cb279695a79d', '324317917612a0998de88b', '2021-06-28 00:00:00', '', '0000-00-00', ''),
('0201e9c8-4986-4f43-8885-c1a68400a809', '324317917612a0998de88b', '2021-07-07 00:00:00', '', '0000-00-00', ''),
('0209a5d5-6ab1-46e2-ac51-3fd04219825b', '324317917612a0998de88b', '2021-08-27 00:00:00', '', '0000-00-00', ''),
('0244e66f-e345-4d36-9ed6-808ec01794ea', '324317917612a0998de88b', '2021-08-25 00:00:00', '', '0000-00-00', ''),
('0263f057-8fe9-4799-97f7-9b5f3fa6df2e', '324317917612a0998de88b', '2021-06-08 00:00:00', '', '0000-00-00', ''),
('02c85e8b-5546-405c-b9a1-7936fa398256', '324317917612a0998de88b', '2021-08-24 00:00:00', '', '0000-00-00', ''),
('030bc99f-d85e-4066-8a89-798fba69dbf2', '324317917612a0998de88b', '2021-04-28 00:00:00', '', '0000-00-00', ''),
('03286074-dba2-4a4f-801e-c22591aba5af', '324317917612a0998de88b', '2021-06-10 00:00:00', '', '0000-00-00', ''),
('035b9561-12bf-4a4c-8461-6d742f517c2c', '324317917612a0998de88b', '2021-05-04 00:00:00', '', '0000-00-00', ''),
('03ab7d58-3e0d-48ae-b438-4b7901f339ef', '324317917612a0998de88b', '2021-04-28 00:00:00', '', '0000-00-00', ''),
('03fd0726-7e7c-497e-bc5c-a609a733b4e7', '324317917612a0998de88b', '2021-06-30 00:00:00', '', '0000-00-00', ''),
('041077b9-1fdc-4347-a8d4-d43d7de2454b', '324317917612a0998de88b', '2021-02-18 00:00:00', '', '0000-00-00', ''),
('042fcc04-9146-4f2e-8b20-7c25de889e32', '324317917612a0998de88b', '2021-06-08 00:00:00', '', '0000-00-00', ''),
('04eabdb2-a536-4861-8f1d-b10c08b274d6', '324317917612a0998de88b', '2021-02-18 00:00:00', '', '0000-00-00', ''),
('056a8f2e-8b0a-47fd-8ba5-7546f87ff6b4', '324317917612a0998de88b', '2021-06-15 00:00:00', '', '0000-00-00', ''),
('057186f4-4990-4df7-b40c-3fb805c98bc4', '324317917612a0998de88b', '2021-06-22 00:00:00', '', '0000-00-00', ''),
('058d67c9-91cd-4ac5-8d00-055f94de89ce', '324317917612a0998de88b', '2021-07-08 00:00:00', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_checks`
--

CREATE TABLE `cl_contract_checks` (
  `contract_id` char(255) NOT NULL,
  `salesCheck1` tinyint(1) NOT NULL,
  `salesCheck2` tinyint(1) NOT NULL,
  `salesCheck3` tinyint(1) NOT NULL,
  `salesCheck1Date` datetime NOT NULL,
  `salesCheck2Date` datetime NOT NULL,
  `salesCheck3Date` datetime NOT NULL,
  `salesCheck1By` char(23) DEFAULT NULL,
  `salesCheck2By` char(23) DEFAULT NULL,
  `salesCheck3By` char(23) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_contract_checks`
--

INSERT INTO `cl_contract_checks` (`contract_id`, `salesCheck1`, `salesCheck2`, `salesCheck3`, `salesCheck1Date`, `salesCheck2Date`, `salesCheck3Date`, `salesCheck1By`, `salesCheck2By`, `salesCheck3By`) VALUES
('00197b40-8404-48a9-9c6d-4c9e98c5eea3', 1, 1, 1, '2021-06-09 00:00:00', '2021-08-27 00:00:00', '2021-06-09 00:00:00', '324317917612a0998de88b', '', ''),
('003130a4-b035-4d61-b08a-05a7cd4c8742', 1, 1, 1, '2021-07-12 00:00:00', '2021-08-27 00:00:00', '2021-07-07 00:00:00', '1636568260612a0998b7d5d', '', ''),
('003c59cf-241d-409d-bf4b-d0b75e6493f6', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '324317917612a0998de88b', '921790434612a09991d41d', '1590012246612a099902cd2'),
('004f8417-ab95-48b3-9680-17953aae386d', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '324317917612a0998de88b', '81155016612a0999110ed', '1590012246612a099902cd2'),
('00566a02-49bb-4136-ada8-417b0d239c38', 1, 1, 1, '0000-00-00 00:00:00', '2021-08-27 00:00:00', '0000-00-00 00:00:00', '324317917612a0998de88b', '', '1590012246612a099902cd2'),
('006b55e1-9a07-48a4-9381-a7c762998955', 1, 1, 1, '2021-06-30 00:00:00', '2021-08-27 00:00:00', '2021-06-28 00:00:00', '1636568260612a0998b7d5d', '', ''),
('016b6109-7278-4e20-a0ca-e42177071caa', 1, 1, 1, '2021-06-30 00:00:00', '2021-08-27 00:00:00', '2021-06-23 00:00:00', '1636568260612a0998b7d5d', '', ''),
('019e54be-c626-46db-a61c-cb279695a79d', 1, 1, 1, '2021-06-30 00:00:00', '2021-08-27 00:00:00', '2021-06-28 00:00:00', '1636568260612a0998b7d5d', '', ''),
('0201e9c8-4986-4f43-8885-c1a68400a809', 1, 1, 1, '2021-07-12 00:00:00', '2021-08-27 00:00:00', '2021-07-07 00:00:00', '1636568260612a0998b7d5d', '', ''),
('0209a5d5-6ab1-46e2-ac51-3fd04219825b', 1, 1, 1, '2021-08-27 00:00:00', '2021-08-27 00:00:00', '2021-08-27 00:00:00', '695597844612a09999d714', '', ''),
('0244e66f-e345-4d36-9ed6-808ec01794ea', 0, 1, 1, '0000-00-00 00:00:00', '2021-08-27 00:00:00', '2021-08-25 00:00:00', '', '', ''),
('0263f057-8fe9-4799-97f7-9b5f3fa6df2e', 1, 1, 1, '2021-06-10 00:00:00', '2021-08-27 00:00:00', '2021-06-08 00:00:00', '1636568260612a0998b7d5d', '', ''),
('02c85e8b-5546-405c-b9a1-7936fa398256', 0, 1, 1, '0000-00-00 00:00:00', '2021-08-27 00:00:00', '2021-08-24 00:00:00', '', '', ''),
('030bc99f-d85e-4066-8a89-798fba69dbf2', 1, 1, 1, '2021-04-28 00:00:00', '2021-08-27 00:00:00', '2021-04-28 00:00:00', '324317917612a0998de88b', '', ''),
('03286074-dba2-4a4f-801e-c22591aba5af', 1, 1, 1, '2021-06-10 00:00:00', '2021-08-27 00:00:00', '2021-06-10 00:00:00', '1636568260612a0998b7d5d', '', ''),
('035b9561-12bf-4a4c-8461-6d742f517c2c', 1, 1, 1, '2021-05-04 00:00:00', '2021-06-03 00:00:00', '2021-06-08 00:00:00', '324317917612a0998de88b', '81155016612a0999110ed', '1590012246612a099902cd2'),
('03ab7d58-3e0d-48ae-b438-4b7901f339ef', 1, 1, 1, '2021-04-28 00:00:00', '2021-08-27 00:00:00', '2021-04-28 00:00:00', '324317917612a0998de88b', '', ''),
('03fd0726-7e7c-497e-bc5c-a609a733b4e7', 1, 1, 1, '2021-06-30 00:00:00', '2021-08-27 00:00:00', '2021-06-30 00:00:00', '1636568260612a0998b7d5d', '', ''),
('041077b9-1fdc-4347-a8d4-d43d7de2454b', 1, 1, 1, '0000-00-00 00:00:00', '2021-08-27 00:00:00', '0000-00-00 00:00:00', '324317917612a0998de88b', '', ''),
('042fcc04-9146-4f2e-8b20-7c25de889e32', 1, 1, 1, '2021-06-08 00:00:00', '2021-08-27 00:00:00', '2021-06-08 00:00:00', '324317917612a0998de88b', '', ''),
('04eabdb2-a536-4861-8f1d-b10c08b274d6', 1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '324317917612a0998de88b', '921790434612a09991d41d', '1590012246612a099902cd2'),
('056a8f2e-8b0a-47fd-8ba5-7546f87ff6b4', 1, 1, 1, '2021-06-15 00:00:00', '2021-08-27 00:00:00', '2021-06-15 00:00:00', '324317917612a0998de88b', '', ''),
('057186f4-4990-4df7-b40c-3fb805c98bc4', 1, 1, 1, '2021-06-30 00:00:00', '2021-08-27 00:00:00', '2021-06-22 00:00:00', '1636568260612a0998b7d5d', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_controllers`
--

CREATE TABLE `cl_contract_controllers` (
  `contract_id` char(255) NOT NULL,
  `control_system_id` char(25) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `controller_sub` varchar(255) NOT NULL,
  `controller_packages` varchar(255) NOT NULL,
  `interconnecting_packages` varchar(255) NOT NULL,
  `control_info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_contract_controllers`
--

INSERT INTO `cl_contract_controllers` (`contract_id`, `control_system_id`, `controller`, `controller_sub`, `controller_packages`, `interconnecting_packages`, `control_info`) VALUES
('00197b40-8404-48a9-9c6d-4c9e98c5eea3', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', '10M LEAD TO TERMINAL SIGNALS.  10M LEAD TO TERMINAL KCS. ONE & LAMP\r\nCONTROL TO BE VIA A REMOTE CONTROL BOX TO INCORPORATE KCS100R, INS421ABB. ON/OFF FAULT & OK LIGHTS.\r\n\r\nEMERGENCY STOP ON LOAD BANK AND REMOTE CONTROL BOX\r\n\r\nNO AUX SUPPLY'),
('003130a4-b035-4d61-b08a-05a7cd4c8742', 'cs_xw3KChXNjlFnPURoT4bY', 'Tracker', '', '', '', 'ONE & LAMP'),
('003c59cf-241d-409d-bf4b-d0b75e6493f6', 'WTT', 'WTT', '', '', '', 'MANUAL REV.  5 X 80kW STEPS'),
('004f8417-ab95-48b3-9680-17953aae386d', 'cs_jtMq7dNrgDGecB50awfE,c', 'KCS, MCS', 'Nova', 'Nova Platform LC80 Controller', 'Interconnection Package 2', 'INS430 AUTO REV'),
('00566a02-49bb-4136-ada8-417b0d239c38', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', 'N/A', 'N/A', 'N/A', 'AUTO REV. INS 430 MTR'),
('006b55e1-9a07-48a4-9381-a7c762998955', 'cs_Q8jp6AMgFlysKzctkwa4', 'MCS', 'Nova', 'Nova Platform LC80 Controller', 'Interconnection Package 2', 'INS METER AUTO REV'),
('016b6109-7278-4e20-a0ca-e42177071caa', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', 'SYSTEM EXTEND FUNCTION. AUTO'),
('019e54be-c626-46db-a61c-cb279695a79d', 'cs_uobdh0If1BOlyXWNgLHr', 'Toggle Switches, WTT', '', '', '', 'WTT 11x100 & 3x50kW STEPS, WITH BACK UP TOGGLE SWITCHES. ONE & LAMP'),
('0201e9c8-4986-4f43-8885-c1a68400a809', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', 'SYSTEM EXTEND. AUTO REV. INS421ABB METER'),
('0209a5d5-6ab1-46e2-ac51-3fd04219825b', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', 'SYSTEM EXTEND. AUTO'),
('0244e66f-e345-4d36-9ed6-808ec01794ea', 'cs_Q8jp6AMgFlysKzctkwa4', 'MCS', '', '', '', 'Includes Eclipse and Transview software'),
('0263f057-8fe9-4799-97f7-9b5f3fa6df2e', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', 'ins430'),
('02c85e8b-5546-405c-b9a1-7936fa398256', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', 'SYS EXTEND'),
('030bc99f-d85e-4066-8a89-798fba69dbf2', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', '100L '),
('03286074-dba2-4a4f-801e-c22591aba5af', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', 'SYSTEM EXTEND. INS421 ABB METER'),
('035b9561-12bf-4a4c-8461-6d742f517c2c', 'cs_Q8jp6AMgFlysKzctkwa4', 'MCS', '', '', '', 'SOLAR CONTROL. MODBUS. SYS EXTEND. ONE & LAMP. 10M PC LEAD. ECLIPSE'),
('03ab7d58-3e0d-48ae-b438-4b7901f339ef', 'WTT', 'WTT', '', '', '', '3 X STEPS 300/200/100.  ONE & LAMP'),
('03fd0726-7e7c-497e-bc5c-a609a733b4e7', 'cs_jtMq7dNrgDGecB50awfE', 'KCS, Tracker', 'N/A', 'N/A', 'N/A', ''),
('041077b9-1fdc-4347-a8d4-d43d7de2454b', 'cs_jtMq7dNrgDGecB50awfE', 'KCS', '', '', '', ''),
('042fcc04-9146-4f2e-8b20-7c25de889e32', 'cs_Q8jp6AMgFlysKzctkwa4', 'MCS', '', '', '', 'NOVA. ORION. AUTO REV. TRANSVIEW'),
('04eabdb2-a536-4861-8f1d-b10c08b274d6', 'cs_Q8jp6AMgFlysKzctkwa4', 'MCS', '', '', '', 'CONTROL PACKAGE 2. SYS EXT. AUTO REV'),
('056a8f2e-8b0a-47fd-8ba5-7546f87ff6b4', 'cs_Q8jp6AMgFlysKzctkwa4', 'MCS', '', '', '', 'SYS EXTEND, 15M COMMS LEAD. 10M LC60 LEAD. 100M EXT LEAD.15M EM STOP. AUTO REV.10M PC LEAD. ORION'),
('057186f4-4990-4df7-b40c-3fb805c98bc4', 'cs_Q8jp6AMgFlysKzctkwa4', 'MCS', 'Nova', 'Nova Platform LC80 Controller', 'Interconnection Package 1', 'AUTO ETHERNET CONNECTIONS & CABLES.'),
('058d67c9-91cd-4ac5-8d00-055f94de89ce', 'WTT', 'WTT', '', '', '', '10M PC LEAD. ECLIPSE');

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_files`
--

CREATE TABLE `cl_contract_files` (
  `file_id` char(255) NOT NULL,
  `file_ext` varchar(255) NOT NULL,
  `file_name` varchar(1000) NOT NULL,
  `contract_id` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `operator_id` char(23) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `upload_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cl_contract_files`
--

INSERT INTO `cl_contract_files` (`file_id`, `file_ext`, `file_name`, `contract_id`, `operator_id`, `upload_date`) VALUES
('05fe8e3e2b94daccb1c0d3af7b97d42428f46a53', 'png', 'avatar5.png', '00566a02-49bb-4136-ada8-417b0d239c38', '81855781360437e32949c5', '2023-07-12 11:22:32'),
('3274c58e10e259ea32bc43ad7fbd5acbedca5a48', 'png', 'icons.png', '00566a02-49bb-4136-ada8-417b0d239c38', '81855781360437e32949c5', '2023-07-12 11:22:33'),
('49eee5b4309d7e2ce304c528bbab9393e2ddbdaa', 'png', 'default-150x150.png', '00566a02-49bb-4136-ada8-417b0d239c38', '81855781360437e32949c5', '2023-07-12 11:22:33'),
('4c2c2c6b100702b9824d08826184be209537b940', 'jpg', 'prod-1.jpg', '00566a02-49bb-4136-ada8-417b0d239c38', '81855781360437e32949c5', '2023-07-12 11:22:33'),
('8a0668e3e47fa9949ebd312f0ebfad06437954ec', 'png', 'photo2.png', '00566a02-49bb-4136-ada8-417b0d239c38', '81855781360437e32949c5', '2023-07-12 11:22:33'),
('e41ec9f30a817fb852b2b72cd7578c25fbeaca7a', 'pdf', '71a648254f9a9f7d9f4b163672db4263fb4ea512.pdf', '00566a02-49bb-4136-ada8-417b0d239c38', '81855781360437e32949c5', '2023-07-13 00:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_members`
--

CREATE TABLE `cl_contract_members` (
  `id` int(11) NOT NULL,
  `contract_id` char(255) NOT NULL,
  `member_id` char(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_progress`
--

CREATE TABLE `cl_contract_progress` (
  `contract_id` char(255) NOT NULL,
  `contract_pending` tinyint(1) NOT NULL,
  `contract_document_upload` tinyint(1) NOT NULL,
  `contract_software_assigned` tinyint(1) NOT NULL,
  `contract_eng_check` tinyint(1) NOT NULL,
  `contract_sales_check` tinyint(1) NOT NULL,
  `contract_issued_live` tinyint(1) NOT NULL,
  `contract_end_user_notified` tinyint(1) NOT NULL,
  `pending_datetime` datetime NOT NULL,
  `software_assigned_datetime` datetime NOT NULL,
  `document_upload_datetime` datetime NOT NULL,
  `sales_check_datetime` datetime NOT NULL,
  `eng_check_datetime` datetime NOT NULL,
  `issued_live_datetime` datetime NOT NULL,
  `end_user_notified_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_contract_progress`
--

INSERT INTO `cl_contract_progress` (`contract_id`, `contract_pending`, `contract_document_upload`, `contract_software_assigned`, `contract_eng_check`, `contract_sales_check`, `contract_issued_live`, `contract_end_user_notified`, `pending_datetime`, `software_assigned_datetime`, `document_upload_datetime`, `sales_check_datetime`, `eng_check_datetime`, `issued_live_datetime`, `end_user_notified_datetime`) VALUES
('00197b40-8404-48a9-9c6d-4c9e98c5eea3', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('003130a4-b035-4d61-b08a-05a7cd4c8742', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('003c59cf-241d-409d-bf4b-d0b75e6493f6', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('004f8417-ab95-48b3-9680-17953aae386d', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('00566a02-49bb-4136-ada8-417b0d239c38', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('006b55e1-9a07-48a4-9381-a7c762998955', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('016b6109-7278-4e20-a0ca-e42177071caa', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('019e54be-c626-46db-a61c-cb279695a79d', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0201e9c8-4986-4f43-8885-c1a68400a809', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0209a5d5-6ab1-46e2-ac51-3fd04219825b', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0244e66f-e345-4d36-9ed6-808ec01794ea', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0263f057-8fe9-4799-97f7-9b5f3fa6df2e', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('02c85e8b-5546-405c-b9a1-7936fa398256', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('030bc99f-d85e-4066-8a89-798fba69dbf2', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('03286074-dba2-4a4f-801e-c22591aba5af', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('035b9561-12bf-4a4c-8461-6d742f517c2c', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('03ab7d58-3e0d-48ae-b438-4b7901f339ef', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('03fd0726-7e7c-497e-bc5c-a609a733b4e7', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('041077b9-1fdc-4347-a8d4-d43d7de2454b', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('042fcc04-9146-4f2e-8b20-7c25de889e32', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('04eabdb2-a536-4861-8f1d-b10c08b274d6', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('056a8f2e-8b0a-47fd-8ba5-7546f87ff6b4', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('057186f4-4990-4df7-b40c-3fb805c98bc4', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('058d67c9-91cd-4ac5-8d00-055f94de89ce', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('05c81d49-7624-459d-b960-1a84beba0bc8', 0, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_public`
--

CREATE TABLE `cl_contract_public` (
  `contract_id` char(255) NOT NULL,
  `contract_pin` char(255) NOT NULL,
  `contract_pwd` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_contract_public`
--

INSERT INTO `cl_contract_public` (`contract_id`, `contract_pin`, `contract_pwd`) VALUES
('00197b40-8404-48a9-9c6d-4c9e98c5eea3', 'DUAoY8', '$2y$10$E9oLXZ4.TwA3kPd6f4OpXe4zrBZ.NsKJqAKjoc4YtYGP8sapC4aee'),
('003130a4-b035-4d61-b08a-05a7cd4c8742', 'y0nHPs', '$2y$10$GKe3srtC.PecvR7SXGnuY..CUWGlfoxKXXBBnCcKjxTBBV.9poFp6'),
('003c59cf-241d-409d-bf4b-d0b75e6493f6', 'bN694w', '$2y$10$/O2Vf4MVyg2dHUa0wKnYI.v53EJomyDNqDX78Hb9.a0reIf5LrzgO'),
('004f8417-ab95-48b3-9680-17953aae386d', 'LQc8jY', '$2y$10$5hSromBsC0i9bQY0bgN9XuSac37amfaErNIiy9tiIM2WTFYRZRlyW'),
('00566a02-49bb-4136-ada8-417b0d239c38', '4hqxe1', '$2y$10$6eopZlFG0FpF29DQQbJh2e22t2fy5mBZTS/hy27kAN8J9You/kAf2'),
('006b55e1-9a07-48a4-9381-a7c762998955', 'ORzQF8', '$2y$10$x48s2FIVofJpStkIwzdiP.0mlLLI9SwATACQkQI/EtMKPeoczqpZu'),
('016b6109-7278-4e20-a0ca-e42177071caa', 'Nmk2a7', '$2y$10$DwAE4gGfHDSj3PPlYqBQWeJMdYM/hMmFID2woM8iXHE21maxx2RYG'),
('019e54be-c626-46db-a61c-cb279695a79d', 'RN4qUY', '$2y$10$hAbz4YXjD.US88PKau1ZAe.MbguG.zMNQyYq5RO.KPou3/alXMbFu'),
('0201e9c8-4986-4f43-8885-c1a68400a809', 'BCDnj7', '$2y$10$S.NGHMt.awSjKqV54eUIp.KPQ9I3EZSbmqW07pADq7KSkVdwqRpfW'),
('0209a5d5-6ab1-46e2-ac51-3fd04219825b', '', ''),
('0244e66f-e345-4d36-9ed6-808ec01794ea', '', ''),
('0263f057-8fe9-4799-97f7-9b5f3fa6df2e', 'QBKA7o', '$2y$10$ackvVu3ALLUuaFnSkP0nFeT5O7ralECMjgdiyBGT54GpLzIMqiCBq'),
('02c85e8b-5546-405c-b9a1-7936fa398256', '', ''),
('030bc99f-d85e-4066-8a89-798fba69dbf2', '', ''),
('03286074-dba2-4a4f-801e-c22591aba5af', 'Wz5oNq', '$2y$10$vnmMIxXI.PIsBblBkV5Kj.B6WIECbdFWcJgYKtZvVtG0/TRlxM/W2'),
('035b9561-12bf-4a4c-8461-6d742f517c2c', '', ''),
('03ab7d58-3e0d-48ae-b438-4b7901f339ef', 'OJbfg4', '$2y$10$3n/zAHUYRQIX1gr8ScweveZjfr8pbwLm.skpLr0Qn.jEpgDtnSusy'),
('03fd0726-7e7c-497e-bc5c-a609a733b4e7', 'YgWiDp', '$2y$10$6Bz/0BS0Ium6/crCsiVpFeu.dFZTiUhGTf/JgCW6EyEG/fjVySYfi'),
('041077b9-1fdc-4347-a8d4-d43d7de2454b', 'DTmS1P', '$2y$10$QuSIDPlECQym2k6vRCfLfOd6NGHXOuZR42Wqxf4AG8u1tktV36VAi'),
('042fcc04-9146-4f2e-8b20-7c25de889e32', '', ''),
('04eabdb2-a536-4861-8f1d-b10c08b274d6', '1Vdp2V', '$2y$10$gYZxhmH3H6rA8Nt.66SpIeUaln5EGtS4xwKd/hpWX0lWArlUjPn7C'),
('056a8f2e-8b0a-47fd-8ba5-7546f87ff6b4', '', ''),
('057186f4-4990-4df7-b40c-3fb805c98bc4', 'Qfxj4V', '$2y$10$2od/W5Oh8NSh289eTIlgLuTAf97PJtbYOeHLLnKVGbHvNl4M8WGta'),
('058d67c9-91cd-4ac5-8d00-055f94de89ce', 'DGGOGa', '$2y$10$IKCXQcdFwNzu7k5jYLL84eZTIuSyS8BAj/XqagmzylttJDfTyBTIq'),
('05c81d49-7624-459d-b960-1a84beba0bc8', 'Tb3VjC', '$2y$10$yzwgMPdH0ruT.1k2sRHXueNfXszawX1pgNGwz3LtfUMBgMikkudnS');

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_software`
--

CREATE TABLE `cl_contract_software` (
  `contract_id` char(255) NOT NULL,
  `software_id` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_contract_software`
--

INSERT INTO `cl_contract_software` (`contract_id`, `software_id`) VALUES
('00566a02-49bb-4136-ada8-417b0d239c38', 'io_uobdh0If1BOlyXWNgLHr'),
('00566a02-49bb-4136-ada8-417b0d239c38', 'Orion077');

-- --------------------------------------------------------

--
-- Table structure for table `cl_contract_status`
--

CREATE TABLE `cl_contract_status` (
  `contract_id` char(255) NOT NULL,
  `underMods` tinyint(1) NOT NULL,
  `pendingQuery` tinyint(1) NOT NULL,
  `doc_uploaded` tinyint(1) NOT NULL,
  `checkS` tinyint(1) NOT NULL,
  `checkEng` tinyint(1) NOT NULL,
  `completed` tinyint(1) NOT NULL,
  `notified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_cookies`
--

CREATE TABLE `cl_cookies` (
  `cookieid` char(23) NOT NULL,
  `userid` char(23) NOT NULL,
  `tokenid` char(25) NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_customer_contracts`
--

CREATE TABLE `cl_customer_contracts` (
  `id` int(11) NOT NULL,
  `contract_id` char(255) NOT NULL,
  `member_id` char(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_deleted_members`
--

CREATE TABLE `cl_deleted_members` (
  `id` char(23) NOT NULL,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `mod_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_departments`
--

CREATE TABLE `cl_departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_head` char(255) NOT NULL,
  `required` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_departments`
--

INSERT INTO `cl_departments` (`dept_id`, `dept_name`, `dept_head`, `required`) VALUES
(1, 'Default', '', 1),
(2, 'Accounts', '', 1),
(3, 'Engineering', '', 1),
(4, 'Hire', '', 1),
(5, 'HR', '198322359860da253b133eb', 1),
(6, 'IT', '', 1),
(7, 'Production', '', 1),
(8, 'Purchasing', '', 1),
(9, 'Sales', '', 1),
(10, 'Service', '', 1),
(11, 'Stores', '', 1),
(12, 'Test', '', 1),
(13, 'Workshop', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cl_events`
--

CREATE TABLE `cl_events` (
  `event_id` varchar(255) NOT NULL,
  `event_unique_id` varchar(255) NOT NULL,
  `event_kind` varchar(255) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_details` varchar(1000) NOT NULL,
  `event_date` datetime NOT NULL,
  `event_status` tinyint(1) NOT NULL,
  `added_by` char(23) NOT NULL,
  `date_added` datetime NOT NULL,
  `edited_by` char(23) DEFAULT NULL,
  `date_edited` datetime NOT NULL,
  `published_by` char(23) DEFAULT NULL,
  `date_published` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_intermediary_contracts`
--

CREATE TABLE `cl_intermediary_contracts` (
  `id` int(11) NOT NULL,
  `contract_id` char(255) NOT NULL,
  `intermediary_id` char(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_login_attempts`
--

CREATE TABLE `cl_login_attempts` (
  `id` int(11) NOT NULL,
  `username` varchar(65) DEFAULT NULL,
  `ip` varchar(20) NOT NULL,
  `attempts` int(11) NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_login_attempts`
--

INSERT INTO `cl_login_attempts` (`id`, `username`, `ip`, `attempts`, `lastlogin`) VALUES
(1, 'admin', '::1', 1, '2023-07-06 13:46:07');

-- --------------------------------------------------------

--
-- Table structure for table `cl_mail_log`
--

CREATE TABLE `cl_mail_log` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT 'generic',
  `status` varchar(45) DEFAULT NULL,
  `recipient` varchar(5000) DEFAULT NULL,
  `response` mediumtext NOT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_members`
--

CREATE TABLE `cl_members` (
  `id` char(23) NOT NULL,
  `member_type` varchar(255) NOT NULL,
  `username` varchar(65) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL DEFAULT '',
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `banned` tinyint(1) NOT NULL DEFAULT 0,
  `mod_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_members`
--

INSERT INTO `cl_members` (`id`, `member_type`, `username`, `password`, `email`, `verified`, `banned`, `mod_timestamp`) VALUES
('324317917612a0998de88b', 'staff', 'markwh9', '$2y$10$WWlQc.R6TTT.fYHnuQ4TrOTvfJR/5.BWfnhkfgTTj4XuLBTBNN6Qu', 'm.whitaker@crestchic.co.uk', 1, 0, '2021-08-28 20:17:10'),
('670231963612a0998bde97', 'staff', 'sales', '$2y$10$b/UKG1OSEVzBNo3a8vkAy.MX9C5H3rdFG1LPiq7sjDt6A5pOL56dS', 'salesman@crestchic.me', 0, 0, '2023-07-06 12:40:42'),
('69305477864cfb0af6c66f', 'staff', 'crestchi56', '$2y$10$7PMcd.YHSvBRTtoF.h4lE.XjjMpMl7/4if16dcCvYbm3RelfodzuO', 'salerental@crestchic.com', 0, 0, '2023-08-06 14:39:43'),
('81855781360437e32949c5', 'staff', 'admin', '$2y$10$H0Alk.Az/9m7uvwX1eKXcOOM1UffqsPS91ZAG1WxWQaUg1fwN286u', 'admin@sincetech.co.uk', 1, 0, '2022-05-29 13:24:45'),
('84182096666fbcba8b3d7f', 'staff', 'sharjeel34', '$2y$10$BnLdjkYSADtpR/4Vcshf2.4gs8ntka3jX2sb.2DUTbBOZRXTgR/vi', 's.ansari@crestchic.com', 0, 0, '2024-10-01 10:15:04');

--
-- Triggers `cl_members`
--
DELIMITER $$
CREATE TRIGGER `assign_default_role` AFTER INSERT ON `cl_members` FOR EACH ROW BEGIN
    SET @default_role = (SELECT id FROM cl_roles WHERE default_role = 1 LIMIT 1);
    INSERT INTO cl_member_roles (member_id, role_id) VALUES (NEW.id, @default_role);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `move_to_deleted_members` AFTER DELETE ON `cl_members` FOR EACH ROW BEGIN
    DELETE
    FROM cl_deleted_members
    WHERE cl_deleted_members.id = OLD.id;
    INSERT INTO cl_deleted_members (id, username, password, email, verified)
    VALUES (OLD.id, OLD.username, OLD.password, OLD.email, OLD.verified);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cl_member_departments`
--

CREATE TABLE `cl_member_departments` (
  `id` int(11) NOT NULL,
  `member_id` char(23) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_member_departments`
--

INSERT INTO `cl_member_departments` (`id`, `member_id`, `department_id`) VALUES
(1, '81855781360437e32949c5', 1),
(2, '69305477864cfb0af6c66f', 1),
(3, '84182096666fbcba8b3d7f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cl_member_info`
--

CREATE TABLE `cl_member_info` (
  `userid` char(23) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `phone_ext` int(11) NOT NULL,
  `address1` varchar(45) NOT NULL,
  `address2` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(30) NOT NULL,
  `pz_code` varchar(255) NOT NULL,
  `country` varchar(45) NOT NULL,
  `bio` varchar(20000) NOT NULL,
  `job_position` varchar(255) NOT NULL,
  `education` mediumtext NOT NULL,
  `skills` mediumtext NOT NULL,
  `experience` mediumtext NOT NULL,
  `notes` mediumtext NOT NULL,
  `userimage` varchar(255) DEFAULT NULL,
  `bg_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_member_info`
--

INSERT INTO `cl_member_info` (`userid`, `firstname`, `lastname`, `phone`, `phone_ext`, `address1`, `address2`, `city`, `state`, `pz_code`, `country`, `bio`, `job_position`, `education`, `skills`, `experience`, `notes`, `userimage`, `bg_img`) VALUES
('670231963612a0998bde97', 'Sales', 'Man', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
('69305477864cfb0af6c66f', 'Crestchic', 'Rental/Sales', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', NULL, ''),
('81855781360437e32949c5', 'Adminify', 'Blue', '', 323, '', '', '', '', 'KY12 4GW', '', '', 'IT Manager', 'B.S. in Computer Science from the University of Tennessee at Knoxville', 'UI Design Coding Javascript PHP Node.js', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.\r\n ', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque. ', 'avatar_81855781360437e32949c5.png', 'bg_81855781360437e32949c5.jpg'),
('84182096666fbcba8b3d7f', 'Sharjeel', 'Ansari', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `cl_member_jail`
--

CREATE TABLE `cl_member_jail` (
  `id` int(11) NOT NULL,
  `user_id` char(23) NOT NULL,
  `banned_hours` float NOT NULL DEFAULT 24,
  `reason` varchar(2000) DEFAULT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_member_roles`
--

CREATE TABLE `cl_member_roles` (
  `id` int(11) NOT NULL,
  `member_id` char(23) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_member_roles`
--

INSERT INTO `cl_member_roles` (`id`, `member_id`, `role_id`) VALUES
(8, '324317917612a0998de88b', 3),
(3, '670231963612a0998bde97', 3),
(9, '69305477864cfb0af6c66f', 3),
(10, '69305477864cfb0af6c66f', 8),
(2, '81855781360437e32949c5', 1),
(1, '81855781360437e32949c5', 3),
(12, '84182096666fbcba8b3d7f', 2),
(11, '84182096666fbcba8b3d7f', 3);

-- --------------------------------------------------------

--
-- Table structure for table `cl_permissions`
--

CREATE TABLE `cl_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'General',
  `required` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_permissions`
--

INSERT INTO `cl_permissions` (`id`, `name`, `description`, `category`, `required`) VALUES
(1, 'Verify Users', 'Administration permission allowing for the verification of new users', 'Users', 1),
(2, 'Delete Unverified Users', 'Administration permission allowing the deletion of unverified users', 'Users', 1),
(3, 'Ban Users', 'Moderation permission allowing the banning of users', 'Users', 1),
(4, 'Assign Roles to Users', 'Administration permission allowing the assignment of roles to users', 'Users', 1),
(5, 'Assign Users to Roles', 'Administration permission allowing the assignment of users to roles', 'Roles', 1),
(6, 'Create Roles', 'Administration permission allowing for the creation of new roles', 'Roles', 1),
(7, 'Delete Roles', 'Administration permission allowing for the deletion of roles', 'Roles', 1),
(8, 'Create Permissions', 'Administration permission allowing for the creation of new permissions', 'Permissions', 1),
(9, 'Delete Permissions', 'Administration permission allowing for the deletion of permissions', 'Permissions', 1),
(10, 'Assign Permissions to Roles', 'Administration permission allowing the assignment of permissions to roles', 'Roles', 1),
(11, 'Edit Site Config', 'Administration permission allowing the editing of core site configuration (dangerous)', 'Administration', 1),
(12, 'View Permissions', 'Administration permission allowing the viewing of all permissions', 'Permissions', 1),
(13, 'View Roles', 'Administration permission allowing for the viewing of all roles', 'Roles', 1),
(14, 'View Users', 'Administration permission allowing for the viewing of all users', 'Users', 1),
(15, 'View Posts', 'Administration permission allowing for the viewing of all posts', 'Posts', 1),
(16, 'Delete Users', 'Administration permission allowing for the deletion of users', 'Users', 1),
(17, 'Create Post', 'Administration permission allowing for the creation of new posts', 'Posts', 1),
(18, 'Edit Post', 'Administration permission allowing the editing of posts', 'Posts', 1),
(19, 'Delete Post', 'Administration permission allowing for the deletion of posts', 'Posts', 1),
(20, 'Create Departments', 'Administration permission allowing for the creation of new departments', 'Departments', 1),
(21, 'Delete Departments', 'Administration permission allowing for the deletion of departments', 'Departments', 1),
(22, 'View Departments', 'Administration permission allowing for the viewing of all departments', 'Departments', 1),
(23, 'Assign Users to Departments', 'Administration permission allowing the assignment of users to departments', 'Departments', 1),
(24, 'Manage Posts', 'Administration permission allowing for the managing of all posts', 'Posts', 1);

--
-- Triggers `cl_permissions`
--
DELIMITER $$
CREATE TRIGGER `prevent_deletion_of_required_perms` BEFORE DELETE ON `cl_permissions` FOR EACH ROW BEGIN
    IF OLD.required = 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot delete required permissions';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cl_roles`
--

CREATE TABLE `cl_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `default_role` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_roles`
--

INSERT INTO `cl_roles` (`id`, `name`, `description`, `required`, `default_role`) VALUES
(1, 'Superadmin', 'Master administrator of site', 1, NULL),
(2, 'Admin', 'Site administrator', 1, NULL),
(3, 'Standard User', 'Default site role for standard users', 1, 1),
(4, 'Department Head', 'Department Head Role', 1, NULL),
(5, 'Design Engineer', 'Manages all design engineer activities', 1, NULL),
(6, 'Service Engineer', 'Manages all service engineer activities', 1, NULL),
(7, 'Contract Manager', 'Manages all contracts on the site', 1, NULL),
(8, 'Sales Staff', 'Manages all contracts on the site', 1, NULL),
(9, 'Technical Staff', 'Manages all Technical contracts on the site', 1, NULL);

--
-- Triggers `cl_roles`
--
DELIMITER $$
CREATE TRIGGER `prevent_deletion_of_required_roles` BEFORE DELETE ON `cl_roles` FOR EACH ROW BEGIN
    IF OLD.required = 1 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cannot delete required roles';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cl_role_permissions`
--

CREATE TABLE `cl_role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cl_sys_control_systems`
--

CREATE TABLE `cl_sys_control_systems` (
  `control_system_id` char(25) NOT NULL,
  `input_type` varchar(15) NOT NULL,
  `control_system_name` varchar(255) NOT NULL,
  `control_system_category` varchar(255) NOT NULL,
  `control_system_value` varchar(255) NOT NULL,
  `control_system_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_sys_control_systems`
--

INSERT INTO `cl_sys_control_systems` (`control_system_id`, `input_type`, `control_system_name`, `control_system_category`, `control_system_value`, `control_system_description`) VALUES
('cs_dnVxPl6CFg7YuBcyb5fe', 'checkbox', 'controller', 'Baseload', 'Baseload', 'Baseload'),
('cs_jtMq7dNrgDGecB50awfE', 'checkbox', 'controller', 'KCS', 'KCS', 'KCS'),
('cs_Q8jp6AMgFlysKzctkwa4', 'checkbox', 'controller', 'MCS', 'MCS', 'MCS'),
('cs_uobdh0If1BOlyXWNgLHr', 'checkbox', 'controller', 'Toggle Switches', 'Toggle Switches', 'Toggle Switches'),
('cs_xw3KChXNjlFnPURoT4bY', 'checkbox', 'controller', 'Tracker', 'Tracker', 'Tracker'),
('WTT', 'checkbox', 'controller', 'WTT', 'WTT', 'WTT');

-- --------------------------------------------------------

--
-- Table structure for table `cl_sys_enclosures`
--

CREATE TABLE `cl_sys_enclosures` (
  `enclosure_id` char(25) NOT NULL,
  `input_type` varchar(15) NOT NULL,
  `enclosure_name` varchar(255) NOT NULL,
  `enclosure_category` varchar(255) NOT NULL,
  `enclosure_value` varchar(255) NOT NULL,
  `enclosure_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_sys_enclosures`
--

INSERT INTO `cl_sys_enclosures` (`enclosure_id`, `input_type`, `enclosure_name`, `enclosure_category`, `enclosure_value`, `enclosure_description`) VALUES
('enc_dnVxPl6CFg7YuBcyb5fe', 'checkbox', 'controller', 'Canopy', 'Horizontal', 'Small Enclosure'),
('enc_jtMq7dNrgDGecB50awfE', 'checkbox', 'controller', 'Canopy', 'Vertical', 'Vertical'),
('enc_Q8jp6AMgFlysKzctkwa4', 'checkbox', 'controller', 'Container', 'Container', 'Container'),
('enc_uobdh0If1BOlyXWNgLHr', 'checkbox', 'controller', 'Container', 'Small Container', 'Small Container (1, 2 or\n                                          3 Fan)');

-- --------------------------------------------------------

--
-- Table structure for table `cl_sys_software`
--

CREATE TABLE `cl_sys_software` (
  `software_id` char(25) NOT NULL,
  `input_type` varchar(15) NOT NULL,
  `software_name` varchar(255) NOT NULL,
  `software_category` varchar(255) NOT NULL,
  `software_value` varchar(255) NOT NULL,
  `software_description` varchar(255) NOT NULL,
  `software_extension` varchar(255) NOT NULL,
  `software_version` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cl_sys_software`
--

INSERT INTO `cl_sys_software` (`software_id`, `input_type`, `software_name`, `software_category`, `software_value`, `software_description`, `software_extension`, `software_version`) VALUES
('io_dnVxPl6CFg7YuBcyb5fe', 'checkbox', 'ioInfo[]', 'Corona', 'Corona110', 'Corona 1.1', 'zip', '1.1'),
('io_jtMq7dNrgDGecB50awfE', 'checkbox', 'ioInfo[]', 'Corona', 'Corona220', 'Corona 2.2', 'zip', '2.2'),
('io_Q8jp6AMgFlysKzctkwa4', 'checkbox', 'ioInfo[]', 'CrestCom', 'CrestCom3_1.20', 'CrestCom3 1.20', 'zip', '1.2'),
('io_uobdh0If1BOlyXWNgLHr', 'checkbox', 'ioInfo[]', 'Eclipse', 'Eclipse_2_2', 'Eclipse 2.2', 'zip', '2.2'),
('io_xw3KChXNjlFnPURoT4bY', 'checkbox', 'ioInfo[]', 'CrestCom', 'CrestCom3_110', 'CrestCom3 1.10', 'zip', '1.1'),
('Orion077', 'checkbox', 'ioInfo[]', 'Orion', 'Orion077', 'Orion Release 0.77 Installation', 'zip', '0.77'),
('TransView110', 'hidden', 'ioInfo[]', 'TransView', 'TransView110', 'TransView 1.1', 'zip', '1.1'),
('TransView210', 'checkbox', 'ioInfo[]', 'TransView', 'TransView_2_1', 'TransView 2.1', 'zip', '2.1');

-- --------------------------------------------------------

--
-- Table structure for table `cl_tokens`
--

CREATE TABLE `cl_tokens` (
  `tokenid` char(25) NOT NULL,
  `userid` char(23) NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_banned_users`
-- (See below for the actual view)
--
CREATE TABLE `vw_banned_users` (
`user_id` char(23)
,`banned_timestamp` datetime
,`banned_hours` float
,`hours_remaining` double
);

-- --------------------------------------------------------

--
-- Structure for view `vw_banned_users`
--
DROP TABLE IF EXISTS `vw_banned_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`admin_st`@`%` SQL SECURITY DEFINER VIEW `vw_banned_users`  AS SELECT `cl_member_jail`.`user_id` AS `user_id`, `cl_member_jail`.`timestamp` AS `banned_timestamp`, `cl_member_jail`.`banned_hours` AS `banned_hours`, `cl_member_jail`.`banned_hours`- time_to_sec(timediff(current_timestamp(),`cl_member_jail`.`timestamp`)) / 3600 AS `hours_remaining` FROM `cl_member_jail` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cl_app_config`
--
ALTER TABLE `cl_app_config`
  ADD PRIMARY KEY (`setting`),
  ADD UNIQUE KEY `setting_UNIQUE` (`setting`);

--
-- Indexes for table `cl_companies`
--
ALTER TABLE `cl_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `cl_company_contracts`
--
ALTER TABLE `cl_company_contracts`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `c_contracts_company_id` (`company_id`);

--
-- Indexes for table `cl_company_members`
--
ALTER TABLE `cl_company_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cm_company_id` (`company_id`),
  ADD KEY `cm_member_id` (`member_id`);

--
-- Indexes for table `cl_contracts`
--
ALTER TABLE `cl_contracts`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `customerID` (`company_id`),
  ADD KEY `contract_id` (`contract_id`) USING BTREE,
  ADD KEY `c_salesperson_id` (`salesperson_id`);

--
-- Indexes for table `cl_contract_assignees`
--
ALTER TABLE `cl_contract_assignees`
  ADD KEY `c_assignees_contract_id` (`contract_id`),
  ADD KEY `c_assignees_engineer_id` (`engineer_id`);

--
-- Indexes for table `cl_contract_change_log`
--
ALTER TABLE `cl_contract_change_log`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `c_change_log_contract_id` (`contract_id`),
  ADD KEY `c_change_log_added_by_id` (`added_by_id`);

--
-- Indexes for table `cl_contract_checks`
--
ALTER TABLE `cl_contract_checks`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `c_checks_salesCheck1By` (`salesCheck1By`),
  ADD KEY `c_checks_salesCheck2By` (`salesCheck2By`),
  ADD KEY `c_checks_salesCheck3By` (`salesCheck3By`);

--
-- Indexes for table `cl_contract_controllers`
--
ALTER TABLE `cl_contract_controllers`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `contract_id` (`contract_id`) USING BTREE;

--
-- Indexes for table `cl_contract_files`
--
ALTER TABLE `cl_contract_files`
  ADD PRIMARY KEY (`file_id`),
  ADD KEY `c_files_contract_id` (`contract_id`),
  ADD KEY `c_files_operator_id` (`operator_id`);

--
-- Indexes for table `cl_contract_members`
--
ALTER TABLE `cl_contract_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `am_contract_id` (`contract_id`),
  ADD KEY `am_member_id` (`member_id`);

--
-- Indexes for table `cl_contract_progress`
--
ALTER TABLE `cl_contract_progress`
  ADD PRIMARY KEY (`contract_id`);

--
-- Indexes for table `cl_contract_public`
--
ALTER TABLE `cl_contract_public`
  ADD UNIQUE KEY `contract_id` (`contract_id`);

--
-- Indexes for table `cl_contract_software`
--
ALTER TABLE `cl_contract_software`
  ADD KEY `as_contract_id` (`contract_id`),
  ADD KEY `as_software_id` (`software_id`);

--
-- Indexes for table `cl_contract_status`
--
ALTER TABLE `cl_contract_status`
  ADD PRIMARY KEY (`contract_id`);

--
-- Indexes for table `cl_cookies`
--
ALTER TABLE `cl_cookies`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `cl_customer_contracts`
--
ALTER TABLE `cl_customer_contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ma_contract_id` (`contract_id`),
  ADD KEY `ma_member_id` (`member_id`);

--
-- Indexes for table `cl_deleted_members`
--
ALTER TABLE `cl_deleted_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `cl_departments`
--
ALTER TABLE `cl_departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `cl_events`
--
ALTER TABLE `cl_events`
  ADD PRIMARY KEY (`event_id`),
  ADD UNIQUE KEY `event_id_UNIQUE` (`event_id`),
  ADD KEY `user_idd` (`added_by`),
  ADD KEY `edited_by_idd` (`edited_by`),
  ADD KEY `published_by_idd` (`published_by`);

--
-- Indexes for table `cl_intermediary_contracts`
--
ALTER TABLE `cl_intermediary_contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ia_contract_id` (`contract_id`),
  ADD KEY `ia_intermediary_id` (`intermediary_id`);

--
-- Indexes for table `cl_login_attempts`
--
ALTER TABLE `cl_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cl_mail_log`
--
ALTER TABLE `cl_mail_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cl_members`
--
ALTER TABLE `cl_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `cl_member_departments`
--
ALTER TABLE `cl_member_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_idd` (`member_id`),
  ADD KEY `department_idd` (`department_id`);

--
-- Indexes for table `cl_member_info`
--
ALTER TABLE `cl_member_info`
  ADD UNIQUE KEY `userid_UNIQUE` (`userid`),
  ADD KEY `fk_userid_idx` (`userid`);

--
-- Indexes for table `cl_member_jail`
--
ALTER TABLE `cl_member_jail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  ADD KEY `fk_userid_idx` (`user_id`);

--
-- Indexes for table `cl_member_roles`
--
ALTER TABLE `cl_member_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_unique_idx` (`member_id`,`role_id`),
  ADD KEY `member_id_idx` (`member_id`),
  ADD KEY `fk_role_id_idx` (`role_id`);

--
-- Indexes for table `cl_permissions`
--
ALTER TABLE `cl_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`);

--
-- Indexes for table `cl_roles`
--
ALTER TABLE `cl_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `default_role_UNIQUE` (`default_role`);

--
-- Indexes for table `cl_role_permissions`
--
ALTER TABLE `cl_role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Role_Id_idx` (`role_id`),
  ADD KEY `fk_Permission_Id_idx` (`permission_id`);

--
-- Indexes for table `cl_sys_control_systems`
--
ALTER TABLE `cl_sys_control_systems`
  ADD PRIMARY KEY (`control_system_id`),
  ADD UNIQUE KEY `setting_UNIQUE` (`control_system_id`);

--
-- Indexes for table `cl_sys_enclosures`
--
ALTER TABLE `cl_sys_enclosures`
  ADD PRIMARY KEY (`enclosure_id`),
  ADD UNIQUE KEY `setting_UNIQUE` (`enclosure_id`);

--
-- Indexes for table `cl_sys_software`
--
ALTER TABLE `cl_sys_software`
  ADD PRIMARY KEY (`software_id`),
  ADD UNIQUE KEY `setting_UNIQUE` (`software_id`);

--
-- Indexes for table `cl_tokens`
--
ALTER TABLE `cl_tokens`
  ADD PRIMARY KEY (`tokenid`),
  ADD UNIQUE KEY `tokenid_UNIQUE` (`tokenid`),
  ADD UNIQUE KEY `userid_UNIQUE` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cl_companies`
--
ALTER TABLE `cl_companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `cl_company_members`
--
ALTER TABLE `cl_company_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cl_contract_members`
--
ALTER TABLE `cl_contract_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cl_customer_contracts`
--
ALTER TABLE `cl_customer_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cl_departments`
--
ALTER TABLE `cl_departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `cl_intermediary_contracts`
--
ALTER TABLE `cl_intermediary_contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cl_login_attempts`
--
ALTER TABLE `cl_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cl_mail_log`
--
ALTER TABLE `cl_mail_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cl_member_departments`
--
ALTER TABLE `cl_member_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cl_member_jail`
--
ALTER TABLE `cl_member_jail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cl_member_roles`
--
ALTER TABLE `cl_member_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cl_permissions`
--
ALTER TABLE `cl_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cl_roles`
--
ALTER TABLE `cl_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cl_role_permissions`
--
ALTER TABLE `cl_role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cl_company_contracts`
--
ALTER TABLE `cl_company_contracts`
  ADD CONSTRAINT `c_contracts_company_id` FOREIGN KEY (`company_id`) REFERENCES `cl_companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_contracts_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_company_members`
--
ALTER TABLE `cl_company_members`
  ADD CONSTRAINT `cm_company_id` FOREIGN KEY (`company_id`) REFERENCES `cl_companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cm_member_id` FOREIGN KEY (`member_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contracts`
--
ALTER TABLE `cl_contracts`
  ADD CONSTRAINT `c_company_id` FOREIGN KEY (`company_id`) REFERENCES `cl_companies` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_salesperson_id` FOREIGN KEY (`salesperson_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_assignees`
--
ALTER TABLE `cl_contract_assignees`
  ADD CONSTRAINT `c_assignees_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_assignees_engineer_id` FOREIGN KEY (`engineer_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_change_log`
--
ALTER TABLE `cl_contract_change_log`
  ADD CONSTRAINT `c_change_log_added_by_id` FOREIGN KEY (`added_by_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_change_log_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_checks`
--
ALTER TABLE `cl_contract_checks`
  ADD CONSTRAINT `ac_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_checks_salesCheck1By` FOREIGN KEY (`salesCheck1By`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_checks_salesCheck2By` FOREIGN KEY (`salesCheck2By`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_checks_salesCheck3By` FOREIGN KEY (`salesCheck3By`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_controllers`
--
ALTER TABLE `cl_contract_controllers`
  ADD CONSTRAINT `cl_contract_controllers_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_files`
--
ALTER TABLE `cl_contract_files`
  ADD CONSTRAINT `c_files_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_files_operator_id` FOREIGN KEY (`operator_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_members`
--
ALTER TABLE `cl_contract_members`
  ADD CONSTRAINT `am_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `am_member_id` FOREIGN KEY (`member_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_progress`
--
ALTER TABLE `cl_contract_progress`
  ADD CONSTRAINT `c_progress_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_public`
--
ALTER TABLE `cl_contract_public`
  ADD CONSTRAINT `p_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_contract_software`
--
ALTER TABLE `cl_contract_software`
  ADD CONSTRAINT `as_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `as_software_id` FOREIGN KEY (`software_id`) REFERENCES `cl_sys_software` (`software_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_cookies`
--
ALTER TABLE `cl_cookies`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_customer_contracts`
--
ALTER TABLE `cl_customer_contracts`
  ADD CONSTRAINT `ma_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ma_member_id` FOREIGN KEY (`member_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_events`
--
ALTER TABLE `cl_events`
  ADD CONSTRAINT `added_by_idd` FOREIGN KEY (`added_by`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `edited_by_idd` FOREIGN KEY (`edited_by`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `published_by_idd` FOREIGN KEY (`published_by`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_intermediary_contracts`
--
ALTER TABLE `cl_intermediary_contracts`
  ADD CONSTRAINT `ia_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `cl_contracts` (`contract_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ia_intermediary_id` FOREIGN KEY (`intermediary_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_member_departments`
--
ALTER TABLE `cl_member_departments`
  ADD CONSTRAINT `department_idd` FOREIGN KEY (`department_id`) REFERENCES `cl_departments` (`dept_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_idd` FOREIGN KEY (`member_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_member_info`
--
ALTER TABLE `cl_member_info`
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cl_member_jail`
--
ALTER TABLE `cl_member_jail`
  ADD CONSTRAINT `fk_userid_jail` FOREIGN KEY (`user_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `cl_member_roles`
--
ALTER TABLE `cl_member_roles`
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `cl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_role_permissions`
--
ALTER TABLE `cl_role_permissions`
  ADD CONSTRAINT `fk_Permission_Id` FOREIGN KEY (`permission_id`) REFERENCES `cl_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Role_Id_2` FOREIGN KEY (`role_id`) REFERENCES `cl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cl_tokens`
--
ALTER TABLE `cl_tokens`
  ADD CONSTRAINT `userid_t` FOREIGN KEY (`userid`) REFERENCES `cl_members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
