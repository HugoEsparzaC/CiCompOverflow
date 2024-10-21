<?php
namespace Model;
class ActiveRecord {
    public $id_user;

    // Database
    protected static $db;
    protected static $table = '';
    protected static $dbColumns = [];

    // Alerts and Messages
    protected static $alerts = [];
    
    // Define the connection to the DB - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlert($type, $message) {
        static::$alerts[$type][] = $message;
    }

    // Validation
    public static function getAlerts() {
        return static::$alerts;
    }

    public function validate() {
        static::$alerts = [];
        return static::$alerts;
    }

    // Execute the SQL query to get the results
    public static function querySQL($query) {
        // Execute the query
        $result = self::$db->query($query);

        // Iterate the results
        $array = [];
        while($record = $result->fetch_assoc()) {
            $array[] = static::createObject($record);
        }

        // Free the memory
        $result->free();

        // Return the results
        return $array;
    }

    // Create the object in memory that is equal to the DB
    protected static function createObject($record) {
        $object = new static;

        foreach($record as $key => $value ) {
            if(property_exists( $object, $key  )) {
                $object->$key = $value;
            }
        }

        return $object;
    }

    // Identify and join the attributes of the DB
    public function attributes() {
        $attributes = [];
        foreach(static::$dbColumns as $column) {
            if($column === 'id') continue;
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    // Sanitize the attributes before saving them to the DB
    public function sanitizeAttributes() {
        $attributes = $this->attributes();
        $sanitized = [];
        foreach($attributes as $key => $value) {
            $sanitized[$key] = self::$db->escape_string($value);
        }
        return $sanitized;
    }

    // Synchronize the object in memory with the changes made by the user
    public function synchronize($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Save a record
    public function save() {
        $result = '';
        if (!is_null($this->id_user)) {
            // Update
            $result = $this->update();
        } else {
            // Creating a new record
            $result = $this->create();
        }
        return $result;
    }

    // Get all records
    public static function all() {
        $query = "SELECT * FROM " . static::$table;
        $result = self::querySQL($query);
        return $result;
    }

    // Search for a record by its id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$table  ." WHERE id = {$id}";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    // Search for a record by its column
    public static function where($column, $value) {
        $query = "SELECT * FROM " . static::$table  ." WHERE $column = '{$value}'";
        $result = self::querySQL($query);
        return array_shift( $result ) ;
    }

    // Get a limited number of records
    public static function get($limit) {
        $query = "SELECT * FROM " . static::$table . " LIMIT {$limit}";
        $result = self::querySQL($query);
        return array_shift($result);
    }

    // Create a new record
    public function create() {
        // Sanitize the data
        $attributes = $this->sanitizeAttributes();
        // Insert into the database
        $query = "INSERT INTO " . static::$table . " (";
        $query .= join(', ', array_keys($attributes));
        $query .= ") VALUES ('";
        $query .= join("', '", array_values($attributes));
        $query .= "')";
        // remplazar 'CURDATE()' por CURDATE()
        $query = str_replace("'CURDATE()'", "CURDATE()", $query);
        // Result of the query
        $result = self::$db->query($query);
        return [
            'result' => $result,
            'id' => self::$db->insert_id
        ];
    }

    // Update the record
    public function update() {
        // Sanitize the data
        $attributes = $this->sanitizeAttributes();
        // Iterate to add each field to the DB
        $values = [];
        foreach ($attributes as $key => $value) {
            $values[] = "{$key}='{$value}'";
        }
        // SQL query
        $query = "UPDATE " . static::$table . " SET ";
        $query .= join(', ', $values);
        $query .= " WHERE id_user = '" . self::$db->escape_string($this->id_user) . "' ";
        $query .= " LIMIT 1";
        // Update DB
        $result = self::$db->query($query);
        return $result;
    }

    // Delete a record by its ID
    public function delete() {
        $query = "DELETE FROM " . static::$table . " WHERE id = " . self::$db->escape_string($this->id_user) . " LIMIT 1";
        $result = self::$db->query($query);
        return $result;
    }

}