<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class SSOApiHelper {

    private static $urlAuth = "https://api-gateway.telkomuniversity.ac.id/issueauth";
    private static $urlProfile = "https://api-gateway.telkomuniversity.ac.id/issueprofile";

    public static function GetToken($username, $password) {
        $response = Http::post(SSOAPIHelper::$urlAuth, [
            'username' => $username,
            'password' => $password,
        ]);

        if ($response->status() != 200) {
            return null;
        }

        
        $data = $response->json();
        return $data["token"];
    }

    public static function GetProfile($token) {
        $response = Http::withToken($token)->get(SSOAPIHelper::$urlProfile);

        if ($response->status() != 200) {
            return null;
        }

        $data = $response->json();
        return $data;
    }

}