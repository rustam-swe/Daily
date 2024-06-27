<form action="daily.php" method="POST">
<style>
    .bbb{
        text-align: center;
        background-color: dimgrey;
        border-radius: 10px;
        box-shadow: 10px 10px 23px;
    }

h2{
    color: aliceblue;
    box-shadow: 1px 1px 2px;
    
}

#submit{
    background-color: darkslategray;
    color: white;
    border-radius: 10px;
    font-size: 25px;
}

#submit:hover{
    background-color:yellowgreen;
    color: black;
}
label{
    color: white;
}
.div1{
    border-radius: 10px;
}


</style>
 <div>
<div class="bbb">
<h2 style="border-radius: 10px;">>Dushanba</h2>
    <label for="DushanbaarrivedAt">arrivedAt</label>
    <input type="datetime-local" name="Dushanba[arrivedAt]" id="DushanbaarrivedAt" style="background-color:white;"><br><br>
    <label for="DushanbaleavedAt">leavedAt</label>
    <input type="datetime-local" name="Dushanba[leavedAt]" id="DushanbaleavedAt" style="background-color:white;"><br><br>
</div>

   <div class="bbb">
   <h2 style="border-radius: 10px;">>Seshanba</h2>
    <label for="SeshanbaarrivedAt">arrivedAt</label>
    <input type="datetime-local" name="Seshanba[arrivedAt]" id="SeshanbaarrivedAt" style="background-color:white;"><br><br>
    <label for="SeshanbaleavedAt">leavedAt</label>
    <input type="datetime-local" name="Seshanba[leavedAt]" id="SeshanbaleavedAt" style="background-color:white;"><br><br>
   </div>

    <div class="bbb">
    <h2 style="border-radius: 10px;">>Chorshanba</h2>
    <label for="ChorshanbaarrivedAt">arrivedAt</label>
    <input type="datetime-local" name="Chorshanba[arrivedAt]" id="ChorshanbaarrivedAt" style="background-color:white;"><br><br>
    <label for="ChorshanbaleavedAt">leavedAt</label>
    <input type="datetime-local" name="Chorshanba[leavedAt]" id="ChorshanbaleavedAt" style="background-color:white;"><br><br>

    </div>

   <div class="bbb">
   <h2 style="border-radius: 10px;">>Payshanba</h2>
    <label for="PayshanbaarrivedAt">arrivedAt</label>
    <input type="datetime-local" name="Payshanba[arrivedAt]" id="PayshanbaarrivedAt" style="background-color:white;"><br><br>
    <label for="PayshanbaleavedAt">leavedAt</label>
    <input type="datetime-local" name="Payshanba[leavedAt]" id="PayshanbaleavedAt" style="background-color:white;"><br><br>

   </div>
<div class="bbb">
<h2 style="border-radius: 10px;">>Juma</h2>
    <label for="JumaarrivedAt">arrivedAt</label>
    <input type="datetime-local" name="Juma[arrivedAt]" id="JumaarrivedAt" style="background-color:white;"><br><br>
    <label for="JumaleavedAt">leavedAt</label>
    <input type="datetime-local" name="Juma[leavedAt]" id="JumaleavedAt" style="background-color:white;"><br><br>

</div>
<div class="bbb">

<h2 style="border-radius: 10px;">>Shanba</h2>
    <label for="ShanbaarrivedAt">arrivedAt</label>
    <input type="datetime-local" name="Shanba[arrivedAt]" id="ShanbaarrivedAt" style="background-color:white;"><br><br>
    <label for="ShanbaarrivedAt">leavedAt</label>
    <input type="datetime-local" name="Shanba[leavedAt]" id="ShanbaarrivedAt" style="background-color:white;"><br><br>

</div>
<div class="bbb">

<h2 style="border-radius: 10px;">>Yakshanba</h2>
    <label for="YakshanbaarrivedAt">arrivedAt</label>
    <input type="datetime-local" name="Shanba[arrivedAt]" id="YakshanbaarrivedAt" style="background-color:white;"><br><br>
    <label for="YakshanbaarrivedAt">leavedAt</label>
    <input type="datetime-local" name="Yakshanba[leavedAt]" id="YakshanbaarrivedAt" style="background-color:white;"><br><br>
    <button id="submit" type="submit">Submit</button>
</div>
</form>
 </div>


<pre>
<?php


class WorkTimeCalculator {
    private $arrivedAt;
    private $leavedAt;
    private $workSchedule = 540;

    public function __construct($arrivedAt, $leavedAt) {
        $this->arrivedAt = new DateTime($arrivedAt);
        $this->leavedAt = new DateTime($leavedAt);
    }

    public function calculateWorkTime() {
        $interval = $this->arrivedAt->diff($this->leavedAt);
        return $interval->h * 60 + $interval->i;
    }

    public function calculateTotalWorkOffTime() {
        $workTime = $this->calculateWorkTime();
        return $workTime <= $this->workSchedule ? $this->workSchedule - $workTime : $workTime - $this->workSchedule;
    }

    public function formatWorkTime() {
        return $this->arrivedAt->format('H:i') . ' - ' . $this->leavedAt->format('H:i');
    }
}

$days = ['Dushanba', 'Seshanba', 'Chorshanba', 'Payshanba', 'Juma', 'Shanba', 'Yakshanba'];

foreach ($days as $day) {
    if (isset($_POST[$day])) {
        $arrivedAt = $_POST[$day]['arrivedAt'];
        $leavedAt = $_POST[$day]['leavedAt'];

        $calculator = new WorkTimeCalculator($arrivedAt, $leavedAt);
        $formattedWorkTime = (new DateTime($arrivedAt))->diff(new DateTime($leavedAt))->format('%H:%i');

        echo "Work duration on $day: $formattedWorkTime\n";

        $workOffTime = $calculator->calculateTotalWorkOffTime();
        echo "Debt on $day: $workOffTime minutes\n\n";
    }
}

?>


</pre>
