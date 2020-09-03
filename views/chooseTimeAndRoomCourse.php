<select name="trainingTime" id="trainingTime1" >
<?php foreach ($this->$_params['viewAreaTimeslot'] as $value) :?>
                            <option value="<?= $value['startTime'].'-'.$value['endTime'].' '.$value['labelling'] ?>" <?= isset($_GET['trainingTime']) ? ($_GET['trainingTime'] === $value ? "selected" : '') : '' ?>><?= $value['startTime'].'-'.$value['endTime'].' '.$value['labelling'] ?></option>;
                        <?php endforeach; ?>
</select>
