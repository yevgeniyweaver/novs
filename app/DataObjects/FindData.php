<?php


namespace App\DataObjects;


use App\Interfaces\CustomDTO;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class FindData extends DataTransferObject
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

    public ?int $year;

    public ?int $rooms;



    public static function fromRequest(Request $request): self {
        return new self([

            'type' => $request->get('type'),

            'id' => (int) $request->get('id'),

            'page' => (int) $request->get('page'),

            'newjk_input' => (int) $request->get('newjk_input'),

            'complitejk_input' => (int) $request->get('complitejk_input'),

            'price_min' => (int) $request->get('price_min'),

            'price_max' => (int) $request->get('price_max'),

            'region' => $request->get('region'),

            'city' => $request->get('city'),

            'year' => (int) $request->get('year'),

            'rooms' => $request->get('rooms')

        ]);
    }

    public static function fromWebhook(array $params)

    {

        return new self([
            'checkout_id' => $params['id'],
            'completed_at' => $params['completed_at']
        ]);

    }
}