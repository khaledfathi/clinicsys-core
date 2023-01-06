<?php
namespace Clinicsys\Core\Contracts\Database;

interface DatabaseContract {
    public static function Table (string $table):object;
    public function Insert(array $data):int;
    public function Update(array $data):object;
    public function Delete():object;
    public function Select(string $columns):object;
    public function Where(string $column,string $operator , string $value):object;
    public function AndWhere(string $column,string $operator , string $value):object;
    public function OrWhere(string $column,string $operator , string $value):object;
    public function InnerJoin(string $tableToJoin, string $relationRight, string $operator, string $relationLeft): object;
    public function LeftJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object;
    public function RightJoin(string $tableToJoin, string $relationRight, string $operator, string $relationLeft): object;
    public function Exec():int;
    public function First():array;
    public function Last(): array;
    public function All():array;
}