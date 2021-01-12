<?php

namespace Source\Controller;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\User;

/**
 * Class Web
 * @package Source\App
 */
class Web extends Controller
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__."/../../themes/". CONF_VIEW_THEME ."/");
        if(Auth::user()){
            redirect("/app");
        }
    }

    /**
     * SITE LOGIN
     * @param array $data
     */
    public function login(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if($data){
            $data = (object)$data;

            if(empty($data->email) OR empty($data->password)){
                $json["message"] = $this->message->warning("Informe seu email e senha para entrar")->render();
                echo json_encode($json);
                return;
            }

            $save = (!empty($data->save) ? true : false);
            $auth = new Auth();
            $login = $auth->login($data->email, $data->password, $save);

            if(!$login){
                $json["message"] = $auth->message()->render();
            }else{
                $json["redirect"] = url("/app");
            }

            echo json_encode($json);
            return;
        }

        echo $this->view->render("auth-login", [
            "title" => "Login",
            "cookie" => filter_input(INPUT_COOKIE, "authEmail")
        ]);
    }

    /**
     * @param array $data
     */
    public function register(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if($data) {
            $data = (object)$data;

            if(empty($data->first_name) OR empty($data->email) OR empty($data->password)) {
                $json["message"] = $this->message->warning("Preencha os campos com * para cadastrar um novo usuário")->render();
                echo json_encode($json);
                return;
            }

            $user = new User();
            $user->bootstrap(
                $data->first_name,
                $data->last_name,
                $data->email,
                $data->password
            );

            $auth = new Auth();
            if($auth->register($user)){
                $this->message->success("Usuário cadastrado com sucesso! Faça login para continuar.")->flash();
                $json['redirect'] = url("/");
            }else{
                $json['message'] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        echo $this->view->render("auth-register", [
            "title" => "Cadastrar usuários"
        ]);
    }

    /**
     * SITE FORGET
     * @param array $data
     */
    public function forget(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

        if($data){
            $data = (object)$data;

            if(empty($data->email)){
                $json["message"] = $this->message->warning("Preencha com o seu email para prosseguir")->render();
                echo json_encode($json);
                return;
            }

            if (request_repeat("webforget", $data->email)) {
                $json['message'] = $this->message->error("Ooops! Você já tentou este e-mail antes")->render();
                echo json_encode($json);
                return;
            }

            $auth = new Auth();
            if(!$auth->forget($data->email)){
                $json["message"] = $auth->message()->render();
            }else{
                $json["message"] = $this->message->info("Acesse seu e-mail para recuperar a sua senha")->render();
            }

            echo json_encode($json);
            return;
        }

        echo $this->view->render("auth-forget", [
            "title" => "Recuperar Senha",
        ]);
    }

    /**
     * SITE RESET
     * @param array $data
     */
    public function reset(array $data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        $data = (object)$data;

        if(count((array)$data) != 1){
            if(empty($data->password) OR empty($data->password_re)){
                $json["message"] = $this->message->info("Informe e repita a senha para continuar")->render();
                echo json_encode($json);
                return;
            }

            list($email, $code) = explode("|", $data->code);
            $auth = new Auth();
            if($auth->reset($email, $code, $data->password, $data->password_re)){
                $this->message->success("Senha alterada com sucesso. Faça login para continuar!")->flash();
                $json["redirect"] = url("/");
            }else{
                $json["message"] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        echo $this->view->render("auth-reset", [
            "title" => "Resetar Senha",
            "code" => $data->code
        ]);
    }

    public function error()
    {
        var_dump("teste");
    }
}