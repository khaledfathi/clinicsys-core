<?php
namespace Clinicsys\Core\Database;
use Clinicsys\Core\Contracts\Database\DatabaseContract;
use Clinicsys\Core\Environment\Env;
use mysqli; 


class MySQL implements DatabaseContract {
    //connection
    private  object $Conn; 
    private   string $Sql ; 
    private  string $TableName;  
    //errors 
    public   array  $Error = ['connection'=>'']; 

    public function __construct (){
        $this->Connect();
    }

    public function __destruct (){
        $this->Conn->close(); 
    }

    //open connection to database 
    private function Connect() : void {
        $this->Conn = new mysqli(
            Env::getEnv('DATABASE','HOST'),
            Env::getEnv('DATABASE','USER'),
            Env::getEnv('DATABASE','PASSWORD'),
            Env::getEnv('DATABASE','DATABASE'),
            Env::getEnv('DATABASE','PORT')
        );
    }

    //return  current sql statment 
    public function GetSQL():string  {
        return  $this->Sql; 
    }

    //set table name , return this instance 
    public static function Table (string $table):object {
        $obj =  new static;
        $obj->TableName = $table;
        return $obj; 
    }

     //execute 'insert' query , return count of affected rows 
    public function Insert(array $data):int{
        $keys='' ; $values='';
        foreach ($data as $key=>$value){
           $keys .= $key. ' , '; 
           $values .= " '$value' , "; 
        }
        $this->Sql= "INSERT INTO $this->TableName (".rtrim($keys , ', ').") values (".rtrim($values , ', ').")"; 
        return $this->exec();  
    }
 
    //set 'update' sql statment , return this instance
    public function Update(array $data ):object {
        $row = "";
        foreach($data as $key => $value){
            $row .=  "`$key` = '$value' ,";
        }
        $row = rtrim($row,",");

        $this->Sql = "UPDATE TABLE `$this->TableName` SET $row";
        return $this;
    }

    //set 'delete' sql statment , return this instance
    public function Delete ():object{
        $this->Sql= "DELETE FROM $this->TableName "; 
        return $this; 
    }

    //set 'select' sql statment , return this instance
    public function Select (string $column="*") : object{
        $this->Sql = "SELECT ".$column." FROM `".$this->TableName."` "; 
        return $this; 
    }

    //add 'where' to sql statment , return this instance
    public function where (string $column , string $operator , string $value): object{
        $this->Sql .= "WHERE $column $operator '$value' ";
        return $this;  
    }
    
    //add 'and' to sql statment , return this instance
    public function AndWhere (string $column , string $operator , string $value): object{
        $this->Sql .= "and $column $operator '$value' ";
        return $this;  
    }

    //add 'or' to sql statment , return this instance
    public function OrWhere (string $column , string $operator , string $value): object{
        $this->Sql .= "or  $column $operator '$value' ";
        return $this;  
    }
    
    public function InnerJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object{
        $this->Sql .= "INNER JOIN `$tableToJoin` on $relationRight $operator  $relationLeft ";
        return $this;  
    }

    public function LeftJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object{
        $this->Sql .= "RIGHT JOIN `$tableToJoin` on $relationRight $operator  $relationLeft ";
        return $this;  
    } 

    public function rightJoin (string $tableToJoin, string $relationRight , string $operator , string $relationLeft): object{
        $this->Sql .= "RIGHT JOIN `$tableToJoin` on $relationRight $operator  $relationLeft ";
        return $this;  
    } 

    //execute 'select' query , return all rows 
    public function All (): array{
       $result = $this->Conn->query($this->Sql);  
       return $result->fetch_all(); 
    }

      public function exec():int {
        $this->Conn->query($this->Sql);
        return $this->Conn->affected_rows; 
    }

    //execute 'select' query , return first rows[assoc] 
    public function First(): array {
       $result = $this->Conn->query($this->Sql);  
       return $result->fetch_assoc(); 
    }

    //execute 'select' query , return last rows 
    public function last(): array {
       $result = $this->Conn->query($this->Sql)->fetch_all();  
       return end($result); 
    }
}
