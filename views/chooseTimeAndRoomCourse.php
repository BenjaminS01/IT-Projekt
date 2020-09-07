<select name="viewAreaTimeslotId" id="trainingTime1" >
<?php foreach ($this->_params['viewAreaTimeslot'] as $value) :?>
                            <option value="<?= $value['id']?>" <?= isset($_GET['trainingTime']) ? ($_GET['trainingTime'] === $value ? "selected" : '') : '' ?>><?= substr ($value['startTime'],0,5).'-'.substr ($value['endTime'],0,5).' Uhr, '.$value['labelling'].', '.$value['course'] ?></option>;
<?php endforeach; ?>                      
</select>


