<?php

if ( ! function_exists('route_pattern')) {
    function route_pattern($name, $regex) {
        return Ado\Formx\Route\Burp::pattern($name, $regex);
    }
}

if ( ! function_exists('route_get')) {
    function route_get($uri, $parameters) {
        return Ado\Formx\Route\Burp::get($uri, null, $parameters);
    }
}

if ( ! function_exists('route_post')) {
    function route_post($uri, $parameters) {
        return Ado\Formx\Route\Burp::post($uri, null, $parameters);
    }
}

if ( ! function_exists('route_patch')) {
    function route_patch($uri, $parameters) {
        return Ado\Formx\Route\Burp::patch($uri, null, $parameters);
    }
}

if ( ! function_exists('route_put')) {
    function route_put($uri, $parameters) {
        return Ado\Formx\Route\Burp::put($uri, null, $parameters);
    }
}

if ( ! function_exists('route_delete')) {
    function route_delete($uri, $parameters) {
        return Ado\Formx\Route\Burp::delete($uri, null, $parameters);
    }
}

if ( ! function_exists('route_any')) {
    function route_any($uri, $parameters) {
        return Ado\Formx\Route\Burp::any($uri, null, $parameters);
    }
}

if ( ! function_exists('route_head')) {
    function route_head($uri, $parameters) {
        return Ado\Formx\Route\Burp::head($uri, null, $parameters);
    }
}

if ( ! function_exists('route_missing')) {
    function route_missing( $closure) {
        return Ado\Formx\Route\Burp::missing( $closure);
    }
}

if ( ! function_exists('route_query')) {
    function route_query($qs, $parameters) {
        return Ado\Formx\Route\Burp::any(null, $qs, $parameters);
    }
}

if ( ! function_exists('route_dispatch')) {
    function route_dispatch() {
        return Ado\Formx\Route\Burp::dispatch();
    }
}

if ( ! function_exists('is_route')) {
    function is_route($name, $parameters = array() ) {
        return Ado\Formx\Route\Burp::isRoute($name, $parameters);
    }
}

if ( ! function_exists('link_route')) {
    function link_route($name, $parameters = array()) {
        return Ado\Formx\Route\Burp::linkRoute($name, $parameters);
    }
}

if ( ! function_exists('link_url')) {
    function link_url($url, $title = null, $attributes = array()) {
        return Ado\Formx\Route\Burp::linkUrl($url, $title, $attributes);
    }
}

if ( ! function_exists('event_queue')) {
    function event_queue($name, $parameters = array()) {
        Ado\Formx\Route\BurpEvent::queue($name, $parameters);
    }
}

if ( ! function_exists('event_fire')) {
    function event_fire($name, $parameters = array()) {
        Ado\Formx\Route\BurpEvent::fire($name, $parameters);
    }
}

if ( ! function_exists('event_listen')) {
    function event_listen($name, $callable) {
        Ado\Formx\Route\BurpEvent::listen($name, $callable);
    }
}

if ( ! function_exists('event_flush')) {
    function event_flush($name) {
        Ado\Formx\Route\BurpEvent::flush($name);
    }
}

if ( ! function_exists('event_flush_all')) {
    function event_flush_all() {
        Ado\Formx\Route\BurpEvent::flushAll();
    }
}

if ( ! function_exists('request_uri')) {
    function request_uri() {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}

if ( ! function_exists('request_method')) {
    function request_method() {
        return  $_SERVER['REQUEST_METHOD'];
    }
}

if ( ! function_exists('request_method_is')) {
    function request_method_is($method) {
        return ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) ? true : false;
    }
}

if ( ! function_exists('request_input')) {
    function request_input($var, $default = null) {
        return (isset($_REQUEST[$var])) ? $_REQUEST[$var] : $default;
    }
}
