<?php


class Users {

    static function getList($offset = 1, $limit = 3){

        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($mysqli->connect_error) {
            dbg("Users::connect_error error");
        }

        $stmt = $mysqli->prepare("SELECT count(id) FROM `users`");
        if (!$stmt->execute()) {
            dbg("Users::execute error");
        }
        if (!$result = $stmt->get_result()) {
            dbg("Users::get_result error");
        }
        $cnt = $result->fetch_all();
        $stmt->close();

        $stmt = $mysqli->prepare("SELECT u.id, u.name, p.id AS pos_id, p.name AS pos_name, u.status, u.start_date
                                FROM `users` AS u
                                JOIN `positions` AS p ON u.position_id=p.id
                                ORDER BY `id` ASC
                                LIMIT ?, ?");
        $stmt->bind_param("ii", $offset, $limit);

        if (!$stmt->execute()) {
            dbg("Users::execute error");
        }
        if (!$result = $stmt->get_result()) {
            dbg("Users::get_result error");
        }

        while ( $row = $result->fetch_assoc() ) {
            $usersList[] = $row;
        }

        $stmt->close();

        return [$usersList, $cnt[0][0]];

    }

    static function add($name, $position, $status, $start_date){
        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($mysqli->connect_error) {
            dbg("Users::connect_error error");
        }
        $stmt = $mysqli->prepare( "INSERT INTO
                                    `users` (`name`, `position_id`, `status`, `start_date`)
                                    VALUES (?, ?, ?, ?) ");
        $stmt->bind_param("siis", $name, $position, $status, $start_date);

        if (!$stmt->execute()) {
            $resData['success'] = 0;
            $resData['message'] = "Ошибка добавления пользователя";
        } else {
            $resData['success'] = 1;
            $resData['message'] = "Пользователь добавлен";
        }
        $stmt->close();

        return $resData;
    }

    static function update($id, $name, $position, $status, $start_date){
        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($mysqli->connect_error) {
            dbg("Users::connect_error error");
        }
        $stmt = $mysqli->prepare( "UPDATE `users` 
                                    SET `name` = ? , `position_id` = ?, `status` = ?, `start_date` = ?
                                    WHERE `id` = ?
                                    LIMIT 1");
        $stmt->bind_param("siisi", $name, $position, $status, $start_date, $id);

        if (!$stmt->execute()) {
            $resData['success'] = 0;
            $resData['message'] = "Ошибка обновления пользователя";
        } else {
            $resData['success'] = 1;
            $resData['message'] = "Информация обновлена";
        }
        $stmt->close();

        return $resData;

    }

    static function delete($id){
        $mysqli = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
        if ($mysqli->connect_error) {
            dbg("Users::connect_error error");
        }
        $stmt = $mysqli->prepare( "DELETE FROM `users` 
                                    WHERE `id` = ?
                                    LIMIT 1");
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            $resData['success'] = 0;
            $resData['message'] = "Ошибка удаления пользователя";
        } else {
            $resData['success'] = 1;
            $resData['message'] = "Пользователь удален";
        }
        $stmt->close();

        return $resData;

    }
}