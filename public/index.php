<?php
session_start();
include_once '../vendor/autoload.php';
//include_once 'sitemap.php';

// Вытаскиваем конфиг в ассоциативный массив
$jsonString = file_get_contents(__DIR__ . '/data/config.json');
$config = json_decode($jsonString, true);

// Определяем текущую страницу
$page = trim($_SERVER['REQUEST_URI'], '/');

// Если $page == '', то есть REQUEST_URI = '/', то эта страница главная
if ($page == '') {
    $page = $config['generalPage'];
}

// Заголовок сайта
$siteTitle = $config['siteTitle'];

// Заголовок и меню страницы
$pageData = $config['pages'][$page];
$pageData['title'] = 'Welcome';
$pageData['menu'] = '';
$pageTitle = $pageData['title'];
$pageMenu = $pageData['menu'];

// Содержимое страницы
$content = file_get_contents(__DIR__ . '/pages/' . $page . '.php');

// Подключаем шаблон главной страницы
include_once __DIR__ . '/pages/header.html';