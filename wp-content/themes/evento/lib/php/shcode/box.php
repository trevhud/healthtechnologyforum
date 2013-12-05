
<?php 
	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/shcode.php */
	$box_type = array('default','info','warning','download','error','tick','demo','comment');
	$box_size = array('medium','large');
?>
<table class="sh_code_tbl"  id="box_setting_tbl">
	<tr>
		<td> 
			<div>
				<label class="tabs_label" for='box_content'>Content:</label>
				<input type="text" id="box_content">
			</div>
			<div>
				<label class="tabs_label" for='box_type'>Type:</label>
				<select id="box_type" class="select_medium">
					<?php 
						foreach ($box_type as $type) {
							echo "<option value='$type'>".$type."</option>";
						}
					?>
				</select>
			</div>
			
			<div>
				<label class="tabs_label"  for='box_text_size'>Size:</label>
				<select id="box_text_size" class="select_medium">
					<?php 
						foreach ($box_size as $box_size) {
							echo "<option value='$box_size'>".$box_size."</option>";
						}
					?>
				</select>
			</div>
		</td>
		<td class="demo_box" style="padding-left:40px;">
				<label>Preview</label>
				<!-- <div class="box normal" id="box_sample"></div>  -->
				<p style="margin-left: 0px;margin-top: 18px;" class="cosmo-box default " id="box_sample"><span class="cosmo-ico"></span>Box content</p>
		</td>
	</tr>
</table>
<div id='insert_box' style='margin-left:15px'>
	<a href="javascript:void(0);" onclick="resetBoxSettings();" class="button">Reset</a>
	<input type="button" onclick="insertBox()" id="insert_box_btn" value="Insert" class="button-primary">
</div>	