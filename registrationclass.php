<?php
class registrationclass 
{
    public $first,$pass,$last,$user,$email,$number,$city,$address,$zip,$tel;
    
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
    }
    
    
    public function WriteValuesToDatabase()
    {
        require_once('config.php');
		$sql = "INSERT INTO accounts (first_name, last_name, username, email, number, city, address, zip, tel, password ) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$this->first, $this->last,$this->user, $this->email,$this->number,$this->city,$this->address,$this->zip, $this->tel, $this->pass]);
		if($result){
            header('Location: login.php');
		}
        else 
        {
            header('Location: registration.php'); // kan vervangen worden door error pagina !
        }
    }
}

$xd = new registrationclass("test","test","test","test","test","test","test","test","test","test");
//$xd->WriteValuesToDatabase();

?>