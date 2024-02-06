<?php

namespace Src\Models;

use Src\Models\AccessToken;

class User extends Model
{
    public $table = 'users';

    /**
     * @since 1.0.0
     * 
     * @param string $email
     * @param string password
     * @return array
     */
    public function login(string $email, string $password): array
    {
        $user = $this->where('email', '=', $email)->first();

        if(isset($user)):
            if($user->status == 'off'):

                return ['status' => false, 'message' => 'Este usuário está inativo!'];
            elseif(password_verify($password, $user->password)):
                $this->removeTokensInvalid($user->id);
                $token = $this->generateToken(); 

                $acc_token = new AccessToken();
                $acc_token->create([
                    'token' => $token,
                    'user_id' => $user->id
                ]);

                $user->token = $token;

                return ['status' => true, 'message' => "Login efetuado com sucesso! Bem vindo {$user->name}", 'user' => $user];
            else:

                return ['status' => false, 'message' => 'Senha inválida!'];
            endif;
        else:

            return ['status' => false, 'message' => "Usuário não cadastrado no sistema!"];
        endif;
    }

    /**
     * @since 1.0.0
     * 
     * @return void
     */
    public function logout(?int $user_id = null): void
    {
        $acc_token = new AccessToken();

        if(isset($user_id)):
            $acc_token->where('user_id', '=', $user_id)->delete();
        else:
            $token = $_SESSION['token'];

            $acc_token->where('token', '=', $token)->delete();

            session_destroy();
        endif;
    }

    /**
     * @since 1.3.1
     * 
     * @return AccessToken
     */
    public function token(): AccessToken
    {
        return $this->hasMany(AccessToken::class, 'access_token', 'user_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Location
     */
    public function locations(): Location
    {
        return $this->hasMany(Location::class, 'locations', 'user_id');
    }

    /**
     * @since 1.0.0
     * 
     * @return string
     */
    protected function generateToken(): string
    {
        return bin2hex(random_bytes(30));
    }

    /**
     * @since 1.3.0
     * 
     * @param int $user_id
     * @return void
     */
    protected function removeTokensInvalid(int $user_id): void
    {
        $acc_token = new AccessToken();
        $acc_token->where('user_id', '=', $user_id)->delete();
    }
}
