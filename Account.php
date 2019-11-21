<?php

class Account
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createAccountTest()
    {
        $sql = "INSERT INTO `accounts` (`id`, `first_name`, `last_name`, `username`, `email`, `number`, `city`, `address`, `zip`, `tel`, `password`) VALUES (NULL, 'buildtest', 'buildtest', 'buildtest', 'buildtest', '12', 'buildtest', 'buildtest', '1234', '1234', 'buildtest')";
        $this->pdo->query($sql);
        return '';
    }
}
