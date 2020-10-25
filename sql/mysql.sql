# phpMyAdmin MySQL-Dump
# version 2.3.3pl1
# http://www.phpmyadmin.net/ (download page)
#
# ホスト: localhost
# 作成の時間: 2004年3月%d日 21:44
# サーバーのバージョン: 3.23.54
# PHP バージョン: 4.3.1
# データベース: `guestbook231`
# --------------------------------------------------------

#
# テーブルの構造 `book_auth`
#

CREATE TABLE book_auth (
    ID         SMALLINT(5) NOT NULL AUTO_INCREMENT,
    username   VARCHAR(60) NOT NULL DEFAULT '',
    password   VARCHAR(60) NOT NULL DEFAULT '',
    session    VARCHAR(32) NOT NULL DEFAULT '',
    last_visit INT(11)     NOT NULL DEFAULT '0',
    PRIMARY KEY (ID)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_auth`
#

INSERT INTO book_auth
VALUES (1, 'test', '773359240eb9a1d9', 'bbe3a9e3e9842928f5cc65f8d0767eab', 1078397200);
# --------------------------------------------------------

#
# テーブルの構造 `book_ban`
#

CREATE TABLE book_ban (
    ban_ip VARCHAR(15) NOT NULL DEFAULT ''
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_ban`
#

INSERT INTO book_ban
VALUES ('123.123.123.123');
# --------------------------------------------------------

#
# テーブルの構造 `book_com`
#

CREATE TABLE book_com (
    com_id    INT(11)     NOT NULL AUTO_INCREMENT,
    id        INT(11)     NOT NULL DEFAULT '0',
    name      VARCHAR(50) NOT NULL DEFAULT '',
    comments  TEXT        NOT NULL,
    host      VARCHAR(60) NOT NULL DEFAULT '',
    timestamp INT(11)     NOT NULL DEFAULT '0',
    PRIMARY KEY (com_id)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_com`
#
# --------------------------------------------------------

#
# テーブルの構造 `book_config`
#

CREATE TABLE book_config (
    config_id        SMALLINT(4)  NOT NULL AUTO_INCREMENT,
    agcode           SMALLINT(1)  NOT NULL DEFAULT '0',
    allow_html       SMALLINT(1)  NOT NULL DEFAULT '0',
    offset           VARCHAR(5)   NOT NULL DEFAULT '0',
    smilies          SMALLINT(1)  NOT NULL DEFAULT '1',
    dformat          VARCHAR(6)   NOT NULL DEFAULT '',
    tformat          VARCHAR(4)   NOT NULL DEFAULT '24hr',
    admin_mail       VARCHAR(50)  NOT NULL DEFAULT '',
    notify_private   SMALLINT(1)  NOT NULL DEFAULT '0',
    notify_admin     SMALLINT(1)  NOT NULL DEFAULT '0',
    notify_guest     SMALLINT(1)  NOT NULL DEFAULT '0',
    notify_mes       VARCHAR(150) NOT NULL DEFAULT '',
    entries_per_page INT(6)       NOT NULL DEFAULT '10',
    show_ip          SMALLINT(1)  NOT NULL DEFAULT '0',
    pbgcolor         VARCHAR(7)   NOT NULL DEFAULT '0',
    text_color       VARCHAR(7)   NOT NULL DEFAULT '0',
    link_color       VARCHAR(7)   NOT NULL DEFAULT '0',
    width            VARCHAR(4)   NOT NULL DEFAULT '0',
    tb_font_1        VARCHAR(7)   NOT NULL DEFAULT '',
    tb_font_2        VARCHAR(7)   NOT NULL DEFAULT '',
    font_face        VARCHAR(60)  NOT NULL DEFAULT '',
    tb_hdr_color     VARCHAR(7)   NOT NULL DEFAULT '',
    tb_bg_color      VARCHAR(7)   NOT NULL DEFAULT '',
    tb_text          VARCHAR(7)   NOT NULL DEFAULT '',
    tb_color_1       VARCHAR(7)   NOT NULL DEFAULT '',
    tb_color_2       VARCHAR(7)   NOT NULL DEFAULT '',
    lang             VARCHAR(30)  NOT NULL DEFAULT '',
    min_text         SMALLINT(4)  NOT NULL DEFAULT '0',
    max_text         INT(6)       NOT NULL DEFAULT '0',
    max_word_len     SMALLINT(4)  NOT NULL DEFAULT '0',
    comment_pass     VARCHAR(50)  NOT NULL DEFAULT '',
    need_pass        SMALLINT(1)  NOT NULL DEFAULT '0',
    censor           SMALLINT(1)  NOT NULL DEFAULT '0',
    flood_check      SMALLINT(1)  NOT NULL DEFAULT '0',
    banned_ip        SMALLINT(1)  NOT NULL DEFAULT '0',
    flood_timeout    SMALLINT(5)  NOT NULL DEFAULT '0',
    allow_icq        SMALLINT(1)  NOT NULL DEFAULT '0',
    allow_aim        SMALLINT(1)  NOT NULL DEFAULT '0',
    allow_gender     SMALLINT(1)  NOT NULL DEFAULT '0',
    allow_img        SMALLINT(1)  NOT NULL DEFAULT '0',
    max_img_size     INT(10)      NOT NULL DEFAULT '0',
    img_width        SMALLINT(5)  NOT NULL DEFAULT '0',
    img_height       SMALLINT(5)  NOT NULL DEFAULT '0',
    thumbnail        SMALLINT(1)  NOT NULL DEFAULT '0',
    thumb_min_fsize  INT(10)      NOT NULL DEFAULT '0',
    PRIMARY KEY (config_id)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_config`
# 
INSERT INTO book_config
VALUES (1, 1, 0, '0', 1, 'Euro', '24hr', 'root@localhost', 1, 1, 1, 'Thank you for signing the guestbook!', 10, 1, '#ffffff', '#000000', '#006699', '95%', '11px', '10px', 'Osaka', '#7878BE', '#000000', '#FFFFFF', '#E8E8E8', '#F7F7F7', 'japanese', 6, 1500, 100, 'comment', 0, 1, 0, 0, 80, 1, 1, 1, 1,
        120, 320, 80, 1, 12);
# --------------------------------------------------------

#
#
# テーブルの構造 `book_data`
#

CREATE TABLE book_data (
    id       INT(11)     NOT NULL AUTO_INCREMENT,
    name     VARCHAR(50) NOT NULL DEFAULT '',
    gender   CHAR(1)     NOT NULL DEFAULT '',
    email    VARCHAR(60) NOT NULL DEFAULT '',
    url      VARCHAR(70) NOT NULL DEFAULT '',
    date     INT(11)     NOT NULL DEFAULT '0',
    location VARCHAR(50) NOT NULL DEFAULT '',
    host     VARCHAR(60) NOT NULL DEFAULT '',
    browser  VARCHAR(70) NOT NULL DEFAULT '',
    comment  TEXT        NOT NULL,
    icq      INT(11)     NOT NULL DEFAULT '0',
    aim      VARCHAR(70) NOT NULL DEFAULT '',
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_data`
#
# --------------------------------------------------------

#
# テーブルの構造 `book_ip`
#

CREATE TABLE book_ip (
    guest_ip  VARCHAR(15) NOT NULL DEFAULT '',
    timestamp INT(11)     NOT NULL DEFAULT '0',
    KEY guest_ip (guest_ip)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_ip`
#

# --------------------------------------------------------

#
# テーブルの構造 `book_pics`
#

CREATE TABLE book_pics (
    msg_id     INT(11)          NOT NULL DEFAULT '0',
    book_id    INT(11)          NOT NULL DEFAULT '0',
    p_filename VARCHAR(100)     NOT NULL DEFAULT '',
    p_size     INT(11) UNSIGNED NOT NULL DEFAULT '0',
    width      INT(11) UNSIGNED NOT NULL DEFAULT '0',
    height     INT(11) UNSIGNED NOT NULL DEFAULT '0',
    KEY msg_id (msg_id),
    KEY book_id (book_id)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_pics`
#

# --------------------------------------------------------

#
# テーブルの構造 `book_private`
#

CREATE TABLE book_private (
    id       INT(11)     NOT NULL AUTO_INCREMENT,
    name     VARCHAR(50) NOT NULL DEFAULT '',
    gender   CHAR(1)     NOT NULL DEFAULT '',
    email    VARCHAR(60) NOT NULL DEFAULT '',
    url      VARCHAR(70) NOT NULL DEFAULT '',
    date     INT(11)     NOT NULL DEFAULT '0',
    location VARCHAR(50) NOT NULL DEFAULT '',
    host     VARCHAR(60) NOT NULL DEFAULT '',
    browser  VARCHAR(70) NOT NULL DEFAULT '',
    comment  TEXT        NOT NULL,
    icq      INT(11)     NOT NULL DEFAULT '0',
    aim      VARCHAR(70) NOT NULL DEFAULT '',
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_private`
#

# --------------------------------------------------------

#
# テーブルの構造 `book_smilies`
#

CREATE TABLE book_smilies (
    id         INT(11)              NOT NULL AUTO_INCREMENT,
    s_code     VARCHAR(20)          NOT NULL DEFAULT '',
    s_filename VARCHAR(60)          NOT NULL DEFAULT '',
    s_emotion  VARCHAR(60)          NOT NULL DEFAULT '',
    width      SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
    height     SMALLINT(6) UNSIGNED NOT NULL DEFAULT '0',
    PRIMARY KEY (id)
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_smilies`
#

INSERT INTO book_smilies
VALUES (1, ':-)', 'a1.gif', 'smile', 15, 15);
INSERT INTO book_smilies
VALUES (2, ':-(', 'a2.gif', 'frown', 15, 15);
INSERT INTO book_smilies
VALUES (3, ';-)', 'a3.gif', 'wink', 15, 15);
INSERT INTO book_smilies
VALUES (4, ':o', 'a4.gif', 'embarrassment', 15, 15);
INSERT INTO book_smilies
VALUES (5, ':D', 'a5.gif', 'big grin', 15, 15);
INSERT INTO book_smilies
VALUES (6, ':p', 'a6.gif', 'razz (stick out tongue)', 15, 15);
INSERT INTO book_smilies
VALUES (7, ':cool:', 'a7.gif', 'cool', 21, 15);
INSERT INTO book_smilies
VALUES (8, ':rolleyes:', 'a8.gif', 'roll eyes (sarcastic)', 15, 15);
INSERT INTO book_smilies
VALUES (9, ':mad:', 'a9.gif', '#@*%!', 15, 15);
INSERT INTO book_smilies
VALUES (10, ':eek:', 'a10.gif', 'eek!', 15, 15);
INSERT INTO book_smilies
VALUES (11, ':confused:', 'a11.gif', 'confused', 15, 22);
# --------------------------------------------------------

#
# テーブルの構造 `book_words`
#

CREATE TABLE book_words (
    word VARCHAR(30) NOT NULL DEFAULT ''
)
    ENGINE = ISAM;

#
# テーブルのダンプデータ `book_words`
#

INSERT INTO book_words
VALUES ('fuck');

