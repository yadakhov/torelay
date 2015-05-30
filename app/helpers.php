<?php

function tor_url()
{
    $appUrl = env('APP_URL');

    return $appUrl.'?url=';
}
