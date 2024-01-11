<?php
include_once("db.php"); // Include the file with the Database class

class Charts
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function chart1()
    {
        try {
            $query01 = "SELECT T.name AS 'Town Name', COUNT(S.town_city) AS 'Student Population' FROM   student_details AS S
                        INNER JOIN town_city AS T ON S.town_city = T.id
                        GROUP BY S.town_city
                        ORDER BY COUNT(S.town_city) DESC
                        LIMIT 10";

            $stmt = $this->db->getConnection()->prepare($query01);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function chart2()
    {
        try {
            $query01 = "SELECT P.name AS 'Province Name', COUNT(S.province) AS 'Student Population' FROM student_details AS S
            INNER JOIN province AS P ON S.province = P.id
            GROUP BY S.province
            ORDER BY COUNT(S.province) DESC
            LIMIT 10;";

            $stmt = $this->db->getConnection()->prepare($query01);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
    public function chart3()
    {
        try {
            $query01 = "SELECT
                SUM(CASE WHEN s.gender = 1 THEN 1 ELSE 0 END) AS Male,
                SUM(CASE WHEN s.gender = 0 THEN 1 ELSE 0 END) AS Female
            FROM
                students s
            JOIN
                student_details sd ON s.id = sd.student_id
            JOIN
                town_city tc ON sd.town_city = tc.id
            WHERE
                tc.name = 'Lake Thalia';";

            $stmt = $this->db->getConnection()->prepare($query01);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function chart4()
    {
        try {
            $query01 = "SELECT
            MONTH(birthday) AS birth_month,
            COUNT(*) AS student_count
            FROM students GROUP BY birth_month
            ORDER BY birth_month;";

            $stmt = $this->db->getConnection()->prepare($query01);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }

    public function chart5()
    {
        try {
            $query01 = "SELECT
            MONTH(birthday) AS birth_month,
            COUNT(*) AS student_count
        FROM
            students
        WHERE students.birthday >= '2010-01-01'
        
        GROUP BY
            birth_month
        ORDER BY
            birth_month;
            ";

            $stmt = $this->db->getConnection()->prepare($query01);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            // Handle any potential errors here
            echo "Error: " . $e->getMessage();
            throw $e; // Re-throw the exception for higher-level handling
        }
    }
}
?>