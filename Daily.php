<?php

declare(strict_types=1);

class Daily
{
    const int WORK_DURATION = 540;

    public string $date;
    public string $arrivedAt;
    public string $leavedAt;

    public function calculate(
        string $date,
        string $arrivedAt,
        string $leavedAt
    ) {
        $dailyWorkingHours = $leavedAt->diff($arrivedAt);
    }
}

$today = new Daily();
$today->calculate('20.06.2024', '11:00:00', '16:00:00');

