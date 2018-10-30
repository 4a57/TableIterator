<?php

$db = include __DIR__ . '/../db.php';
$query = <<<SQL
create table big_table
(
  id      int auto_increment,
  name    varchar(255) not null,
  address varchar(255) null,
  age     int          null,
  phone   varchar(31)  null,
  constraint address_id_uindex
  unique (id)
);

alter table big_table
  add primary key (id);
SQL;

$db->multi_query($query);
