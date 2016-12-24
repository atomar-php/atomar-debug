<?php

namespace debug\controller;

use atomic\core\Auth;
use atomic\core\Lightbox;
use atomic\core\Templator;

class Post extends Lightbox {

    function GET($matches = array()) {
        if (!Auth::has_authentication('administer_debug')) {
            set_error('You are not authorized to user the debug tools');
            $this->go_back();
        }

        // configure lightbox
        $this->width(500);
        $this->header('Simulate a POST');

        $example = array(
            'key1' => 'value1',
            'arrayKey2' => array(
                'key3' => 'value2',
                'key4' => 'value3'
            )
        );

        // render page
        echo $this->render_view('debug/views/modal.post.html', array(
            'example' => json_encode($example),
        ));
    }

    function POST($matches = array()) {
        if (!Auth::has_authentication('administer_debug')) {
            set_error('You are not authorized to user the debug tools');
            $this->go_back();
        }

        Templator::$css_inline[] = <<<CSS
#response-container {
  height:215px;
  margin-bottom:0px;
  border: 1px solid #e3e3e3;
}
#response-sandbox {
    width:100%;
    height:100%;
    border:none;
}
CSS;

        $url = $_REQUEST['url'];
        $variables = $_REQUEST['variables'];

        try {
            $variables = json_decode($variables);
        } catch (Exception $e) {
            $variables = array();
        }
        if($variables === null) {
            $variables = array();
        }

        $response = post($url, http_build_query($variables));

        // configure lightbox
        $this->width(700);
        $this->header('Simulate a POST');

        $example = array(
            'key1' => 'value1',
            'arrayKey2' => array(
                'key3' => 'value2',
                'key4' => 'value3'
            )
        );

        // render page
        echo $this->render_view('debug/views/modal.post.html', array(
            'has_response' => true,
            'response' => $response,
            'url' => $url,
            'variables' => $_REQUEST['variables'],
            'example' => json_encode($example)
        ));
    }

    /**
     * This method will be called before GET, POST, and PUT when the lightbox is returned to e.g. when using lightbox.dismiss_url or lightbox.return_url
     */
    function RETURNED() {

    }
}