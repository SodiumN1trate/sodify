<?php
namespace Model;

use Core\Model;

class User extends Model
{
    public static string $tableName = 'users';

    protected array $fillable = [
        'name',
        'surname',
    ];

}