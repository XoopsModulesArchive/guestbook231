# MySQL dump 8.16
#
# Host: localhost    Database: gb23
#--------------------------------------------------------
# Server version	3.23.42

#
# Table structure for table 'book_pics'
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

ALTER TABLE `book_config`
    ADD `thumbnail`       SMALLINT(1) NOT NULL,
    ADD `thumb_min_fsize` INT(10)     NOT NULL;

