<?php

require_once "entities\Student.php";

    class StudentsController
    {
        public function __construct($action = "index")
        {
            switch ($action) {
                case "index":
                    return $this->index();
                case "add":
                    return $this->add();
                case "edit":
                    return $this->edit();
                case "save":
                    return $this->save();
                case "delete":
                    return $this->delete();
            }
        }


        function index(){
            $db_connection = mysqli_connect("localhost", "root", "", "database");

            $query = mysqli_query($db_connection, "SELECT * FROM `database`.students");

            $students = mysqli_fetch_all($query, MYSQLI_ASSOC);

            include("templates/student/index.php");

        }
        function add(){
            if (isset($_GET["form_sent"])){
                $db_connection = mysqli_connect("localhost", "root", "", "database");

                $email = $_POST["email"]??"";

                $query = mysqli_query($db_connection, "INSERT INTO `database`.users (`email`, `password`) VALUES ('$email', MD5('123123'))");

                if ($query){
                    $user_id = mysqli_insert_id($db_connection);
                    $name = $_POST["name"]??"";
                    $surname = $_POST["surname"]??"";
                    $query = mysqli_query($db_connection, "INSERT INTO `database`.students (`name`, `surname`,`user_id`) VALUES ('$name', '$surname', '$user_id')");
                }
            }
            include("templates/student/create.php");
        }
        function edit(?int $id=null){
            $db_connection = mysqli_connect("localhost", "root", "", "database");
            $student_id = $id??$_GET['student_id'];
            $query = mysqli_query($db_connection,
                "
SELECT
    students.id,
    students.name,
    students.surname,
    users.email
    FROM `database`.students
         JOIN `database`.users
         ON `database`.`users`.`id` = `database`.`students`.`user_id`
         WHERE `database`.`students`.`id` = '{$student_id}'

");
            $student = mysqli_fetch_assoc($query);
            include("templates/student/edit.php");
        }
        function save(){

            print_r($_POST);

            $db_connection = mysqli_connect("localhost", "root", "", "database");
            // Pobieranie danych
            if (
                isset($_POST["id"]) &&
                isset($_POST["name"]) &&
                isset($_POST["surname"])
            ){
                $sql = "
                    UPDATE 
                        `database`.students                          
                    SET  
                        `name` = '{$_POST['name']}',
                        `surname` = '{$_POST['surname']}'                    
                    WHERE 
                        `database`.`students`.`id` = '{$_POST['id']}'                
                ";

                mysqli_query($db_connection, $sql);
                $result = mysqli_affected_rows($db_connection);
                if ($result==1){
                    return $this->index();
                }
            }

            return $this->edit($_POST['id']);

        }
        function delete(){}
    }