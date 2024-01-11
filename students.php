<?php
include_once("db.php"); // Include the file with the Database class

class Students
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
            $sql = "INSERT INTO students(student_number, first_name, middle_name, last_name, gender, birthday) VALUES(:student_number, :first_name, :middle_name, :last_name, :gender, :birthday);";
            $stmt = $this->db->getConnection()->prepare($sql);

            // Bind values to placeholders
            $stmt->bindParam(':student_number', $data['student_number']);
            $stmt->bindParam(':first_name', $data['first_name']);
            $stmt->bindParam(':middle_name', $data['middle_name']);
            $stmt->bindParam(':last_name', $data['last_name']);
            $stmt->bindParam(':gender', $data['gender']);
            $stmt->bindParam(':birthday', $data['birthday']);

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

            $sql = "SELECT * FROM students WHERE id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Fetch the student data as an associative array
            $studentData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $studentData;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function update($id, $data)
    {
        try {
            $sql = "UPDATE students SET
                    student_number = :student_number,
                    first_name = :first_name,
                    middle_name = :middle_name,
                    last_name = :last_name,
                    gender = :gender,
                    birthday = :birthday
                    WHERE id = :id";

            $stmt = $this->db->getConnection()->prepare($sql);
            // Bind parameters
            $stmt->bindValue(':student_number', $data['student_number']);
            $stmt->bindValue(':first_name', $data['first_name']);
            $stmt->bindValue(':middle_name', $data['middle_name']);
            $stmt->bindValue(':last_name', $data['last_name']);
            $stmt->bindValue(':gender', $data['gender']);
            $stmt->bindValue(':birthday', $data['birthday']);
            $stmt->bindValue(':id', $data['id']);

            // Execute the query
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM students WHERE id = :id";
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
            $sql = "SELECT * FROM students LIMIT 1000"; // Modify the table name to match your database
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

    public function readStudentAndDetails($id)
    {
        try {
            $connection = $this->db->getConnection();

            $sql = "SELECT students.id, students.student_number, students.first_name, students.last_name, students.middle_name, students.gender, students.birthday, student_details.id AS 'details_id', student_details.student_id, student_details.contact_number, student_details.street, student_details.town_city, student_details.province, student_details.zip_code FROM students 
            LEFT JOIN student_details ON students.id = student_details.student_id WHERE students.id = :id";
            $stmt = $connection->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Fetch the student data as an associative array
            $studentData = $stmt->fetch(PDO::FETCH_ASSOC);

            return $studentData ? $studentData : false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function getAllWithStudentDetails()
    {
        try {
            $sql = "SELECT students.id AS ids, student_number, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS 'full_name', gender, birthday, student_details.*
                    FROM students
                    LEFT JOIN student_details ON students.id = student_details.student_id LIMIT 10"; // Modify the LIMIT clause based on your requirements

            $stmt = $this->db->getConnection()->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            // Handle errors (log or display)
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function updateAllWithStudents($id, $data)
    {
        try {
            $sql = "UPDATE students
                LEFT JOIN student_details ON students.id = student_details.student_id
                SET
                students.student_number = :student_number,
                students.first_name = :first_name,
                students.middle_name = :middle_name,
                students.last_name = :last_name,
                students.gender = :gender,
                students.birthday = :birthday,
                student_details.id = :details_id,
                student_details.student_id = :student_id,
                student_details.contact_number = :contact_number,
                student_details.street = :street,
                student_details.zip_code = :zip_code,
                student_details.town_city = :town_city,
                student_details.province = :province
                WHERE students.id = :id";

            $stmt = $this->db->getConnection()->prepare($sql);
            // Bind parameters
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':student_number', $data['student_number']);
            $stmt->bindValue(':first_name', $data['first_name']);
            $stmt->bindValue(':middle_name', $data['middle_name']);
            $stmt->bindValue(':last_name', $data['last_name']);
            $stmt->bindValue(':gender', $data['gender']);
            $stmt->bindValue(':birthday', $data['birthday']);
            $stmt->bindValue(':details_id', $data['details_id']);
            $stmt->bindValue(':student_id', $data['student_id']);
            $stmt->bindValue(':contact_number', $data['contact_number']);
            $stmt->bindValue(':street', $data['street']);
            $stmt->bindValue(':zip_code', $data['zip_code']);
            $stmt->bindValue(':town_city', $data['town_city']);
            $stmt->bindValue(':province', $data['province']);

            // Execute the statement
            $stmt->execute();

        } catch (PDOException $e) {
            // Handle the exception
            echo "SQL Error: " . $e->getMessage(); // Display the full SQL error message
            echo "<pre>"; // This tag is used for better formatting of the output
            var_dump($data); // Display the submitted data for debugging
            echo "</pre>";
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
}

?>