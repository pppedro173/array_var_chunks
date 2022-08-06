<?php
/**
 * Replace array_chunk()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @license     LGPL - http://www.gnu.org/licenses/lgpl.html
 * @copyright   2004-2007 Pedro Soares <pass@php.net>
 * @link        http://php.net/function.array_var_chunks
 * @author      Pedro Soares <pass@php.net>
 * @version     $Revision$
 * @since       PHP 8.2.0
 * @require     PHP 8.0.0 (user_error)
 */
function php_compat_array_var_chunks($input, $sizes, $preserve_keys = false)
{
    if (!is_array($input)) {
        user_error('array_var_chunks() expects parameter 1 to be array, ' .
            gettype($input) . ' given', E_USER_WARNING);
        return;
    }

    if (!is_array($sizes)) {
        user_error('array_var_chunks() expects parameter 2 to be array, ' .
            gettype($size) . ' given', E_USER_WARNING);
        return;
    }

    foreach ($sizes as $size) {
            $sizes[] = (int)$size;

            if ($size <= 0) {
                user_error('array_var_chunks() Sizes values expected to be greater than 0',
                E_USER_WARNING);
                return;
          }
    }

    $chunks = array();
    $i = 0;
    $j = 0;

    if ($preserve_keys !== false) {
        foreach ($input as $key => $value) {
            $chunks[(int)($i++ / $sizes[$j])][$key] = $value;
            if($i % $size[$j] === 0) $j++;
        }
    } else {
        foreach ($input as $value) {
            $chunks[(int)($i++ / $sizes[$j])][] = $value;
            if($i % $size[$j] === 0) $j++;
        }
    }

    return $chunks;
}


// Define
if (!function_exists('array_var_chunks')) {
    function array_var_chunks($input, $sizes, $preserve_keys = false)
    {
        return php_compat_array_var_chunks($input, $sizes, $preserve_keys);
    }
}