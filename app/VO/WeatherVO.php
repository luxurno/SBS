<?php

declare(strict_types = 1);

namespace App\VO;

class WeatherVO extends AbstractVOModel
{
    private string $date;
    private float $temp;
    private int $pressure;
    private int $humidity;

    public function __construct(
        string $date,
        float $temp,
        int $pressure,
        int $humidity
    )
    {
        $this->date = $date;
        $this->temp = $temp;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getTemp(): float
    {
        return $this->temp;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function jsonSerialize()
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'date' => $this->date,
            'temp' => $this->temp,
            'pressure' => $this->pressure,
            'humidity' => $this->humidity,
        ];
    }
}
