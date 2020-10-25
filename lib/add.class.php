<?php

/**
 * ----------------------------------------------
 * Advanced Guestbook 2.3.1 (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
class addentry
{
    public $db;

    public $ip;

    public $include_path;

    public $template;

    public $name = '';

    public $email = '';

    public $url = '';

    public $comment = '';

    public $location = '';

    public $icq = '';

    public $aim = '';

    public $gender = '';

    public $userfile = '';

    public $user_img = '';

    public $preview = '';

    public $private = '';

    public $image_file = '';

    public $image_tag = '';

    public $GB_TPL = [];

    public $table = [];

    public function __construct($path = '')
    {
        global $GB_TPL, $GB_TBL, $HTTP_SERVER_VARS;

        if (isset($HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR']) && eregi('^[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}$', $HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR'])) {
            $this->ip = $HTTP_SERVER_VARS['HTTP_X_FORWARDED_FOR'];
        } else {
            $this->ip = getenv('REMOTE_ADDR');
        }

        $this->db = new guestbook_vars($path);

        $this->db->getVars();

        $this->template = &$this->db->template;

        $this->include_path = $path;

        $this->GB_TPL = &$GB_TPL;

        $this->table = &$GB_TBL;
    }

    public function undo_htmlspecialchars($string)
    {
        $html = [
            '&amp;' => '&',
'&quot;' => '"',
'&lt;' => '<',
'&gt;' => '>',
        ];

        for (reset($html); $key = key($html); next($html)) {
            $string = str_replace((string)$key, (string)$html[$key], $string);
        }

        return ($string);
    }

    public function clear_tmpfiles($cachetime = 1800)
    {
        global $GB_TMP;

        $delfiles = 0;

        $filelist = '';

        if (is_dir("$this->include_path/$GB_TMP")) {
            chdir("$this->include_path/$GB_TMP");

            $hnd = opendir('.');

            while ($file = readdir($hnd)) {
                if (is_file($file)) {
                    $filelist[] = $file;
                }
            }

            closedir($hnd);
        }

        if (is_array($filelist)) {
            while (list($key, $file) = each($filelist)) {
                $tmpfile = explode('.', $file);

                $tmpfile[0] = preg_replace('img-', '', $tmpfile[0]);

                if ($tmpfile[0] < (time() - $cachetime)) {
                    if (unlink($file)) {
                        $delfiles++;
                    }
                }
            }
        }

        return $delfiles;
    }

    public function is_uploaded_file_readable($uploaded_file_tmp_name)
    {
        $check = @fopen($uploaded_file_tmp_name, 'rb');

        if ($check) {
            fclose($check);

            return 1;
        }

        $is_safe_mode = get_cfg_var('safe_mode');

        if ($is_safe_mode) {
            return -1;
        }

        return 2;
    }

    public function check_entry($type = '')
    {
        global $GB_UPLOAD, $GB_TMP, $GB_PG;

        $this->db->VARS['max_img_size'] *= 1024;

        if (1 == $this->db->VARS['banned_ip']) {
            if ($this->db->isBannedIp($this->ip)) {
                return $this->db->gb_error($this->db->LANG['ErrorPost9']);
            }
        }

        if (1 == $this->db->VARS['flood_check']) {
            if ($this->db->FloodCheck($this->ip)) {
                return $this->db->gb_error($this->db->LANG['ErrorPost8']);
            }
        }

        if (is_array($this->userfile) && 'none' != $this->userfile['userfile']['tmp_name']) {
            $uploaded_img_file_stat = $this->is_uploaded_file_readable($this->userfile['userfile']['tmp_name']);
        } else {
            $uploaded_img_file_stat = -1;
        }

        if ($uploaded_img_file_stat > 0) {
            $extension = ['1' => 'gif', '2' => 'jpg', '3' => 'png', '4' => 'swf'];

            $the_time = time();

            if ($this->userfile['userfile']['size'] > $this->db->VARS['max_img_size']) {
                return $this->db->gb_error($this->db->LANG['ErrorPost6']);
            }

            if (1 == $uploaded_img_file_stat) {
                $size = getimagesize($this->userfile['userfile']['tmp_name']);

                $open_basedir_res = false;
            } else {
                $open_basedir_res = true;

                if (!eregi('WIN', PHP_OS)) {
                    exec('cp ' . $this->userfile['userfile']['tmp_name'] . " $this->include_path/$GB_TMP/img-$the_time.tmp");
                } else {
                    $win_command = str_replace('/', '\\', $this->userfile['userfile']['tmp_name']);

                    $win_loc = str_replace('/', '\\', "$this->include_path/$GB_TMP/img-$the_time.tmp");

                    exec("copy $win_command $win_loc");
                }

                $size = getimagesize("$this->include_path/$GB_TMP/img-$the_time.tmp");
            }

            if ($size[2] > 0 && $size[2] < 4) {
                $this->image_file = "img-$the_time." . $extension[$size[2]];

                $img = new gb_image();

                $img->set_destdir("$this->include_path/$GB_UPLOAD");

                $img->set_border_size($this->db->VARS['img_width'], $this->db->VARS['img_height']);

                if ('preview' == $type) {
                    if (!$open_basedir_res) {
                        copy($this->userfile['userfile']['tmp_name'], "$this->include_path/$GB_TMP/$this->image_file");
                    } else {
                        rename("$this->include_path/$GB_TMP/img-$the_time.tmp", "$this->include_path/$GB_TMP/$this->image_file");
                    }

                    $new_img_size = $img->get_img_size_format($size[0], $size[1]);

                    $GB_UPLOAD = $GB_TMP;

                    $row['p_filename'] = $this->image_file;

                    $row['width'] = $size[0];

                    $row['height'] = $size[1];

                    eval('$this->tmp_image = "' . $this->template->get_template($this->GB_TPL['image']) . '";');
                } else {
                    if (!$open_basedir_res) {
                        copy($this->userfile['userfile']['tmp_name'], "$this->include_path/$GB_UPLOAD/$this->image_file");
                    } else {
                        rename("$this->include_path/$GB_TMP/img-$the_time.tmp", "$this->include_path/$GB_UPLOAD/$this->image_file");
                    }

                    if (1 == $this->db->VARS['thumbnail']) {
                        $min_size = 1024 * $this->db->VARS['thumb_min_fsize'];

                        $img->set_min_filesize($min_size);

                        $img->set_prefix('t_');

                        $img->create_thumbnail("$this->include_path/$GB_UPLOAD/$this->image_file", (string)$this->image_file);
                    }
                }
            } else {
                return $this->db->gb_error($this->db->LANG['ErrorPost7']);
            }
        }

        if (!empty($this->user_img)) {
            $this->image_file = trim($this->user_img);
        }

        $this->name = $this->db->FormatString($this->name);

        $this->location = $this->db->FormatString($this->location);

        $this->comment = $this->db->FormatString($this->comment);

        $this->icq = $this->db->FormatString($this->icq);

        $this->aim = $this->db->FormatString($this->aim);

        $this->aim = htmlspecialchars($this->aim, ENT_QUOTES | ENT_HTML5);

        if ($this->icq < 1000 || $this->icq > 999999999) {
            $this->icq = '';
        }

        if ('' == $this->name) {
            return $this->db->gb_error($this->db->LANG['ErrorPost1']);
        } elseif (mb_strlen($this->comment) < $this->db->VARS['min_text'] || mb_strlen($this->comment) > $this->db->VARS['max_text']) {
            return $this->db->gb_error($this->db->LANG['ErrorPost3']);
        }

        $this->url = trim($this->url);

        $this->email = trim($this->email);

        if (!eregi('^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\\.)+[a-z]{2,5}$', $this->email)) {
            $this->email = '';
        }

        if (!eregi('^http://[_a-z0-9-]+\\.[_a-z0-9-]+', $this->url)) {
            $this->url = '';
        }

        if (htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5) != (string)$this->url) {
            $this->url = '';
        }

        if (1 == $this->db->VARS['censor']) {
            $this->name = $this->db->CensorBadWords($this->name);

            $this->location = $this->db->CensorBadWords($this->location);

            $this->comment = $this->db->CensorBadWords($this->comment);
        }

        if (!$this->db->CheckWordLength($this->name) || !$this->db->CheckWordLength($this->location)) {
            return $this->db->gb_error($this->db->LANG['ErrorPost4']);
        }

        if (!$this->db->CheckWordLength($this->comment)) {
            return $this->db->gb_error($this->db->LANG['ErrorPost10']);
        }

        return 1;
    }

    public function add_guest()
    {
        global $GB_TMP, $GB_UPLOAD, $GB_PG;

        if (1 == $this->preview && $this->user_img) {
            $img = new gb_image();

            $img->set_destdir("$this->include_path/$GB_UPLOAD");

            $img->set_border_size($this->db->VARS['img_width'], $this->db->VARS['img_height']);

            if (1 == $this->db->VARS['thumbnail']) {
                $min_size = 1024 * $this->db->VARS['thumb_min_fsize'];

                $img->set_min_filesize($min_size);

                $img->set_prefix('t_');

                $img->create_thumbnail("$this->include_path/$GB_TMP/$this->user_img", $this->user_img);
            }

            copy("$this->include_path/$GB_TMP/$this->user_img", "$this->include_path/$GB_UPLOAD/$this->user_img");

            unlink("$this->include_path/$GB_TMP/$this->user_img");

            $this->image_file = $this->user_img;
        }

        $this->name = htmlspecialchars($this->name, ENT_QUOTES | ENT_HTML5);

        $this->location = htmlspecialchars($this->location, ENT_QUOTES | ENT_HTML5);

        if (0 == $this->db->VARS['allow_html']) {
            $this->comment = htmlspecialchars($this->comment, ENT_QUOTES | ENT_HTML5);
        }

        if (1 == $this->db->VARS['agcode']) {
            $this->comment = $this->db->AGCode($this->comment);
        }

        if (!get_magic_quotes_gpc()) {
            $this->name = addslashes($this->name);

            $this->location = addslashes($this->location);

            $this->aim = addslashes($this->aim);

            $this->email = addslashes($this->email);

            $this->url = addslashes($this->url);

            $this->comment = addslashes($this->comment);
        }

        $host = gethostbyaddr($this->ip);

        $agent = getenv('HTTP_USER_AGENT');

        $the_time = time();

        $sql_usertable = (1 == $this->private) ? $this->table['priv'] : $this->table['data'];

        $this->db->query("INSERT INTO $sql_usertable (name,gender,email,url,date,location,host,browser,comment,icq,aim) VALUES ('$this->name','$this->gender','$this->email','$this->url','$the_time','$this->location','$host','$agent','$this->comment','$this->icq','$this->aim')");

        if (!empty($this->image_file) || !empty($this->user_img)) {
            $size = getimagesize("$this->include_path/$GB_UPLOAD/$this->image_file");

            if (is_array($size) && $size[2] > 0 && $size[2] < 4) {
                $book_id = (1 == $this->private) ? 1 : 2;

                $p_filesize = filesize("$this->include_path/$GB_UPLOAD/$this->image_file");

                $this->db->fetch_array($this->db->query("SELECT MAX(id) AS msg_id FROM $sql_usertable"));

                $this->db->query('INSERT INTO ' . $this->table['pics'] . " (msg_id,book_id,p_filename,p_size,width,height) VALUES ('" . $this->db->record['msg_id'] . "',$book_id,'$this->image_file','$p_filesize','$size[0]','$size[1]')");
            }
        }

        $from_email = ('' == $this->email) ? "nobody@$host" : $this->email;

        if (1 == $this->db->VARS['notify_private'] && 1 == $this->private) {
            @mail($this->db->VARS['admin_mail'], $this->db->LANG['EmailAdminSubject'], "$this->name\n$this->host\n\n$this->comment", 'From: <' . $this->name . "> $from_email\nX-Mailer: Advanced Guestbook 2");
        }

        if (1 == $this->db->VARS['notify_admin'] && 0 == $this->private) {
            @mail($this->db->VARS['admin_mail'], $this->db->LANG['EmailAdminSubject'], "$this->name\n$this->host\n\n$this->comment", 'From: <' . $this->name . "> $from_email\nX-Mailer: Advanced Guestbook 2");
        }

        if (1 == $this->db->VARS['notify_guest'] && '' != $this->email) {
            @mail($this->email, $this->db->LANG['EmailGuestSubject'], $this->db->VARS['notify_mes'], 'From: <' . $this->db->VARS['admin_mail'] . '> ' . $this->db->VARS['admin_mail'] . "\nX-Mailer: Advanced Guestbook 2");
        }

        if (1 == $this->db->VARS['flood_check']) {
            $this->db->query('INSERT INTO ' . $this->table['ip'] . " (guest_ip,timestamp) VALUES ('$this->ip','$the_time')");
        }

        $LANG = &$this->db->LANG;

        $VARS = &$this->db->VARS;

        eval('$success_html = "' . $this->template->get_template($this->GB_TPL['success']) . '";');

        eval('$success_html .= "' . $this->template->get_template($this->GB_TPL['footer']) . '";');

        return $success_html;
    }

    public function form_addguest()
    {
        global $GB_PG, $HTTP_COOKIE_VARS;

        $HTML_CODE = (1 == $this->db->VARS['allow_html']) ? $this->db->LANG['BookMess2'] : $this->db->LANG['BookMess1'];

        $SMILE_CODE = (1 == $this->db->VARS['smilies']) ? $this->db->LANG['FormMess2'] : $this->db->LANG['FormMess7'];

        $AG_CODE = (1 == $this->db->VARS['agcode']) ? $this->db->LANG['FormMess3'] : $this->db->LANG['FormMess6'];

        $LANG = &$this->db->LANG;

        $VARS = &$this->db->VARS;

        $OPTIONS[] = '';

        if (1 == $this->db->VARS['allow_icq']) {
            eval("\$OPTIONS['icq'] = \"" . $this->template->get_template($this->GB_TPL['frm_icq']) . '";');
        }

        if (1 == $this->db->VARS['allow_aim']) {
            eval("\$OPTIONS['aim'] = \"" . $this->template->get_template($this->GB_TPL['frm_aim']) . '";');
        }

        if (1 == $this->db->VARS['allow_gender']) {
            eval("\$OPTIONS['gender'] = \"" . $this->template->get_template($this->GB_TPL['frm_gender']) . '";');
        }

        if (1 == $this->db->VARS['allow_img']) {
            eval("\$OPTIONS['img'] = \"" . $this->template->get_template($this->GB_TPL['frm_image']) . '";');
        }

        $OPTIONAL = implode("\n", $OPTIONS);

        if (isset($HTTP_COOKIE_VARS['lang']) && !empty($HTTP_COOKIE_VARS['lang']) && file_exists("$this->include_path/lang/codes-" . $HTTP_COOKIE_VARS['lang'] . '.php')) {
            $LANG_CODES = "$GB_PG[base_url]/lang/codes-" . $HTTP_COOKIE_VARS['lang'] . '.php';
        } elseif (file_exists("$this->include_path/lang/codes-" . $VARS['lang'] . '.php')) {
            $LANG_CODES = "$GB_PG[base_url]/lang/codes-" . $VARS['lang'] . '.php';
        } else {
            $LANG_CODES = "$GB_PG[base_url]/lang/codes-english.php";
        }

        eval('$addform_html = "' . $this->template->get_template($this->GB_TPL['header']) . '";');

        eval('$addform_html .= "' . $this->template->get_template($this->GB_TPL['form']) . '";');

        eval('$addform_html .= "' . $this->template->get_template($this->GB_TPL['footer']) . '";');

        return $addform_html;
    }

    public function preview_entry()
    {
        global $GB_PG;

        if (function_exists('get_magic_quotes_gpc') && @get_magic_quotes_gpc()) {
            $this->name = stripslashes($this->name);

            $this->comment = stripslashes($this->comment);

            $this->location = stripslashes($this->location);
        }

        $this->name = htmlspecialchars($this->name, ENT_QUOTES | ENT_HTML5);

        if (0 == $this->db->VARS['allow_html']) {
            $message = htmlspecialchars($this->comment, ENT_QUOTES | ENT_HTML5);

            $message = nl2br($message);
        } else {
            $message = nl2br($this->comment);
        }

        if (1 == $this->db->VARS['smilies']) {
            $message = $this->db->emotion($message);
        }

        if (1 == $this->db->VARS['agcode']) {
            $message = $this->db->AGCode($message);
        }

        $this->location = htmlspecialchars($this->location, ENT_QUOTES | ENT_HTML5);

        $this->comment = htmlspecialchars($this->comment, ENT_QUOTES | ENT_HTML5);

        $USER_PIC = $this->tmp_image ?? '';

        $DATE = $this->db->DateFormat(time());

        $host = @gethostbyaddr($this->ip);

        $AGENT = getenv('HTTP_USER_AGENT');

        $LANG = &$this->db->LANG;

        $VARS = &$this->db->VARS;

        if ($this->url) {
            $row['url'] = $this->url;

            eval('$URL = "' . $this->template->get_template($this->GB_TPL['url']) . '";');
        } else {
            $URL = '';
        }

        if ($this->icq && 1 == $this->db->VARS['allow_icq']) {
            $row['icq'] = $this->icq;

            eval('$ICQ = "' . $this->template->get_template($this->GB_TPL['icq']) . '";');
        } else {
            $ICQ = '';
        }

        if ($this->aim && 1 == $this->db->VARS['allow_aim']) {
            $row['aim'] = $this->aim;

            eval('$AIM = "' . $this->template->get_template($this->GB_TPL['aim']) . '";');
        } else {
            $AIM = '';
        }

        if ($this->email) {
            $row['email'] = $this->email;

            eval('$EMAIL = "' . $this->template->get_template($this->GB_TPL['email']) . '";');
        } else {
            $EMAIL = '';
        }

        if (1 == $this->db->VARS['allow_gender']) {
            $GENDER = ('f' == $this->gender) ? "&nbsp;<img src=\"$GB_PG[base_url]/img/female.gif\" width=\"12\" height=\"12\">" : "&nbsp;<img src=\"$GB_PG[base_url]/img/male.gif\" width=\"12\" height=\"12\">";
        } else {
            $GENDER = '';
        }

        if (1 == $this->db->VARS['show_ip']) {
            $hostname = (eregi('^[-a-z_]+', $host)) ? 'Host' : 'IP';

            $HOST = "$hostname: $host\n";
        } else {
            $HOST = '';
        }

        $HIDDEN = "<input type=\"hidden\" name=\"gb_preview\" value=\"1\">\n";

        $HIDDEN .= '<input type="hidden" name="gb_name" value="' . $this->name . "\">\n";

        $HIDDEN .= '<input type="hidden" name="gb_email" value="' . $this->email . "\">\n";

        $HIDDEN .= '<input type="hidden" name="gb_url" value="' . $this->url . "\">\n";

        $HIDDEN .= '<input type="hidden" name="gb_comment" value="' . $this->comment . "\">\n";

        $HIDDEN .= '<input type="hidden" name="gb_location" value="' . $this->location . "\">\n";

        if ($this->image_file) {
            $HIDDEN .= '<input type="hidden" name="gb_user_img" value="' . $this->image_file . "\">\n";
        }

        if (1 == $this->private) {
            $HIDDEN .= '<input type="hidden" name="gb_private" value="' . $this->private . "\">\n";
        }

        if (1 == $this->db->VARS['allow_gender']) {
            $HIDDEN .= '<input type="hidden" name="gb_gender" value="' . $this->gender . "\">\n";
        }

        if ($this->icq && 1 == $this->db->VARS['allow_icq']) {
            $HIDDEN .= '<input type="hidden" name="gb_icq" value="' . $this->icq . "\">\n";
        }

        if ($this->aim && 1 == $this->db->VARS['allow_aim']) {
            $HIDDEN .= '<input type="hidden" name="gb_aim" value="' . $this->aim . "\">\n";
        }

        $row['name'] = $this->name;

        $row['location'] = $this->location;

        $row['email'] = $this->email;

        eval('$GB_PREVIEW = "' . $this->template->get_template($this->GB_TPL['prev_entry']) . '";');

        eval('$preview_html = "' . $this->template->get_template($this->GB_TPL['header']) . '";');

        eval('$preview_html .= "' . $this->template->get_template($this->GB_TPL['preview']) . '";');

        eval('$preview_html .= "' . $this->template->get_template($this->GB_TPL['footer']) . '";');

        return $preview_html;
    }

    public function process($action = '')
    {
        switch ($action) {
            case $this->db->LANG['FormSubmit']:
                if (1 == $this->preview) {
                    $this->comment = $this->undo_htmlspecialchars($this->comment);

                    $this->name = $this->undo_htmlspecialchars($this->name);
                }
                $this->clear_tmpfiles();
                $status = $this->check_entry();

                return (1 == $status) ? $this->add_guest() : $status;
                break;
            case $this->db->LANG['FormPreview']:
                $status = $this->check_entry('preview');

                return (1 == $status) ? $this->preview_entry() : $status;
                break;
            default:
                return $this->form_addguest();
        }
    }
}
?>
