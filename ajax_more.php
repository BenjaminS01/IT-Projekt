
<?php
require_once 'config/imports.php';
if(!empty($_POST["id"])){

    // Include the database configuration file
   
    $db = $GLOBALS['db'];
   

    // Count all records except already displayed
    $query = $db->prepare('SELECT DISTINCT trainingDate FROM trainingEntry WHERE trainingDate <  STR_TO_DATE("'.$_POST['id'].'", "%Y-%m-%d") and memberId = '.$_POST['member'].' ORDER BY trainingDate DESC');
    $query->execute();
    
    $result = $query->fetchall();
    $totalRowCount = count($result);
    
    $showLimit = 10;
    
  
    // Get records from the database
 
    
    if(count($result) > 0){ 
        foreach($result as $row){ 
            $postID = $row['trainingDate'];


         
    ?>
           <div class="list_item">
        <div class="container">
            <div class="row">
            <div class="col-sm"><p><?php echo $row['trainingDate']?> </p></div>
            <div class="col-sm"><button type="button" class="btn btn-success btn-lg"> Trainingsdetails </button></div>
            </div>
        </div>
    </div>
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