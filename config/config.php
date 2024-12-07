<?php
/*********************************************************************
 * config.inc.php
 *
 * Master include file which must be included at the start of every file.
 * The brain of the whole system.
 *
 * Copyright (c) 2017-2022 SINCE TECH
 * http://www.sincetech.co.uk/
 *
 * Released under the GNU General Public License WITHOUT ANY WARRANTY.
 **********************************************************************/

# Security: Prevent direct access
if (basename($_SERVER['SCRIPT_NAME']) === basename(__FILE__)) {
    die('Access denied!');
}

# Disable Globals if enabled (not needed in PHP 5.4+ but kept for compatibility)
ini_set('register_globals', 0);
foreach ($_REQUEST as $key => $val) {
    if (isset($$key)) unset($$key);
}

# Security measures
//ini_set('allow_url_fopen', 0);
//ini_set('allow_url_include', 0);
//ini_set('session.use_trans_sid', 0);
//ini_set('session.cache_limiter', 'nocache');

# Error reporting for production
error_reporting(E_ERROR); // Display only fatal errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 0);

# Start the session if running in a web environment
if (isset($_SERVER['HTTP_HOST'])) {
    session_start();
}

define('CHARSET', 'utf8'); // Default charset for the database
# Define base URLs and directories
define('HTTPS_BASE_URL', 'https://localhost/Dropbox/www/Projects/connect/');
define('ASSETS_URL', HTTPS_BASE_URL . 'assets/');
define('VIEWS_URL', HTTPS_BASE_URL . 'views/');

// Define path constants
define('ROOT_PATH', './');
define('ROOT_DIR', realpath(dirname(dirname(__FILE__))) . '/');
define('INCLUDE_DIR', ROOT_DIR . 'include/');
define('ASSETS_DIR', ROOT_DIR . 'assets/');
define('MODULES_DIR', ROOT_DIR . 'modules/');
define('CONFIG_DIR', ROOT_DIR . 'config/');
define('VENDOR_DIR', ROOT_DIR . 'vendor/');
define('VIEWS_DIR', ROOT_DIR . 'views/');
define('PARTIALS_DIR', VIEWS_DIR . 'partials/');

# Application version
define('THIS_VERSION', '1.2.1');

# Whitelist for local environment
$whitelist = ['127.0.0.1', '::1'];

# Determine environment (local vs live server)
$host = $_SERVER['SERVER_NAME'] ?? 'CLI';
$remote_addr = $_SERVER['REMOTE_ADDR'] ?? 'CLI';

// Database Configuration
if (!in_array($remote_addr, $whitelist)) {
    // Live Server Configuration
    $db_config = [
        'username' => 'admin_st',
        'dbname' => 'admin_cl_connect',
        'host' => 'localhost',
        'password' => 'shu}hfubtF`$;%7P'
    ];
} else {
    // Local Server Configuration
    $db_config = [
        'username' => 'admin_st',
        'dbname' => 'connect',
        'host' => 'localhost',
        'password' => 'shu}hfubtF`$;%7P'
    ];
}


# Define table prefixes and names
$tbl_prefix = 'cl_';
// Define table names
$tbl_announcements = $tbl_prefix . 'announcements';
$tbl_app_config = $tbl_prefix . 'app_config';
$tbl_contracts = $tbl_prefix . 'contracts';
$tbl_contract_assignees = $tbl_prefix . 'contract_assignees';
$tbl_contract_change_log = $tbl_prefix . 'contract_change_log';
$tbl_contract_checks = $tbl_prefix . 'contract_checks';
$tbl_contract_controllers = $tbl_prefix . 'contract_controllers';
$tbl_contract_files = $tbl_prefix . 'contract_files';
$tbl_contract_members = $tbl_prefix . 'contract_members';
$tbl_contract_progress = $tbl_prefix . 'contract_progress';
$tbl_contract_public = $tbl_prefix . 'contract_public';
$tbl_contract_software = $tbl_prefix . 'contract_software';
$tbl_contract_status = $tbl_prefix . 'contract_status';
$tbl_associated_users = $tbl_prefix . 'associated_users';
$tbl_booking_cr = $tbl_prefix . 'booking_cr';
$tbl_chat = $tbl_prefix . 'chat';
$tbl_companies = $tbl_prefix . 'companies';
$tbl_company_contracts = $tbl_prefix . 'company_contracts';
$tbl_company_members = $tbl_prefix . 'company_members';
$tbl_cookies = $tbl_prefix . 'cookies';
$tbl_customer_contracts = $tbl_prefix . 'customer_contracts';
$tbl_deleted = $tbl_prefix . 'deleted_members';
$tbl_departments = $tbl_prefix . 'departments';
$tbl_events = $tbl_prefix . 'events';
$tbl_intermediary_contracts = $tbl_prefix . 'intermediary_contracts';
$tbl_leave = $tbl_prefix . 'leave';
$tbl_leave_structure = $tbl_prefix . 'leave_structure';
$tbl_attempts = $tbl_prefix . 'login_attempts';
$tbl_mail_log = $tbl_prefix . 'mail_log';
$tbl_members = $tbl_prefix . 'members';
$tbl_member_departments = $tbl_prefix . 'member_departments';
$tbl_member_info = $tbl_prefix . 'member_info';
$tbl_member_jail = $tbl_prefix . 'member_jail';
$tbl_member_roles = $tbl_prefix . 'member_roles';
$tbl_news = $tbl_prefix . 'news';
$tbl_noticeboard = $tbl_prefix . 'noticeboard';
$tbl_noticeboard_del = $tbl_prefix . 'noticeboard_del';
$tbl_permissions = $tbl_prefix . 'permissions';
$tbl_post_del = $tbl_prefix . 'post_del';
$tbl_roles = $tbl_prefix . 'roles';
$tbl_role_permissions = $tbl_prefix . 'role_permissions';
$tbl_sys_control_systems = $tbl_prefix . 'sys_control_systems';
$tbl_sys_enclosures = $tbl_prefix . 'sys_enclosures';
$tbl_sys_software = $tbl_prefix . 'sys_software';
$tbl_tokens = $tbl_prefix . 'tokens';

$tables1 = [
    'announcements' => $tbl_prefix . 'announcements',
    'app_config' => $tbl_prefix . 'app_config',
    'contracts' => $tbl_prefix . 'contracts',
    'contract_assignees' => $tbl_prefix . 'contract_assignees',
    'contract_change_log' => $tbl_prefix . 'contract_change_log',
    'contract_checks' => $tbl_prefix . 'contract_checks',
    'contract_controllers' => $tbl_prefix . 'contract_controllers',
    'contract_files' => $tbl_prefix . 'contract_files',
    'contract_members' => $tbl_prefix . 'contract_members',
    'contract_progress' => $tbl_prefix . 'contract_progress',
    'contract_public' => $tbl_prefix . 'contract_public',
    'contract_software' => $tbl_prefix . 'contract_software',
    'contract_status' => $tbl_prefix . 'contract_status',
    'associated_users' => $tbl_prefix . 'associated_users',
    'booking_cr' => $tbl_prefix . 'booking_cr',
    'chat' => $tbl_prefix . 'chat',
    'companies' => $tbl_prefix . 'companies',
    'company_contracts' => $tbl_prefix . 'company_contracts',
    'company_members' => $tbl_prefix . 'company_members',
    'cookies' => $tbl_prefix . 'cookies',
    'customer_contracts' => $tbl_prefix . 'customer_contracts',
    'deleted_members' => $tbl_prefix . 'deleted_members',
    'departments' => $tbl_prefix . 'departments',
    'events' => $tbl_prefix . 'events',
    'intermediary_contracts' => $tbl_prefix . 'intermediary_contracts',
    'leave' => $tbl_prefix . 'leave',
    'leave_structure' => $tbl_prefix . 'leave_structure',
    'login_attempts' => $tbl_prefix . 'login_attempts',
    'mail_log' => $tbl_prefix . 'mail_log',
    'members' => $tbl_prefix . 'members',
    'member_departments' => $tbl_prefix . 'member_departments',
    'member_info' => $tbl_prefix . 'member_info',
    'member_jail' => $tbl_prefix . 'member_jail',
    'member_roles' => $tbl_prefix . 'member_roles',
    'news' => $tbl_prefix . 'news',
    'noticeboard' => $tbl_prefix . 'noticeboard',
    'noticeboard_del' => $tbl_prefix . 'noticeboard_del',
    'permissions' => $tbl_prefix . 'permissions',
    'post_del' => $tbl_prefix . 'post_del',
    'roles' => $tbl_prefix . 'roles',
    'role_permissions' => $tbl_prefix . 'role_permissions',
    'sys_control_systems' => $tbl_prefix . 'sys_control_systems',
    'sys_enclosures' => $tbl_prefix . 'sys_enclosures',
    'sys_software' => $tbl_prefix . 'sys_software',
    'tokens' => $tbl_prefix . 'tokens',
];


# Additional configurations
define('STORAGE_DIR', MODULES_DIR . 'file_server/');
define('CONTRACTS_FILE_DIR', STORAGE_DIR . 'contracts/');
define('SOFTWARE_FILE_DIR', STORAGE_DIR . 'io/');
define('DATASHEETS_FILE_DIR', STORAGE_DIR . 'datasheets/');
define('CONNECT_CLASS_DIR', 'classes/');
define('ADMIN_DIR', MODULES_DIR . 'admin/');


// Security salt (should be randomized and secured in production)
define('SALT', 'X7aK8nU8zT5jS7bW');
define('SALTY_PASSPHRASE', SALT . 'iVBORw0KGgoAAAANSUhEUgAAAUgAAAE/CAYAAAAkM1pKAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAAZdEVYdFNvZnR3YXJlAEFkb2JlIEltYWdlUmVhZHlxyWU8AAAEAmlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS4wLWMwNjAgNjEuMTM0Nzc3LCAyMDEwLzAyLzEyLTE3OjMyOjAwICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9InV1aWQ6NUIyMDg5MjQ5M0JGREIxMTkxNEE4NTkwRDMxNTA4QzgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OTE2QUM3MDI5RTE3MTFFM0E5NzY4NTRFMjU1QTMyQzAiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTE2QUM3MDE5RTE3MTFFM0E5NzY4NTRFMjU1QTMyQzAiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QTcwNDdBNDQwQzlFRTMxMUI1QUVG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');

define('COMPANY_LABEL', 'Crestchic Limited');

//DEVELOPER
define('DEV_DOMAIN', 'https://linktr.ee/iamrc');
define('DEV_DOMAIN_LABEL_1', 'STL');
define('DEV_DOMAIN_LABEL_2', 'Richard Coleman');
define('DEV_EMAIL', 'admin@sincetech.co.uk');

// Ensure VIEWS_DIR is defined
if (!defined('VIEWS_DIR')) {
    die('Fatal error: Views directory is not defined!');
}

# Function to handle errors (optional addition)
//function handleError($errno, $errstr, $errfile, $errline)
//{
//    error_log("Error [$errno]: $errstr in $errfile on line $errline", 3, ROOT_DIR . 'error_log.txt');
//}
//
//set_error_handler('handleError');



