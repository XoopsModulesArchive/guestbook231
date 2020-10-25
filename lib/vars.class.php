<?php

/**
 * ----------------------------------------------
 * Advanced Guestbook 2.3.1 (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
class guestbook_vars extends gbook_sql
{
    public $VARS;

    public $LANG;

    public $table = [];

    public $GB_TPL = [];

    public $SMILIES;

    public $template;

    public function __construct($path = '')
    {
        global $GB_TPL,$GB_TBL;

        $this->table = &$GB_TBL;

        $this->GB_TPL = &$GB_TPL;

        parent::__construct();

        $this->connect();

        $this->template = new gb_template($path);
    }

    public function getVars()
    {
        global $HTTP_COOKIE_VARS;

        $this->VARS = $this->fetch_array($this->query('SELECT * FROM ' . $this->table['cfg']));

        $this->free_result($this->result);

        if (isset($HTTP_COOKIE_VARS['lang']) && !empty($HTTP_COOKIE_VARS['lang'])) {
            $this->template->set_lang($HTTP_COOKIE_VARS['lang']);
        } else {
            $this->template->set_lang($this->VARS['lang']);
        }

        $this->LANG = $this->template->get_content();

        return $this->VARS;
    }

    public function emotion($message)
    {
        global $GB_PG;

        if (!isset($this->SMILIES)) {
            $this->query('SELECT * FROM ' . $this->table['smile']);

            while (false !== ($this->fetch_array($this->result))) {
                $this->SMILIES[$this->record['s_code']] = "<img src=\"$GB_PG[base_url]/img/smilies/" . $this->record['s_filename'] . '" width="' . $this->record['width'] . '" height="' . $this->record['height'] . '">';
            }
        }

        if (isset($this->SMILIES)) {
            for (reset($this->SMILIES); $key = key($this->SMILIES); next($this->SMILIES)) {
                $message = str_replace((string)$key, $this->SMILIES[$key], $message);
            }
        }

        return $message;
    }

    public function DateFormat($timestamp)
    {
        $timestamp += $this->VARS['offset'] * 3600;

        [$wday, $mday, $month, $year, $hour, $minutes, $hour12, $ampm] = preg_split('( )', date('w j n Y H i h A', $timestamp));

        if ('AMPM' == $this->VARS['tformat']) {
            $newtime = " $hour12:$minutes $ampm";
        } else {
            $newtime = " $hour:$minutes";
        }

        if ('USx' == $this->VARS['dformat']) {
            $newdate = " $month-$mday-$year";
        } elseif ('US' == $this->VARS['dformat']) {
            $month -= 1;

            $newdate = $this->template->WEEKDAY[$wday] . ', ' . $this->template->MONTHS[$month] . " $mday, $year";
        } elseif ('Euro' == $this->VARS['dformat']) {
            $month -= 1;

            $newdate = $this->template->WEEKDAY[$wday] . ", $mday. " . $this->template->MONTHS[$month] . " $year";
        } else {
            $newdate = "$mday.$month.$year";
        }

        return ($newdate .= $newtime);
    }

    public function AGCode($string)
    {
        $string = eregi_replace('\\[img\\](http://[^\\[]+)\\[/img\\]', '<img src="\\1" border=0>', $string);

        $string = eregi_replace('\\[b\\]([^\\[]*)\\[/b\\]', '<b>\\1</b>', $string);

        $string = eregi_replace('\\[i\\]([^\\[]*)\\[/i\\]', '<i>\\1</i>', $string);

        $string = eregi_replace('\\[email\\]([^\\[]*)\\[/email\\]', '<a href="mailto:\\1">\\1</a>', $string);

        $string = eregi_replace('\\[url\\]www.([^\\[]*)\\[/url\\]', '<a href="http://www.\\1" target="_blank">\\1</a>', $string);

        $string = eregi_replace('\\[url\\]([^\\[]*)\\[/url\\]', '<a href="\\1" target="_blank">\\1</a>', $string);

        $string = eregi_replace('\\[url=http://([^\\[]+)\\]([^\\[]*)\\[/url\\]', '<a href="http://\\1" target="_blank">\\2</a>', $string);

        return $string;
    }

    public function FormatString($strg)
    {
        $strg = trim($strg);

        $strg = preg_replace('[ ]+', ' ', $strg);

        return $strg;
    }

    public function CheckWordLength($strg)
    {
        $word_array = preg_split("[ |\n]", $strg);

        for ($i = 0, $iMax = count($word_array); $i < $iMax; $i++) {
            if (preg_match('^\\[[a-z]{3,5}\\].+\\]', $word_array[$i])) {
                if (mb_strlen($word_array[$i]) > 200) {
                    return false;
                }
            } elseif (mb_strlen($word_array[$i]) > $this->VARS['max_word_len']) {
                return false;
            }
        }

        return true;
    }

    public function isBannedIp($ip)
    {
        $this->query('SELECT * from ' . $this->table['ban']);

        if (!$this->result) {
            return false;
        }

        while (false !== ($row = $this->fetch_array($this->result))) {
            if (preg_match("^$row[ban_ip]", $ip)) {
                return true;
            }
        }

        return false;
    }

    public function FloodCheck($ip)
    {
        $the_time = time() - $this->VARS['flood_timeout'];

        $this->query('DELETE FROM ' . $this->table['ip'] . " WHERE (timestamp < $the_time)");

        $this->query('SELECT * FROM ' . $this->table['ip'] . " WHERE (guest_ip = '$ip')");

        $this->fetch_array($this->result);

        return ($this->record) ? true : false;
    }

    public function CensorBadWords($strg)
    {
        $replace = '#@*%!';

        $this->query('select * from ' . $this->table['words']);

        while (false !== ($row = $this->fetch_array($this->result))) {
            $strg = eregi_replace($row['word'], $replace, $strg);
        }

        return $strg;
    }

    public function gb_error($ERROR)
    {
        global $GB_PG;

        $LANG = &$this->LANG;

        $VARS = &$this->VARS;

        eval('$error_html = "' . $this->template->get_template($this->GB_TPL['header']) . '";');

        eval('$error_html .= "' . $this->template->get_template($this->GB_TPL['error']) . '";');

        eval('$error_html .= "' . $this->template->get_template($this->GB_TPL['footer']) . '";');

        return $error_html;
    }
}
?>
