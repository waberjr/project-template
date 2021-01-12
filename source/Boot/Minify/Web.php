<?php
if (strpos(url(), "localhost")) {
    /**
     * CSS
     */
    $minCSS = new MatthiasMullie\Minify\CSS();
    $minCSS->add(__DIR__ . "/../../../shared/styles/ajax-load.css");
    $minCSS->add(__DIR__ . "/../../../shared/styles/styles.css");

    //Minify CSS
    $minCSS->minify(__DIR__ . "/../../../themes/" . CONF_VIEW_THEME . "/assets/styles.css");


    /**
     * JS
     */
    $minJS = new MatthiasMullie\Minify\JS();
    $minJS->add(__DIR__ . "/../../../shared/scripts/script.js");

    //Minify JS
    $minJS->minify(__DIR__ . "/../../../themes/" . CONF_VIEW_THEME . "/assets/scripts.js");
}