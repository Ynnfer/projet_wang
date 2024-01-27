<?php
namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use App\Entity\User;

/**
 * L'événement user.created est envoyé à chaque fois qu'une commande est créée dans le système. 
 * Chaque fois que le système crée une nouvelle commande, l'événement user.created sera envoyé
 */
class UserCreatedEvent extends Event
{
    const NAME = 'user.created';

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}