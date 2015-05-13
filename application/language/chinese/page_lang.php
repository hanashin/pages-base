<?php
/* 
 * 该文件保存ECU页面的显示语言（中文版） 
 */
/* 标题 */
	$lang['title'] = "昱能科技能量控制软件";
	$lang['title_ecu'] = "能量通信器 (ECU)";
	$lang['language'] = "切换语言";
	$lang['energy_control']="能量控制";
	$lang['test']="测试";
	$lang['faq']="常见问题";
	
/* 通用 */
	$lang['button_more'] = "更多";
	$lang['button_save'] = "保存";
	$lang['button_update'] = "确定";
	$lang['button_ok'] = "确定";
	$lang['button_cancel'] = "取消";
	$lang['button_reset'] = "重置";
	$lang['button_query'] = "查询";
	$lang['button_refresh'] = "刷新";
	$lang['button_read'] = "读取";
	$lang['button_save_all'] = "保存所有逆变器";
	$lang['button_read_all'] = "读取所有逆变器";
	
	$lang['message_success'] = "设置成功";
	$lang['message_warning'] = "警告";
	$lang['message_failed'] = "登录失败";	

	$lang['inverter_id'] = "逆变器 ID";
	
	$lang['ecu_reboot_title'] = "ECU 正在重启 ……";
	$lang['ecu_reboot'] = "请勿刷新页面，重启完毕后若页面未自动跳转，请在地址栏输入液晶屏所显示的IP";
	
/* 导航栏 */
	$lang['item_1'] = "主页";
	$lang['item_2'] = "实时数据";
	$lang['item_2_1'] = "实时数据";
	$lang['item_2_2'] = "功率曲线图";
	$lang['item_2_3'] = "能量柱状图";
	$lang['item_2_4'] = "逆变器状态";	
	$lang['item_3'] = "参数配置";
	$lang['item_3_1'] = "参数配置";
	$lang['item_3_2'] = "GFDI";
	$lang['item_3_3'] = "远程控制";
	$lang['item_3_4'] = "功率设置";
	$lang['item_4'] = "系统管理";
	$lang['item_4_1'] = "ID管理";
	$lang['item_4_2'] = "时间管理";
	$lang['item_4_3'] = "语言管理";
	$lang['item_4_4'] = "网络管理";
	$lang['item_4_5'] = "用户管理";
	$lang['item_4_6'] = "无线网络管理";
	
/* 主页 */
	$lang['function_home'] = "主页";
	$lang['home_ecuid'] = "ECU ID";
	$lang['home_lifetimepower'] = "历史发电量";
	$lang['home_systemp'] = "最近一次系统功率";
	$lang['home_todaypower'] = "系统当天累计发电量";
	$lang['home_datetime'] = "最近一次连接服务器时间";
	$lang['home_maxnum'] = "逆变器总台数";
	$lang['home_curnum'] = "最近一次逆变器连接台数";
	$lang['home_version'] = "软件版本号";
	$lang['home_file_size'] = "数据库使用量";
	$lang['home_timezone'] = "当前时区";
	$lang['home_eth0_mac'] = "ECU有线网络Mac地址";
	$lang['home_wlan0_mac'] = "ECU无线网络Mac地址";
	$lang['home_grid_quality'] = "逆变器通信信号强度";
	//环保效益
	$lang['home_environment_benefits'] = "系统环保效益";
	$lang['home_equivalent'] = "等量折算";
	$lang['home_gallons'] = "加仑";
	$lang['home_trees'] = "棵";
	$lang['home_kg'] = "千克";
	
/* 实时数据 */
	$lang['function_data'] = "实时数据";
	$lang['data_inverter_id'] = "逆变器 ID";
	$lang['data_current_power'] = "当前功率";
	$lang['data_grid_frequency'] = "电网频率";
	$lang['data_grid_voltage'] = "电网电压";
	$lang['data_temperature'] = "机内温度";
	$lang['data_date'] = "上报时间";
	
	//图表属性
	$lang['graph_language'] = "lang:'zh-cn'";
	$lang['graph_title_power'] = "系统当日功率曲线";
	$lang['graph_title_energy'] = "系统发电量统计";
	$lang['graph_y_label_power'] = "功率 (W)";
	$lang['graph_y_label_energy'] = "能量 (kWh)";
	$lang['graph_value_power'] = "功率";
	$lang['graph_value_energy'] = "能量";
	$lang['graph_daily_energy'] = "当天的总发电量";
	$lang['graph_weekly_energy'] = "一周的总发电量";
	$lang['graph_monthly_energy'] = "一月的总发电量";
	$lang['graph_yearly_energy'] = "一年的总发电量";
	$lang['contextButtonTitle'] = "图表导出菜单";
	$lang['downloadJPEG'] = "下载JPEG图片";
	$lang['downloadPDF'] = "下载PDF文件";
	$lang['downloadPNG'] = "下载PNG文件";
	$lang['downloadSVG'] = "下载SVG文件";
	$lang['printChart'] = "打印图表";
	
	//功率曲线图
	$lang['function_power'] = "功率曲线图";
	
	//能量柱状图
	$lang['function_energy'] = "能量柱状图";
	$lang['energy_weekly'] = "最近一周";
	$lang['energy_monthly'] = "最近一月";
	$lang['energy_yearly'] = "最近一年";
	
	//逆变器工作状态
	$lang['function_inverter_status'] = "逆变器状态";
	$lang['status_inverter_id'] = "逆变器ID";
	$lang['status_channel'] = "通道";
	$lang['status_status'] = "工作状态";
	$lang['status_energy'] = "当天发电量";
	
/* 参数配置 */

	//登录页面
	$lang['function_login'] = "登录";
	$lang['login_title'] = "登录";
	$lang['login_username'] = "用户名";
	$lang['login_password'] = "密码";
	$lang['login_login'] = "登录";	
	$lang['login_result_0'] = "登录成功";
	$lang['login_result_1'] = "用户名或密码错误";
	
	//交流保护参数
	$lang['function_protection'] = "参数配置";
	$lang['function_protection2'] = "参数配置(13项)";
	$lang['protection_set'] = "参数设置";
	$lang['protection_actual_value'] = "逆变器实际值";	
	$lang['protection_select_inverter'] = "选择逆变器";
	$lang['protection_select_inverter_all'] = "所有逆变器";
	$lang['protection_inverter_id'] = "逆变器 ID";	
	$lang['protection_under_voltage_fast'] = "外围电压下限";
	$lang['protection_over_voltage_fast'] = "外围电压上限";
	$lang['protection_under_voltage_slow'] = "内围电压下限";
	$lang['protection_over_voltage_slow'] = "内围电压上限";
	$lang['protection_under_frequency_fast'] = "外围频率下限";
	$lang['protection_over_frequency_fast'] = "外围频率上限";
	$lang['protection_under_frequency_slow'] = "内围频率下限";
	$lang['protection_over_frequency_slow'] = "内围频率上限";
	$lang['protection_voltage_triptime_fast'] = "外围过欠压延迟保护时间";
	$lang['protection_voltage_triptime_slow'] = "内围过欠压延迟保护时间";
	$lang['protection_frequency_triptime_fast'] = "外围过欠频延迟保护时间";
	$lang['protection_frequency_triptime_slow'] = "内围过欠频延迟保护时间";
	$lang['protection_grid_recovery_time'] = "并网恢复时间";
	$lang['protection_read_parameters'] = "读取参数";
	
	$lang['protection_result_0'] = "参数保存成功！（请过5分钟之后查看结果）";
	$lang['protection_result_1'] = "请至少输入一个保护参数！";
	$lang['read_protection_result_0'] = "参数读取成功！（请过5分钟之后查看结果）";
	$lang['read_protection_result_1'] = "参数读取失败！";

	//GFDI设置
	$lang['function_gfdi'] = "GFDI";
	$lang['gfdi_inverter_id'] = "逆变器 ID";
	$lang['gfdi_state'] = "状态";
	$lang['gfdi_unlock'] = "GFDI 解锁";
	
	$lang['gfdi_result_0'] = "请过5分钟之后查看结果";
	$lang['gfdi_result_1'] = "请选择需要解锁的逆变器";
	
	//远程控制开关机
	$lang['function_switch'] = "远程控制";
	$lang['switch_inverter_id'] = "逆变器 ID";
	$lang['switch_state'] = "状态";
	$lang['switch_turn_on'] = "开启";
	$lang['switch_turn_off'] = "关闭";
	$lang['switch_turn_on_off'] = "执行开关机操作";
	$lang['switch_turn_on_all'] = "开启所有逆变器";
	$lang['switch_turn_off_all'] = "关闭所有逆变器";
	
	$lang['switch_result_0'] = "请过5分钟之后查看结果！";
	$lang['switch_result_1'] = "请选择逆变器！";
	$lang['switch_result_2'] = "设置失败！";
		
	//最大功率设置
	$lang['function_maxpower'] = "功率设置";
	$lang['maxpower_inverter_id'] = "逆变器 ID";
	$lang['maxpower_maxpower'] = "最大功率 (20-300W)";
	$lang['maxpower_actual_maxpower'] = "实际最大功率";
	
	$lang['maxpower_result_0'] = "请过5分钟之后查看结果！";
	$lang['maxpower_result_1'] = "请输入20-300之间的整数！";
	$lang['maxpower_result_2'] = "读取最大功率失败！";
	
/* 系统管理 */	
	//ID管理
	$lang['function_id'] = "ID管理";
	$lang['id_inverter_id'] = "逆变器 ID";
	$lang['id_clear_id'] = "清空 ID";
	$lang['id_total'] = "总数";
	$lang['id_correct'] = "更新成功";
	$lang['id_error'] = "格式错误";
	
	$lang['clear_id_result_0'] = "清空ID成功";
	$lang['set_id_result_0'] = "更新ID成功";
	$lang['set_id_result_1'] = "以下错误的ID没有被添加：";
	$lang['set_id_result_2'] = "请输入逆变器ID";
	
	//时间管理
	$lang['function_time'] = "时间管理";
	$lang['time_datetime'] = "日期 时间";
	$lang['time_timezone'] = "时区";
	$lang['time_ntp'] = "NTP服务器";
	
	$lang['datetime_result_0'] = "更改时间成功";
	$lang['datetime_result_1'] = "更改时间失败";
	$lang['timezone_result_0'] = "更改时区成功";
	$lang['timezone_result_1'] = "更改时区失败";
	$lang['ntp_result_0'] = "更改NTP服务器成功";
	$lang['ntp_result_1'] = "更改NTP服务器失败";
	
	//语言管理
	$lang['function_language'] = "语言管理";
	$lang['language_current_language'] = "当前语言";
	$lang['language_english'] = "英文";
	$lang['language_chinese'] = "中文";
	$lang['language_result_0'] = "切换语言成功";
	$lang['language_result_1'] = "语言配置文件打开失败";
	
	//网络管理
	$lang['function_network'] = "网络管理";
	$lang['network_set_gprs'] = "GPRS 设置";
	$lang['network_use_gprs'] = "使用 GPRS 模块";
	$lang['network_set_ip'] = "IP 设置";
	$lang['network_use_dhcp'] = "自动获得IP地址";
	$lang['network_use_static_ip'] = "使用下面的IP地址";
	$lang['network_ip_address'] = "IP 地址";
	$lang['network_subnet_mask'] = "子网掩码";
	$lang['network_default_gateway'] = "默认网关";
	$lang['network_preferred_dns_server'] = "首选 DNS 服务器";
	$lang['network_alternate_dns_server'] = "备用 DNS 服务器";
	
	$lang['gprs_result_0_1'] = "已启用GPRS模式";
	$lang['gprs_result_0_0'] = "已关闭GPRS模式";
	$lang['gprs_result_1_1'] = "启用GPRS失败";
	$lang['gprs_result_1_0'] = "关闭GPRS失败";
	$lang['network_result_success_dhcp'] = "设置动态IP成功";
	$lang['network_result_success_static_ip'] = "设置静态IP成功";
	
	//用户管理
	$lang['function_user_info'] = "用户管理";
	$lang['user_info_username'] = "用户名";
	$lang['user_info_new_username'] = "新用户名";
	$lang['user_info_old_password'] = "旧密码";
	$lang['user_info_new_password'] = "新密码";
	$lang['user_info_confirm_password'] = "确认密码";
	$lang['user_info_change_password'] = "更改密码";
	
	$lang['user_info_result_0'] = "密码修改成功！";
	$lang['user_info_result_1'] = "原用户名密码错误";
	$lang['user_info_result_2'] = "密码不能为空";
	$lang['user_info_result_3'] = "两次输入的密码不一致";
	
	//无线网络管理
	$lang['function_wlan'] = "无线网络管理";
	$lang['wlan_mode'] = "模式";
	$lang['wlan_ssid'] = "信号名称";
	$lang['wlan_ip_address'] = "IP 地址";
	$lang['wlan_state'] = "状态";
	$lang['wlan_change_to_ap_mode'] = "切换为无线热点";
	$lang['wlan_change_to_sta_mode'] = "连接到附近的WLAN";
	$lang['wlan_reboot'] = "警告：此操作会重启ECU，确定执行请点击'确定'，否则点击‘取消’。";
	  //AP
	$lang['wlan_mode_ap'] = "无线热点";
	$lang['wlan_ifopen_1'] = "开启";
	$lang['wlan_ifopen_0'] = "关闭";
	$lang['wlan_ap_setting'] = "更改设置";
	$lang['wlan_ap_ssid'] = "信号名称";
	$lang['wlan_ap_channel'] = "信道";
	$lang['wlan_ap_channel_auto'] = "自动";	
	$lang['wlan_ap_method'] = "安全类型";
	$lang['wlan_ap_password'] = "安全密钥";
	$lang['wlan_ap_update'] = "确定";
      //STA	
	$lang['wlan_mode_sta'] = "连接的WLAN";
	$lang['wlan_ifconnect_1'] = "已连接";
	$lang['wlan_ifconnect_0'] = "未连接";
	$lang['wlan_sta_signals'] = "附近的WLAN";
	$lang['wlan_sta_ssid'] = "信号名称";
	$lang['wlan_sta_quality'] = "信号强度";
	$lang['wlan_sta_password'] = "密码";
	$lang['wlan_sta_connect'] = "连接";
	$lang['wlan_sta_disconnect'] = "断开";
	//wlan
	$lang['wlan_open'] = "开启 WLAN";
	$lang['wlan_open_info'] = "开启 WLAN 会关闭无线热点并重启ECU，确定开启？";
	$lang['wlan_close'] = "关闭 WLAN";
	$lang['wlan_close_info'] = "确定关闭 WLAN ？";
	// hotspot
	$lang['hotspot_open'] = "开启无线热点";
	$lang['hotspot_open_info'] = "开启无线热点会断开 WLAN 并重启ECU，确定开启？";
	$lang['hotspot_close'] = "关闭无线热点";
	$lang['hotspot_close_info'] = "确定关闭无线热点？";
	$lang['hotspot_set'] = "设置无线热点";
	$lang['hotspot_set_info'] = "修改无线热点需要重启ECU，是否确认修改？";
	
	$lang['wlan_result_success_change_mode'] = "设置成功";
	$lang['wlan_result_success_set_ap'] = "设置无线热点参数成功";
	$lang['wlan_result_success_connect_sta'] = "连接WIFI成功";
	$lang['wlan_result_success_disconnect_sta'] = "断开WIFI成功";
	$lang['wlan_result_failed_connect_sta'] = "连接WIFI失败";
	$lang['wlan_result_failed_wrong_password'] = "密码错误";
	
/* 显示数据库数据 */
	//status
	$lang['function_status'] = "状态";
	$lang['function_status2'] = "状态2";
	$lang['display_status_event_id'] = "事件编号";
	$lang['display_status_event'] = "状态";
	$lang['display_status_inverter_id'] = "逆变器ID";
	$lang['display_status_date'] = "日期";
	$lang['display_status_event_0'] = "交流频率太低";
	$lang['display_status_event_1'] = "交流频率太高";
	$lang['display_status_event_2'] = "交流电压太高";
	$lang['display_status_event_3'] = "交流电压太低";
	$lang['display_status_event_7'] = "超出温度范围";
	$lang['display_status_event_11'] = "GFDI 锁住";
	$lang['display_status_event_13'] = "主动防孤岛保护";
	$lang['display_status_event_14'] = "CP 保护";
	$lang['display_status_event_15'] = "HV 保护";
	$lang['display_status_event_16'] = "过零保护";
	
	//显示数据库
	$lang['function_database'] = "数据库";
	$lang['function_historical_data'] = "历史数据库";
	$lang['function_record'] = "Record数据库";
	
/* 隐藏功能 */
	$lang['function_hidden_index'] = "隐藏页面";
	//debug
	$lang['function_debug'] = "调试";
	$lang['debug_command_input'] = "请输入自定义命令";
	$lang['debug_command_execute'] = "执行";
	$lang['debug_command_success'] = "执行成功";
	$lang['debug_command_failed'] = "执行失败";	
	$lang['debug_command_is_null'] = "命令不能为空";

	//导数据
	$lang['function_export_file'] = "导出历史数据";
	$lang['export_file_start_time'] = "起始时间";
	$lang['export_file_end_time'] = "结束时间";
	$lang['export_file_export'] = "导出";

	//EMA服务器地址与端口
	$lang['function_datacenter'] = "数据服务器";
	$lang['datacenter_domain'] = "域名";
	$lang['datacenter_ip'] = "IP 地址";
	$lang['datacenter_port1'] = "端口 1";
	$lang['datacenter_port2'] = "端口 2";
	$lang['datacenter_update'] = "确定";
	
	$lang['datacenter_result_0'] = "服务器地址与端口已修改";
	
	//自动更新服务器地址与端口
	$lang['function_updatecenter'] = "自动更新服务器";
	$lang['updatecenter_domain'] = "域名";
	$lang['updatecenter_ip'] = "IP 地址";
	$lang['updatecenter_port'] = "端口";
	$lang['updatecenter_update'] = "确定";
	
	$lang['updatecenter_result_0'] = "服务器地址与端口已修改";
	
	//初始化数据库
	$lang['function_initialize'] = "初始化数据库";
	$lang['initialize_clear_energy'] = "清除历史发电量";
	$lang['initialize_success'] = "清除成功";
	$lang['initialize_failed'] = "清除失败";
	
	//串口
	$lang['function_serial'] = "串口设置";
	$lang['serial_switch'] = "串口开关";
	$lang['serial_switch_on'] = "开启";
	$lang['serial_switch_off'] = "关闭";
	$lang['serial_baud_rate'] = "串口波特率";
	$lang['serial_ecu_address'] = "ECU 地址";
	$lang['serial_update'] = "确定";
	
	$lang['serial_result_0'] = "串口已修改";
	$lang['serial_result_1'] = "串口修改失败";

	//电网环境
	$lang['function_grid_environment'] = "电网环境设置";
	$lang['grid_environment_result'] = "设置结果";
	$lang['grid_environment_setting'] = "电网环境设置值";
	$lang['grid_environment_select'] = "--选择电网环境值--";
	
	$lang['grid_environment_result_0'] = "设置成功";
	$lang['grid_environment_result_1'] = "请选择电网环境值";
	$lang['grid_environment_result_2'] = "设置失败";
	
	//IRD控制
	$lang['function_ird'] = "IRD模式设置";
	$lang['ird_result'] = "设置结果";
	$lang['ird_setting'] = "IRD模式设置值";
	$lang['ird_select'] = "--选择IRD模式--";
	$lang['ird_select_1'] = "关闭IRD";
	$lang['ird_select_2'] = "开启IRD带锁存";
	$lang['ird_select_3'] = "开启IRD不带锁存";
	
	$lang['ird_result_0'] = "设置成功";
	$lang['ird_result_1'] = "请选择IRD模式";
	$lang['ird_result_2'] = "设置失败";
	
	//逆变器信号强度
	$lang['function_signal_level'] = "信号强度";
	$lang['signal_level'] = "信号强度";
	
	$lang['signal_level_result_0'] = "读取成功";
	$lang['signal_level_result_1'] = "读取失败";
	
	//上传文件到ECU临时目录
	$lang['function_upload'] = "上传文件";
	$lang['upload_filename'] = "文件名称";
	$lang['upload_browse'] = "浏览";
	
	$lang['upload_result_0'] = "上传文件成功！";
	$lang['upload_result_1'] = "上传文件失败！";
	$lang['upload_result_2'] = "请上传8Mb以下的文件！";
	$lang['upload_result_3'] = "文件已存在！";
	
?>