<?php

namespace App\Utils;

class Model {

    private static $model = null;
    private $db = null;
    private $sql = '';

    public static function getInstance() {
        if (self::$model == null) {
            self::$model = new self;
        }
        return self::$model;
    }

    public function __construct() {
        $this->db = DB::getInstance();
    }

    public function __destruct() {
        $this->db = null;
    }

    public function getDB() {
        return $this->db;
    }

    public function setDB($db) {
        $this->db = $db;
    }

    public function insert($table, array $data = []) {
        $columns = array_keys($data);
        $values = array_values($data);

        $columns = implode(',', $columns);
        $values = implode(',', $values);

        $this->sql = 'INSERT INTO ' . $table . '(' . $columns . ') SET (' . $values . ')';
        return $this;
    }

    public function update($table, array $data = []) {
        $rows = [];

        foreach ($data as $key => $value) {
            $rows[] = $key . ' = ' . $value;
        }

        $rows = implode(',', $rows);
        
        $this->sql = 'UPDATE ' . $table . ' SET ' . $rows;

        return $this;
    }

    public function delete($table) {
        $this->sql = 'DELETE FROM ' . $table;
        return $this;
    }

    public function select($select) {
        $this->sql = 'SELECT ' . $select;
        return $this;
    }

    public function from($table) {
        $this->sql .= ' FROM ' . $table;
        return $this;
    }

    public function where($key, $value) {
        $this->sql .= ' WHERE ' . $key . ' = "' . $value . '"';
        return $this;
    }

    public function whereNot($key, $value) {
        $this->sql .= ' WHERE ' . $key . ' != "' . $value . '"';
        return $this;
    }

    public function whereLike($key, $value) {
        $this->sql .= ' WHERE ' . $key . ' LIKE "' . $value . '"';
        return $this;
    }

    public function whereNotLike($key, $value) {
        $this->sql .= ' WHERE ' . $key . ' NOT LIKE "' . $value . '"';
        return $this;
    }

    public function whereIn($key, array $data = []) {
        $data = implode(',', $data);
        $this->sql .= ' WHERE ' . $key . ' IN (' . $data . ')';
        return $this;
    }

    public function join($join, array $on = []) {
        $on = implode(' = ', $on);
        $this->sql .= ' JOIN ' . $join . ' ON ' . $on;
        return $this;
    }

    public function leftJoin($join, array $on = []) {
        $on = implode(' = ', $on);
        $this->sql .= ' LEFT JOIN ' . $join . ' ON ' . $on;
        return $this;
    }

    public function rightJoin($join, array $on = []) {
        $on = implode(' = ', $on);
        $this->sql .= ' RIGHT JOIN ' . $join . ' ON ' . $on;
        return $this;
    }

    public function and() {
        $this->sql .= ' AND ';
        return $this;
    }

    public function or() {
        $this->sql .= ' OR ';
        return $this;
    }

    public function limit($limit) {
        $this->sql .= ' LIMIT ' . $limit;
        return $this;
    }

    public function offset($offset) {
        $this->sql .= ' OFFSET ' . $offset;
        return $this;
    }

    public function order($order) {
        $this->sql .= ' ORDER BY ' . $order;
        return $this;
    }

    public function asc() {
        $this->sql .= ' ASC';
        return $this;
    }

    public function desc() {
        $this->sql .= ' DESC';
        return $this;
    }

    public function groupBy($groupBy) {
        $this->sql .= ' GROUP BY ' . $groupBy;
        return $this;
    }

    public function getSQL() {
        return $this->sql;
    }

    public function get() {
        return $this->db->query($this->sql);
    }

    public function execute() {
        return $this->db->query($this->sql);
    }

    public function insertId() {
        return $this->db->insert_id;
    }
}