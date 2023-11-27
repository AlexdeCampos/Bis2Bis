<?php
namespace src\handlers;

use core\Database;
use PDO;
use src\Config;
use src\models\User;

class DbHandler {
    public static function renegateBkp(User $user){
        $pdo = Database::getInstance();
        $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL);
        $save_string = "base_bkp/".$user->id.md5(time().rand(0,9999).time());
        $handle = fopen($save_string, 'a+');

        $numtypes = array('tinyint', 'smallint', 'mediumint', 'int', 'bigint', 'float', 'double', 'decimal', 'real');
        $return = "";
        $return .= "CREATE DATABASE `".Config::DB_DATABASE."`;\n";
        $return .= "USE `".Config::DB_DATABASE."`;\n";

        $pstm1 = $pdo->query('SHOW TABLES');
        while ($row = $pstm1->fetch(PDO::FETCH_NUM)) {
            $tables[] = $row[0];
        }

        foreach ($tables as $table) {
        $result = $pdo->query("SELECT * FROM $table");
        $num_fields = $result->columnCount();
        $num_rows = $result->rowCount();
       
        //table structure
        $pstm2 = $pdo->query("SHOW CREATE TABLE $table");
        $row2 = $pstm2->fetch(PDO::FETCH_NUM);
        $ifnotexists = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $row2[1]);
        $return .= "\n\n" . $ifnotexists . ";\n\n";
        
        
        fwrite($handle, $return);
       
        $return = "";
        //insert values
        if ($num_rows) {
            $return = 'INSERT INTO `' . $table . '` (';
            $pstm3 = $pdo->query("SHOW COLUMNS FROM $table");
            $count = 0;
            $type = array();
            while ($rows = $pstm3->fetch(PDO::FETCH_NUM)) {
                if (stripos($rows[1], '(')) {
                    $type[$table][] = stristr($rows[1], '(', true);
                } else {
                    $type[$table][] = $rows[1];
                }
                $return .= "`" . $rows[0] . "`";
                $count++;
                if ($count < ($pstm3->rowCount())) {
                    $return .= ", ";
                }
            }
            $return .= ")" . ' VALUES';
            fwrite($handle, $return);

            $return = "";
        }
        $counter = 0;
        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $return = "\n\t(";
            for ($j = 0; $j < $num_fields; $j++) {
                if (isset($row[$j])) {
                    //if number, take away "". else leave as string
                    if ((in_array($type[$table][$j], $numtypes)) && (!empty($row[$j]))) {
                        $return .= $row[$j];
                    } else {
                        $return .= $pdo->quote($row[$j]);
                    }
                } else {
                    $return .= 'NULL';
                }
                if ($j < ($num_fields - 1)) {
                    $return .= ',';
                }
            }
            $counter++;
            if ($counter < ($result->rowCount())) {
                $return .= "),";
            } else {
                $return .= ");";
            }
            
            fwrite($handle, $return);
            
            $return = "";
        }
        $return = "\n\n-- ------------------------------------------------ \n\n";
        fwrite($handle, $return);
        $return = "";
    }
    
    fclose($handle);

    return $save_string;
    }
}