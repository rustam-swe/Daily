<form action="Daily.php" method="post">

    Kelish vaqti <input type="time" name="time_arrived"> <br><br>
    Ketish vaqti <input type="time" name="time_leaved"> <br><br>

    <button>Hisobla</button>

</form>



<?php

class Daily
{
    const WORK_DURATION = 9 * 60; // 9 soat = 540 minut

    public string $date;
    public string $arrivedAt;
    public string $leavedAt;

    public function calculate(
        string $date,
        string $arrivedAt,
        string $leavedAt
    ): void {
        $arrivedAt = DateTime::createFromFormat('H:i', $arrivedAt);
        $leavedAt = DateTime::createFromFormat('H:i', $leavedAt);

        $dailyWorkingHours = $leavedAt->diff($arrivedAt);

        $workedMinutes = ($dailyWorkingHours->h * 60) + $dailyWorkingHours->i;

        $this->date = $date;
        $this->arrivedAt = $arrivedAt->format('H:i');
        $this->leavedAt = $leavedAt->format('H:i');

        $workOffMinutes = self::WORK_DURATION - $workedMinutes;
        $workOffHours = floor($workOffMinutes / 60);
        $workOffRemainingMinutes = $workOffMinutes % 60;

        echo "Sana: {$this->date}<br>";
        echo "Kelish vaqti: {$this->arrivedAt}<br>";
        echo "Ketish vaqti: {$this->leavedAt}<br>";
        echo "Ish vaqti davomiyligi: {$dailyWorkingHours->format('%H:%I:%S')}<br>";
        echo "Qarzingiz: {$workOffHours} soat va {$workOffRemainingMinutes} daqiqa<br>";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = date('Y-m-d');
    $arrivedAt = $_POST['time_arrived'];
    $leavedAt = $_POST['time_leaved'];

    $today = new Daily();
    $today->calculate($date, $arrivedAt, $leavedAt);
}
