<div class="table-responsive">
  <table class="table table-condensed table-striped table-hover table-bordered">
    <thead>
      <tr>
        <th scope="col"><?php echo $this->lang->line('device_id')?></th>
        <th scope="col"><?php echo $this->lang->line('realtimedata_current_power')?></th>
        <th scope="col"><?php echo $this->lang->line('realtimedata_grid_frequency')?></th>
        <th scope="col"><?php echo $this->lang->line('realtimedata_grid_voltage')?></th>
        <th scope="col"><?php echo $this->lang->line('realtimedata_temperature')?></th>
        <th scope="col"><?php echo $this->lang->line('realtimedata_date')?></th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($curdata as $value){
        echo "<tr>
                <td>{$value[0]}</td>
                <td>{$value[1]}&nbsp;W</td>
                <td>{$value[2]}&nbsp;Hz</td>
                <td>{$value[3]}&nbsp;V</td>
                <td>{$value[4]}&nbsp;<sup>o</sup>C</td>
                <td>{$value[5]}</td>
              </tr>";
      }
    ?>
    </tbody>
  </table>
</div>