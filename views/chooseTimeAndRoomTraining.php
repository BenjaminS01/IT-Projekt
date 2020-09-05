<select name="trainingTime" id="trainingTime1" >
<?php foreach ($this->$_params['viewAreaTimeslot'] as $value) :?>
                            <option value="<?= $value['id']?>" <?= isset($_GET['trainingTime']) ? ($_GET['trainingTime'] === $value ? "selected" : '') : '' ?>><?= substr ($value['startTime'],0,5).'-'.substr ($value['endTime'],0,5).' Uhr' ?></option>;
                        <?php endforeach; ?>
</select>
<select name="trainingArea" id="trainingArea1" >
<?php foreach ($this->$_params['Area'] as $value) :?>
                            <option value="<?= $value['labelling']?>" <?= isset($_GET['trainingArea']) ? ($_GET['trainingTime'] === $value ? "selected" : '') : '' ?>><?= $value['labelling'] ?></option>;
                        <?php endforeach; ?>
</select>