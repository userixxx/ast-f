<?php

namespace App\Actions\General\Profiles;

class UpdateProfile
{
    public function execute($validatedRequest, $user)
    {
        return $user->update($validatedRequest);
    }
}
