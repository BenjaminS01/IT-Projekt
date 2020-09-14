<div class ="container">

<h1>Monatskalender</h1>

    <table class="k" id="kalender"> </table>
    <?php if (!isset($_GET['nextMonth'])) : ?>
    <form method="get">
    <input type="hidden"  name="c" value="pages">
      <input type="hidden"  name="a" value="kalender">
      <input type="hidden"  name="nextMonth" value="true">
      <div class= "kalenderButton">
        <button type="submit"  name="next" class="btn btn-info">nächster Monat</button>
      </div>
    </form>
    <?php else: ?>

    <form method="get">

    <input type="hidden"  name="c" value="pages">
      <input type="hidden"  name="a" value="kalender">
      <div class= "kalenderButton">
        <button type="submit"  name="next" class="btn btn-info">zurück</button>
      </div>
    </form>
    <?php endif; ?>
    </div>
<script src="assets/js/kalenderCall.js"></script>
<?php if (!isset($_GET['nextMonth'])) : ?>
<script src="assets/js/kalender.js"></script>
<?php else : ?>
<script src="assets/js/nextMonthKalender.js"></script>
<?php endif; ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php
foreach ($this->_params['trainingEntry'] as $value){


echo '<script>
function test(kalender){
let test = document.getElementById(kalender)




let test3 = document.getElementById("i_'.$value['trainingDate'].'").style.display ="inherit";



}
test("'.$value['trainingDate'].'");

</script>';
}
