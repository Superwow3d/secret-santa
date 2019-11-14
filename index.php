<?php

use App\Participant\Participant;
use App\SecretSanta\SecretSanta;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once 'vendor/autoload.php';

try {
    $santa = (new SecretSanta())
        ->addParticipant(new Participant('Amir', 'some@mail'))
        ->addParticipant(new Participant('Amir', 'some@mail'))
        ->addParticipant(new Participant('Amir', 'some@mail'))
        ->addParticipant(new Participant('Amir', 'some@mail'))
        ->addParticipant(new Participant('Amir', 'some@mail'))
        ->addParticipant(new Participant('Amir', 'some@mail'));

    $list = $santa->getShuffledList();
} catch (Exception $exception) {
    $exception->getMessage();
}

$mailer = new PHPMailer(true);