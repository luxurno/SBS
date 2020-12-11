<?php

declare(strict_types = 1);

namespace App\Builder;

use App\Core\Validator\DayValidator;
use App\VO\Collection\WeatherVOCollection;
use App\VO\WeatherVO;
use DateTimeImmutable;

class WeatherBuilder
{
    private const RESPONSE_KEY = 'list';
    private DayValidator $dayValidator;

    public function __construct(DayValidator $dayValidator)
    {
        $this->dayValidator = $dayValidator;
    }

    public function build(array $response, int $days = 5): WeatherVOCollection
    {
        $collection = new WeatherVOCollection();

        if (array_key_exists(self::RESPONSE_KEY, $response)) {
            foreach ($response[self::RESPONSE_KEY] as $key => $item) {
                if ($this->dayValidator->validate($item['dt_txt'])) {
                    $collection->add(new WeatherVO(
                        new DateTimeImmutable($item['dt_txt']),
                        $item['main']['temp'],
                        $item['main']['pressure'],
                        $item['main']['humidity'],
                    ));

                    if (count($collection) === $days) {
                        break;
                    }
                }
            }
        }

        return $collection;
    }
}
