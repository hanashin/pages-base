<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Management_model extends CI_Model {

    public $pdo;

    public function __construct() 
    {
        parent::__construct();
        $dsn = 'sqlite:'.APPPATH.'../../../database.db';
        $this->pdo = new PDO($dsn);          
    }

    /* 获取逆变器ID列表 */
    public function get_id() 
    {
        $temp = array();

        $query = "SELECT id FROM id";
        $result = $this->pdo->prepare($query);
        if(!empty($result))
        {
            $result->execute();
            $res = $result->fetchAll();
            foreach ($res as $key => $value) {
            	$temp[$key] = $value[0];
            }
        }
        
        $data['ids'] = $temp;

        return $data;
    }

    /* 设置逆变器ID列表 */
    public function set_id() 
    {
        //用于保存逆变器ID的数组
        $results = array();
        $ids = array();
        $error_ids = array();
        
    	//若输入为空，则保存错误标志，退出该函数
    	if(!($this->input->post('ids'))) {
    	    $results["value"] = 2; // 输入为空
    	    return $results;
    	}
    	//将textarea中的每一行数据存入数组
		$temp = preg_split('/\n/', $this->input->post('ids'));
// 		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
// 		    $temp = preg_split('/\r\n/', $this->input->post('ids'));
// 		}

        //检验数据格式(是否为12位纯数字)
        foreach ($temp as $key => $id) 
        {
            if(ctype_digit($id) && (strlen($id)==12))
            {
                array_push($ids, $id);
            }
            else if(strlen($id))
            {
                array_push($error_ids, $id);
            }
        }

        //保存ID并删除重复的ID
        $results['ids'] = array_unique($ids);

        //保存格式错误的ID
        $results['error_ids'] = $error_ids;

        //将正确的ID加入数据库
        if(count($results['ids']))
        {
            $this->pdo->exec("DELETE FROM id");
            foreach ($results['ids'] as $key => $id) 
            {
                $this->pdo->exec("INSERT INTO id (item,id,flag) VALUES($key, \"$id\", 0)");
            }     
            //power表(注：最好能设置power表的主键为id,采用replace添加新的逆变器)
            $query = "SELECT item FROM power";
            $result = $this->pdo->prepare($query);            
            if(!empty($result)){
                $result->execute();
                $res = $result->fetchAll();
                $item = count($res);
            }
            foreach ($results['ids'] as $key => $id) {
                $query = "SELECT id FROM power WHERE id='$id'";
                $result = $this->pdo->prepare($query);
                if(!empty($result)){
                    $result->execute();
                    $res = $result->fetchAll();
                    if(!count($res)){
                        //注：flag为0说明初始时并不设置最大功率，是否先不写进power表，用join查找id与power表，并显示默认值250
                        //当需要设置时再写入power表？（提高inputid页面的速度）
                        $this->pdo->exec("INSERT INTO power VALUES($item, \"$id\", 250, '-', 250, '-', 0)");
                        $item++;
                    }
                }
            }
            system('killall main.exe');
            $fp = @fopen("/etc/yuneng/autoflag.conf", 'w');
            if($fp){
                fwrite($fp, "0");
                fclose($fp);
            }           
            $fp = @fopen("/etc/yuneng/reconfigtn.conf", 'w');
            if($fp){
                fwrite($fp, "1");
                fclose($fp);
            }
            $fp = @fopen("/etc/yuneng/presetdata.txt", 'w');
            if($fp){
                fclose($fp);
            }
            
            if(!empty( $results['error_ids'])) {
                $results["value"] = 1; // 存在错误ID
            }
            else {
                $results["value"] = 0; // 保存逆变器成功,没有错误的ID
            }
            

        /* 将ECU本地页面变动数据存入数据库 */
            //创建表单
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS process_result
                (item INTEGER, result VARCHAR, flag INTEGER, 
                primary key(item))");
            
            //ECU_id
            $ecuid = "000000000000";
            $fp = @fopen("/etc/yuneng/ecuid.conf",'r');
            if($fp)
            {
                $ecuid = fgets($fp);
                fclose($fp);
            }

            //ECU_version
            $version = "unknow";        
            $fp = @fopen("/etc/yuneng/version.conf",'r');
            if($fp)
            {
                $version = fgets($fp);
                fclose($fp);
            }

            //ECU_version_number
            $version_number = "";        
            $fp = @fopen("/etc/yuneng/version_number.conf",'r');
            if($fp)
            {
                $version_number = fgets($fp);
                fclose($fp);
            }

            //当前逆变器数量
            $num = sprintf("%03d", count($results['ids']));

            //初始化消息体
            if(strlen($version_number))
            {
                $length = sprintf("%02d",strlen($version)+2+strlen($version_number));
                $record = "APS1300000A102AAA0".$ecuid.$length.$version."--".$version_number.$num."00000000000000END";
            }
            else
            {
                $length = sprintf("%02d",strlen($version));
                $record = "APS1300000A102AAA0".$ecuid.$length.$version.$num."00000000000000END";
            }

            //当前逆变器ID
            foreach ($results['ids'] as $value) {
                $record = $record.$value."00"."00000"."END";
            }

            //计算消息长度并加上回车符号
            $record_length = sprintf("%05d", strlen($record));
            $record = substr_replace($record, $record_length, 5, 5);
            $record = $record."\n";
            
            //将消息保存到数据库
            $sql = "REPLACE INTO process_result (item, result, flag) VALUES(102, '$record', 1)";
            $this->pdo->exec($sql);
        }
        else {
            $results["value"] = 1; // 存在错误ID
        }

        return $results;
    }

     /* 清空逆变器列表 */
    public function set_id_clear()
    {
        $results = array();

        //清空逆变器列表 
        $this->pdo->exec("DELETE FROM id");
        system('killall main.exe');

        $results["value"] = 0;

        return $results;   
    }

    /* 获取时间信息 */
    public function get_datetime() 
    {        
        $data = array();

        //获取ECU当前设置的时区
        $data['timezone'] = "Asia/Shanghai";
        $fp = @fopen("/etc/yuneng/timezone.conf",'r');
        if ($fp)
        {
          $data['timezone'] = fgets($fp);
          fclose($fp);
        }
        date_default_timezone_set($data['timezone']);//设置默认时区

        //获取ECU当前设置的NTP服务器
        $data['ntp'] = "0.asia.pool.ntp.org";
        $fp = @fopen("/etc/yuneng/ntp_server.conf",'r');
        if ($fp)
        {
          $data['ntp'] = fgets($fp);
          fclose($fp);
        }

        return $data;
    }

    /* 设置日期时间 */
    public function set_datetime() 
    {
        $results = array();

        //读取当前时区
        $timezone = "Asia/Shanghai";
        $fp = @fopen("/etc/yuneng/timezone.conf",'r');
        if ($fp)
        {
          $timezone = fgets($fp);
          fclose($fp);
        }

        //读取输入日期时间
        $datetime = $this->input->post('datetime');

        //将日期转换成时间戳
        date_default_timezone_set($timezone);
        if($timestamp = strtotime($datetime))
        {
            //将时间保存至系统文件/dev/rtc2
            $datetime = getdate($timestamp);
            $save_datetime = sprintf("%04d%02d%02d%02d%02d%02d",
                    $datetime['year'], $datetime['mon'], $datetime['mday'],
                    $datetime['hours'], $datetime['minutes'], $datetime['seconds']);
            $fp = @fopen("/dev/rtc2", 'w');
            if($fp)
            {
                fwrite($fp, $save_datetime);
                fclose($fp);
            }

            //设置linux系统时间
            //date_default_timezone_set("UTC");
            $datetime = getdate($timestamp);
            $cmd = sprintf("date %02d%02d%02d%02d%04d.%02d",
                    $datetime['mon'], $datetime['mday'], $datetime['hours'],
                    $datetime['minutes'], $datetime['year'], $datetime['seconds']);
            exec($cmd);

            $results["value"] = 0;
            
            //重启主函数和客户端函数
            system("killall main.exe");
            system("killall client");
        }
        else
        {
            //格式错误，转换为时间戳失败
            $results["value"] = 1;
        }

        return $results;
    }

    /* 设置时区 */
    public function set_timezone() 
    {
        $results = array();

        //获取页面选择的时区 
        $timezone = $this->input->post('timezone');      

        //设置linux系统时区
        $cmd = "cp /usr/share/zoneinfo/$timezone /etc/localtime";
        system($cmd);

        //将时区保存到配置文件
        $fp = @fopen("/etc/yuneng/timezone.conf",'w');
        if($fp){
            fwrite($fp, $timezone);
            fclose($fp);
        }        

        //重启主函数和客户端函数
        //system("/home/application/ntpapp.exe");
        system("killall main.exe");
        system("killall client");

        $results["value"] = 0;      

    /* 将ECU本地页面变动数据存入数据库 */
        //ECU_id
        $ecuid = "000000000000";
        $fp = @fopen("/etc/yuneng/ecuid.conf",'r');
        if($fp)
        {
            $ecuid = fgets($fp);
            fclose($fp);
        }

        //ECU本地时间
        date_default_timezone_set($timezone);
        $localtime_assoc = localtime(time(), true);
        $local_time = sprintf("%04d%02d%02d%02d%02d%02d",
                            $localtime_assoc['tm_year'] + 1900,
                            $localtime_assoc['tm_mon'] + 1,
                            $localtime_assoc['tm_mday'],
                            $localtime_assoc['tm_hour'],
                            $localtime_assoc['tm_min'],
                            $localtime_assoc['tm_sec']
                            );

        //初始化消息体
        $record = "APS1300000A104AAA0".$ecuid.$local_time."00000000000000".$timezone."END";

        //计算消息长度并加上回车符号
        $record_length = sprintf("%05d", strlen($record));
        $record = substr_replace($record, $record_length, 5, 5);
        $record = $record."\n";

        //将消息保存到数据库
        $sql = "REPLACE INTO process_result (item, result, flag) VALUES(104, '$record', 1)";
        $this->pdo->exec($sql);

        return $results;
    }

    /* 设置NTP服务器 */
    public function set_ntp_server() 
    {        
        $results = array();

        //获取页面输入的NTP服务器地址
        $ntp = $this->input->post('ntp');

        //保存NTP服务器地址
        $fp = @fopen("/etc/yuneng/ntp_server.conf",'w');
        if($fp)
        {
            fwrite($fp, $ntp);
            fclose($fp);
            $results["value"] = 0;
        }
        else 
        {
            $results["value"] = 1;
        }

        return $results;
    }

    /* 获取语言信息 */
    public function get_language() 
    {        
        $data = array();

        $data['language'] = "english";
        $fp = @fopen("/etc/yuneng/language.conf",'r');
        if ($fp)
        {
          $data['language'] = fgets($fp);
          fclose($fp);
        }
        else if($this->session->userdata("language"))
        {
            $data['language'] = $this->session->userdata("language");
        }

        return $data;
    }

    /* 设置语言信息 */
    public function set_language()
    {
        $results = array();
               
        $language = $this->input->post('language');
        $this->session->set_userdata("language", $language);
        
        $fp = @fopen("/etc/yuneng/language.conf",'w');
        if ($fp){
          fwrite($fp, $language);
          fclose($fp);
          $results["value"] = 0;
        }
        else{
            //文件打开失败
            $results["value"] = 1;
        }       

        return $results;
    }

    /* 获取ECU网络配置 */
    public function get_network() 
    {        
        $data = array();

        //获取GPRS标志位
        $data['gprs'] = 0;
        $fp = @fopen("/etc/yuneng/gprs.conf",'r');
        if ($fp)
        {
          $data['gprs'] = intval(fgets($fp)); 
          fclose($fp);
        }

        //获取DHCP标志位
        $data['dhcp'] = 1;
        $fp = @fopen("/etc/yuneng/dhcp.conf",'r');
        if ($fp)
        {
           $data['dhcp'] = intval(fgets($fp));          
          fclose($fp);
        }

        //获取静态IP地址信息
        $ip = "";
        $mask = "";
        $gate = "";
        $dns1 = "";
        $dns2 = "";

        if ($data['dhcp'] == 0)
        {
            $fp = fopen("/etc/network/interfaces", 'r');
            if ($fp) 
            {
                while(!feof($fp))
                {
                    $temp = fgets($fp);
                    if(!strncmp($temp, "address", 7))
                    {
                        $ip = substr($temp, 8);
                    }
                    if(!strncmp($temp, "netmask", 7))
                    {
                        $mask = substr($temp, 8);
                    }
                    if(!strncmp($temp, "gateway", 7))
                    {
                        $gate = substr($temp, 8);
                    }
                }
                fclose($fp);
            }
            $fp = fopen("/etc/resolv.conf", 'r');
            if ($fp) 
            {
                $temp = fgets($fp);
                if(!strncmp($temp, "nameserver", 10))
                {
                    $dns1 = substr($temp, 11);
                }
                $temp = fgets($fp);
                if(!strncmp($temp, "nameserver", 10))
                {
                    $dns2 = substr($temp, 11);
                }
 
                fclose($fp); 
            }
        }
        $data['ip'] = $ip;
        $data['mask'] = $mask;
        $data['gate'] = $gate;
        $data['dns1'] = $dns1;
        $data['dns2'] = $dns2;

        return $data;
    }

    /* 设置GPRS */
    public function set_gprs() 
    {        
        $results = array();

        //获取GPRS设置选项
        $gprs = $this->input->post('gprs');
        if($gprs == "true")
            $gprs = "1";
        else
            $gprs = "0";
        $results["gprs"] = $gprs;

        //将标志位写入文件
        $fp = @fopen("/etc/yuneng/gprs.conf",'w');
        if ($fp)
        {
            fwrite($fp, $gprs);
            fclose($fp);
            $results["value"] = 0;
        }
        else{
            $results["value"] = 1;
        }
        //重启主函数
        //system("killall main.exe");      
        return $results;
    }

    /* 设置IP */
    public function set_ip() 
    {
        $results = array();
        
        //获取DHCP设置选项
        $dhcp = $this->input->post('dhcp');
        
        if($dhcp == "1")
        {   
            //使用动态IP地址       
            //保存DHCP状态
            $fp = @fopen("/etc/yuneng/dhcp.conf",'w');
            if($fp){
                fwrite($fp, $dhcp);
                fclose($fp);
            }
//             echo "<!--";
//             system("killall udhcpc");
//             system("/sbin/udhcpc &");
//             echo "-->";

            //重启ECU
            system("/sbin/reboot");
            $results["value"] = 0;            
        }
        else if($dhcp == "0")
        {
            //使用静态IP地址
            //获取静态IP地址信息
            $ip = $this->input->post('ip');
            $mask = $this->input->post('mask');
            $gate = $this->input->post('gate');
            $dns1 = $this->input->post('dns1');
            $dns2 = $this->input->post('dns2');

            //将静态IP地址信息写入文件
            $fp = @fopen("/etc/network/interfaces", 'w');
            if($fp){
                fwrite($fp, "auto lo\n");
                fwrite($fp, "iface lo inet loopback\n");
                fwrite($fp, "auto eth0\n");
                fwrite($fp, "iface eth0 inet static\n");
                fwrite($fp, "address ".$ip."\n");
                fwrite($fp, "netmask ".$mask."\n");
                fwrite($fp, "gateway ".$gate."\n");
                fclose($fp);
            }            

            $fp = @fopen("/etc/yuneng/resolv.conf", 'w');
            if($fp){
                fwrite($fp, "nameserver ".$dns1."\n");
                if (strlen($dns2)) {
                    fwrite($fp, "nameserver ".$dns2."\n");
                }
                fclose($fp);
            }
            system("cp /etc/yuneng/resolv.conf /etc/");

            //保存DHCP状态
            $fp = @fopen("/etc/yuneng/dhcp.conf",'w');
            if($fp){
                fwrite($fp, $dhcp);
                fclose($fp);
            }
//             echo "<!--";
//             system("killall network.exe");
//             system("killall udhcpc");
//             system("/etc/init.d/S40network stop");
//             sleep(1);
//             system("/etc/init.d/S40network start");
//             system("killall main.exe");
//             echo "-->";

            //重启ECU
            system("/sbin/reboot");
            $results["value"] = 0;
        }       
        return $results;
    }

    /* 获取无线局域网信息 */
    public function get_wlan()
    {      
        $data = array();
        $data['ssid'] = "-";
        $data['ifconnect'] = 0;
        $data['ap_info']['ssid'] = "";
        $data['ap_info']['channel'] = 0;
        $data['ap_info']['method'] = 0;
        $data['ap_info']['psk'] = "";
        $data['wifi_signals'] = "";
        $data['num'] = 0;

        //获取wifi模块工作模式
        $data['mode'] = 1;//默认为主机模式
        $fp = @fopen("/etc/yuneng/wifi_stat.conf", 'r');
        if($fp)
        {
            $data['mode'] = intval(fgets($fp));
            fclose($fp);
        }

        if($data['mode'] == 1)
        {
            /* 主机模式 */
            //读取主机模式参数
            $fp = @fopen("/etc/yuneng/wifi_ap_info.conf", 'r');
            if($fp)
            {
                while(!feof($fp))
                {
                    $temp = fgets($fp);
                    if(strncmp($temp, "#", 1))
                        break;
                    if(!strncmp($temp, "#SSID", 5))
                    {
                        $temp = substr($temp, 6);
                        sscanf($temp, "%[^\n]", $data['ap_info']['ssid']);
                    }
                    if(!strncmp($temp, "#channel", 8))
                    {
                        $temp = substr($temp, 9);
                        $data['ap_info']['channel'] = intval($temp);
                    }
                    if(!strncmp($temp, "#method", 7))
                    {
                        $temp = substr($temp, 8);
                        $data['ap_info']['method'] = intval($temp);
                    }
                    if(!strncmp($temp, "#psk", 4))
                    {
                        $temp = substr($temp, 5);
                        sscanf($temp, "%[^\n]", $data['ap_info']['psk']);
                    }
                }
            }
        }
        else if($data['mode'] == 2)
        {
            /* 从机模式 */            
            //获取wifi信号名称
            system("/usr/sbin/iwconfig | grep -E \"wlan0\">/tmp/wifi_temp.conf");
            $fp = @fopen("/tmp/wifi_temp.conf", 'r');
            if($fp)
            {
                $temp = fgets($fp);
                $temp = strstr($temp, "ESSID");
                if(!strncmp($temp, "ESSID", 5))
                {
                    $temp = substr($temp, 7);
                    sscanf($temp, "%[^\"]", $data['ssid']);
                    $data['ifconnect'] = 1;
                }
                fclose($fp);
            }
            
            //获取ip
            $data['ip'] = "-";
            if(strncmp($data['ssid'], "-", 1))
            {
                system("/sbin/ifconfig wlan0 | grep -E \"inet addr\" >/tmp/wifi_temp.conf");
                $fp = fopen("/tmp/wifi_temp.conf", 'r');
                if($fp)
                {
                    $temp = fgets($fp);
                    if(strlen($temp))
                    {
                        $temp = substr($temp, 20);
                        sscanf($temp, "%[^ ]", $data['ip']);
                    }
                    fclose($fp);
                }
            }

            //扫描无线信号，筛选出SSID、信号强度、加密方式并保存到临时文件
            system("/usr/sbin/iwlist scan | grep -E \"SSID|Quality|Encryption|Group\" | sed 's/^ *//' >/tmp/wifi_temp.conf");

            //读取扫描到的wifi信号及信息
            $data['wifi_signals'] = "";
            $num = 0;
            $fp = @fopen("/tmp/wifi_temp.conf", 'r');
            //$fp = fopen(APPPATH.'../../wifi_temp.conf', 'r');
            if($fp)
            {
                $num = -1;
                while(!feof($fp))
                {
                    $temp = fgets($fp);
                    if(!strncmp($temp, "ESSID", 5))
                    {
                        $temp = substr($temp, 7);
                        sscanf($temp, "%[^\"]", $data['wifi_signals'][$num+1]['ssid']);
                        $data['wifi_signals'][$num+1]['quality'] = "";
                        $data['wifi_signals'][$num+1]['ifkey'] = "";
                        $data['wifi_signals'][$num+1]['group'] = "";
                        $num++;
                    }
                    if(!strncmp($temp, "Quality", 7))
                    {
                        $temp = substr($temp, 8, 2);
                        $data['wifi_signals'][$num]['quality'] = intval($temp);
                    }
                    if(!strncmp($temp, "Encryption key", 14))
                    {
                        $temp = substr($temp, 15);
                        sscanf($temp, "%[^\n]", $ifkey);
                        if(!strncmp($ifkey, "on", 2))
                            $data['wifi_signals'][$num]['ifkey'] = 1;
                        else
                            $data['wifi_signals'][$num]['ifkey'] = 0;  
                    }
                    if(!strncmp($temp, "Group Cipher", 12))
                    {
                        $temp = substr($temp, 15);
                        sscanf($temp, "%[^\n]", $data['wifi_signals'][$num]['group']);
                    }
                }
                $num++;
                fclose($fp);
            }
            $data['num'] = $num;
        }
        return $data;
    }

    /* 设置wifi模块工作模式 */
    public function set_wlan_mode()
    {
        $results =array();
        //获取wifi工作模式      
        $mode = $this->input->post('mode');
        if($mode == 0) {           
            //断开wifi连接
            system("killall wpa_supplicant");
            //关闭AP
            system("killall udhcpd");
            system("killall hostapd");
            
            //将工作模式记录到配置文件
            $fp = @fopen("/etc/yuneng/wifi_stat.conf", 'w');
            if ($fp) {
                fwrite($fp, $mode);
                fclose($fp);
            }
        }
        if($mode == 1) {
        /* 将wifi工作切换至AP模式 */

            //将工作模式记录到配置文件
            $fp = @fopen("/etc/yuneng/wifi_stat.conf", 'w');
            if ($fp) {
                fwrite($fp, $mode);
                fclose($fp);
            }

//             //断开wifi连接
//             system("killall wpa_supplicant");
//             usleep(1000);

//             //设置模式为主机模式
//             system("/usr/sbin/iwconfig wlan0 mode master");
//             usleep(1000);

//             //设置主机IP地址
//             system("/sbin/ifconfig wlan0 192.168.0.1");
//             usleep(1000);

//             //建立AP    
//             $ret = system("/usr/sbin/hostapd /etc/yuneng/wifi_ap_info.conf -B");
//             if(NULL != $ret)
//             {
//                 $data['result'] = "failed_change_mode";
//                 return $data;
//             }
//             usleep(10000);

//             if(!$ret)
//             {
//                 //自动为连接的设备分配IP
//                 system("/usr/sbin/udhcpd /etc/yuneng/udhcpd_wlan0.conf");
//                 usleep(1000);

//                 $data['result'] = "success_change_mode";
//             }
            //重启ECU
            system("/sbin/reboot");
        }

         if($mode == 2) {
         /* 将wifi工作切换至STA模式 */

            //将工作模式记录到配置文件
            $fp = @fopen("/etc/yuneng/wifi_stat.conf", 'w');
            if ($fp) {
                fwrite($fp, $mode);
                fclose($fp);
            }
            
//             //关闭AP
//             system("killall udhcpd");
//             system("killall hostapd");

//             //卸载模块驱动
//             system("/sbin/rmmod ar6000");
//             usleep(10000);

//             //加载模块驱动
//             system("/sbin/insmod /home/modules/ar6000.ko fwpath=/home/");
//             usleep(10000);
            
//             //设置模式为从机模式
//             system("/usr/sbin/iwconfig wlan0 mode managed");
//             usleep(1000);

//             //连接路由器
//             $ret = system("/usr/sbin/wpa_supplicant -Dwext -i wlan0 -c /etc/yuneng/wifi_signal_info.conf -B");
//             sleep(1);

//             if(!$ret)
//             {
//                 //向路由器请求分配IP地址
//                 echo "<!--";
//                 $flag = system("/sbin/udhcpc -nq -i wlan0");
//                 echo "-->";
//                 sleep(1);
//                 if(!$flag)
//                 {
//                     //连接成功
//                     $data['result'] = "success_change_mode";
//                 }
//             }
            //重启ECU
            system("/sbin/reboot");
        }
        
        $results["value"] = 0;
        return $results;
    }

    /* 设置主机模式参数 */
    public function set_wlan_ap()
    {
        $results =array();
//         //关闭原有AP
//         system("killall udhcpd");
//         system("killall hostapd");

        //获取主机模式参数
        $ssid = $this->input->post('SSID');
        $channel = intval($this->input->post('channel'));
        $method = intval($this->input->post('method'));
        if($method == 1)
            $psk = $this->input->post('psk_wep');
        else if($method == 2)
            $psk = $this->input->post('psk_wpa');

        if(strlen($ssid))
        {
            //保存主机模式参数到"/tmp/hostapd.conf"
            $fp = @fopen("/tmp/hostapd.conf", 'w');
            if($fp)
            {
                fwrite($fp, "#SSID=".$ssid."\n");
                fwrite($fp, "#channel=".$channel."\n");
                switch ($method) {
                    case '0':
                        fwrite($fp, "#method=0\n");
                        break;
                    case '1':
                        fwrite($fp, "#method=1\n");
                        fwrite($fp, "#psk=".$psk."\n");
                        break;
                    case '2':
                        fwrite($fp, "#method=2\n");
                        fwrite($fp, "#psk=".$psk."\n");
                        break;            
                    default:
                        # code...
                        break;
                }
                fwrite($fp, "interface=wlan0\n");
                fwrite($fp, "driver=ar6000\n");
                fwrite($fp, "ssid=".$ssid."\n");
                fwrite($fp, "channel=".$channel."\n");
                fwrite($fp, "ignore_broadcast_ssid=0\n");
                switch ($method) {
                    case '0':
                        # code...
                        break;
                    case '1':
                        //WEP
                        fwrite($fp, "auth_algs=1\n");
                        fwrite($fp, "wep_key0=\"".$psk."\"\n");
                        fwrite($fp, "wep_key1=1111111111\n");
                        fwrite($fp, "wep_key2=2222222222\n");
                        fwrite($fp, "wep_key3=3333333333\n");
                        fwrite($fp, "wep_default_key=0\n");
                        break;
                    case '2':
                        //WPA
                        fwrite($fp, "wpa=2\n");                
                        fwrite($fp, "wpa_key_mgmt=WPA-PSK\n");
                        fwrite($fp, "wpa_pairwise=CCMP TKIP\n");
                        fwrite($fp, "wpa_passphrase=".$psk."\n");
                        break;            
                    default:
                        # code...
                        break;
                }
                fclose($fp);
            }

            //设置主机模式参数
//             if($method == 1)
//             {
//                 //WEP类型需要重新加载驱动
//                 system("/sbin/rmmod ar6000");
//                 sleep(1);
//                 system("/sbin/insmod /home/modules/ar6000.ko fwpath=/home/");
//                 sleep(1);
//                 system("/usr/sbin/iwconfig wlan0 mode master");
//                 usleep(100000);
//             }
//             system("/sbin/ifconfig wlan0 192.168.0.1");
//             usleep(100000);
//             $ret = system("/usr/sbin/hostapd /tmp/hostapd.conf -B");
//             if(NULL != $ret)
//             {
//                 $data['result'] = "failed_set_ap";
//                 return $data;
//             }
//             sleep(1);
//             system("/usr/sbin/udhcpd /etc/yuneng/udhcpd_wlan0.conf");
//             usleep(100000);

            system("cp /tmp/hostapd.conf /etc/yuneng/wifi_ap_info.conf");
                        
            //重启ECU
            system("/sbin/reboot");
            $results["value"] = 0;
        }
        else {
            $results["value"] = 1;
        }
        return $results;
    }

    /* 设置从机模式参数 */
    public function set_wlan_sta()
    {
        $data = array();
        $data['result'] = "";

        //获得要连接的wifi信号的信息
        $ssid_id = $this->input->post('ssid_id');
        $ifconnect = $this->input->post("ifconnect$ssid_id");
        $ssid = $this->input->post("ssid$ssid_id");
        $ifkey = $this->input->post("ifkey$ssid_id");
        $psk = $this->input->post("psk$ssid_id");
        $group = $this->input->post("group$ssid_id");        
        // echo "ssid_id:".$ssid_id."\n";
        // echo "ssid:".$ssid."\n";
        // echo "ifkey:".$ifkey."\n";
        // echo "psk:".$psk."\n";
        // echo "group:".$group."\n";
        // echo "ifconnect:".$ifconnect."\n";

        if(strlen($ssid) && !$ifconnect)
        {
            $fp = @fopen("/tmp/wpa_supplicant.conf", 'w');
            fwrite($fp, "ctrl_interface=/var/run/wpa_supplicant\n");
            if($ifkey)
            {
                if(strlen($group))
                {
                    //WPA/WPA2加密
                    fwrite($fp, "ctrl_interface_group=0\n");
                    fwrite($fp, "ap_scan=1\n");
                    fwrite($fp, "network={\n\tssid=\"".$ssid."\"\n");
                    fwrite($fp, "\tkey_mgmt=WPA-PSK\n");
                    fwrite($fp, "\tproto=WPA RSN\n");
                    fwrite($fp, "\tpairwise=TKIP CCMP\n");
                    fwrite($fp, "\tgroup=TKIP CCMP\n");
                    fwrite($fp, "\tpsk=\"".$psk."\"\n}\n");
                }
                else
                {
                    //WEP加密
                    fwrite($fp, "network={\n\tssid=\"".$ssid."\"\n");
                    fwrite($fp, "\tkey_mgmt=NONE\n");
                    fwrite($fp, "\twep_key0=\"".$psk."\"\n");
                    fwrite($fp, "\twep_tx_keyidx=0\n}\n");
                }
            }
            else
            {
                //无加密
                fwrite($fp, "network={\n\tssid=\"".$ssid."\"\n");
                fwrite($fp, "\tkey_mgmt=NONE\n}\n");
            }
            fclose($fp);
        }

        //设置从机模式参数
        if($ifconnect == 0)
        {
            system("killall udhcpc");
            usleep(10000);
            system("killall wpa_supplicant");
            usleep(10000);
            $ret = system("wpa_supplicant -Dwext -i wlan0 -c /tmp/wpa_supplicant.conf -B");
            sleep(1);
            if(!$ret)
            {
                echo "<!--";
                $flag = system("/sbin/udhcpc -nq -i wlan0");
                echo "-->";
                sleep(1);
                if(substr_count($flag, "Adding DNS"))
                {
                    //连接成功
                    system("cp /tmp/wpa_supplicant.conf /etc/yuneng/wifi_signal_info.conf");
                    
                    //设置默认网关
                    $fp = fopen("/etc/resolv.conf", 'r');
                    if($fp)
                    {
                        $temp = fgets($fp);
                        if(!strncmp($temp, "nameserver", 10))
                        {
                            $temp = substr($temp, 11);
                            sscanf($temp, "%[^\n]", $gateway);
                        }
                    }
                    fclose($fp);
                    $cmd = "/sbin/route add default gw ".$gateway." dev wlan0";
                    system($cmd);

                    //添加无线网络
                    $ip_arr = explode(".", $gateway);
                    $cmd = "/sbin/route add -net ".$ip_arr[0].".".$ip_arr[1].".".$ip_arr[2].".0 "."netmask 255.255.255.0 dev wlan0";
                    system($cmd);

                    //重新获取IP地址
                    exec("/sbin/udhcpc");

                    $data['result'] = "success_connect_sta";
                }
                else
                {
                    //分配IP地址失败
                    system("killall wpa_supplicant");
                    $data['result'] = "failed_connect_sta";
                }
            }
            else
            {
                //密码错误
                $data['result'] = "failed_wrong_password";
            }

        }
        else if($ifconnect == 1)
        {
            system("killall wpa_supplicant");

            $data['result'] = "success_disconnect_sta";
        }

        return $data;
    }
}


/* End of file management_model.php */
/* Location: ./application/models/management_model.php */