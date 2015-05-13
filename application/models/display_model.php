<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display_model extends CI_Model {

    public $pdo;

    public function __construct() 
    {
        parent::__construct();
        $dsn = 'sqlite:'.APPPATH.'../../../database.db';
        $this->pdo = new PDO($dsn);          
    }

    public function get_status() 
    {
        $status = array();

        $query = "SELECT * FROM event";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        { 
            $result->execute();
            $res = $result->fetchAll();
            $num = 0;
            foreach ($res as $key => $value) 
            {
                $event = $value['eve'];
                for ($i=0; $i<strlen($event); $i++)
                {   
                    $event_kinds = array('0', '1', '2', '3', '7', '11');
                    if (substr($event, $i, 1) == "1" && in_array("$i", $event_kinds))
                    {
                        $status[$num]['event'] = "$i";
                        $status[$num]['inverter_id'] = $res[$key]['device']; 
                        $status[$num]['date'] = $res[$key]['date'];
                        $num++;
                    }
                }
            }
        }

        $data['status'] = $status;
      
        return $data;
    }

    public function get_status2() 
    {
        $status = array();

        $query = "SELECT * FROM event";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        { 
            $result->execute();
            $res = $result->fetchAll();
            $num = 0;
            foreach ($res as $key => $value) 
            {
                $event = $value['eve'];
                for ($i=0; $i<strlen($event); $i++)
                {   
                    $event_kinds = array('0', '1', '2', '3', '7', '11', '13', '14', '15', '16',);
                    if (substr($event, $i, 1) == "1" && in_array("$i", $event_kinds))
                    {
                        $status[$num]['event'] = "$i";
                        $status[$num]['inverter_id'] = $res[$key]['device']; 
                        $status[$num]['date'] = $res[$key]['date'];
                        $num++;
                    }
                }
            }
        }

        $data['status'] = $status;
      
        return $data;
    }

    /* 获取数据库数据 */
    public function get_database($table)
    {
        //查询数据库中的所有表名
        $table_name = array();
        $query = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY name";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        { 
            $result->execute();
            $res = $result->fetchAll();
            foreach ($res as $key => $value) {
                $table_name[$key] = $value[0];
            }
        }

        //查询数据库中某张表中的数据
        $table_value = array();
        $query = "SELECT * FROM $table";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        { 
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            $table_value = $res;
        }

        $data['table_name'] = $table_name;
        $data['table_value'] = $table_value;

        return $data;
    }

    /* 获取历史数据库数据 */
    public function get_historical_data($table)
    {
        //重新连接历史数据库
        $dsn = 'sqlite:'.APPPATH.'../../../historical_data.db';
        $this->pdo = new PDO($dsn); 

        //查询数据库中的所有表名
        $table_name = array();
        $query = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY name";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        { 
            $result->execute();
            $res = $result->fetchAll();
            foreach ($res as $key => $value) {
                $table_name[$key] = $value[0];
            }
        }

        //查询数据库中某张表中的数据
        $table_value = array();
        if(!strncmp($table, "lifetime_energy", 15))
            $query = "SELECT * FROM $table ";
        else
            $query = "SELECT * FROM $table ORDER BY date DESC";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        { 
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            $table_value = $res;
        }

        $data['table_name'] = $table_name;
        $data['table_value'] = $table_value;

        return $data;
    }
    
    /* 获取record数据库数据 */
    public function get_record($table)
    {
        //重新连接record数据库
        $dsn = 'sqlite:'.APPPATH.'../../../record.db';
        $this->pdo = new PDO($dsn);
    
        //查询数据库中的所有表名
        $table_name = array();
        $query = "SELECT name FROM sqlite_master WHERE type='table' ORDER BY name";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        {
            $result->execute();
            $res = $result->fetchAll();
            foreach ($res as $key => $value) {
                $table_name[$key] = $value[0];
            }
        }
    
        //查询数据库中某张表中的数据
        $table_value = array();
        $query = "SELECT * FROM $table ORDER BY date_time DESC LIMIT 1,2000";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        {
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            $table_value = $res;
        }
    
        $data['table_name'] = $table_name;
        $data['table_value'] = $table_value;
    
        return $data;
    }

}


/* End of file display_model.php */
/* Location: ./application/models/display_model.php */