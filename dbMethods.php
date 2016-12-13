<?php

class dbMethods {
    public static function getDB()
    {
        return new PDO("mysql:host=localhost;dbname=staffdirectory","root","");
    }
    public function getDepartments()
    {
        try
        {
            $query="SELECT Distinct department FROM staffdirectory";
            $db=self::getDB();
            $deps=$db->query($query);
            return $deps;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    public function getStaffByDepartment($dep)
    {
        try {
            $query="SELECT * FROM staffdirectory where department='$dep'";
            $db=self::getDB();
            $staffs=$db->query($query);
            return $staffs;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    public function getStaffById($id)
    {
        try {
            $query="SELECT * FROM staffdirectory where id='$id'";
            $db=self::getDB();
            $stmt=$db->prepare($query);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
