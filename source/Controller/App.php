<?php

namespace Source\Controller;

use Source\Core\Controller;
use Source\Core\View;
use Source\Models\Account;
use Source\Models\AccountClassification;
use Source\Models\AccountType;
use Source\Models\Auth;
use Source\Models\Company;
use Source\Models\EmailAccount;
use Source\Models\License;
use Source\Models\Role;
use Source\Models\User;
use Source\Support\Email;

/**
 * Class App
 * @package Source\App
 */
class App extends Controller
{
    /**
     * @var \CoffeeCode\DataLayer\DataLayer|null
     */
    private $user;

    /**
     * App constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__."/../../themes/". CONF_VIEW_APP ."/");
        if(!$this->user = Auth::user()){
            redirect("/");
        }
    }

    /**
     * APP HOME
     */
    public function home(): void
    {
        echo $this->view->render("home", [
            "title" => "Project Template"
        ]);
    }

    /**
     * APP LOGOUT
     */
    public function logout(): void
    {
        Auth::logout();
        $this->message->success("Você saiu com sucesso! Volte sempre :)")->flash();
        redirect("/");
    }
}