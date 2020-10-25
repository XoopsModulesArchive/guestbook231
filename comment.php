<?php

include '../../mainfile.php';
require XOOPS_ROOT_PATH . '/header.php';

$include_path = __DIR__;
require_once $include_path . '/admin/config.inc.php';
require_once $include_path . "/lib/$DB_CLASS";
require_once $include_path . '/lib/image.class.php';
require_once $include_path . '/lib/template.class.php';

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

require XOOPS_ROOT_PATH . '/footer.php';
