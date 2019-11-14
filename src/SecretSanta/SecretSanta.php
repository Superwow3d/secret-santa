<?php

namespace App\SecretSanta;

use App\Participant\Participant;

class SecretSanta
{
    /** @var Participant[] */
    private $participants = [];

    /**
     * @param Participant $participant
     * @return SecretSanta
     * @throws DuplicateParticipantException
     */
    public function addParticipant(Participant $participant): SecretSanta
    {
        $new = clone $this;
        if (array_key_exists($participant->getEmail(), $new->participants)) {
            throw new DuplicateParticipantException('Participant "' . $participant->getEmail() . '" exist');
        }
        $new->participants[$participant->getEmail()] = $participant;
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

    /**
     * @return array
     * @throws InsufficientNumberOfParticipants
     */
    public function getShuffledList(): array
    {
        if (count($this->participants) < 2) {
            throw new InsufficientNumberOfParticipants('Number of participants should be bigger');
        }

        return $this->shuffle($this->participants);
    }

    /**
     * @param Participant[] $participants
     * @return array
     */
    private function shuffle(array $participants): array
    {
        shuffle($participants);
        $list = [];
        for ($i = 0; $i < count($participants) - 1; $i++) {
            $list[$participants[$i]->getEmail()] = $participants[$i + 1]->getName();
        }
        $list[end($participants)->getEmail()] = $participants[0]->getName();

        return $list;
    }
}