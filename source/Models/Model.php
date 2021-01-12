<?php


namespace Source\Models;


use CoffeeCode\DataLayer\DataLayer;
use Source\Support\Message;

abstract class Model extends DataLayer
{
    /** @var Message */
    protected $message;

    public function __construct(string $entity, array $required, string $primary = 'id', bool $timestamps = true)
    {
        parent::__construct($entity, $required, $primary, $timestamps);
        $this->message = new Message();
    }

    public function message()
    {
        return $this->message;
    }
}