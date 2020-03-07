<?php

namespace App\Services;

use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static function store($request)
    {
        try {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);
            return [
                'status' => true,
                'user' => $user
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function getUserPorId($id)
    {
        try {
            $user = User::findOrFail($id);
            return [
                'status' => true,
                'user' => $user
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function update($request, $id)
    {
        try {
            $user = User::findOrFail($id);

            if($request['password']) {
                $request['password'] = Hash::make($request['password']);
                $user->update($request);
            } else {
                unset($request['password']);
                $user->update($request);
            }
            return [
                'status' => true,
                'user' => $user
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return [
                'status' => true
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }
}
