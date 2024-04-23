<?php
   include ('cConstants.php');
class cConections extends cConstants{
    private  $connection = FALSE;

    public function __construct()
    {
        $conn = new cConstants();
        if (! $this->connection) {
            $conn = new mysqli($conn->host, $conn->ursql, $conn->pass, $conn->db);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            } else {
                $this->connection = $conn;
            }
        }
    }

    public  function stmtExecution($mysql, $tPr, $vPr)
    {
        try {
            $connection = $this->connection;
            $connection->set_charset('utf8');
            $stmt = $connection->prepare($mysql);
            $stmt->bind_param($tPr, ...$vPr);
            $stmt->execute();
        } catch (Exception $e) {
            die(json_encode(array(
                'error' => $e->getMessage()
            )));
        }
        return $stmt;
    }
}