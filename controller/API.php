<?php

namespace debug\controller;

use atomic\core\ApiController;
use atomic\core\Auth;
use atomic\core\Lightbox;
use ReCaptcha\RequestMethod\Post;

class API extends ApiController {

    function _GET($matches = array()) {
        if (!Auth::has_authentication('administer_debug')) {
            set_error('You are not authorized to accessing the debugging menu');
            Lightbox::redirect('/');
        }

        $api = $matches['api'];
//        AutoLoader::register('includes/extensions/debug/controllers/');
        switch ($api) {
//            case 'post':
//                if (Auth::has_authentication('administer_debug')) {
//                    $controller = new Post();
//                    $controller->GET($matches);
//                    exit(1);
//                } else {
//                    set_error('You do not have permission to use the developer menu.');
//                }
//            case 'menu_lightbox':
//                if (Auth::has_authentication('administer_debug')) {
//                    $controller = new DebugMenu();
//                    $controller->GET($matches);
//                    exit(1);
//                } else {
//                    set_error('You do not have permission to use the developer menu.');
//                }
//            case 'log':
//                if (Auth::has_authentication('administer_debug')) {
//                    $controller = new Log();
//                    $controller->GET($matches);
//                    exit(1);
//                } else {
//                    set_error('You do not have permission to use the developer menu.');
//                }
            case 'clear_log':
                if (Auth::has_authentication('administer_debug')) {
                    \R::wipe('log');
                    set_success('The log has been cleared');
//                    $controller = new DebugMenu();
//                    $controller->GET($matches);
//                    exit(1);
                } else {
                    set_error('You do not have permission to use the developer menu.');
                }
                break;
            default:
                set_error('Unknown API process "' . $api . '".');
                break;
        }
        $this->go_back();
    }

    function _POST($matches = array()) {
        if (!Auth::has_authentication('administer_debug')) {
            set_error('You are not authorized to accessing the debugging menu');
            Lightbox::redirect('/');
        }

        $api = $matches['api'];
//        AutoLoader::register('includes/extensions/debug/controllers/');
        switch ($api) {
            case 'post':
                $controller = new Post();
                $controller->POST($matches);
                exit(1);
            default:
                set_error('Unknown API process "' . $api . '".');
                break;
        }
        $this->go_back();
    }

    /**
     * Allows you to perform any additional actions before get requests are processed
     * @param array $matches
     */
    protected function setup_get($matches = array()) {
        // TODO: Implement setup_get() method.
    }

    /**
     * Allows you to perform any additional actions before post requests are processed
     * @param array $matches
     */
    protected function setup_post($matches = array()) {
        // TODO: Implement setup_post() method.
    }
}