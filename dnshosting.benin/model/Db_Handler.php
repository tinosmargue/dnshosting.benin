<?php

class Db_Handler
{
	
	private $conn;
	private $racine;
	private $racine1;
	function __construct()
	{
	require_once ('Db_Connect.php');
	$db=new Db_Connect();
	$this->conn=$db->connect();	
	}

	public function isLoginUser($email,$pass){
		$req1="SELECT COUNT(*) FROM users WHERE email=? AND pass=?";				
		$sql1=$this->conn->prepare($req1);
		$response1=$sql1->execute(array($email,$pass));
					
				if($response1)
				{				
						if($sql1->fetchColumn()>0)
						{
						
						$req1=null;
						$sql1=null;
						$response1=null;
								$req="SELECT * FROM users WHERE email=? AND pass=?";
								$sql=$this->conn->prepare($req);
								$response=$sql->execute(array($email,$pass));
									if($response)
									{
												$row=array();
												$result=array();
												$donne=$sql->fetch();
												$row['id']=$donne['id'];
												$sql->closeCursor();
												$req=null;
												$sql=null;
						                        $response=null;
												return $row["id"];
											
									}	
									else
									{
									return 'erreur';
									}
						}
						else
						{
						$req1=null;
						$sql1=null;
						$response1=null;
						return false;
						}
				
				}
				else
				{
				return 'erreur';
				}
		
	}

    public  function saveDns($nom,$prenom,$email,$domain){
     $req="INSERT INTO users (nom,prenom,email,domain,create_at) VALUES (?,?,?,?,NOW())";
		 $sql=$this->conn->prepare($req);
		 $response=$sql->execute(array($nom,$prenom,$email,$domain));
			if($response)
			{
					if($sql->rowCount()>0)
					{
					return true;
					}
					else
					{
					return $sql->errorInfo();
					}
			}
			else{
				echo "Erreur";
			}
	
    }

    public function getUser($email,$pass){
			$req1="SELECT COUNT(*) FROM users WHERE email=? AND pass=?";				
		$sql1=$this->conn->prepare($req1);
		$response1=$sql1->execute(array($email,$pass));
					
				if($response1)
				{				
						if($sql1->fetchColumn()>0)
						{
						
						$req1=null;
						$sql1=null;
						$response1=null;
								$req="SELECT * FROM users WHERE email=? AND pass=?";
								$sql=$this->conn->prepare($req);
								$response=$sql->execute(array($email,$pass));
									if($response)
									{
												$row=array();
												$result=array();
												$donne=$sql->fetch();
												$row['id']=$donne['id'];
												$row['nom']=$donne['nom'];
												$row['prenom']=$donne['prenom'];
												$row['email']=$donne['email'];
												$row['domain']=$donne['domain'];
												$row['create_at']=$donne['create_at'];
												$row['adress']=$donne['adress'];
												$row['nbrAn']=$donne['nbrAn'];
												$row['ns1']=$donne['ns1'];
												$row['ns2']=$donne['ns2'];
												$row['pass']=$donne['pass'];
												
												$sql->closeCursor();
												$req=null;
												$sql=null;
						                        $response=null;
												return $row;
											
									}	
									else
									{
									
									return 'erreur';
									}
						}
						else
						{
						$req1=null;
						$sql1=null;
						$response1=null;
						return 'vide';
						}
				
				}
				else
				{
				
				return 'erreur';
				}
     
	}


    public  function saveOnlyDns($domain){
     $req="INSERT INTO domain (domain) VALUES (?)";
		 $sql=$this->conn->prepare($req);
		 $response=$sql->execute(array($domain));
			if($response)
			{
					if($sql->rowCount()>0)
					{
					return true;
					}
					else
					{
					return $sql->errorInfo();
					}
			}
			else{
				echo "Erreur";
			}
	
    }

    public function checkDnsExists($domain){
		$req1="SELECT COUNT(*) FROM domain WHERE domain=?";				
		$sql1=$this->conn->prepare($req1);
		$response1=$sql1->execute(array($domain));
					
				if($response1)
				{		

						if($sql1->fetchColumn()>0)
						{
						
						return true;
						}
						else
						{
						$req1=null;
						$sql1=null;
						$response1=null;
						return false;
						}
				
				}
				else
				{
				return 'erreur';
				}
	}
    
    
}

?>