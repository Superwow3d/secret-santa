<?php

namespace test;

use App\Participant\EmptyNameException;
use App\Participant\IncorrectMailException;
use App\Participant\Participant;
use PHPUnit\Framework\TestCase;

class ParticipantTest extends TestCase
{
    public function testIncorrectMail()
    {
        $this->expectException(IncorrectMailException::class);
        $participant = new Participant('Amir', 'wrong mail');
    }

    public function testEmptyName()
    {
        $this->expectException(EmptyNameException::class);
        $participant = new Participant('', 'some-mail@bk.ru');
    }
}