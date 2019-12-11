<?php
class profileclass
{
    public $id;
    
    public $dbhosta = 'eu-sql.pebblehost.com';
    public $dbusera = 'customer_93889';
    public $dbpassa = '64a2b900dd';
    public $dbnamea = 'customer_93889';


	public $db;

    
    function __construct($userid)
    {
        $this->id = $userid;
        
        $this->db = new PDO('mysql:host='. $this->dbhosta.';dbname='. $this->dbnamea . ';charset=utf8', $this->dbusera, $this->dbpassa);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
    }
    
    public function getPosts()
    {   
		$sql = "SELECT * FROM posts WHERE user_id=" . $this->id;
		$stmtinsert = $this->db->prepare($sql);
		$result = $stmtinsert->execute();
        if($result)
        {
        	return true;
        }
        return false;
    }
    public function getInfo()
    {   
		$sql = "INSERT INTO accounts (first_name, last_name, username, email, number, city, address, zip, tel, password ) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$stmtinsert = $this->db->prepare($sql);
		$result = $stmtinsert->execute([$this->first, $this->last,$this->user, $this->email,$this->number,$this->city,$this->address,$this->zip, $this->tel, $this->pass]);
        if($result)
        {
        	return true;
        }
        return false;
    }
}
?>