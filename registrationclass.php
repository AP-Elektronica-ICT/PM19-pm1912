<?php
class registrationclass 
{
    public $first,$pass,$last,$user,$email,$number,$city,$address,$zip,$tel;
    
    public $dbhosta = 'eu-sql.pebblehost.com';
    public $dbusera = 'customer_93889';
    public $dbpassa = '64a2b900dd';
    public $dbnamea = 'customer_93889';


	public $db;

    
    function __construct($f,$p,$l,$u,$e,$n,$c,$a,$z,$t)
    {
        $this->first = $f;
        $this->pass = $p;
        $this->last = $l;
        $this->user = $u;
        $this->email = $e;
        $this->number = $n;
        $this->city = $c;
        $this->address = $a;
        $this->zip = $z;
        $this->tel = $t;   
        
        $this->db = new PDO('mysql:host='. $this->dbhosta.';dbname='. $this->dbnamea . ';charset=utf8', $this->dbusera, $this->dbpassa);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);       
    }
    
    public function add()
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
    
    public function remove()
    {       
		$sql = "DELETE from accounts where username='BuildTest'";
		$stmtinsert = $this->db->prepare($sql);
		$result = $stmtinsert->execute([$this->first, $this->last,$this->user, $this->email,$this->number,$this->city,$this->address,$this->zip, $this->tel, $this->pass]);
        if($result)
        {
        	return true;
        }
        return false;
    }
    
    public function WriteValuesToDatabase()
    {
		if($this->add()){
            header('Location: login.php');
		}
        else 
        {
            header('Location: registration.php'); // kan vervangen worden door error pagina !
        }
    }
}
//$xd = new registrationclass("test","test","test","test","test","test","test","test","test","test");
//$xd->WriteValuesToDatabase();
?>
