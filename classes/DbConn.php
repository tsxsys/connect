<?php
/**
 * Connect\DbConn
 */

namespace Connect;

/**
 * Database connection handler
 *
 * Establishes foundational database connection and property assignment pulled from `dbconf.php` config file.
 * This base class is extended or utilized by numerous other classes.
 */
class DbConn
{
    /**
     * Database name
     * @var string
     */
    private $db_name;
    /**
     * Database server hostname
     * @var string
     */
    private $host;
    /**
     * Database username
     * @var string
     */

    private $username;
    /**
     * Database password
     * @var string
     */
    private $password;
    /**
     * PDO Connection object
     * @var object
     */
    public $conn;
    /**
     * Database Table Prefix
     * @var string
     */
    public $tbl_prefix;
    /**
     * Table where announcements are stored
     * @var string
     */
    public $tbl_announcements;
    /**
     * Table where main application configuration is stored
     * @var string
     */
    public $tbl_app_config;

    public $tbl_contracts;
    public $tbl_contract_assignees;

    public $tbl_contract_change_log;

    public $tbl_contract_checks;
    public $tbl_contract_controllers;
    public $tbl_contract_files;
    public $tbl_contract_members;
    public $tbl_contract_progress;
    public $tbl_contract_public;
    public $tbl_contract_software;
    public $tbl_contract_status;
    public $tbl_associated_users;
    public $tbl_booking_cr;
    public $tbl_companies;
    public $tbl_company_contracts;
    public $tbl_company_members;

    public $tbl_customer_contracts;

    public $tbl_events;
    /**
     * Table where basic intermediary asset data is stored
     * @var string
     */
    public $tbl_intermediary_contracts;
    /**
     * Table where basic user data is stored
     * @var string
     */
    public $tbl_members;
    /**
     * Table where user profile info is stored
     * @var string
     */
    public $tbl_member_info;
    /**
     * Table where role data is stored
     * @var string
     */
    public $tbl_roles;
    /**
     * Table where user role associations are stored
     * @var string
     */
    public $tbl_member_roles;
    /**
     * Table where permission data is stored
     * @var string
     */
    public $tbl_permissions;
    /**
     * Table where role permission associations are stored
     * @var string
     */
    public $tbl_role_permissions;
    /**
     * Table where login attempts are logged
     * @var string
     */
    public $tbl_attempts;
    /**
     * Table where deleted users are stored temporarily
     * @var string
     */
    public $tbl_deleted;
    /**
     * Table that JWT tokens are validated against
     * @var string
     */
    public $tbl_tokens;
    /**
     * Table that cookies are stored and validated against
     * @var string
     */
    public $tbl_cookies;

    /**
     * Table where mail send logs are stored
     * @var string
     */
    public $tbl_mail_log;
    /**
     * Table where banned users are stored
     * @var string
     */
    public $tbl_member_jail;
    /**
     * Table where announcements are stored
     * @var string
     */
    public $tbl_leave;

    public $tbl_leave_structure;

    public $tbl_noticeboard;

    public $tbl_news;

    public $tbl_noticeboard_del;

    public $tbl_post_del;

    public $tbl_departments;

    public $tbl_chat;

    public $tbl_member_departments;
    public $tbl_sys_control_systems;
    public $tbl_sys_enclosures;
    public $tbl_sys_software;

    public $filter;
    public $condition;
    var $json_array = array();
    var $categories = '';
//    var $filter ='';


    /**
     * Class constructor
     * Initializes PDO connection and sets object properties
     */
    public function __construct($condition = false, $cf = '')
    {
        // Pulls tables from dbconf.php file
        $up_dir = realpath(__DIR__ . '/..');
        $config_dir = realpath(__DIR__ . '/../config');
        $config_file = $config_dir . '/config.php';

        // Check if config.php exists in the current directory first
        if (file_exists($config_file)) {
            require $config_file;
        } else {
            // Handle the case where the config file is missing
            die('Config file not found.');
        }

        $this->tbl_prefix = $tbl_prefix;
        $this->tbl_announcements = $tbl_announcements;
        $this->tbl_app_config = $tbl_app_config;
        $this->tbl_contracts = $tbl_contracts;
        $this->tbl_contract_assignees = $tbl_contract_assignees;
        $this->tbl_contract_change_log = $tbl_contract_change_log;
        $this->tbl_contract_checks = $tbl_contract_checks;
        $this->tbl_contract_controllers = $tbl_contract_controllers;
        $this->tbl_contract_files = $tbl_contract_files;
        $this->tbl_contract_members = $tbl_contract_members;
        $this->tbl_contract_progress = $tbl_contract_progress;
        $this->tbl_contract_public = $tbl_contract_public;
        $this->tbl_contract_software = $tbl_contract_software;
        $this->tbl_contract_status = $tbl_contract_status;
        $this->tbl_associated_users = $tbl_associated_users;
        $this->tbl_booking_cr = $tbl_booking_cr;
        $this->tbl_chat = $tbl_chat;
        $this->tbl_companies = $tbl_companies;
        $this->tbl_company_contracts = $tbl_company_contracts;
        $this->tbl_company_members = $tbl_company_members;
        $this->tbl_cookies = $tbl_cookies;
        $this->tbl_customer_contracts = $tbl_customer_contracts;
        $this->tbl_deleted = $tbl_deleted;
        $this->tbl_departments = $tbl_departments;
        $this->tbl_events = $tbl_events;
        $this->tbl_intermediary_contracts = $tbl_intermediary_contracts;
        $this->tbl_leave = $tbl_leave;
        $this->tbl_leave_structure = $tbl_leave_structure;
        $this->tbl_attempts = $tbl_attempts;
        $this->tbl_mail_log = $tbl_mail_log;
        $this->tbl_members = $tbl_members;
        $this->tbl_member_departments = $tbl_member_departments;
        $this->tbl_member_info = $tbl_member_info;
        $this->tbl_member_jail = $tbl_member_jail;
        $this->tbl_member_roles = $tbl_member_roles;
        $this->tbl_news = $tbl_news;
        $this->tbl_noticeboard = $tbl_noticeboard;
        $this->tbl_noticeboard_del = $tbl_noticeboard_del;
        $this->tbl_permissions = $tbl_permissions;
        $this->tbl_post_del = $tbl_post_del;
        $this->tbl_roles = $tbl_roles;
        $this->tbl_role_permissions = $tbl_role_permissions;
        $this->tbl_sys_control_systems = $tbl_sys_control_systems;
        $this->tbl_sys_enclosures = $tbl_sys_enclosures;
        $this->tbl_sys_software = $tbl_sys_software;
        $this->tbl_tokens = $tbl_tokens;

        $this->filter = $cf;
        $this->condition = $condition;

        // Connect to server and select database
        try {

            $this->conn = new \PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset=utf8",
                $db_config['username'],
                $db_config['password']);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // Internal UTF-8
            $this->conn->exec("SET NAMES 'utf8'");
            $this->conn->exec('SET character_set_connection=utf8');
            $this->conn->exec('SET character_set_client=utf8');
            $this->conn->exec('SET character_set_results=utf8');


            // json_transform filter
//            $start = @$this->filter['start'];
//            $end = @$this->filter['end'];
//
//            if(isset($start) && isset($end))
//            {
//                $newdate_start = strtotime('-4 months', strtotime($start));
//                $start = date('Y-m-d', $newdate_start);
//
//                $newdate_end = strtotime('+1 month', strtotime($end));
//                $end = date('Y-m-d', $newdate_end);
//            }
//
//            // Run The Query
//            $dc = '';
//            if($this->condition == false)
//            {
//                if(strlen($start) !== 0 && strlen($end) !== 0)
//                {
//                    $dc = sprintf(" WHERE start >= '%s' AND end <= '%s'", addslashes($start), addslashes($end));
//                }
//
//                $this->result = mysqli_query($this->conn, "SELECT * FROM $this->tbl_booking_cr $dc");
//            } else {
//
//                if(strlen($start) !== 0 && strlen($end) !== 0)
//                {
//                    $dc = sprintf(" AND start >= '%s' AND end <= '%s'", addslashes($start), addslashes($end));
//                }
//                $this->result = mysqli_query($this->conn, "SELECT * FROM $this->tbl_booking_cr WHERE $this->condition $dc");
//            }

        } catch (\PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Class destructor
     * Disconnects and unsets PDO object
     * @return void
     */
    public function __destruct()
    {
        $this->conn = null;
    }

    /**
     * Prevents cloning
     * @return void
     **/
    private function __clone()
    {
    }
    /**
     * Prevents unserialization
     * @return void
     **/
    public function __wakeup()
    {
    }
}
