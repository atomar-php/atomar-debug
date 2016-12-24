<?php

namespace debug\controller;

use atomic\core\Auth;
use atomic\core\Lightbox;

class Menu extends Lightbox {

    function GET($matches = array()) {
        if (!Auth::has_authentication('administer_debug')) {
            set_error('You are not authorized to user the debug tools');
            $this->go_back();
        }

        // configure lightbox
        $this->width(750);
        $this->header('Developer Tools');

        // render page
        echo $this->render_view('debug/views/modal.menu.html');
    }

    function POST($matches = array()) {
        $this->redirect();
    }

    /**
     * This method will be called before GET, POST, and PUT when the lightbox is returned to e.g. when using lightbox.dismiss_url or lightbox.return_url
     */
    function RETURNED() {

    }
}