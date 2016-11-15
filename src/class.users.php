<?php
require_once("connection.php");

class User
{
    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->conn = $db;
    }

    public function runQuery($q) {
        $statement = $this->conn->prepare($q);
        return $statement;
    }

    public function register($user_username,$user_password,$user_email,$user_firstName,$user_lastName,$user_adress,$user_premission,$user_etaj,$user_app,$user_telNomer) {
        try {
            $generate_password = password_hash($user_password,PASSWORD_DEFAULT);
            $statement = $this->conn->prepare("INSERT INTO users(users_username,
                users_password,
                users_email,
                users_first_name,
                users_last_name,
                users_adress,
                users_premissions,
                users_etaj,
                users_apartament,
                users_tel_nomer)
		        VALUES(:user_username,
                    :user_password,
                    :user_email,
                    :user_firstName,
                    :user_lastName,
                    :user_adress,
                    :user_premission,
                    :user_etaj,
                    :user_app,
                    :user_telNomer)");

                $statement->bindparam(":user_username", $user_username);
                $statement->bindparam(":user_password", $user_password);
                $statement->bindparam(":user_email",    $user_email);
                $statement->bindparam(":user_firstName",$user_firstName);
                $statement->bindparam(":user_lastName", $user_lastName);
                $statement->bindparam(":user_adress",   $user_adress);
                $statement->bindparam(":user_premission", $user_premission);
                $statement->bindparam(":user_etaj", $user_etaj);
                $statement->bindparam(":user_app", $user_app);
                $statement->bindparam(":user_telNomer", $user_telNomer);

                $statement->execute();
                return $statement
            }
            catch(PDOException $e) {
                echo $e->getMessage();
        	}
        }

        //doLogin($user_username,$user_email,$user_password)
        //is_loggedin()
        //doLogout()
        // tva sa nai basic neshtata za user class-a


}



?>
