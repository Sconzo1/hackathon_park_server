<?php

//Reserved errors
const ERR_PARSE = ["code" => "-32700", "message" => "Ошибка анализа запроса"];
const ERR_INVALID_REQUEST = ["code" => "-32600", "message" => "Некорректный запрос"];
const ERR_METHOD_NOT_FOUND = ["code" => "-32601", "message" => "Метод не найден"];
const ERR_INVALID_PARAMS = ["code" => "-32602", "message" => "Неверные параметры"];
const ERR_INTERNAL = ["code" => "-32603", "message" => "Внутрення ошибка"];

//Custom errors
const ERR_INVALID_PRODUCT = ["code" => "-32004", "message" => "Продукт не добавлен"];

//Payment errors
const ERR_PRODUCT_NOT_FOUND = ["code" => "-32000", "message" => "Продукт не найден"];
const ERR_PRODUCT_PAYMENT = ["code" => "-32001", "message" => "Ошибка при оплате"];
const ERR_INVALID_ID = ["code" => "-32002", "message" => "Некорректный ID"];
const ERR_PRODUCT_CHECK = ["code" => "-32003", "message" => "Ошибка при проверке продуктов"];

//Login and registration errors
const ERR_DUPLICATE_USER = ["code" => "-32010", "message" => "Такой пользователь уже существует"];
const ERR_REGISTRATION = ["code" => "-32011", "message" => "Ошибка регистрации"];
const ERR_USER_DATA = ["code" => "-32012", "message" => "Неверные email или пароль"];
const ERR_INVALID_EMAIL = ["code" => "-32013", "message" => "Некорректный email"];
const ERR_EMPTY_FIELDS = ["code" => "-32014", "message" => "Заполните пустые поля"];

//DB errors
const ERR_DATA_NOT_FOUND = ["code" => "-32030", "message" => "Данные не найдены"];
const ERR_CANT_ADD_USER = ["code" => "-32031", "message" => "Пользователь не был добавлен"];
const ERR_QUERY_PRODUCTS = ["code" => "-32032", "message" => "Ошибка запроса в таблице products"];
const ERR_QUERY_PRODUCTS_INFO = ["code" => "-32033", "message" => "Ошибка запроса в таблице products_info"];
const ERR_QUERY_USERS = ["code" => "-32034", "message" => "Ошибка запроса в таблице users"];


//Encode and decode errors
const ERR_DECODE = ["code" => "-32048", "message" => "JSON decode error"];
const ERR_ENCODE = ["code" => "-32049", "message" => "JSON encode error"];

//Other
const ERR_EMPTY_METHOD = ["code" => "-32015", "message" => "Пустой метод"];