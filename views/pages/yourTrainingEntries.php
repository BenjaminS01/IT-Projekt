<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<h1 style="margin-left: 18px;" >Ihre Trainingstage</h1>

  <div class="postList">
    <?php
    // Include the database configuration file

    
    // Get records from the database
    $db = $GLOBALS['db'];
    $memberId = getMemberId();

    $query = $db->prepare("SELECT DISTINCT trainingDate FROM trainingEntry WHERE memberId = ".$memberId. " ORDER BY TrainingDate DESC LIMIT 15");
    $query->execute();
    $result = $query->fetchall();

    
    if(count($result) > 0){ 
        foreach($result as $row){ 
            $postID = $row['trainingDate'];

     
    ?>
    <div class="list_item">
        <div class="container">
            <div class="row">
            <div class="col-sm"><p><?php echo dateInRightOrder($row['trainingDate']) ?> </p></div>
            <div class="col-sm">
            <form method="get"  class="needs-validation" novalidate>
            <div class="form-group">
            <input type="hidden"  name="c" value="pages">
            <input type="hidden"  name="a" value="yourTrainingDay">
            <input type="hidden"  name="trainingDate" value='<?php echo $row['trainingDate'] ?>'>
            <button type="submit" class="btn btn-success btn-lg"> Trainingsdetails </button>
            </div>
            </form>
            </div>
            </div>
        </div>
    </div>
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