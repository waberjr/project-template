<?php

/**
 * DB CONFIG
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "project-template",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__."/../../themes");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_THEME", "web");
define("CONF_VIEW_APP", "app");

/**
 * URL
 */
define("CONF_URL_BASE", "http://localhost/project-template");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "");//smtp.gmail.com
define("CONF_MAIL_PORT", "");//587
define("CONF_MAIL_USER", "");//example@gmail.com
define("CONF_MAIL_PASS", "");//examplepass
define("CONF_MAIL_REPLY", "");//reply.example@example.com
define("CONF_MAIL_SENDER", ["name" => "", "email" => ""]);//Name Example //example@gmail.com
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

/**
 * SITE
 */
define("CONF_SITE_NAME", "project-template");
define("CONF_SITE_TITLE", "The best project template for you");
define("CONF_SITE_DESC", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean feugiat justo nec purus efficitur, a tempor ex mattis. Integer ullamcorper lacinia iaculis.");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "example.com.br");
define("CONF_SITE_ADDR_STREET", "Rua Lorem Qd 1 Lt 1");
define("CONF_SITE_ADDR_NUMBER", "1");
define("CONF_SITE_ADDR_COMPLEMENT", "Bloco A, Sala 1");
define("CONF_SITE_ADDR_CITY", "Goiânia");
define("CONF_SITE_ADDR_STATE", "GO");
define("CONF_SITE_ADDR_ZIPCODE", "12345-678");