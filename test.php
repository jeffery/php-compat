<?php

namespace ebhjgjhebrgjhebrg;

require_once __DIR__ . '/vendor/autoload.php';

// Get every possible combination of flags passed to the html*() functions
function get_html_flags() {
	$ret = array(0);
	foreach (array(
		\ENT_COMPAT,
		\ENT_QUOTES,
		\ENT_NOQUOTES,
		\ENT_IGNORE,
		// These constants don't exist on PHP 5.3
		// \ENT_SUBSTITUTE,
		// \ENT_DISALLOWED,
		// \ENT_HTML401,
		// \ENT_XML1,
		// \ENT_XHTML,
		// \ENT_HTML5,
	) as $flag) {
		$ret2 = $ret;
		foreach ($ret as $r) {
			$ret2[] = $r | $flag;
		}
		$ret = $ret2;
		// Sort and remove duplicates
		$ret = \array_unique($ret, \SORT_NUMERIC);
	}
	return $ret;
}

function call_func($func, $params) {
	$ret = \call_user_func_array($func, $params);
	$params = \array_map(function ($p) { return \var_export($p, true); }, $params);
	$params = \join(', ', $params);
	echo $func . '(' . $params . ') = ' . \var_export($ret, true), "\n";
}

function main() {
  $str = '& " \' < > ´ µ ¶ ·';
  foreach (array('', 'IVT\\PHP53::') as $prefix) {
    call_func($prefix.'htmlentities', array($str));
    call_func($prefix.'html_entity_decode', array($str));
    call_func($prefix.'htmlspecialchars', array($str));
    foreach (get_html_flags() as $flags) {
      call_func($prefix.'htmlentities', array($str, $flags));
      call_func($prefix.'html_entity_decode', array($str, $flags));
      call_func($prefix.'htmlspecialchars', array($str, $flags));
      foreach (array('ISO-8859-1', 'UTF-8') as $enc) {
        call_func($prefix.'htmlentities', array($str, $flags, $enc));
        call_func($prefix.'html_entity_decode', array($str, $flags, $enc));
        call_func($prefix.'htmlspecialchars', array($str, $flags, $enc));
        foreach (array(true, false) as $double_encode) {
          call_func($prefix.'htmlentities', array($str, $flags, $enc, $double_encode));
          call_func($prefix.'htmlspecialchars', array($str, $flags, $enc, $double_encode));
        }
      }
    }
  }
}

main();
