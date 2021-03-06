<?php

class PDOLayer{
	
    protected $_connection;
    protected $_className;
    protected $_classProps;
    protected $_insert;
    protected $_update;
    protected $_delete;
    protected $_selectOne;
    protected $_selectAll;
    //protected $_DBName = 'squad.com.db';
    protected $_DBName = 'epiz_28582191_squad_ecommerce';
    protected $_additions = ['ID'];
    protected $_exclusions = ['_connection','_className','_classProps','_exclusions','_additions','_DBName','_insert','_update','_delete','_selectOne','_selectAll'];//list PDOLayer properties here
    
    public function __construct(PDO $connection = null)
    {
        $this->_connection = $connection;
        if ($this->_connection === null) {
            //$this->_connection = new PDO('mysql:host=localhost;dbname=' . $this->_DBName, 'root', '');
            $this->_connection = new PDO('mysql:host=sql308.epizy.com;dbname=' . $this->_DBName, 'epiz_28582191', 'Lk1Clj82Ph');

            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        $this->getInfo();
    }

    public function prepare($statement){
        return $this->_connection->prepare($statement);
    }

    public function find($ID)
    {
        $stmt = $this->_connection->prepare($this->_selectOne);
        $stmt->execute(array($ID));
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        return $stmt->fetch();
    }

    public function where($assocArray)
    {
        $SQL = $this->_selectAll . ' WHERE ';
        $first = true;
        foreach($assocArray as $key => $value){
            if(!$first)
                $SQL .= 'AND ';
            else
                $first = false;
            $SQL .= "$key=:$key ";
        }
        $stmt = $this->_connection->prepare($SQL);
        $stmt->execute($assocArray);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }


    public function findAll()
    {
        $stmt = $this->_connection->prepare($this->_selectAll);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
        	$returnVal[] = $rec;
        }
        return $returnVal;
    }

	public function toArray(){
        $data = [];
        foreach($this->_classProps as $prop)
            $data[$prop] = $this->$prop;
        return $data;
    }

    public function toArrayUpdate($array){

        $data = [];
        foreach($this->_classProps as $prop){
            if(!in_array($prop,$array)){
                $data[$prop] = $this->$prop;
            }
        }
        return $data;
    }
    
    public function toJSON(){
        return json_encode($this->toArray());
    }


    public function insert(){
        $stmt = $this->_connection->prepare($this->_insert);
        $stmt->execute($this->toArray());
	}

	public function update(){
        $stmt = $this->_connection->prepare($this->_update);
        var_dump($stmt);
        $stmt->execute($this->toArray());

	}

	public function delete(){
        $stmt = $this->_connection->prepare($this->_delete);
        $stmt->execute(array($this->ID));
	}

	public function getInfo(){
		//extract the deriving class name
        $this->_className = get_class($this);
        
        //extract the deriving class properties
        $this->_classProps = [];
		$array = get_object_vars($this);
		foreach ($array as $key => $value) {
			if(!in_array($key, $this->_exclusions))
				$this->_classProps[] = $key;
		}
        
        //count the deriving class properties, and prepare CRUD operations as appropriate
		$num = count($this->_classProps);
		if ($num  > 0){
			$this->_insert 	= 'INSERT INTO ' . $this->_className . '(' . implode(',', $this->_classProps) . ') VALUES (:'. implode(',:', $this->_classProps) . ')';
			$this->_update 	= 'UPDATE ' . $this->_className . ' SET ' . implode(' = ?, ', $this->_classProps) . ' = ? WHERE ID = ?';
//			$this->_update 	= 'UPDATE ' . $this->_className . ' SET ' . implode(' = ?, ', $this->_classProps) . ' = ? WHERE ID = ?';
		}
		$this->_delete 		= "DELETE FROM $this->_className WHERE ID = ?";
		$this->_selectOne 	= "SELECT * FROM $this->_className WHERE ID = ?";
		$this->_selectAll 	= "SELECT * FROM $this->_className";
	}

    public function lastIndex()
    {
        return $this->_connection->lastInsertId();
    }
}
?>