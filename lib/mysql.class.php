<?php

/**
 * ----------------------------------------------
 * Advanced Guestbook 2.3.1 (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
class gbook_sql
{
    public $conn_id;

    public $result;

    public $record;

    public $db = [];

    public $port;

    public function __construct()
    {
        global $GB_DB;

        $this->db = &$GB_DB;

        if (preg_match(':', $this->db['host'])) {
            [$host, $port] = explode(':', $this->db['host']);

            $this->port = $port;
        } else {
            $this->port = 3306;
        }
    }

    public function connect()
    {
        $this->conn_id = mysql_connect($this->db['host'] . ':' . $this->port, $this->db['user'], $this->db['pass']);

        if (0 == $this->conn_id) {
            $this->sql_error('Connection Error');
        }

        if (!mysqli_select_db($GLOBALS['xoopsDB']->conn, $this->db['dbName'], $this->conn_id)) {
            $this->sql_error('Database Error');
        }

        return $this->conn_id;
    }

    public function query($query_string)
    {
        $this->result = $GLOBALS['xoopsDB']->queryF($query_string, $this->conn_id);

        if (!$this->result) {
            $this->sql_error('Query Error');
        }

        return $this->result;
    }

    public function fetch_array($query_id)
    {
        $this->record = $GLOBALS['xoopsDB']->fetchBoth($query_id, MYSQL_ASSOC);

        return $this->record;
    }

    public function num_rows($query_id)
    {
        return ($query_id) ? $GLOBALS['xoopsDB']->getRowsNum($query_id) : 0;
    }

    public function num_fields($query_id)
    {
        return ($query_id) ? mysqli_num_fields($query_id) : 0;
    }

    public function free_result($query_id)
    {
        return $GLOBALS['xoopsDB']->freeRecordSet($query_id);
    }

    public function affected_rows()
    {
        return $GLOBALS['xoopsDB']->getAffectedRows($this->conn_id);
    }

    public function close_db()
    {
        if ($this->conn_id) {
            return $GLOBALS['xoopsDB']->close($this->conn_id);
        }

        return false;
    }

    public function sql_error($message)
    {
        global $TEC_MAIL;

        $description = $GLOBALS['xoopsDB']->error();

        $number = $GLOBALS['xoopsDB']->errno();

        $error = "MySQL Error : $message\n";

        $error .= "Error Number: $number $description\n";

        $error .= 'Date        : ' . date('D, F j, Y H:i:s') . "\n";

        $error .= 'IP          : ' . getenv('REMOTE_ADDR') . "\n";

        $error .= 'Browser     : ' . getenv('HTTP_USER_AGENT') . "\n";

        $error .= 'Referer     : ' . getenv('HTTP_REFERER') . "\n";

        $error .= 'PHP Version : ' . PHP_VERSION . "\n";

        $error .= 'OS          : ' . PHP_OS . "\n";

        $error .= 'Server      : ' . getenv('SERVER_SOFTWARE') . "\n";

        $error .= 'Server Name : ' . getenv('SERVER_NAME') . "\n";

        echo "<b><font size=4 face=Arial>$message</font></b><HR>";

        echo "<pre>$error</pre>";

        if (eregi('^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\\.)+[a-z]{2,5}$', $TEC_MAIL)) {
            $headers = 'From: ' . $this->db['user'] . '@' . $this->db['host'] . "\nX-Mailer: Advanced Guestbook 2";

            @mail((string)$TEC_MAIL, 'Guestbook - Error', (string)$error, (string)$headers);
        }

        exit();
    }
}
