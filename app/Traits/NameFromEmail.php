<?php

namespace App\Traits;

trait NameFromEmail
{
    public function getNameFromEmail(string $email): string
    {
        $arr = explode("@", $email, 2);

        return ucfirst($arr[ 0 ]);
    }
}