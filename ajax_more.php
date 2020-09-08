
<?php
require_once 'config/imports.php';
if(!empty($_POST["id"])){

    // Include the database configuration file
   
    $db = $GLOBALS['db'];
   

    // Count all records except already displayed
    $query = $db->prepare("SELECT COUNT(*) as num_rows FROM trainingEntry WHERE id < ".$_POST['id']." and memberId = ".$_POST['member']." ORDER BY id DESC");
    $query->execute();
    
    $row = $query->fetchall();
    $totalRowCount = $row[0]['num_rows'];
    
    $showLimit = 5;
    
    // Get records from the database
    $query = $db->prepare("SELECT * FROM trainingEntry WHERE id < ".$_POST['id']." and memberId = ".$_POST['member']. " ORDER BY id DESC  LIMIT ".$showLimit);
    $query->execute();
    $result = $query->fetchall();
    
    if(count($result) > 0){ 
        foreach($result as $row){ 
            $postID = $row['id'];


            $query1 = $db->prepare("SELECT * FROM ViewAreaTimeslot WHERE id = ".$row['areaTimeslotId']);
            $query1->execute();
            $view = $query1->fetchall();
         
    ?>
        <div class="list_item"><?php echo $row['id'].' '.$row['trainingDate']. ' <br> '.$view[0]['startTime'].'-'.$view[0]['endTime'].' Uhr '.$view[0]['course']; ?></div>
    <?php } ?>
    <?php if($totalRowCount > $showLimit){ ?>
        <div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
            <span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Show more</span>
            <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
            <span id="<?php echo $_POST['member']; ?>" class="member" style="display: none;"></span>
        </div>
    <?php } ?>
<?php
    }
}
?>