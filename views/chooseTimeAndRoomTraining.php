<select class="form-control"  name="trainingTime" id="trainingTime1" >
<?php foreach ($this->_params['viewAreaTimeslot'] as $value) :?>
                            <option value="<?= $value['startTime']?>" <?= isset($_GET['trainingTime']) ? ($_GET['trainingTime'] === $value ? "selected" : '') : '' ?>><?= substr ($value['startTime'],0,5).'-'.substr ($value['endTime'],0,5).' Uhr' ?></option>;
                        <?php endforeach; ?>
</select>
<div class="trainingArea">
<select class="form-control"  name="trainingArea" id="trainingArea1" >
<?php foreach ($this->_params['area'] as $value) :?>
                            <option value="<?= $value['labelling']?>" <?= isset($_GET['trainingArea']) ? ($_GET['trainingArea'] === $value ? "selected" : '') : '' ?>><?= $value['labelling'] ?></option>;
                        <?php endforeach; ?>
</select>
</div>