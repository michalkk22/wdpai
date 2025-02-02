<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/User.php';

class UserRepository extends Repository
{
    public function findByEmail(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return $this->fromAssoc($user);
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->database->connect()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return null;
        }

        return $this->fromAssoc($user);
    }

    public function create($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->database->connect()->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $hashedPassword]);
    }

    public function verifyPassword($email, $password)
    {
        $stmt = $this->database->connect()->prepare("SELECT password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $storedHash = $stmt->fetchColumn();
        return password_verify($password, $storedHash);
    }

    private function fromAssoc($assoc)
    {
        return new User(
            $assoc['id'],
            $assoc['email'],
            $assoc['password'],
            $assoc['is_admin']
        );
    }
}