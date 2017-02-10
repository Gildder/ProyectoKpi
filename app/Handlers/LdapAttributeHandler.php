<?php
namespace App\Handlers;

use Adldap\Models\User;

class LdapAttributeHandler
{
    /**
     * Returns the common name of the AD User.
     *
     * @param User $user
     *
     * @return string
     */
    public function name(User $user)
    {
        return $user->getAccountName();
    }
}