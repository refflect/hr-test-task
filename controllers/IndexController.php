<?php

include_once '../models/UsersModel.php';
include_once '../models/PositionsModel.php';

function indexAction($twig){

    $paginator = [];
    $paginator['perPage'] = 5;
    $paginator['currentPage'] = isset($_GET['page']) ? $_GET['page'] : 1;
    $paginator['offset'] = ($paginator['perPage'] * $paginator['currentPage']) - $paginator['perPage'];
    $paginator['link'] = "/index/index/?page=";

    list($userList, $cnt) = Users::getList($paginator['offset'], $paginator['perPage']);
    $paginator['totalCnt'] = $cnt;
    if ($paginator['totalCnt']) {
        $paginator['pageCnt'] = ceil($paginator['totalCnt'] / $paginator['perPage']);
    }

    $positionsList = Positions::getList();

    $twig->display('index.twig', [
        'users' => $userList,
        'positions' => $positionsList,
        'paginator' => $paginator]);

}

