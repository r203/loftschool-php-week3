<?php
const DB_USER = 'root';
const DB_NAME = 'blog';
const DB_HOST = 'localhost';
const DB_PASSWORD = '';

const ADMIN_IDS = [1];

function d(...$args)
{
  echo '<pre>';
  var_dump($args);
  die;
}