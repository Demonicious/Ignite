<?php 

if(!function_exists('is_closure')) {
    function is_closure($v) {
        return $v instanceof \Closure;
    }
}