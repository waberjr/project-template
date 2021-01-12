<?php

use Source\Core\Session;
use Source\Support\Message;

/**
 * ######################
 * ###   VALIDATION   ###
 * ######################
 */

function is_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param $phone
 * @return bool
 */
function is_phone($phone){
    if(strlen($phone) > 0 AND strlen($phone) < 15){
        return false;
    }

    return true;
}

/**
 * @param $phone
 * @return bool
 */
function is_fix_phone($phone){
    if(strlen($phone) > 0 AND strlen($phone) < 14){
        return false;
    }

    return true;
}

/**
 * @param $cnpj
 * @return bool
 */
function is_cnpj($cnpj){
    if(strlen($cnpj) > 0 AND strlen($cnpj) < 18){
        return false;
    }

    return true;
}

/**
 * @param $cep
 * @return bool
 */
function is_cep($cep){
    if(strlen($cep) > 0 AND strlen($cep) < 9){
        return false;
    }

    return true;
}

/**
 * @param $uf
 * @return bool
 */
function is_uf($uf){
    if(strlen($uf) == 1 OR filter_var($uf, FILTER_SANITIZE_NUMBER_INT)){
        return false;
    }

    return true;
}

/**
 * @param $password
 * @return bool
 */
function is_password($password){
    if (password_get_info($password)['algo'] || (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN)) {
        return true;
    }

    return false;
}

/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string
{
    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE;
}

/**
 * @return string
 */
function uri(): string
{
    return $_SERVER["REQUEST_URI"];
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

/**
 * ##################
 * ###   ASSETS   ###
 * ##################
 */

function theme(string $path = null, string $theme = CONF_VIEW_THEME): string
{
    if ($path) {
        return CONF_URL_BASE . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE . "/themes/{$theme}";
}

/**
 * ####################
 * ###   PASSWORD   ###
 * ####################
 */

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    if (password_get_info($password)['algo'] || (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN)) {
        return true;
    }

    return false;
}

/**
 * @param string $password
 * @return string
 */
function password(string $password): string
{
    if (!empty(password_get_info($password)['algo'])) {
        return $password;
    }

    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @param string $password
 * @return string
 */
function password_encode_64(string $password): string
{
    for ($i = 0; $i < 5; $i++){
        $password = base64_encode($password);
    }

    return $password;
}

/**
 * @param string $password
 * @return string
 */
function password_decode_64(string $password): string
{
    for ($i = 0; $i < 5; $i++){
        $password = base64_decode($password);
    }

    return $password;
}

/**
 * ################
 * ###   DATE   ###
 * ################
 */

/**
 * @param string|null $date
 * @param string $format
 * @return string
 * @throws Exception
 */
function date_fmt(?string $date, string $format = "d/m/Y H\hi"): string
{
    $date = (empty($date) ? "now" : $date);
    return (new DateTime($date))->format($format);
}

/**
 * ###################
 * ###   REQUEST   ###
 * ###################
 */

/**
 * @return string|null
 */
function flash(): ?string
{
    $session = new Session();
    if ($flash = $session->flash()) {
        $json["message"] = $flash->render();
        return json_encode($json);
    }
    return null;
}

/**
 * @param string $field
 * @param string $value
 * @return bool
 */
function request_repeat(string $field, string $value): bool
{
    $session = new \Source\Core\Session();
    if ($session->has($field) && $session->$field == $value) {
        return true;
    }

    $session->set($field, $value);
    return false;
}