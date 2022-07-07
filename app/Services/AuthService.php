<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    public function signIn(string $email, string $password): string
    {
        $user = User::where('email', $email)->first();
        if (Hash::check($password, $user->password)) {
            return $this->getOrGenerate($user);
        }

        throw new AuthenticationException('Wrong Credentials');
    }

    private function getOrGenerate(User $user): string
    {
        if (is_null($token = $user->api_token)) {
            $token = Str::random(60);
            $user->update(['api_token' => $token]);
        }

        return $token;
    }

    public function submitResetPasswordLink(string $email): bool
    {
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email'      => $email,
            'token'      => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('email.forgetPassword', ['token' => $token, 'email' => $email], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Reset Password');
        });

        return true;
    }

    public function resetPassword(string $email, string $token): string
    {
        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $email,
                'token' => $token,
            ])
            ->first();

        if (!$updatePassword) {
            throw new Exception('Invalid token!');
        }

        $password = Str::random(8);
        User::where('email', $email)->update(['password' => Hash::make($password)]);

        DB::table('password_resets')->where(['email' => $email])->delete();

        return $password;
    }
}
