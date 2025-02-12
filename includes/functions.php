<?php

function base_path(): string
{
    return __DIR__ . '/../';
}

function responseJSON(string $json): string
{
    header('Content-Type: application/json');
    return $json;
}
