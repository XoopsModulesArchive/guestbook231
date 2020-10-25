<?php

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.3.1 (PHP/MySQL)
 * ----------------------------------------------
 */
$include_path = __DIR__;
require_once $include_path . '/admin/config.inc.php';
require_once $include_path . "/lib/$DB_CLASS";
require_once $include_path . '/lib/image.class.php';
require_once $include_path . '/lib/template.class.php';

if (IS_MODULE) {
    if (!eregi('modules.php', $HTTP_SERVER_VARS['PHP_SELF'])) {
        die("You can't access this file directly...");
    }

    $ModName = basename(__DIR__);

    ob_start();

    include 'header.php';

    $GB_PG['base_url'] .= "/modules/$ModName";

    $GB_SELF = basename($HTTP_SERVER_VARS['PHP_SELF']);

    $GB_PG['index'] = "$GB_SELF?op=modload&name=$ModName&file=index";

    $GB_PG['admin'] = "$GB_SELF?op=modload&name=$ModName&file=index&agbook=admin";

    $GB_PG['comment'] = "$GB_SELF?op=modload&name=$ModName&file=index&agbook=comment";

    $GB_PG['addentry'] = "$GB_SELF?op=modload&name=$ModName&file=index&agbook=addentry";

    if (!isset($agbook)) {
        $agbook = '';
    }

    switch ($agbook) {
        case 'admin':
            require_once $include_path . '/lib/session.class.php';
            $gb_auth = new gb_session($include_path);
            $AUTH = $gb_auth->checkSessionID();
            $VARS = $gb_auth->fetch_array($gb_auth->query('SELECT * FROM ' . $gb_auth->table['cfg']));
            $gb_auth->free_result($gb_auth->result);
            $template = new gb_template($include_path);
            if (isset($HTTP_COOKIE_VARS['lang']) && !empty($HTTP_COOKIE_VARS['lang'])) {
                $template->set_lang($HTTP_COOKIE_VARS['lang']);
            } else {
                $template->set_lang($VARS['lang']);
            }
            $LANG = $template->get_content();
            $gb_auth->close_db();
            if (!$AUTH) {
                $message = (isset($username) || isset($password)) ? $LANG['PassMess2'] : $LANG['PassMess1'];

                eval('$enter_html = "' . $template->get_template($GB_TPL['header']) . '";');

                eval('$enter_html .= "' . $template->get_template($GB_TPL['adm_enter']) . '";');

                eval('$enter_html .= "' . $template->get_template($GB_TPL['footer']) . '";');

                echo $enter_html;
            } else {
                $GB_PG['admin'] = $GB_PG['base_url'] . "/admin.php?username=$username&password=$password&enter=1";

                header("Location: $GB_PG[admin]");

                exit();
            }
            break;
        case 'comment':
            require_once $include_path . '/lib/vars.class.php';
            require_once $include_path . '/lib/comment.class.php';
            $gb_com = new gb_comment($include_path);
            $gb_com->id = $_GET['gb_id'] ?? '';
            $gb_com->id = $_POST['gb_id'] ?? $gb_com->id;
            $gb_com->comment = $_POST['comment'] ?? '';
            $gb_com->user = $_POST['gb_user'] ?? '';
            $gb_com->pass_comment = $_POST['pass_comment'] ?? '';
            $gb_action = $_POST['gb_comment'] ?? '';
            $gb_com->comment_action($gb_action);
            $gb_com->db->close_db();
            break;
        case 'addentry':
            require_once $include_path . '/lib/vars.class.php';
            require_once $include_path . '/lib/add.class.php';
            $gb_post = new addentry($include_path);
            if (isset($_POST['gb_action'])) {
                $gb_post->name = $_POST['gb_name'] ?? '';

                $gb_post->email = $_POST['gb_email'] ?? '';

                $gb_post->url = $_POST['gb_url'] ?? '';

                $gb_post->comment = $_POST['gb_comment'] ?? '';

                $gb_post->location = $_POST['gb_location'] ?? '';

                $gb_post->icq = $_POST['gb_icq'] ?? '';

                $gb_post->aim = $_POST['gb_aim'] ?? '';

                $gb_post->gender = $_POST['gb_gender'] ?? '';

                $gb_post->userfile = (isset($HTTP_POST_FILES['userfile']['tmp_name']) && '' != $HTTP_POST_FILES['userfile']['tmp_name']) ? $HTTP_POST_FILES : '';

                $gb_post->user_img = $_POST['gb_user_img'] ?? '';

                $gb_post->preview = (isset($_POST['gb_preview'])) ? 1 : 0;

                $gb_post->private = (isset($_POST['gb_private'])) ? 1 : 0;

                echo $gb_post->process($_POST['gb_action']);
            } else {
                echo $gb_post->process();
            }
            $gb_post->db->close_db();
            break;
        default:
            require_once $include_path . '/lib/vars.class.php';
            require_once $include_path . '/lib/gb.class.php';
            $gb = new guestbook($include_path);
            $entry = $_GET['entry'] ?? 0;
            $entry = $_POST['entry'] ?? $entry;
            echo $gb->show_entries($entry);
            $gb->db->close_db();
    }

    ob_end_flush();

    $base_path = dirname($include_path, 2);

    chdir((string)$base_path);

    include "$base_path/footer.php";
} else {
    require_once $include_path . '/lib/vars.class.php';

    require_once $include_path . '/lib/gb.class.php';

    $gb = new guestbook($include_path);

    $entry = $_GET['entry'] ?? 0;

    $entry = $_POST['entry'] ?? $entry;

    echo $gb->show_entries($entry);
}

require XOOPS_ROOT_PATH . '/footer.php';
?>
