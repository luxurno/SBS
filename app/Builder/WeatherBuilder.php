<?php

declare(strict_types = 1);

namespace App\Builder;

use App\Core\Validator\DaysValidator;
use App\VO\Collection\WeatherVOCollection;
use App\VO\WeatherVO;
use Carbon\Carbon;

class WeatherBuilder
{
    private const RESPONSE_KEY = 'list';
    private DaysValidator $dayValidator;

    public function __construct(DaysValidator $dayValidator)
    {
        $this->dayValidator = $dayValidator;
    }

    public function build(?array $response, int $days = 5): WeatherVOCollection
    {
        $collection = new WeatherVOCollection();

        if ($response !== null) {
            if (array_key_exists(self::RESPONSE_KEY, $response)) {
                foreach ($response[self::RESPONSE_KEY] as $key => $item) {
                    if ($this->dayValidator->validate($item['dt_txt'], $days)) {
                        $collection->add(new WeatherVO(
                            Carbon::parse($item['dt_txt']),
                            $item['main']['temp'],
                            $item['main']['pressure'],
                            $item['main']['humidity'],
                        ));
                    }
                }
            }
        }

        return $collection;
    }
}
