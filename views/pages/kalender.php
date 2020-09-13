<h1>Monatskalender</h1>
<main>
    <table class="k" id="kalender"> </table>
    <button style="float:right;" onclick="nextMonth()" name="submitLogin" class="btn btn-primary">next month</button>
</main>
<script>const d = new Date();
const dm = d.getMonth() +1;
const dj = d.getYear() + 1900;
Kalender(dm, dj, 'kalender');

function Kalender(Monat, Jahr, KalenderId) {
    const Monatsname = new Array("Januar", "Februar", "März", "April", "Mai",
        "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    const Tag = new Array("Mo", "Di", "Mi", "Do", "Fr", "Sa", "So");
    // aktuelles Datum für die spätere Hervorhebung ermitteln
    const jetzt = new Date();
    let DieserTag = -1;
    if ((jetzt.getFullYear() == Jahr) && (jetzt.getMonth() + 1 == Monat))
        DieserTag = jetzt.getDate();
    // ermittle Wochentag des ersten Tags im Monat halte diese Information in Start fest
    // getDay liefert 0..6 für So..Sa. Wir möchten aber Mo=0 bis So=6, darum +6 und mod 7.
    const Zeit = new Date(Jahr, Monat - 1, 1);
    const Start = (Zeit.getDay() + 6) % 7;
    // die meisten Monate haben 31 Tage...
    let Stop = 31;
    // ...April (4), Juni (6), September (9) und November (11) haben nur 30 Tage...
    if (Monat == 4 || Monat == 6 || Monat == 9 || Monat == 11)
        --Stop;
    // ...und der Februar nur 28 Tage...
    if (Monat == 2) {
        Stop = Stop - 3;
        // ...außer in Schaltjahren
        if (Jahr % 4 == 0) Stop++;
        if (Jahr % 100 == 0) Stop--;
        if (Jahr % 400 == 0) Stop++;
    }
    const tabelle = document.getElementById(KalenderId);
    if (!tabelle) return false;
    // schreibe Tabellenüberschrift
    const caption = tabelle.createCaption();
    caption.innerHTML = Monatsname[Monat - 1] + " " + Jahr;
    caption.id = 'caption';
    // schreibe Tabellenkopf
    const headRow = tabelle.insertRow(0);
    for (var i = 0; i < 7; i++) {
        var cell = headRow.insertCell(i);
        cell.innerHTML = Tag[i];
        
    }
    // ermittle Tag und schreibe Zeile
    let Tageszahl = 1;
    // Monate können 4 bis 6 Wochen berühren. Darum laufen, bis die Tageszahl hinter dem Monatsletzen liegt.
    for (let i = 0; Tageszahl <= Stop; i++) {
        let row = tabelle.insertRow(1 + i);
        for (let j = 0; j < 7; j++) {
            let cell = row.insertCell(j);
            cell.setAttribute("style", "height: 100px;"); 
            // Zellen vor dem Start-Tag in der ersten Zeile und Zeilen nach dem Stop-Tag werden leer aufgefüllt
            if (((i == 0) && (j < Start)) || (Tageszahl > Stop)) {
                cell.innerHTML = ' ';
            } else {
                let neueTagesZahl = '';
                let neuMonat = '';
                if (Tageszahl < 10) { neueTagesZahl = '0' + Tageszahl; } else { neueTagesZahl = Tageszahl; }
                if (Monat < 10) { neuMonat = '0' + Monat; } else { neueMonat = Monat; }
                // normale Zellen werden mit der Tageszahl befüllt und mit der Klasse Kalendertag markiert
                if (Tageszahl >= DieserTag){ 

                    cell.innerHTML = '<div style = " margin-top:10px; font-weight: bold; height: 100px;width:100px"><a href="?a=chooseTypeOfTraining&trainingDate=' + Jahr + '-' + neuMonat + '-' + neueTagesZahl + '&type=1" > <i class="fa fa-edit" style="font-size:18px"><p style=" float:right">' +Tageszahl  +'</p></i></a><br><br><br><a href="?a=yourTrainingDay&trainingDate=' + Jahr + '-' + neuMonat + '-' + neueTagesZahl + '"><i  id="i_'+Jahr + '-' + neuMonat + '-' + neueTagesZahl+'" style=" color: rgb(101, 248, 113); ; display:none; font-size:16px" class="fas">&#xf44b;</i></a></div>';

                }
                else{   
                   
                    cell.innerHTML = '<div style = "margin-top:10px; font-weight: bold; height: 100px;width:100px"><a id="link_'+Jahr + '-' + neuMonat + '-' + neueTagesZahl+'" href="?a=yourTrainingEntries&trainingDate=' + Jahr + '-' + neuMonat + '-' + neueTagesZahl + '" ><i class="fa fa-calendar-check-o" style="font-size:18px"><p style=" float:right">' + Tageszahl  + '</p></i></a><br><br><br class="test"><a href="?a=yourTrainingDay&trainingDate=' + Jahr + '-' + neuMonat + '-' + neueTagesZahl + '"><i  id="i_'+Jahr + '-' + neuMonat + '-' + neueTagesZahl+'" style="margin-top:60px; color: grey;  display:none; font-size:16px" class="fas">&#xf44b;</i></a></div>';
                }
                cell.className = 'kalendertag'
                cell.id = Jahr + '-' + neuMonat + '-' + neueTagesZahl;
                
                // und der aktuelle Tag (heute) wird noch einmal speziell mit der Klasse "heute" markiert
                if (Tageszahl == DieserTag) {
                    cell.className = cell.className + ' heute';
                } else if (Tageszahl < DieserTag) { cell.className = cell.className + ' alt'; }
                Tageszahl++;
            }
        }
    }
    return true;
}

function nextMonth(){
    let test3 = document.getElementById("caption");
    const Monatsname = new Array("Januar", "Februar", "März", "April", "Mai",
        "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
        const dm = d.getMonth() +2;
        const dj = d.getYear() + 1900;
    if(dm == 13){
        dm = 1;
        dj = d.getYear() + 1901;
    }

    caption.innerHTML = Monatsname[dm - 1] + " " + dj;
}

</script>
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
