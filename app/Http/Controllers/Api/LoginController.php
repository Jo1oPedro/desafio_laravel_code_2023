<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $user = User::whereEmail($request->email)
            ->wherePersonIsUser()
            ?->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json('As credenciais enviadas estão incorretas.', 401);
        }

        $token = $user->createToken($request->device_name);

        return $token;
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'Logout realizado com sucesso'
        ];
    }
}
