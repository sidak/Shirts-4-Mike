<?php
	// target opens from submissions in a new tab or window
	// input type hidden are not displayed on the page but are submitted to the server
	?>
<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="UUM75F2DX74G4"><!-- paypal id for our red shirt -->
<table>
<tr><th>
		<input type="hidden" name="on0" value="Size"><label for="os0">Size</label>
	</th>
	<td>
		<select name="os0" id="os0" ><!-- on0 = option name for 0th thing , os0 option select for 0-->
	<option value="small">small </option>
	<option value="medium">medium </option>
	<option value="large">large </option>
	<option value="x-large">x-large </option><!-- paypal can accept new changes, add new sizes or names , drawback use inspect element to change it-->
</select> </td></tr>
</table>
<input type="submit" value="Add To Cart"  name="submit" >
<!-- the below image is used for tracking , transparent img , cld pixel
	Paypal uses this to record how many times someone views a form on ur site
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1"-->
</form>
