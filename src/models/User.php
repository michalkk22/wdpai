<?php

class User
{
    private $email;
    private $password;
    private $nickname;

    public function __construct(string $email, string $password, string $nickname)
    {
        $this->email = $email;
        $this->password = $password;
        $this->nickname = $nickname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function getNickname(): string
    {
        return $this->nickname;
    }
    public function setNickname(string $nickname): void
    {
        $this->nickname = $nickname;
    }

}
