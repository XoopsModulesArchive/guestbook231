<?php

/**
 * ----------------------------------------------
 * Advanced Guestbook 2.3.1 (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
class gb_session extends gbook_sql
{
    public $expire = 7200;

    public $include_path;

    public $table;

    public function __construct($path = '')
    {
        global $GB_TBL;

        $this->table = &$GB_TBL;

        parent::__construct();

        $this->connect();

        $this->include_path = $path;
    }

    public function isValidSession($session, $user_id)
    {
        $this->query('SELECT session, last_visit from ' . $this->table['auth'] . " WHERE session='$session' and ID='$user_id'");

        $row = $this->fetch_array($this->result);

        if ($row) {
            return ($this->expire + $row['last_visit'] > time()) ? $row['session'] : false;
        }

        return false;
    }

    public function isValidUser($user_id)
    {
        $this->query('SELECT username FROM ' . $this->table['auth'] . " WHERE ID='$user_id'");

        $this->fetch_array($this->result);

        return ($this->record) ? true : false;
    }

    public function changePass($user_id, $new_password)
    {
        $this->query('UPDATE ' . $this->table['auth'] . " SET password=PASSWORD('$new_password') WHERE ID='$user_id'");

        return ($this->record) ? true : false;
    }

    public function generateNewSessionID($user_id)
    {
        mt_srand((float)microtime() * 1000000);

        $session = md5(uniqid(mt_rand()));

        $timestamp = time();

        $this->query('UPDATE ' . $this->table['auth'] . " SET session='$session', last_visit='$timestamp' WHERE ID='$user_id'");

        return $session;
    }

    public function checkPass($username, $password)
    {
        $this->query('SELECT ID FROM ' . $this->table['auth'] . " WHERE username='$username' and password=PASSWORD('$password')");

        $this->fetch_array($this->result);

        return ($this->record) ? $this->record['ID'] : false;
    }

    public function checkSessionID()
    {
        global $username, $password, $session, $uid;

        if (isset($session) && isset($uid)) {
            return ($this->isValidSession($session, $uid)) ? ['session' => (string)$session, 'uid' => (string)$uid] : false;
        } elseif (isset($username) && isset($password)) {
            if (!get_magic_quotes_gpc()) {
                $username = addslashes($username);

                $password = addslashes($password);
            }

            $ID = $this->checkPass($username, $password);

            if ($ID) {
                $session = $this->generateNewSessionID($ID);

                return ['session' => (string)$session, 'uid' => (string)$ID];
            }

            return false;
        }

        return false;
    }
}
