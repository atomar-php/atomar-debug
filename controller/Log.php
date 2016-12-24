<?php

namespace debug\controller;

use atomic\core\Auth;
use atomic\core\Lightbox;
use atomic\core\Templator;

class Log extends Lightbox {

    function GET($matches = array()) {
        if (!Auth::has_authentication('administer_debug')) {
            set_error('You are not authorized to user the debug tools');
            $this->go_back();
        }

        // configure lightbox
        $this->width(750);
        $this->header('System Log');

        Templator::$css_inline[] = <<<CSS
.popover {
  max-width:550px;
}
.popover-content {
  width:550px;
  word-wrap: break-word;
}
td {
  word-wrap: break-word;
}
CSS;

        $logs = \R::findAll('log', ' ORDER BY created_at DESC');

        // render page
        echo $this->render_view('debug/views/modal.log.html', array(
            'logs' => $logs
        ));
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