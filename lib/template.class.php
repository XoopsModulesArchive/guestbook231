<?php

/**
 * ----------------------------------------------
 * Advanced Guestbook 2.3.1 (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
class gb_template
{
    public $template = [];

    public $root_dir;

    public $LANG;

    public $plain_html = [];

    public function __construct($path = '')
    {
        $this->root_dir = $path;
    }

    public function set_rootdir($tpl_dir)
    {
        if (!is_dir($tpl_dir)) {
            return false;
        }

        $this->root_dir = $tpl_dir;

        return true;
    }

    public function set_lang($language = '')
    {
        if (!empty($language) && file_exists("$this->root_dir/lang/$language.php")) {
            $this->language = $language;
        } else {
            $this->language = 'english';
        }

        return $this->language;
    }

    public function get_content()
    {
        if (!isset($this->LANG)) {
            include "$this->root_dir/lang/" . $this->language . '.php';

            $this->LANG = &$LANG;

            $this->WEEKDAY = &$weekday;

            $this->MONTHS = &$months;
        }

        return $this->LANG;
    }

    public function get_template($tpl)
    {
        if (!isset($this->template[$tpl])) {
            $filename = "$this->root_dir/templates/$tpl";

            if (file_exists((string)$filename)) {
                $fd = fopen($filename, 'rb');

                $this->template[$tpl] = fread($fd, filesize($filename));

                fclose($fd);

                $this->template[$tpl] = preg_replace('"', '\\"', $this->template[$tpl]);
            }
        }

        return $this->template[$tpl];
    }
}
