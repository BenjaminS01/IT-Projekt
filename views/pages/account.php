<div class="account">
  
  <div class="container">
    <h1>Accountverwaltung</h1>
  <table class="table table-bordered">

    <tbody>
      <tr>
        <td>Vorname: </td>
        <td><?= $this->_params['member'][0]['firstName']?></td>
      </tr>
      <tr>
        <td>Nachname</td>
        <td><?= $this->_params['member'][0]['lastName']?></td>
      </tr>
      <tr>
        <td>Handynummer:</td>
        <td><?= $this->_params['member'][0]['phoneNumber']?></td>
      </tr>
      <tr>
        <td>email: </td>
        <td><?= $this->_params['member'][0]['email']?></td>
      </tr>
    </tbody>
  </table>  
  </div>
  <div class="container">
          <div class="box1">
            <form action="">
            <input type="hidden"  name="c" value="pages">
      <input type="hidden"  name="a" value="editPersonalData">
                  <button type="submit" class="btn btn-warning">Persönliche Daten ändern</button>
                </form>
                </div>
                
           
           
            <div class="box">
            <form action="">
            <input type="hidden"  name="c" value="pages">
      <input type="hidden"  name="a" value="editPassword">
                  <button type="submit" class="btn btn-warning">Passwort ändern</button>
                </form>
              </div>
            
  </div>
</div>