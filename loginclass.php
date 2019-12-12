<?php
class Login 
{
    private $username,$password;
    
    function __construct($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
    }
    function LoginUser()
    {
        session_start();
        require_once('config.php');    
        $sql = "SELECT * FROM accounts WHERE username = ? AND password = ? LIMIT 1";
        $stmtselect  = $db->prepare($sql);
        $result = $stmtselect->execute([$this->username, $this->password]);
        
        while($row = $stmtselect->fetch()) {
        $id = $row["id"];            
}
        
        if($result){
	       if($stmtselect->rowCount() > 0){
                $_SESSION['userlogin'] = $result;
		        $_SESSION['id'] = $id;
                header('Location: index.php');
	}  else{
        echo 'There no user for that combo';
        header('Location: login.php');              
	}
}else{
	echo 'There were errors while connecting to database.';
}
    }
}

$logintest = new Login("sha1","40bd001563085fc35165329ea1ff5c5ecbdbbeef");
$logintest->LoginUser();

?>