<?php

namespace App\Manager;

use App\Entity\User;
use App\Event\UserCreatedEvent;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class UserManager
{
    public static function getSubscribedEvents()
    {
        return [
            UserCreatedEvent::class => 'onUserCreated',
        ];
    }

    public function onUserCreated(UserCreatedEvent $event, MailerInterface $mailer)
    {
        $user = $event->getUser();

        // Gérer la logique des événements créés par l'utilisateur et envoyer des e-mails
        $email = (new Email())
            ->from('nuoxi.wang1@projet.com')
            ->to($user->getEmail())
            ->subject("Succès de l'inscription")
            ->text('Merci de votre inscription!');
        printf("OK");
        $mailer->send($email);
    }
}
