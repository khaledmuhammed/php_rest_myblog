<?php
class Category{
    // DB stuff
    private $conn;
    private $table = 'categories';

    // category properties
    public $id;
    public $name;
    public $created_at;

    // constactor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // Get categories
    public function read(){
         // create query
         $query = 'SELECT
            id ,
            name
         FROM
         ' .$this->table. '
         ORDER BY 
           created_at DESC';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        // Excute query
        $stmt->execute();

        return $stmt;
    }

    // create Category
    public function create(){
        // create query
        $query = 'INSERT INTO '. $this->table .'
            SET
              name = :name ';
  
        // prepare statmet 
        $stmt = $this->conn->prepare($query);
  
        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
  
        // Bind data
        $stmt->bindParam(':name', $this->name);

        // Excute query
        if($stmt->execute()){
          return true;
        }
        // print error if something wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
    }

    // update Category
    public function update(){
        // create query
        $query = 'UPDATE '. $this->table .'
            SET
                name = :name
                WHERE 
                id = :id';
    
        // prepare statmet 
        $stmt = $this->conn->prepare($query);
    
        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
    
        // Bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':id', $this->id);

        // Excute query
        if($stmt->execute()){
            return true;
        }
        // print error if something wrong
        printf("Error: %s.\n", $stmt->error);
    
        return false;
        }
    
        // Delete Post
        public function delete(){
        // delete query
        $query = 'DELETE FROM '. $this->table . ' WHERE id = :id';
    
        // prepare statmet 
        $stmt = $this->conn->prepare($query);
    
        // clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        // bind data
        $stmt->bindParam(':id', $this->id);
    
        // Excute query
        if($stmt->execute()){
            return true;
        }
        // print error if something wrong
        printf("Error: %s.\n", $stmt->error);
    
        return false;
        }
}