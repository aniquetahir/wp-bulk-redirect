<?php
/**
 * User: anique
 * Date: 1/26/15
 * Time: 11:49 AM
 */

global $wpdb;
$table = $wpdb->prefix.'bulk_redirect';

$current_redirections = $wpdb->get_results("
    select urlfrom,urlto from $table
",ARRAY_A);

?>

<?php if($current_redirections && count($current_redirections)>0){ ?>
<table class="wp-list-table widefat">
    <thead>
        <tr>
            <th>From</th>
            <th>To</th>
        </tr>
    </thead>
    <tbody>

<?php
    foreach($current_redirections as $current_redirection){
?>
        <tr>
            <td><?= htmlspecialchars($current_redirection['urlfrom']) ?></td>
            <td><?= htmlspecialchars($current_redirection['urlto']) ?></td>
            <td>
                <a href="?page=<?= $_GET['page'] ?>&action=delete&from=<?= urlencode($current_redirection['urlfrom']) ?>" class="button">Delete</a>
            </td>
        </tr>
<?php
    }
?>

    </tbody>
</table>
<?php } ?>