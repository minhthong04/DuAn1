<?php
// 1 connect
// truy vấn => nhiều, 1, field
// CRUD
// input: sql
// out: mảng, chuỗi / số
function connect()
{

   try {
      $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
   } catch (PDOException $e) {
      // echo "Connection failed: " . $e->getMessage();
   }
   return $conn;
}

function get_all($sql)
{
   $conn = connect();
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   $stmt->setFetchMode(PDO::FETCH_ASSOC);
   $kq = $stmt->fetchAll();
   return $kq;
}
function get_one($sql)
{
   $conn = connect();
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   $stmt->setFetchMode(PDO::FETCH_ASSOC);
   $kq = $stmt->fetch();
   return $kq;
}
function get_execute($sql)
{
   $conn = connect();
   $stmt = $conn->prepare($sql);
   $stmt->execute();
}
