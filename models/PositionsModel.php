<?php


class Positions {

    static function getList(){

        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($mysqli->connect_error) {
            dbg("Positions::connect_error error");
        }

        $stmt = $mysqli->prepare("SELECT * FROM `positions`");
        if (!$stmt->execute()) {
            dbg("Positions::execute error");
        }
        if (!$result = $stmt->get_result()) {
            dbg("Positions::get_result error");
        }

        while ( $row = $result->fetch_assoc() ) {
            $res[] = $row;
        }

        $stmt->close();

        return $res;

    }
}