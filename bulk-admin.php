
<div id="message" class="updated fade">
<?php
	global $wpdb;
	$table = $wpdb->prefix.'bulk_redirect';

	//error_reporting(E_ALL);
	if(isset($_FILES) && isset($_FILES['bulkfile'])){
		$fhandle = fopen($_FILES['bulkfile']['tmp_name'],'r');

		$csv_redirects = array();

		while($line = fgetcsv($fhandle,0,'|')){
			if(count($line)==2) {
				array_push($csv_redirects, $line);
			}
		}

		fclose($fhandle);


		if(count($csv_redirects)>0){
			$str_inserts = array();
			foreach($csv_redirects as $csv_redirect){
				array_push($str_inserts,"('".str_replace("'","''",$csv_redirect[0])."','".str_replace("'","''",$csv_redirect[0])."')");
			}

			$structure = "
				insert ignore into $table
				VALUES
			";
			$structure.=implode(",",$str_inserts);

			$wpdb->query($structure);
		}



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


