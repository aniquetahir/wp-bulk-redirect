<?php
global $wpdb;
$table = $wpdb->prefix.'bulk_redirect';
$display_message=null;

//error_reporting(E_ALL);
if(isset($_GET['action']) && $_GET['action']=='delete'){
	$delresult = $wpdb -> delete($table,array('urlfrom'=>$_GET['from']));
	if($delresult){
		$display_message = 'Redirection Deleted Successfully!';
	}
}
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
			array_push($str_inserts,"('".str_replace("'","''",trim($csv_redirect[0]))."','".str_replace("'","''",trim($csv_redirect[1]))."')");
		}

		$structure = "
				insert ignore into $table
				VALUES
			";
		$structure.=implode(",",$str_inserts);

		$res = $wpdb->query($structure);

		if($res){
			$display_message = 'Redirections Added!';
		}


	}
}
?>

<?php if($display_message!=null){ ?>
<div id="message" class="updated fade">
<p><?= $display_message ?></p>
<p><a href="?page=<?= $_GET['page'] ?>">Refresh Data</a></p>
</div>
<?php } ?>

<div class="wrap">
	<form method="post" action="?page=<?= $_GET['page'] ?>" enctype="multipart/form-data">
		<p><label>Please input bulk redirection file (pipe seperated)</label></p>
		<p><input name="bulkfile" type="file" /></p>
		<p><input type="submit" class="button button-primary" value="Add" /></p>
	</form>
	<?php include('bulk-show.php'); ?>

	<p><h3>Example:</h3></p>
	<p>
<code>
http://www.example.com/wp/blah|http://www.example2.com/wp<br>
http://example.com/wp/blah2?abc=def|http://www.example2.com/wp
</code>
	</p>

</div>
<?php


