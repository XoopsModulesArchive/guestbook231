<?php

/**
 * ----------------------------------------------
 * Advanced Guestbook 2.3.1 (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */
class gb_image
{
    public $imagick = '';  /*
                         * Windows: c:/imagemagick/convert.exe
                         */

    public $max_width;

    public $max_height;

    public $min_filesize = 10240;

    public $destdir = '.';

    public $prefix = '';

    public $supported_types = '';

    public function __construct()
    {
        $this->max_width = 300;

        $this->max_height = 85;

        $this->get_supported_types();
    }

    public function set_border_size($max_width, $max_height)
    {
        if ($max_width > 0 && $max_height > 0) {
            $this->max_width = $max_width;

            $this->max_height = $max_height;

            return true;
        }

        return false;
    }

    public function set_prefix($strg)
    {
        $bad_chars = ['\\', '/', '*', '?', '"', '<', '>', '|'];

        for ($i = 0, $iMax = count($bad_chars); $i < $iMax; $i++) {
            if (mb_strstr($strg, $bad_chars[$i])) {
                return false;
            }
        }

        $this->prefix = $strg;

        return true;
    }

    public function set_destdir($img_dir)
    {
        if (!is_dir((string)$img_dir)) {
            return false;
        }

        $this->destdir = $img_dir;

        return true;
    }

    public function get_supported_types()
    {
        if (extension_loaded('gd')) {
            if (function_exists('imagegif')) {
                $this->supported_types['1'] = 'GIF';
            }

            if (function_exists('imagejpeg')) {
                $this->supported_types['2'] = 'JPEG';
            }

            if (function_exists('imagepng')) {
                $this->supported_types['3'] = 'PNG';
            }

            return (is_array($this->supported_types) && count($this->supported_types) > 0) ? $this->supported_types : false;
        }

        return false;
    }

    public function is_imagick()
    {
        $is_safe_mode = get_cfg_var('safe_mode');

        if ($is_safe_mode) {
            return false;
        }

        if (eregi('convert', $this->imagick)) {
            return true;
        } elseif ('none' != $this->imagick) {
            if (!eregi('WIN', PHP_OS)) {
                $retval = exec('whereis convert');

                if (!empty($retval)) {
                    $this->imagick = 'convert';

                    return true;
                }
            }

            $this->imagick = 'none';

            return false;
        }

        return false;
    }

    public function create_thumbnail($source, $destination = '')
    {
        $img_filesize = (file_exists((string)$source)) ? filesize((string)$source) : false;

        $destination = trim($destination);

        if (mb_strstr($destination, '/') || mb_strstr($destination, '\\')) {
            $new_file = $destination;
        } elseif ('' == $destination) {
            $new_file = $this->destdir . '/' . $this->prefix . basename($source);
        } else {
            $new_file = $this->destdir . '/' . $this->prefix . $destination;
        }

        if (!$img_filesize || $img_filesize <= $this->min_filesize) {
            return false;
        }

        $size = getimagesize((string)$source);

        $new_size = $this->get_img_size_format($size[0], $size[1]);

        if ($this->is_imagick()) {
            if (is_array($size) && count($size) > 0) {
                exec($this->imagick . " -quality 90 -antialias -sample $new_size[0]x$new_size[1] $source $new_file");
            }
        } else {
            $type = (string)$size[2];

            if (isset($this->supported_types[(string)$type])) {
                switch ($type) {
                    case '1':
                        $im = imagecreatefromgif((string)$source);
                        $new_im = imagecreate($new_size[0], $new_size[1]);
                        imagecopyresized($new_im, $im, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
                        imagegif($new_im, $new_file);
                        break;
                    case '2':
                        $im = imagecreatefromjpeg((string)$source);
                        $new_im = imagecreate($new_size[0], $new_size[1]);
                        imagecopyresized($new_im, $im, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
                        imagejpeg($new_im, $new_file, 90);
                        break;
                    case '3':
                        $im = imagecreatefrompng((string)$source);
                        $new_im = imagecreate($new_size[0], $new_size[1]);
                        imagecopyresized($new_im, $im, 0, 0, 0, 0, $new_size[0], $new_size[1], $size[0], $size[1]);
                        imagepng($new_im, $new_file);
                        break;
                }
            }
        }

        return (file_exists((string)$new_file)) ? true : false;
    }

    public function set_min_filesize($file_size)
    {
        if ($file_size > 4096) {
            $this->min_filesize = $file_size;

            return true;
        }

        return false;
    }

    public function get_img_size_format($img_width, $img_height)
    {
        if ($img_width > $this->max_width) {
            $tag_height = ($this->max_width / $img_width) * $img_height;

            $tag_width = $this->max_width;

            if ($tag_height > $this->max_height) {
                $tag_width = ($this->max_height / $tag_height) * $tag_width;

                $tag_height = $this->max_height;
            }
        } elseif ($img_height > $this->max_height) {
            $tag_width = ($this->max_height / $img_height) * $img_width;

            $tag_height = $this->max_height;

            if ($tag_width > $this->max_width) {
                $tag_height = ($this->max_width / $tag_width) * $tag_height;

                $tag_width = $this->max_width;
            }
        } else {
            $tag_width = $img_width;

            $tag_height = $img_height;
        }

        $tag_width = round($tag_width);

        $tag_height = round($tag_height);

        return [
            (string)$tag_width,
            (string)$tag_height,
            "width=\"$tag_width\" height=\"$tag_height\"",
        ];
    }
}
