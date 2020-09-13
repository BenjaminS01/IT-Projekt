
<div class="test">
<div class="container">
<h3 style="margin-top:100px;">Möchten Sie Ihren Traingseintrag wirklich löschen?</h3>
    <form class="deleteEntry" method="post" action="<?= $_SERVER['PHP_SELF'] . '?a=deleteEntry'; ?>" >
        <div class="box">
            <form action="">
            <input type="hidden"  name="c" value="pages">
            <input type="hidden"  name="a" value="deleteEntry">
            <input type="hidden"  name="trainingDate" value="<?= $this->_params['trainingEntry'][0]['trainingDate']?>">
            <button type="submit" class="btn btn-danger">Löschen bestätigen</button>
        </div>
    </form>
</div>
</div>