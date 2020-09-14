<select class="form-control" name="viewAreaTimeslotId" id="trainingTime1" >
<?php foreach ($this->_params['viewAreaTimeslot'] as $value) :?>
                            <option value="<?= $value['id']?>" <?= isset($_GET['trainingTime']) ? ($_GET['trainingTime'] === $value ? "selected" : '') : '' ?>><?= timeInRightOrder($value['startTime']).'-'.timeInRightOrder($value['endTime'],true).', '.$value['labelling'].', '.$value['course'] ?></option>;
<?php endforeach; ?>                      
</select>


