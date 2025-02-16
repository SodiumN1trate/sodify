<?php
namespace Model;

use Core\Model;

class Test extends Model
{
    public static string $tableName = 'tests';

    protected array $fillable = [
        'name',
        'surname',
    ];

}