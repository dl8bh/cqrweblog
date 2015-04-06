<table align="center" border="0">
	<td width="15">DXCC</td>
	<td width="10"></td>
	<td width="200">Mode</td>
	<td width="10"></td>
	<td width="200">Confirmation</td>
	<td width="10"></td>
<?php


echo '<form action="stats2.php?log_id=' . $log_id . '" method="post">'
?>
<tr>
	<td><input type="text" maxlength="5" size="5" name="dxcc"></td>
	<td></td>
  <td>
		<input type="checkbox" name="mode[]" value="CW" > CW<br>
    <input type="checkbox" name="mode[]" value="SSB" > SSB
	</td>
	<td></td>
  <td>
	  <input type="checkbox" name="confirmation_paper" value="paper" checked> Paper<br>
    <input type="checkbox" name="confirmation_lotw" value="lotw" checked> LotW<br>
    <input type="checkbox" name="confirmation_eqsl" value="eqsl" checked> Eqsl
	</td>
	<td></td>
	<td><input type="submit" value="Submit"></td>
	


</tr>
</form>
</table>
