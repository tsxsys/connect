<?php
/**
 * Connect\AuthorizationHandler extends DbConn
 */

namespace Connect;

/**
 * Handles authorization functions
 *
 * Includes methods for checking session keys, user roles, and permissions
 */
class AuthorizationHandler extends DbConn
{
    /**
     * Imports Department Trait
     * Includes `checkDepartment` function and `checkDepartmentHead` function
     * @var DepartmentTrait
     */
    use Traits\DepartmentTrait;

    /**
     * Imports Role Trait
     * Includes `checkRole` function
     * @var RoleTrait
     */
    use Traits\RoleTrait;

    /**
     * Imports Permission Trait
     * Includes `checkPermission` function
     * @var PermissionTrait
     */
    use Traits\PermissionTrait;

    /**
     * Administrative roles
     * @var array
     */
    protected $adminroles = ['Admin', 'Superadmin'];

    /**
     * Checks if key exists in $_SESSION superglobal
     *
     * @param string $key Name of key to check
     *
     * @return mixed Returns session value of given key if found, or false if not
     */
    private function checkSessionKey($key)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION[$key] ?? false;
    }

    /**
     * Checks if the session user is the current user
     *
     * @param string $key
     * @return bool
     */
    private function checkCurrentUser($key): bool
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION[$key]) && $_SESSION[$key] === $key;
    }

    /**
     * Checks if session IP address equals $_SERVER["REMOTE_ADDR"]
     *
     * @return bool
     */
    private function sessionValid(): bool
    {
        return $_SERVER["REMOTE_ADDR"] === $this->checkSessionKey("ip_address");
    }

    /**
     * Checks if current user has given role
     *
     * @param string|null $roleName Role name
     *
     * @return bool
     */
    public function hasRole($roleName): bool
    {
        if ($roleName === null || $roleName === 'loginpage') {
            return true;
        }

        switch ($roleName) {
            case 'Admin':
                return $this->isAdmin();
            case 'Superadmin':
                return $this->isSuperAdmin();
            default:
                return ($this->checkRole($this->checkSessionKey("uid"), $roleName) !== false || $this->isAdmin()) && $this->sessionValid();
        }
    }

    /**
     * Checks if current user has given permission
     *
     * @param string $permissionName Permission name
     *
     * @return bool
     */
    public function hasPermission($permissionName): bool
    {
        return ($this->checkPermission($this->checkSessionKey("uid"), $permissionName) !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Superadmin role
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->checkRole($this->checkSessionKey("uid"), "Superadmin") !== false && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Admin role
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return ($this->checkRole($this->checkSessionKey("uid"), "Admin") !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Contract Manager role
     *
     * @return bool
     */
    public function isContractManager(): bool
    {
        return ($this->checkRole($this->checkSessionKey("uid"), "Contract Manager") !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Design Engineer role
     *
     * @return bool
     */
    public function isDesignEngineer(): bool
    {
        return ($this->checkRole($this->checkSessionKey("uid"), "Design Engineer") !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Sales Staff role
     *
     * @return bool
     */
    public function isSalesStaff(): bool
    {
        return ($this->checkRole($this->checkSessionKey("uid"), "Sales Staff") !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Technical Staff role
     *
     * @return bool
     */
    public function isTechnicalStaff(): bool
    {
        return ($this->checkRole($this->checkSessionKey("uid"), "Technical Staff") !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Service Engineer role
     *
     * @return bool
     */
    public function isServiceEngineer(): bool
    {
        return ($this->checkRole($this->checkSessionKey("uid"), "Service Engineer") !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the Department Head role
     *
     * @return bool
     */
    public function isDepartmentHead(): bool
    {
        return ($this->checkDepartmentHead($this->checkSessionKey("uid")) !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if current user belongs to the HR Department
     *
     * @return bool
     */
    public function isHR(): bool
    {
        return ($this->checkDepartment($this->checkSessionKey("uid"), "HR") !== false || $this->isSuperAdmin()) && $this->sessionValid();
    }

    /**
     * Checks if session user is the current user
     *
     * @return bool
     */
    public function isThisUser(): bool
    {
        return $this->checkCurrentUser($this->checkSessionKey("uid")) && $this->sessionValid();
    }

    /**
     * Checks if session has registered username and if session IP address is valid
     *
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        return $this->checkSessionKey("uid") !== false && $this->sessionValid();
    }
}
