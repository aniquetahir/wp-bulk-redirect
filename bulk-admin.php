
<div id="message" class="updated fade">
<?php
	if(isset($_FILES)){
		var_dump($_FILES);
	}
?>
</div>

<div class="wrap">
	<form method="post" action="?page=<?= $_GET['page'] ?>" enctype="multipart/form-data">
		<p><label>Please input bulk redirection file (pipe seperated)</label></p>
		<p><input name="bulkfile" type="file" /></p>
		<p><input type="submit" class="button button-primary" value="Add" /></p>
	</form>
</div>
<?php


