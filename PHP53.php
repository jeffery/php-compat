<?php

namespace IVT;

final class PHP53 {
    public static function htmlentities(
        $string,
        $flags = \ENT_COMPAT, // Documented as ENT_COMPAT | ENT_HTML401, but ENT_HTML401 is 0
        $encoding = 'ISO-8859-1',
        $double_encode = true
    ) {
        return \htmlentities($string, $flags, $encoding, $double_encode);
    }

    public static function html_entity_decode(
        $string,
        $flags = \ENT_COMPAT, // Documented as ENT_COMPAT | ENT_HTML401, but ENT_HTML401 is 0
        $encoding = 'ISO-8859-1'
    ) {
        return \html_entity_decode($string, $flags, $encoding);
    }

    public static function htmlspecialchars(
        $string,
        $flags = \ENT_COMPAT, // Documented as ENT_COMPAT | ENT_HTML401, but ENT_HTML401 is 0
        $encoding = 'ISO-8859-1',
        $double_encode = true
    ) {
        return \htmlspecialchars($string, $flags, $encoding, $double_encode);
    }

    public static function HTTP_RAW_POST_DATA() {
        global $HTTP_RAW_POST_DATA;
        // If "always_populate_raw_post_data = 1" in the INI file on PHP < 7.0, this
        // global variable will already be set.
        if (isset($HTTP_RAW_POST_DATA))
            return $HTTP_RAW_POST_DATA;
        // Otherwise, we set it by reading all of php://input. See https://wiki.php.net/rfc/slim_post_data
        return ($HTTP_RAW_POST_DATA = \file_get_contents('php://input'));
    }

    private function __construct() {
    }
}

