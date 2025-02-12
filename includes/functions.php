<?php

function base_path(): string
{
    return __DIR__ . '/../';
}

function responseJSON(array $json): string
{
    header('Content-Type: application/json');
    return json_encode($json);
}
