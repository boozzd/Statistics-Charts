<?php

// return [
//   db => [
//     host => $_ENV['DB_HOST'],
//     pass => $_ENV['DB_PASS'],
//     user => $_ENV['DB_USER'],
//     database => $_ENV['DB_DATABASE']
//   ]
// ];

// Get config from environment
$config = [
  db => [
    host => $_ENV['DB_HOST'],
    pass => $_ENV['DB_PASS'],
    user => $_ENV['DB_USER'],
    database => $_ENV['DB_DATABASE']
  ]
];
