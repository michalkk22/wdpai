<?php

class User
{
    private $id;
    private $email;
    private $password;
    private ?bool $isAdmin;

    public function __construct(int $id, string $email, string $password, ?bool $isAdmin)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->isAdmin = $isAdmin;
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}
