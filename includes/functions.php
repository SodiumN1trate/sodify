<?php

function base_path(): string
{
    return __DIR__ . '/../';
}

function responseJSON($json)
{
    header('Content-Type: application/json');
    return json_encode($json);
}
