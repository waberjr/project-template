<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

/**
 * Class User
 * @package Source\Models
 */
class User extends Model
{
    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct("users", ["first_name", "email", "password"]);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @return $this
     */
    public function bootstrap(
        string $firstName,
        string $lastName,
        string $email,
        string $password
    ): User {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->email = $email;
        $this->password = $password;
        return $this;
    }

    /**
     * @param string $email
     * @param string $collumns
     * @return User|null
     */
    public function findByEmail(string $email, string $collumns = "*"): ?User
    {
        return $this->find("email = :email", "email={$email}", $collumns)->fetch();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function save(): bool
    {
        if (!$this->required()) {
            $this->message->warning("Nome, Email e Senha são obrigatórios");
            return false;
        }

        if (!is_email($this->email)) {
            $this->message->warning("O e-mail informado não tem um formato válido");
            return false;
        }

        if (!is_passwd($this->password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message->warning("A senha deve ter entre {$min} e {$max} caracteres");
            return false;
        } else {
            $this->password = password($this->password);
        }

        /** User Update */
        if (!empty($this->id)) {
            $userId = $this->id;

            if ($this->find("email = :e AND id != :i", "e={$this->email}&i={$userId}", "id")->fetch()) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return false;
            }

            $this->update($this->safe(), "id = :id", "id={$userId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByEmail($this->email, "id")) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return false;
            }

            $userId = $this->create($this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return false;
            }
        }

        $this->data = ($this->findById($userId))->data();
        return true;
    }
}