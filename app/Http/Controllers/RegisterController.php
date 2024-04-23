<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Kreait\Laravel\Firebase\Facades\Firebase;

class RegisterController extends Controller
{
    private $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = Firebase::auth();
    }

    public function register(Request $request)
    {
        // Validation
        $validator = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $createdUser = $this->firebaseAuth->createUserWithEmailAndPassword($email, $password);
            $uid = $createdUser->uid;
            Firebase::database()->getReference('/users/' . $uid . '/name')->set($username);

            return response()->json(['success' => true], 200);
        } catch (\Kreait\Firebase\Auth\EmailExists $e) {
            return response()->json(['success' => false], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

}
