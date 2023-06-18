<?php
    
    /***
     * @author Subhankar Sarkar
     * @name Database
     * @params none
     * @description returns all database related datas
     */
    //Database Class
    
    /***
     * 
     * Manual
     * @name : Query(string)         -> Execute a query, returns true on successful execution, false on error
     * @name : CountRows(string)     -> Retuns number of rows
     * @name : RetriveSingle(string) -> Retuns data object of single row
     * @name : RetriveArray(string)  -> Retuns data object of multiple rows
     * @name : CheckUnique(value,column,table_name) -> check if value is unique in a column of a table
     */

    Class Database{
        
        public $connection; //Connection Object

        public $query; //Query String
        
        public $query_count = 0; //Query Count
        
        public $error;
        
        //Default Constructor 
        
        public function __consrtuct(){}
        
        //Database Connection
        
        public function Connect(){
        
            $this->connection=new mysqli("localhost","root","","crcs");
        }
        
        //Query Handling
        
        public function Query($query){
        
            $this->Connect();
        
            //Execute query
            if($this->connection->query($query)){
                return true; //Returns TRUE on successful execution
            }else{
                return false; //Returns FALSE on unsuccessful execution
            }
        
        }
        //Retrive Data
        public function RetriveSingle($query){
        
            $this->Connect();
        
            //Executing query
            $res=$this->connection->query($query);
        
            //Fetching data
            $data=$res->fetch_assoc();
        
            //Return data
            return $data;

        }
        //Retrive Array
        public function RetriveArray($query){
            
            $this->Connect();
            
            //Executing query
            $res=$this->connection->query($query);
            
            //Response
            $response=array();
            
            //Fetching data
            while($data=$res->fetch_array(MYSQLI_ASSOC)){
            // while($data=$res->fetch_all(MYSQLI_ASSOC)){
                array_push($response,$data);
            }
            
            //Return data
            return $response;
        
        }
        //Count Rows
        public function CountRows($query){
            $this->Connect();
            //Executing query
            $res=$this->connection->query($query);
            //Fetching data
            $data=$res->num_rows;
            //Return data
            return $data;
        }
        //Count Rows
        public function CheckUnique($value,$column,$table){
            $this->Connect();
            //query
            $query="SELECT * FROM `".$table."` WHERE `".$column."`='".$value."' ";
            //Executing query
            $res=$this->connection->query($query);
            //Fetching data
            if(!$res->num_rows){
                return true;
            }else{
                return false;
            }
        }
    }
  
?>