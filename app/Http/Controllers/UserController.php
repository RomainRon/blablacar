<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    // Afficher les informations d'un utilisateur authentifié
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    // Mettre à jour les informations d'un utilisateur authentifié
    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:8|confirmed',
            'avatar' => 'sometimes|nullable|string',
            'role' => 'sometimes|string|in:user,admin'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update($request->only(['firstname', 'lastname', 'email', 'avatar', 'role']));

        return response()->json($user);
    }

    // Supprimer un utilisateur authentifié
    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
