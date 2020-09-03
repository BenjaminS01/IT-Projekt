

<div class="chooseTrainingTime">
  <div class="mx-auto">
    <form method="get"  class="needs-validation" novalidate>
      <div class="form-group">
      <input type="hidden" id="trainingDate2" name="trainingDate" value="<?= $_GET['trainingDate']?>">
      <input type="hidden"  name="c" value="pages">
      <input type="hidden"  name="a" value="timesForTraining">
      

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
      <button type="submit" name="submitTrainingTime" class="btn btn-primary">Weiter</button>
    </form>
  </div>
</div>



