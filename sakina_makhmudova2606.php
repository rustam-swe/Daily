<?php
declare(strict_types=1);
?>

<form action="sakina_makhmudova2606.php" method="post">
    <h3>Monday</h3>
    Arrived at:<input type="datetime-local" name="arrivedAt[Monday]"> <br>
    Leaved at:<input type="datetime-local" name="leavedAt[Monday]"> <br>

    <h3>Tuesday</h3>
    Arrived at:<input type="datetime-local" name="arrivedAt[Tuesday]"> <br>
    Leaved at:<input type="datetime-local" name="leavedAt[Tuesday]"> <br>
    <button>Send</button>
</form>

<pre>
<?php
class Daily{
    public DateTime $arrivedAt;
    public DateTime $leavedAt;

    public function calculateWorkTime(DateTime $arrivedAt, DateTime $leavedAt): DateInterval|false
    {
        return $arrivedAt->diff($leavedAt);
    }

    public function calculateTotalWorkOffTime($workTime): int {
        $totalTime = 0;
        $workSchedule = 540; // in minutes

        if ($workTime <= 540) {
            $workOffTime = $workSchedule - $workTime;
            $totalTime += $workOffTime;
        } else {
            $workOffTime = $workTime - $workSchedule;
            $totalTime -= $workOffTime;
        }

        return $totalTime;
    }
}

$today = new Daily();

$days = ['Monday', 'Tuesday'];

foreach ($days as $day) {
    $arrivedAt = DateTime::createFromFormat('Y-m-d\TH:i', $_POST["arrivedAt"][$day]);
    $leavedAt = DateTime::createFromFormat('Y-m-d\TH:i', $_POST["leavedAt"][$day]);

    $workTime = $today->calculateWorkTime($arrivedAt, $leavedAt)->h * 60 + $today->calculateWorkTime($arrivedAt, $leavedAt)->i;
    var_dump("Work duration: " . $today->calculateWorkTime($arrivedAt, $leavedAt)->format("%H:%I"));

    var_dump("Debt: " . $today->calculateTotalWorkOffTime($workTime) . "\n");
}
?>
</pre>
