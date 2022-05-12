<?php
namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\PropertyAccess\Exception\UnexpectedTypeException;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
public function checkPreAuth(UserInterface $user): void
{
if (!$user instanceof AppUser) {
return;
}

// user is deleted, show a generic Account Not Found message.
if ($user->getEtatBlock() == true) {
    throw new CustomUserMessageAuthenticationException('ACCES REFUSEE !! VOUS ÊTES BLOQUE !!');
}
}

public function checkPostAuth(UserInterface $user): void
{
if (!$user instanceof AppUser) {
return;
}


}
}