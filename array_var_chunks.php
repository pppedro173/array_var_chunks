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

    $i = 0;
    foreach ($sizes as $size) {
          if ($size <= 0) {
                user_error('array_var_chunks() Sizes values expected to be greater than 0',
                E_USER_WARNING);
                return;
          }
            $sizes[(int)$i] = (int)$size;
            $i++;
    }
    $chunks = array();
    $i = 0;
    $counter = 0;

    if ($preserve_keys !== false) {
        foreach ($input as $key => $value) {
            if($counter === $sizes[$i]){ 
              $i++;
              $counter = 0;
            }
            $chunks[(int)$i][$key] = $value;
            $counter++;
        }
    } else {
        foreach ($input as $value) {
            if($counter === $sizes[$i]){ 
              $i++;
              $counter = 0;
            }
            echo $i;
            $chunks[(int)$i][] = $value;
            $counter++;
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

$arrayData = [1,2,3,4,5,6];

$sizes = [2,4];

$result = array_var_chunks($arrayData,$sizes);

print_r($result);
