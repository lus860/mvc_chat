<?php

namespace vendor\core;

use vendor\lib\Db;

abstract class Model {

	public $db;
    protected $table = '';
    protected $sql = '';
    protected $selectFlag = false;

	public function __construct()
    {
		$this->db = new Db;
        $this->table = lcfirst(get_class($this))."s";
	}

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function insert($data)
    {
        $fieldsArray = [];
        $valuesArray = [];
        if (!empty($data)) {
            foreach ($data as $field => $value) {
                $fieldsArray[] = "$field";
                $valuesArray[] = "':$value'";
            }
            $fieldsStr = implode(',', $fieldsArray);
            $valuesStr = implode(',', $valuesArray);
            $this->sql = "INSERT INTO  $this->table ($fieldsStr) VALUES ($valuesStr)";
            $stmt = $this->db->prepare($this->sql);

            foreach ($data as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
    }

    public function select($what = "*")
    {   $whatStr = '*';
        if (is_array($what)) {
            $whatArr = [];
            foreach ($what as $value) {
                $whatArr[] = "'$value'";
            }
            $whatStr = implode(',',$whatArr);
        } else {
            if ($what != "*") {
                $whatStr = "'$what'";
            }
        }

        $this->selectFlag = true;
        $this->sql = "SELECT $whatStr FROM $this->table";
        return $this;
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE id = '$id' ");
        return $stmt->execute();

    }

    public function where($conditions = 1)
    {
        $condStr = 1;
        if (is_array($conditions)) {
            $condArr = [];
            foreach ($conditions as $field => $value) {
                $condArr[] = "$field = '$value'";
            }
            $condStr = implode(' AND ',$condArr);
        }

        if ($this->selectFlag) {

            $this->sql .= " WHERE $condStr";

        } else {

            $this->sql = " WHERE $condStr";

        }
        return $this;
    }

    public function limit ($a,$b = null)
    {
        if (!$b) { $this->sql .= " LIMIT $a";
        }
        else { $this->sql .= " LIMIT $a, $b"; }
        return $this;
    }

    public function order_by ($name, $type="ASC")
    {
        if($type == "DESC"){
            $this->sql .= " ORDER BY $name DESC";
        } else {
            $this->sql .= " ORDER BY $name";
        }
        return $this;
    }

    public function delete ($data = [])
    {
        $this->selectFlag = false;

        $this->sql = "DELETE FROM $this->table". "$this->sql";
       if(!empty($data)){
           $this->where($data);
       }
        $this->db->exec($this->sql);
    }

    public function update($data1)
    {
        $this->selectFlag = false;
        $condArr1 = [];
        foreach ($data1 as $field => $value){
            $condArr1[] = "$field='$value'";
        }
        $condStr1 = implode(' , ',$condArr1);

        $this->sql = "UPDATE $this->table SET $condStr1". "$this->sql";

        $this->get();

    }

    public function get()
    {
        $stmt = $this->db->prepare($this->sql);
        return $stmt->execute();
    }

    public function row()
    {
        return $this->get()->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column()
    {
        return $this->get()->fetchColumn();
    }

}