<?php
include_once("db.php"); // Include the file with the Database class

class Town
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($data)
    {
        try {
            // Prepare the SQL INSERT statement
            $sql = "INSERT INTO town_city(name) VALUES(:name);";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind values to placeholders
            $stmt->bindParam(':name', $data['name']);
            // Execute the INSERT query
            $stmt->execute();

            // Check if the insert was successful

            if ($stmt->rowCount() > 0) {
                return $this->db->getConnection()->lastInsertId();
            }

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function read($id)
    {
        try {
            $connection = $this->db->getConnection();

            $sql = "SELECT * FROM town_city WHERE id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Fetch the student data as an associative array
            $townData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $townData;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function update($id, $data)
    {
        try {
            $sql = "UPDATE town_city SET
                    name = :name
                    WHERE id = :id";

            $stmt = $this->db->getConnection()->prepare($sql);
            // Bind parameters
            $stmt->bindValue(':name', $data['name']);
            $stmt->bindValue(':id', $id);

            // Execute the query
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            echo "SQL Query: " . $sql; // Output the SQL query for debugging
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM town_city WHERE id = :id";
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Check if any rows were affected (record deleted)
            if ($stmt->rowCount() > 0) {
                return true; // Record deleted successfully
            } else {
                return false; // No records were deleted (student_id not found)
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function displayAll()
    {
        try {
            $sql = "SELECT * FROM town_city"; // Modify the table name to match your database
            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    /////////////////////////////////
    public function displayAllWithPagination($start_from, $records_per_page)
    {
        $query = "SELECT * FROM town_city LIMIT :start_from, :records_per_page";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':start_from', $start_from, PDO::PARAM_INT);
        $stmt->bindParam(':records_per_page', $records_per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalRecords()
    {
        $query = "SELECT COUNT(*) as total FROM town_city";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }




}
?>