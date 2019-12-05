<?php
class loginclass 
{
    private $username,$password;
    
    public $dbhosta = 'remotemysql.com';
	public $dbusera = 'Q6EhZWemZR';
	public $dbpassa = 'iEkb5TgEqO';
	public $dbnamea = 'Q6EhZWemZR';


	public $db;

    
    function __construct($username,$password)
    {
        $this->username = $username;
        $this->password = $password;
        
        $this->db = new PDO('mysql:host='. $this->dbhosta.';dbname='. $this->dbnamea . ';charset=utf8', $this->dbusera, $this->dbpassa);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    function LoginUser()
    {    
        $sql = "SELECT * FROM accounts WHERE username = ? AND password = ? LIMIT 1";
        $stmtselect  = $db->prepare($sql);
        $result = $stmtselect->execute([$this->username, $this->password]);        
     
        if($result){
	       if($stmtselect->rowCount() > 0)
           {
                return true;
	       }
            return false;
        }
    }
}

?>