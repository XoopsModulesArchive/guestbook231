<?php

$modversion['name'] = 'ゲストブック';
$modversion['dirname'] = 'guestbook231';
$modversion['description'] = $modversion['name'];
$modversion['version'] = '1.0';
$modversion['credits'] = '';
$modversion['author'] = '';
$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'logo.gif';

// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = 'book_auth';
$modversion['tables'][1] = 'book_ban';
$modversion['tables'][2] = 'book_com';
$modversion['tables'][3] = 'book_config';
$modversion['tables'][4] = 'book_data';
$modversion['tables'][5] = 'book_ip';
$modversion['tables'][6] = 'book_pics';
$modversion['tables'][7] = 'book_private';
$modversion['tables'][8] = 'book_smilies';
$modversion['tables'][9] = 'book_words';

// START MENU
$modversion['hasMain'] = 1;
// END MENU
