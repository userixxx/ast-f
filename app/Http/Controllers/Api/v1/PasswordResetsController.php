<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetsController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Отправить письмо со ссылкой на сброс пароля.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Отправка письма с ссылкой на сброс пароля
        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Reset password email sent.']);
        } else {
            return response()->json(['message' => 'Unable to send reset password email.'], 500);
        }
    }
}
