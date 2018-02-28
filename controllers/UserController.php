<?php
/**
 * UserController
 * /user/1
 */


include_once '../models/UsersModel.php';
include_once '../models/PositionsModel.php';

function saveAction()
{

    if ( empty($_POST['name']) || empty($_POST['position']) || empty($_POST['startdate']) ) {
        $resData['success'] = 0;
        $resData['message'] = "Заполните все поля";
    } elseif ( !empty($_POST['id']) ) {
        $resData = Users::update($_POST['id'], $_POST['name'], $_POST['position'], $_POST['status'], $_POST['startdate']);
    }else {
        $resData = Users::add($_POST['name'], $_POST['position'], $_POST['status'], $_POST['startdate']);
    }

    echo json_encode($resData);
}

function deleteAction()
{

    if ( empty($_POST['id']) ) {
        $resData['success'] = 0;
        $resData['message'] = "Пользователь не найден";
    } else {
        $resData = Users::delete($_POST['id']);
    }

    echo json_encode($resData);
}