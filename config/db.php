<?php
/*
** EPITECH PROJECT, 2020:
** MVC_Rush_PHP
**
** db.php
** File description:
**  File storing all the data necessary to connect to the database.
**
*/
return [
  'dbname' => 'MVC_rush',
  'username' => 'Client',
  'password' => 'Barcelona.20',
  'driver' => 'mysql',
  'host' => '127.0.0.1',
  'options' => [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]
];
