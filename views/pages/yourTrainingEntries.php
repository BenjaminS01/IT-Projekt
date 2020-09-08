<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<h1>Your Training entrys</h1>
https://www.codexworld.com/load-more-data-using-jquery-ajax-php-from-database/
<p><?=  $this->_params['test'] ?></p>

<?php foreach ($this->_params['trainingEntry'] as $value): ?>


  <?php endforeach; ?>

  <div class="postList">
    <?php
    // Include the database configuration file

    
    // Get records from the database
    $db = $GLOBALS['db'];
    $memberId = getMemberId();

    $query = $db->prepare("SELECT * FROM trainingEntry WHERE memberId = ".$memberId. " ORDER BY id DESC LIMIT 5");
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
    <div class="show_more_main" id="show_more_main<?php echo $postID; ?>">
        <span id="<?php echo $postID; ?>" class="show_more" title="Load more posts">Show more</span>
        <span class="loding" style="display: none;"><span class="loding_txt">Loading...</span></span>
        <span id="<?php echo $memberId; ?>" class="member" style="display: none;"></span></span>

    </div>
    <?php } ?>
</div>

<script type="text/javascript">
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('id');
        $('.show_more').hide();
        $('.loding').show();
        var MEMBER = $('.member').attr('id');

        $.ajax({
            type:'POST',
            url:'ajax_more.php',
            data: {id: ID , member: MEMBER},
            success:function(html){
                $('#show_more_main'+ID).remove();
                $('.postList').append(html);
            }
        });
    });
});
</script>