<?php

namespace App\DataObjects;

use Illuminate\Http\Request;

class FindData
{

    public ?string $type;
    public ?int $id;
    public ?int $page;
    public ?int $newjk_input;
    public ?int $complitejk_input;
    public ?int $price_min;
    public ?int $price_max;
    public ?string $region;
    public ?string $city;
    public ?array $year;
    public ?array $rooms;
    public ?string $req;

    /**
     * @param string|null $type
     * @param int|null $id
     * @param int|null $page
     * @param int|null $newjk_input
     * @param int|null $complitejk_input
     * @param int|null $price_min
     * @param int|null $price_max
     * @param string|null $region
     * @param string|null $city
     * @param array|null $year
     * @param array|null $rooms
     * @param string|null $req
     */
    public function __construct(?string $type, ?int $id, ?int $page, ?int $newjk_input, ?int $complitejk_input, ?int $price_min, ?int $price_max, ?string $region, ?string $city, ?array $year, ?array $rooms, ?string $req)
    {
        $this->type = $type;
        $this->id = $id;
        $this->page = (int)$page;
        $this->newjk_input = $newjk_input;
        $this->complitejk_input = $complitejk_input;
        $this->price_min = (int)$price_min;
        $this->price_max = (int)$price_max;
        $this->region = $region;
        $this->city = $city;
        $this->year = $year;
        $this->rooms = $rooms;
        $this->req = $req;
    }

    public static function fromRequest(Request $request): self {
        return new self(
            $request->get('type'),
            $request->get('id'),
            $request->get('page'),
            $request->get('newjk_input'),
            $request->get('complitejk_input'),
            $request->get('price_min'),
            $request->get('price_max'),
            $request->get('region'),
            $request->get('city'),
            $request->get('year'),
            $request->get('rooms'),
            $request->get('req')
        );
    }
}
