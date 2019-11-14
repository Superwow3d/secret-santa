<?php

namespace App\Participant;

class Participant
{
    private $name;
    private $email;

    /**
     * Participant constructor.
     * @param string $name
     * @param string $email
     * @throws EmptyNameException
     * @throws IncorrectMailException
     */
    public function __construct(string $name, string $email)
    {
        if ($name === '') {
            throw new EmptyNameException('Name cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new IncorrectMailException('Incorrect email');
        }

        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}