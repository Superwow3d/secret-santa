<?php

namespace App\SecretSanta;

use App\Participant\Participant;

class SecretSanta
{
    private $participants = [];

    public function addParticipant(Participant $participant): SecretSanta
    {
        $new = clone $this;
        if (array_key_exists($participant->getEmail(), $new->participants)) {
            throw new DuplicateParticipantException('Participant "' . $participant->getEmail() . '" exist');
        }
        $new->participants[$participant->getEmail()] = $participant->getName();
        return $new;
    }

    public function deleteParticipantByEmail(string $email)
    {
        $new = clone $this;
        if (array_key_exists($email, $new->participants)) {
            unset($new->participants[$email]);
        }

        return $new;
    }

    public function getParticipantCount(): int
    {
        return count($this->participants);
    }
}