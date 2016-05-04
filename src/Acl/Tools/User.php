<?php
/**
 * @namespace
 */
namespace Vein\Core\Acl\Tools;

trait User
{

    /**
     * Return user by auth credentials
     *
     * @param array $credentials
     * @return \Engine\Mvc\Model
     */
    public static function findByCredentials(array $credentials)
    {
        $login = false;
        if (isset($credentials['login'])) {
            $login = $credentials['login'];
        } elseif (isset($credentials['username'])) {
            $login = $credentials['username'];
        } elseif (isset($credentials['email'])) {
            $login = $credentials['email'];
        } elseif (isset($credentials['mail'])) {
            $login = $credentials['mail'];
        } elseif (isset($credentials['name'])) {
            $login = $credentials['name'];
        }

        $password = false;
        if (isset($credentials['password'])) {
            $password = $credentials['password'];
        }

        if (!$login || !$password) {
            throw new \Engine\Exception('Auth credentials not correct!');
        }

        return static::findFirst([
            static::$_loginCredential." = :login:",
            'bind' => ['login' => $login]
        ]);

        /*return static::findFirst([
            static::$_loginCredential." = :login: AND ".static::$_passwordCredential." = :password:",
            'bind' => ['login' => $login, 'password' => $password]
        ]);*/
    }

    /**
     * Return user by id
     *
     * @param integer $id
     * @return \Engine\Mvc\Model
     */
    public static function findUserById($id)
    {
        return static::findFirst($id);
    }


    /**
     * Return login credential
     *
     * @return string
     */
    public function getLoginCredential()
    {
        return $this->{static::$_loginCredential};
    }

    /**
     * Return password credential
     *
     * @return string
     */
    public function getPasswordCredential()
    {
        return $this->{static::$_passwordCredential};
    }

    /**
     * Return user role
     *
     * @return string
     */
    public function getId()
    {
        return $this->{$this->getPrimary()};
    }

    /**
     * Return user role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->Role->{$this->Role->getNameExpr()};
    }

    /**
     * Return user role id
     *
     * @return string
     */
    public function getRoleId()
    {
        return $this->Role->{$this->Role->getPrimary()};
    }
}