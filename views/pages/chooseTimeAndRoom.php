



<div class="chooseTimeAndRoom">
  <div class="mx-auto">
    <form method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=confirmTrainingTimes'; ?>"  class="needs-validation" novalidate>
      <div class="form-group">
      <input type="hidden" id="trainingDate2" name="trainingDate" value="<?= $_GET['trainingDate']?>">
      <input type="hidden" id="trainingType2" name="typeOfTraining" value="<?= $_GET['typeOfTraining']?>">
     
      

            <?php
                if(isset($_GET['typeOfTraining'])) {

                    if($_GET['typeOfTraining']=='Kurs'){
                      include 'views/chooseTimeAndRoomCourse.php';
                    }
                    else{
                      include 'views/chooseTimeAndRoomTraining.php';
                    }

                }
            ?>     
                
      
      </div>
      <button type="submit" name="submitChooseTimeAndRoom" class="btn btn-primary">Weiter</button>
    </form>
  </div>
</div>



