<?php
namespace App\Service\Provider;

use Symfony\Bundle\SecurityBundle\Security;

class AuthenticatedUserProvider
{
    public function __construct(
        private Security $security 
    ){
    }
    public function getAuthenticatedUser(): ?string
    {
        return $this->security->getUser()->getUserIdentifier();
    }
}