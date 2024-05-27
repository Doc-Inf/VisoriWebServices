<?php
    interface DB{
        public function getConnection();
        public function query(string $sql,$params=[]);
        public function dmlCommand(string $sql,$params=[]);
        public function beginTransaction();
        public function commit();
        public function rollback();
        public function close();
        public function getErrors();
        public function lastInsertId();
    }

?>
