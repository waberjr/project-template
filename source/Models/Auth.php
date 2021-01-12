<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;
use Source\Core\Session;
use Source\Core\View;
use Source\Support\Email;

/**
 * Class Auth
 * @package Source\Models
 */
class Auth extends Model
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["email", "password"]);
    }

    /**
     * @return DataLayer
     */
    public static function user(): ?DataLayer
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return (new User())->findById($session->authUser);
    }

    /**
     * log-out
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    /**
     * @param string $email
     * @param string $password
     * @param bool $save
     * @return bool
     */
    public function login(string $email, string $password, bool $save = false): bool
    {
        if(!is_email($email)){
            $this->message->warning("O e-mail informado não é válido");
            return false;
        }

        if($save){
            setcookie("authEmail", $email, time() + 604800, "/"); //7 days
        }else{
            setcookie("authEmail", null, time() - 3600, "/");
        }

        if(!is_password($password)){
            $this->message->warning("A senha informada não é valida");
            return false;
        }

        $user = (new User())->findByEmail($email);
        if(!$user){
            $this->message->error("O e-mail informado não está cadastrado");
            return false;
        }

        if(!password_verify($password, $user->password)){
            $this->message->error("A senha informada está incorreta");
            return false;
        }

        (new Session())->set("authUser", $user->id);
        return true;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function register(User $user): bool
    {
        if(!is_email($user->email)){
            $this->message->warning("O e-mail informado não é válido");
            return false;
        }

        if (!is_passwd($user->password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message->info("Sua senha deve ter entre {$min} e {$max} caracteres.");
            return false;
        }

        if (!$user->save()) {
            $this->message = $user->message;
            return false;
        }

        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function forget(string $email):bool
    {
        if(!is_email($email)){
            $this->message->warning("O e-mail informado não é válido");
            return false;
        }

        $user = (new User())->findByEmail($email);
        if(!$user){
            $this->message->error("O e-mail informado não está cadastrado");
            return false;
        }

        $user->forget = md5(uniqid(rand(), true));
        $user->save();

        $view = new View(__DIR__."/../../themes/". CONF_VIEW_THEME ."/views/email");
        $message = $view->render("forget", [
            "title" => "Recuperação de senha",
            "first_name" => $user->first_name,
            "forget_link" => url("/recuperar/{$user->email}|{$user->forget}")
        ]);

        (new Email())->bootstrap(
            "Recupere sua senha no ". CONF_SITE_NAME,
            $message,
            $user->email,
            "{$user->first_name} {$user->last_name}"
        )->send();

        return true;
    }

    /**
     * @param string $email
     * @param string $code
     * @param string $password
     * @param string $passwordRe
     * @return bool
     */
    public function reset(string $email, string $code, string $password, string $passwordRe): bool
    {
        $user = (new User())->findByEmail($email);

        if (!$user) {
            $this->message->error("A conta para recuperação não foi encontrada.");
            return false;
        }

        if ($user->forget != $code) {
            $this->message->error("Desculpe, mas o código de verificação não é válido.");
            return false;
        }

        if (!is_passwd($password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message->info("Sua senha deve ter entre {$min} e {$max} caracteres.");
            return false;
        }

        if ($password != $passwordRe) {
            $this->message->warning("Você informou duas senhas diferentes.");
            return false;
        }

        $user->password = $password;
        $user->forget = null;
        $user->save();
        return true;
    }
}