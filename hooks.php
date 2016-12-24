<?php

namespace debug;
use atomic\Atomic;
use atomic\core\Auth;
use atomic\core\Templator;

/**
 * Implements hook_permission()
 */
function permission() {
    return array(
        'administer_debug'
    );
}

/**
 * Implements hook_menu()
 */
function menu() {
    return array();
}

/**
 * Implements hook_model()
 */
function model() {
    return array();
}

/**
 * Implements hook_url()
 */
function url() {
    return array(
        '/!/debug/(?P<api>[a-zA-Z\_-]+)/?(\?.*)?' => 'debug\controller\API',
        '/debug/menu/?(\?.*)?' => 'debug\controller\Menu',
        '/debug/log/?(\?.*)?' => 'debug\controller\Log',
        '/debug/post/?(\?.*)?' => 'debug\controller\Post',
    );
}

/**
 * Implements hook_libraries()
 */
function libraries() {
    // Initialize debug
    if (Atomic::$config['debug'] && Auth::has_authentication('administer_site')) {
        Templator::$js[] = Templator::resolve_ext_asset('debug/js/Debugger.js');
        Templator::$js_onload[] = <<<JS
if(!$('#debugger').length) {
  var myDebugger = new Debugger();
  RegisterGlobal('debugger', myDebugger);
}
JS;
        Templator::$css[] = Templator::resolve_ext_asset('debug/css/debug.css');
    }

    return array();
}

/**
 * Implements hook_cron()
 */
function cron() {
    // execute actions to be performed on cron
}

/**
 * Implements hook_twig_function()
 */
function twig_function() {
    // return an array of key value pairs.
    // key: twig_function_name
    // value: actual_function_name
    // You may use object functions as well
    // e.g. ObjectClass::actual_function_name
    return array();
}
