<?php

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';
$include_path = __DIR__;
require_once $include_path . '/admin/config.inc.php';
require_once $include_path . "/lib/$DB_CLASS";
require_once $include_path . '/lib/image.class.php';
require_once $include_path . '/lib/template.class.php';

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

require XOOPS_ROOT_PATH . '/footer.php';
