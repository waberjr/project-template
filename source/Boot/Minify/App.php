<?php
if (strpos(url(), "localhost")) {
    /**
     * CSS
     */
    $minCSS = new MatthiasMullie\Minify\CSS();
    $minCSS->add(__DIR__ . "/../../../shared/styles/ajax-load.css");
    $minCSS->add(__DIR__ . "/../../../shared/styles/styles.css");

    //theme CSS
//    $cssDir = scandir(__DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/assets/css");
//    foreach ($cssDir as $css) {
//        $cssFile = __DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/assets/css/{$css}";
//        if (is_file($cssFile) && pathinfo($cssFile)['extension'] == "css") {
//            $minCSS->add($cssFile);
//        }
//    }

    //Minify CSS
    $minCSS->minify(__DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/assets/styles.css");


    /**
     * JS
     */
    $minJS = new MatthiasMullie\Minify\JS();
    $minJS->add(__DIR__ . "/../../../shared/scripts/script.js");

    //theme JS
//    $jsDir = scandir(__DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/assets/js");
//    foreach ($jsDir as $js) {
//        $jsFile = __DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/assets/js/{$js}";
//        if (is_file($jsFile) && pathinfo($jsFile)['extension'] == "js") {
//            $minJS->add($jsFile);
//        }
//    }

    //Minify JS
    $minJS->minify(__DIR__ . "/../../../themes/" . CONF_VIEW_APP . "/assets/scripts.js");
}