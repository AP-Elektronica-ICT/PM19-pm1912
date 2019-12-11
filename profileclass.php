<?php
class profileclass
{
    public $id;
    public $first_name;
    public $last_name;
    public $user_name;
    public $number;
    public $address;
    public $tel;

    
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

        $post = mysql_fetch_row($result);
        if($result)
        {
        	return true;
        }
        return false;
    }
    public function canViewPost($friends, $postid)
    {   
		$sql = "SELECT * FROM posts WHERE post_id=" . $postid;
		$stmtinsert = $this->db->prepare($sql);
        $result = $stmtinsert->execute();

        $post = mysql_fetch_row($result);
        if($result)
        {
            if ($friends)
            {
                return "yes";
            }
            else {
                return "no";
            }
        }
        return "error";
    }
    public function LikePost($postid, $userid)
    {   
		$sql = "SELECT * FROM posts WHERE user_id=" . $this->id;
		$stmtinsert = $this->db->prepare($sql);
        $result = $stmtinsert->execute();
    }

    public function ViewPost($postid, $userid)
    {   
		$sql = "SELECT * FROM posts WHERE user_id=" . $this->id;
		$stmtinsert = $this->db->prepare($sql);
        $result = $stmtinsert->execute();
    }

    public function ReactPost($postid, $userid, $string)
    {   
		$sql = "INSERT INTO POSTS postid=". $postid . " text=" .$string. "";
		$stmtinsert = $this->db->prepare($sql);
        $result = $stmtinsert->execute();
    }

    public function getInfo()
    {   
		$sql = "SELECT FROM accounts (first_name, last_name, username, email, number, city, address, zip, tel, password ) VALUES(?,?,?,?,?,?,?,?,?,?)";
		$stmtinsert = $this->db->prepare($sql);
		$result = $stmtinsert->execute([$this->first, $this->last,$this->user, $this->email,$this->number,$this->city,$this->address,$this->zip, $this->tel, $this->pass]);
    }
}
?>