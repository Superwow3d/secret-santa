<?php

namespace test;

use App\Participant\Participant;
use App\SecretSanta\DuplicateParticipantException;
use App\SecretSanta\InsufficientNumberOfParticipants;
use App\SecretSanta\SecretSanta;
use PHPUnit\Framework\TestCase;

class SecretSantaTest extends TestCase
{
    public function testAddParticipant()
    {
        $santa = (new SecretSanta())
                        ->addParticipant(new Participant($name = 'Amir', $email = 'some@bk.ru'))
                        ->addParticipant(new Participant($name = 'LerA', $email = 'another@bk.ru'));
        $this->assertEquals(2, $santa->getParticipantCount());
    }

    public function testDuplicateParticipant()
    {
        $this->expectException(DuplicateParticipantException::class);
        (new SecretSanta())
            ->addParticipant(new Participant($name = 'Amir', $email = 'some@bk.ru'))
            ->addParticipant(new Participant($name = 'Some', $email = 'some@bk.ru'));
    }

    public function testDeleteParticipant()
    {
        $santa = (new SecretSanta())
            ->addParticipant(new Participant($name = 'Amir', $email = 'some@bk.ru'))
            ->addParticipant(new Participant($name = 'LerA', $email = 'another@bk.ru'))
            ->deleteParticipantByEmail('some@bk.ru');
        $this->assertEquals(1, $santa->getParticipantCount());
    }

    public function testShuffle()
    {
        $santa = (new SecretSanta())
            ->addParticipant(new Participant($name = 'user1', $email = 'mail1@bk.ru'))
            ->addParticipant(new Participant($name = 'user2', $email = 'mail2@bk.ru'))
            ->addParticipant(new Participant($name = 'user3', $email = 'mail3@bk.ru'))
            ->addParticipant(new Participant($name = 'user4', $email = 'mail4@bk.ru'))
            ->addParticipant(new Participant($name = 'user5', $email = 'mail5@bk.ru'))
            ->addParticipant(new Participant($name = 'user6', $email = 'mail6@bk.ru'))
            ->addParticipant(new Participant($name = 'user7', $email = 'mail7@bk.ru'));

        $listOfMail = $santa->getShuffledList();
        $this->assertEquals(7, count($listOfMail));
        $this->assertTrue($listOfMail['mail1@bk.ru'] != 'user1' &&
            $listOfMail['mail2@bk.ru'] != 'user2' &&
            $listOfMail['mail3@bk.ru'] != 'user3' &&
            $listOfMail['mail4@bk.ru'] != 'user4' &&
            $listOfMail['mail5@bk.ru'] != 'user5' &&
            $listOfMail['mail6@bk.ru'] != 'user6' &&
            $listOfMail['mail7@bk.ru'] != 'user7'
        );
    }

    public function testInsufficientNumberOfParticipants()
    {
        $santa = (new SecretSanta())
            ->addParticipant(new Participant($name = 'Amir', $email = 'some@bk.ru'));
        $this->expectException(InsufficientNumberOfParticipants::class);
        $santa->getShuffledList();
    }
}