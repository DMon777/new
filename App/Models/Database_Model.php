<?php
namespace App\Models;


class Database_Model
{

    protected $pdo;
    protected static $instance;

    public static function instance(){
        if(self::$instance instanceof self) {
            return self::$instance;
        }
        return self::$instance = new self;
    }



    protected function __construct()
    {
        try{
            $this->pdo = new \PDO('mysql:dbname='.DB_NAME.';host='.HOST.'', USER_NAME,PASSWORD);
        }
        catch(\PDOException $e){
            die("Ошибка подключения к базе данных ") ;
        }
    }


    public function query($sql)
    {
        return $this->pdo->query($sql);
    }

    public function prepared_select($sql,$params = []){
        $pattern = "/\?/";
        $arr = [];
        if(preg_match_all($pattern,$sql,$matches)){


            $result = $this->pdo->prepare($sql);

            for($i=1;$i<=count($matches[0]);$i++){
                $result->bindParam($i,$params[$i-1]);
            }
            $result->execute();

            while($row = $result->fetch(\PDO::FETCH_ASSOC)){
                $arr[] = $row;
            }
            return $arr;
        }
        else{
            $result = $this->pdo->prepare($sql);
            $result->execute();
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                $arr[] = $row;
            }
            return $arr;
        }
    }

    public function pdo_insert($table_name,$fields,$values){
        $sql = 'INSERT INTO '.$table_name.' (';
        foreach($fields as $field){
            $sql.= $field.',';
        }
        $sql = rtrim($sql,',');
        $sql .= ") VALUES (";

        for($i=0;$i<count($values);$i++){
            $sql.="?,";
        }
        $sql = rtrim($sql,',');
        $sql .= ") ";
        $result = $this->pdo->prepare($sql);

        for($i=1;$i<=count($values);$i++){
            $val_count = $i-1;
            $result->bindParam($i,$values[$val_count]);
        }
        return $result->execute();
    }

    public function pdo_update($table,$data = [],$values = [],$where = []){

        $data_res = array_combine($data,$values);


        $sql = "UPDATE ".$table." SET ";

        foreach($data_res as $key=>$val) {
            $sql .= $key."='".$val."',";
        }

        $sql = rtrim($sql,',');

        foreach($where as $k=>$v) {
            $sql .= " WHERE ".$k."="."'".$v."'";
        }

        $result = $this->pdo->prepare($sql);
        for($i=1;$i<=count($values);$i++){
            $val_count = $i-1;
            $result->bindParam($i,$values[$val_count]);
        }
        return $result->execute();
    }


    public function pdo_delete($table,$where = array(),$operand = array('=')){

        $sql = "DELETE FROM ".$table;
        if(is_array($where)) {
            $i = 0;
            foreach($where as $k=>$v) {
                $sql .= ' WHERE '.$k.$operand[$i]."'".$v."'";
                $i++;

                if((count($operand) -1) < $i) {
                    $operand[$i] = $operand[$i-1];
                }
            }

        }
        $result = $this->pdo->prepare($sql);
        foreach($where as $key => $val){
            $count = 1;
            $result->bindParam($count,$val);
            $count++;
        }
        return $result->execute();
    }



}