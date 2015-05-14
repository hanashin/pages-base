<!-- 模态框 开启WLAN -->
<div class="modal fade" id="open_wlan" tabindex="-1" role="dialog" aria-labelledby="open_wlan_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h4 class="modal-title" id="open_wlan_title"><?php echo $this->lang->line("wlan_open")?></h4></div>
      <div class="modal-body"><?php echo $this->lang->line("wlan_open_info")?></div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('button_cancel')?></button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="button_open_wlan"><?php echo $this->lang->line('button_ok')?></button>
      </div>
    </div>
  </div>
</div>

<!-- 模态框 关闭WLAN -->
<div class="modal fade" id="close_wlan" tabindex="-1" role="dialog" aria-labelledby="close_wlan_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id=""close_wlan_title""><?php echo $this->lang->line("wlan_close")?></h4>
      </div>
      <div class="modal-body"><?php echo $this->lang->line("wlan_close_info")?></div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('button_cancel')?></button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="button_close_wlan"><?php echo $this->lang->line('button_ok')?></button>
      </div>
    </div>
  </div>
</div>

<!-- 模态框 开启Hotspot -->
<div class="modal fade" id="open_hotspot" tabindex="-1" role="dialog" aria-labelledby="open_hotspot_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h4 class="modal-title" id="open_hotspot_title"><?php echo $this->lang->line("hotspot_open")?></h4></div>
      <div class="modal-body"><?php echo $this->lang->line("hotspot_open_info")?></div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('button_cancel')?></button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="button_open_hotspot"><?php echo $this->lang->line('button_ok')?></button>
      </div>
    </div>
  </div>
</div>

<!-- 模态框 关闭Hotspot -->
<div class="modal fade" id="close_hotspot" tabindex="-1" role="dialog" aria-labelledby="close_hotspot_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h4 class="modal-title" id="close_hotspot_title"><?php echo $this->lang->line("hotspot_close")?></h4></div>
      <div class="modal-body"><?php echo $this->lang->line("hotspot_close_info")?></div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('button_cancel')?></button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="button_close_hotspot"><?php echo $this->lang->line('button_ok')?></button>
      </div>
    </div>
  </div>
</div>

<!-- 模态框 设置Hotspot -->
<div class="modal fade" id="set_hotspot" tabindex="-1" role="dialog" aria-labelledby="set_hotspot_title" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h4 class="modal-title" id="set_hotspot_title"><?php echo $this->lang->line("hotspot_set")?></h4></div>
      <div class="modal-body"><?php echo $this->lang->line("hotspot_set_info")?></div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo $this->lang->line('button_cancel')?></button>
          <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" id="button_set_hotspot"><?php echo $this->lang->line('button_ok')?></button>
      </div>
    </div>
  </div>
</div>

<!-- 模态框 重启ECU -->
<div class="modal fade" id="ecu_reboot" tabindex="-1" role="dialog" aria-labelledby="ecu_reboot_title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h4 class="modal-title" id="ecu_reboot_title"><?php echo $this->lang->line('ecu_reboot_title')?></h4></div>
      <div class="modal-body">
        <div class="progress">
          <div class="progress-bar progress-bar-striped active" id="bar" role="progressbar"  aria-valuemin="0" aria-valuemax="100" style="width: 2%"></div>
        </div>
        <p><?php echo $this->lang->line('ecu_reboot')?></p>
      </div>
    </div>
  </div>
</div>

<!-- 主体 标签页头 -->
<ul class="nav nav-tabs">
    <li <?php if($mode != 1) echo "class=\"active\"";?>><a href="#wlan-tab" data-toggle="tab">WLAN <i class="fa"></i></a></li>
    <li <?php if($mode == 1) echo "class=\"active\"";?>><a href="#hotspot-tab" data-toggle="tab">Hotspot <i class="fa"></i></a></li>
</ul>

<div class="tab-content">    
    <!-- WLAN标签页 -->
    <div class="tab-pane <?php if($mode != 1) echo "active";?>" id="wlan-tab">    
        <fieldset class="col-sm-12">
            <legend class="no-border">                            
            WLAN &nbsp;&nbsp;<small></small>&nbsp;
            <input class="no-display" id="wlan" type="checkbox" <?php if($mode == 2) echo "checked";?>>
            <label class="slider" for="wlan"></label>   
            </legend>
        </fieldset>         
        <div id="wlan_info" class="col-sm-12">
            <?php //以后改成写html,做隐藏显示处理
            if ($ifconnect) {
                echo "<fieldset><legend>".$this->lang->line('wlan_mode_sta')."</legend>";
                echo "<form method=\"post\" action=\"".base_url('index.php/management/set_wlan_sta')."\" class=\"form-horizontal\">";
                echo "<input name=\"ifconnect\" type=\"hidden\" value=\"1\">";
                echo "<div class=\"form-group\">
                      <label class=\"col-sm-4 control-label\">".$this->lang->line('wlan_ssid')."</label>
                      <div class=\"col-sm-4\">
                        <p class=\"form-control-static\">".$ssid."</p>
                      </div>
                    </div>
                    <div class=\"form-group\">
                      <label class=\"col-sm-4 control-label\">".$this->lang->line('wlan_ip_address')."</label>
                      <div class=\"col-sm-4\">
                        <p class=\"form-control-static\">".$ip."</p>
                      </div>
                    </div>
                    <div class=\"form-group\">
                      <div class=\"col-sm-offset-4 col-sm-2\">
                        <button type=\"submit\" class=\"btn btn-primary btn-sm\">".$this->lang->line('wlan_sta_disconnect')."</button>
                      </div>
                    </div>
                  </fieldset>
                </form>";
            } 
            ?>
        
            <!-- 显示wifi信号及强度 -->
            <form method="post" action="<?php echo base_url('index.php/management/set_wlan_sta');?>" class="form-horizontal" role="form">            
            <fieldset class="table_wlan">
                <legend><?php echo $this->lang->line('wlan_sta_signals')?></legend>                
                <table class="table table-condensed table-striped table-hover">
                    <tbody>
                        <?php          
                        if($num > 0)
                        {
                            foreach ($wifi_signals as $key => $value) 
                            {
                                echo "<tr>";                     
                                //显示SSID
                                if($value['ssid'] == $ssid)
                                  echo "<td><input type=\"radio\" name=\"ssid_id\" value=\"$key\" onclick=\"show_key(this)\">&nbsp;&nbsp;<strong>{$value['ssid']}</strong></td>\n";
                                else
                                  echo "<td><input type=\"radio\" name=\"ssid_id\" value=\"$key\" onclick=\"show_key(this)\">&nbsp;&nbsp;{$value['ssid']}</td>\n";
                                //显示信号强度
                                echo "<td>";
                                $signal = (int)log($value['quality'], 2);
                                if($signal > 5)$signal = 5;
                                echo "<span><img src=\"".base_url("resources/images/signal$signal.png")."\"></span>";
                                echo "</td>\n";  
                                 //隐藏项
                                echo "<td>\n";
                                echo "<input name=\"ssid$key\" type=\"hidden\" value=\"".$value['ssid']."\">\n";
                                echo "<input name=\"ifkey$key\" type=\"hidden\" value=\"".$value['ifkey']."\">\n";
                                echo "<input name=\"group$key\" type=\"hidden\" value=\"".$value['group']."\">\n";
                                echo "</td>\n";
                                echo "</tr>\n";
                               
                                //显示密码框                 
                                echo "<tr name=\"show_key\" style=\"display:none;\">";
                                echo "<td colspan=\"3\">";
                                echo "<div class=\"col-sm-6\">\n";
                                echo "<div class=\"input-group\">\n";
                                if($value['ifkey'])
                                {
                                  if($value['ssid'] == $ssid){
                                    echo "<input name=\"ifconnect$key\" type=\"hidden\" value=\"1\">";
                                    echo "<button type=\"submit\" class=\"btn btn-default btn-sm\">".$this->lang->line('wlan_sta_disconnect')."</button>\n";
                                  }
                                  else{
                                    echo "<input name=\"ifconnect$key\" type=\"hidden\" value=\"0\">";
                                    echo "<input type=\"password\" name=\"psk$key\" class=\"form-control input-sm\">\n";
                                    echo "<span class=\"input-group-btn\">\n";
                                    echo "<button type=\"submit\" class=\"btn btn-default btn-sm\">".$this->lang->line('wlan_sta_connect')."</button>\n";
                                  }
                                  echo "</span>\n";
                                }
                                else
                                {
                                  echo "<input name=\"ifconnect$key\" type=\"hidden\" value=\"0\">";                
                                  echo "<button type=\"submit\" class=\"btn btn-default btn-sm\">".$this->lang->line('wlan_sta_connect')."</button>\n";                         
                                }
                                echo "</div>\n";
                                echo "</div>\n";
                                echo "</td>";                         
                                echo "</tr>\n";
                            }
                        }
                        ?>
                    </tbody>        
                </table>
            </fieldset>
            </form>
        </div><!-- end of 'wlan-info' -->
    </div><!-- end of 'wlan-tab' -->
        
    <!-- Hotspot标签页 -->
    <div class="tab-pane <?php if($mode == 1) echo "active";?>" id="hotspot-tab">    
        <fieldset class="col-sm-12">
            <legend class="no-border">                            
            Hotspot &nbsp;&nbsp;&nbsp;
            <input class="no-display" id="hotspot" type="checkbox" <?php if($mode == 1) echo "checked";?>>
            <label class="slider" for="hotspot"></label>
            </legend>
        </fieldset>
        <div id="hotspot_info" class="col-sm-12">              
            <form id="defaultForm" method="post" action="<?php echo base_url('index.php/management/set_wlan_ap');?>" class="form-horizontal">
            <fieldset>
                <legend><?php echo $this->lang->line('wlan_ap_setting')?></legend>            
                <div class="form-group">
                  <label for="inputdata1" class="col-sm-4 control-label"><?php echo $this->lang->line('wlan_ap_ssid')?></label>
                  <div class="col-sm-4">
                    <input type="text" name="SSID" class="form-control" id="inputdata1" value="<?php echo $ap_info['ssid'];?>">
                  </div>
                </div>            
                <div class="form-group">
                  <label for="inputdata2" class="col-sm-4 control-label"><?php echo $this->lang->line('wlan_ap_channel')?></label>
                  <div class="col-sm-4">
                    <select name="channel" class="form-control" id="inputdata2">
            			<?php
            				if($ap_info['channel'] == 0)
            					echo "<option value=0 selected=\"selected\">".$this->lang->line('wlan_ap_channel_auto')."</option>";
            				else
            					echo "<option value=0 >".$this->lang->line('wlan_ap_channel_auto')."</option>";
            				for($i=1; $i<=13; $i++)
            				{
            					if($ap_info['channel'] == $i)
            						echo "<option value=".$i." selected=\"selected\">".$i."</option>";
            					else
            						echo "<option value=".$i.">".$i."</option>";
            				}
            			?>						
            	    </select>
                  </div>
                </div>            
                <div class="form-group">
                  <label for="inputdata3" class="col-sm-4 control-label"><?php echo $this->lang->line('wlan_ap_method')?></label>
                  <div class="col-sm-4">
            		<select name="method" class="form-control" id="inputdata3" onchange="show_password(this.value)">
            		  	<?php
            		  		if($ap_info['method'] == 2)
            		  			echo "<option value=0>NONE</option>
            						  <option value=1>WEP</option>
            						  <option value=2 selected=\"selected\">WPA2-PSK</option>";
            				else if($ap_info['method'] == 1)
            					echo "<option value=0>NONE</option>
            						  <option value=1 selected=\"selected\">WEP</option>
            						  <option value=2>WPA2-PSK</option>";
            				else
            					echo "<option value=0 selected=\"selected\">NONE</option>
            						  <option value=1>WEP</option>
            						  <option value=2>WPA2-PSK</option>";
            		  	?>
            	  </select>
                  </div>
                </div>            
                <div class="form-group" id="password_wep" <?php if($ap_info['method'] == 0 | $ap_info['method'] == 2){echo "style=\"display:none;\"";}?>>
                  <label for="inputdata4" class="col-sm-4 control-label"><?php echo $this->lang->line('wlan_ap_password')?></label>
                  <div class="col-sm-4">
                    <input type="text" name="psk_wep" class="form-control" id="inputdata4" placeholder="<?php echo $ap_info['psk'];?>">
                  </div>
                </div>            
                <div class="form-group" id="password_wpa" <?php if($ap_info['method'] == 0 | $ap_info['method'] == 1){echo "style=\"display:none;\"";}?>>
                  <label for="inputdata5" class="col-sm-4 control-label"><?php echo $this->lang->line('wlan_ap_password')?></label>
                  <div class="col-sm-4">
                    <input type="text" name="psk_wpa" class="form-control" id="inputdata5" placeholder="<?php echo $ap_info['psk'];?>">
                  </div>
                </div>                
                <div class="form-group" id="hotspot_ip">
                  <label for="inputdata6" class="col-sm-4 control-label">IP<?php echo $this->lang->line('')?></label>
                  <div class="col-sm-4">
                    <input type="text" name="ip" class="form-control" id="inputdata6" placeholder="192.168.0.1" readonly="readonly">
                  </div>
                </div>                        
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-4">
                      <button type="submit" class="btn btn-primary btn-sm"><?php echo $this->lang->line('button_save')?></button>
                    </div>
                </div>
            </fieldset>
            </form>              
        </div><!-- end of 'hotspot_info' -->        
    </div><!-- end of 'hotspot-tab' -->
</div><!-- end of 'tab-content' -->
    
<script>                		  	
/* WLAN信号显示密码框函数 */
var tempradio = null;   
function show_key(checkedRadio) {
    var key = document.getElementsByName("show_key"); 
    for(i=0;i<key.length;i++){
        key[i].style.display= 'none'; 
    }
    if(tempradio == checkedRadio)
    {  
        tempradio.checked = false;  
        tempradio = null;  
    }   
    else
    {  
        tempradio= checkedRadio;
        key[checkedRadio.value].style.display= '';
    }        
}

/* Hotspot热点显示设置密码框函数 */
function show_password(value) {
    if (value == 0){
        document.getElementById('password_wep').style.display= 'none';
        document.getElementById('password_wpa').style.display= 'none';
    } 
    else if(value == 1){
    	document.getElementById('password_wep').style.display= ''; 
    	document.getElementById('password_wpa').style.display= 'none'; 
    }
    else if(value == 2){
    	document.getElementById('password_wep').style.display= 'none'; 
    	document.getElementById('password_wpa').style.display= ''; 
    }
}

/* 进度条控制函数 */
var progress = 1;  
function doProgress() {
	progress = progress +1;
	$("#bar").css("width", progress + "%");
	if($("#bar").css("width") == "100%"){
		//完成
	}
}

/* 主函数 */
$(document).ready(function() {
	if (!$("#wlan").attr("checked")) {
		$("#wlan_info").hide();
    }
	if (!$("#hotspot").attr("checked")) {
        $("#hotspot_info").hide();
    }
	 $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            SSID: {
                validators: {
                	notEmpty: {
                        message: '<?php echo $this->lang->line('validform_null_ap_ssid')?>'
                    },
                    stringLength: {
                    	min: 4,
                        max: 18,
                        message: '<?php echo $this->lang->line('validform_ap_ssid')?>'
                    },
                }
            },
            psk_wep: {
                validators: {
                	notEmpty: {
                        message: '<?php echo $this->lang->line('validform_null_ap_password')?>'
                    },
                    regexp: {
                        regexp: /^\d{5}$|^\d{13}$/,
                        message: '<?php echo $this->lang->line('validform_ap_password_wep')?>'
                    }
                }
            },
            psk_wpa: {
                validators: {
                  notEmpty: {
                        message: '<?php echo $this->lang->line('validform_null_ap_password')?>'
                    },
                    stringLength: {
                        min: 8,
                        max: 18,
                        message: '<?php echo $this->lang->line('validform_ap_password_wpa')?>'
                    },
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
        //防止默认表单提交，采用ajax提交
        e.preventDefault();
        $('#set_hotspot').modal('toggle');
    });
	    
    $("#wlan").click(function() {
        if (!$("#wlan").attr("checked")) {
        	$("#wlan").attr('checked', true);
            $('#close_wlan').modal('toggle');
        }
        else {
        	$("#wlan").attr('checked', false);         
            $('#open_wlan').modal('toggle');
        }
    });
    $("#hotspot").click(function() {
        if (!$("#hotspot").attr("checked")) {
        	$("#hotspot").attr('checked', true);
            $('#close_hotspot').modal('toggle');
        }
        else {         
        	$("#hotspot").attr('checked', false);
            $('#open_hotspot').modal('toggle');            
        }
    });

    // 开启WLAN
    $("#button_open_wlan").click(function(){    	
	    $.ajax({
    		url : "<?php echo base_url('index.php/management/set_wlan_mode');?>",
    		type : "post",
            dataType : "json",
    		data: "mode=2",
  	    	success : function(Results) {
                if(Results.value == 0) {
    	            $('#ecu_reboot').modal('toggle');
    	            setInterval('doProgress()', 500);
    	    	    setTimeout('window.location.reload()', 50000);
  	            }
    		},
    		error : function() { alert("Error"); }
        })
    });

    // 关闭WLAN
    $("#button_close_wlan").click(function(){    	
	    $.ajax({
    		url : "<?php echo base_url('index.php/management/set_wlan_mode');?>",
    		type : "post",
            dataType : "json",
    		data: "mode=0",
  	    	success : function(Results){
                if(Results.value == 0) {
                	$("#wlan").attr('checked', false);
                	$("#wlan_info").hide();
                	}
                else {}
    		},
    		error : function() { alert("Error"); }
        })
    });

    // 开启Hotspot
    $("#button_open_hotspot").click(function(){    	
	    $.ajax({
    		url : "<?php echo base_url('index.php/management/set_wlan_mode');?>",
    		type : "post",
            dataType : "json",
    		data: "mode=1",
  	    	success : function(Results) {
                if(Results.value == 0) {
    	            $('#ecu_reboot').modal('toggle');
    	            setInterval('doProgress()', 500);
    	    	    setTimeout('window.location.reload()', 50000);
  	            }
                else {}
    		},
    		error : function() { alert("Error"); }
        })	    
    });

    // 关闭Hotspot
    $("#button_close_hotspot").click(function(){    	
	    $.ajax({
    		url : "<?php echo base_url('index.php/management/set_wlan_mode');?>",
    		type : "post",
            dataType : "json",
    		data: "mode=0",
  	    	success : function(Results) {
                if(Results.value == 0) {
                	$("#hotspot").attr('checked', false);
                	$("#hotspot_info").hide();
                }
    		},
  	    	error : function() { alert("Error"); }
        })
    });

    // 设置Hotspot
    $("#button_set_hotspot").click(function(){
	    $.ajax({
    		url : "<?php echo base_url('index.php/management/set_wlan_ap');?>",
    		type : "post",
            dataType : "json",
    		data: "SSID=" + $("#inputdata1").val()
    		      + "&channel=" + $("#inputdata2").val()
    		      + "&method=" + $("#inputdata3").val()
    		      + "&psk_wep=" + $("#inputdata4").val()
    		      + "&psk_wpa=" + $("#inputdata5").val(),
  	    	success : function(Results) {
                if(Results.value == 0) {
    	            $('#ecu_reboot').modal('toggle');
    	            setInterval('doProgress()', 500);
    	    	    setTimeout('window.location.reload()', 55000); 
  	            }
    		},
    		error : function() { alert("Error"); }
        })
    });
    
});
</script>