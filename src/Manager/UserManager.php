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
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject("Succès de l'inscription")
            ->text('Merci de votre inscription!')
            // ->html('<p>See Twig integration for better HTML integration!</p>')
            ;
        printf("OK");
        $mailer->send($email);
    }
}