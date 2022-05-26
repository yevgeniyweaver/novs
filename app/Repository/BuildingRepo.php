<?php

namespace App\Repository;
use App\DataObjects\FindData;
use App\Models\Building;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class BuildingRepo
{
    static public string $objectWhereAdd = 'pub = 1 and not_active !=1';

    const DEFAULT_SELECT_COLUMNS = [
        'obj_objects.*',
        'kom.end_building_date',
        'kom.end_kvartal',
        't.type_partner_logo as dev_logo'
    ];

    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @param array|null $q
     * @param bool|null $pagination
     * @return string
     */
    public function buildWhere(?array $q = [], ?bool $pagination = false): string  {

        if (empty($q)) {
            $q = [];
        }
        $where = [];
        $pagination = $pagination ?? false;

        if (isset($q['builder']) && !empty($q['builder'])) {
            $where[] = 'developer = ' . intval($q['builder']);
        }

        if (isset($q['year']) && !empty($q['year'])) {
            $years = array();

            foreach($q['year'] as $v){
                if($v == '2021+') {
                    $years[] = 'year_finish >= ' . qv('2021');

                }else if($v =='Сданные'){
                    $years[] = ' complite=1';
                }else{
                    $years[] = 'year_finish = ' . qv($v);
                }
            }
            $where[] = '('.implode(' OR ', $years).')';
//                $where[] = implode(' OR ', $years);
        }

        // `rooms` LIKE '%3%' OR `rooms` LIKE '%4%' OR `rooms` LIKE '%2%'
        if(isset($q['rooms']) && !empty($q['rooms'])){
            $rooms = array();
            foreach($q['rooms'] as $v){
//                if(count($q['rooms']) ==1) {
//                    $rooms[] = "rooms LIKE '%" . k_q::e( $q['rooms']) . "%'";
//                }else{
//                }
                $rooms[] = "rooms LIKE '%" . $v . "%'";
            }
            $where[] = '('.implode(' OR ', $rooms).')';
        }

        ///////////////////РАЙОН В КОТОРОМ НАХОДИТСЯ ОБЪЕКТ///////////////

        if (isset($q['region']) && !empty($q['region'])) {
            $where[] = 'region = ' . qv($q['region']);
        }
        if (isset($q['city']) && !empty($q['city'])) {
            $where[] = 'city = ' . qv($q['city']);
        }

        /////////////////////// ЦЕНА ЗА КВЮ М2    /////////////////
        if (isset($q['price']) && !empty($q['price'])) {
            $where[] = 'price = ' . qv($q['price']);
        }
        if (isset($q['street_like']) && !empty($q['street_like'])) {
            $where[] = "street LIKE '%" . eMy( $q['street_like']) . "%'";
        }
        if (isset($q['developer']) && !empty($q['developer'])) {
            $where[] = 'developer = '.qv($q['developer']);
        }
        if (isset($q['city_like']) && !empty($q['city_like'])) {
            $where[] = "city LIKE '%" . eMy( $q['city_like']) . "%'";
        }
        if (isset($q['region_like']) && !empty($q['region_like'])) {
            $where[] = "region LIKE '%" . eMy( $q['region_like']) . "%'";
        }

        if (isset($q['newjk_input']) && isset($q['complitejk_input'])) {//isset($q['jk_is_new']) && isset($q['jk_was_passed'])
            $where[] = 'new = 1 OR complite = 1';
        } elseif (isset($q['newjk_input'])) {
            $where[] = 'new = 1';
        } elseif (isset($q['complitejk_input'])) {
            $where[] = 'complite = 1';
        }

        if (isset($q['price_min']) && !empty($q['price_min'])) {
            $where[] = 'obj_objects.price  >= ' . qv(intval($q['price_min']));
        }
        if (isset($q['price_max']) && !empty($q['price_max'])) {
            $where[] = 'obj_objects.price  <= ' . qv(intval($q['price_max']));
        }

        if (isset($q['id']) && !empty($q['id'])) {
            $where = [];
            if (is_array($q['id'])) {
                $where['id'] = 'id IN (' . implode(',', array_map('qv', $q['id'])) . ')';
            } else {
                $where['id'] = 'id = ' . qv(intval($q['id']));
            }
        }

        $noKadorr = " AND developer!=22291 AND developer!=0 ";
        $where[] = self::$objectWhereAdd.$noKadorr;

        $whereAll = implode(' and ', $where);
        $page = $q['page'] ?? 0;

//        $pag_info = K_Paginator::prepear($page, 12);
//        $limit = "LIMIT {$pag_info['onPage']} OFFSET {$pag_info['start']}";

        if (isset($q['map_geo']) || isset($q['nolimit'])) {
            $limit = '';
            $pag_info = '';
        }

        return $whereAll;
    }


    /**
     * @param array $query
     * @param bool $pagination
     * @return array
     */
    public function find(array $query, bool $pagination = false): array {

        $building = (new Building());
        $buildingTable = $building->getTable();
        $where = $this->buildWhere($query, $pagination);
        $select = self::DEFAULT_SELECT_COLUMNS;

        $sub = $building
            ->select($select)
            ->leftJoin("type_partner as t", "$buildingTable.developer", "=", "t.type_partner_id")
            ->leftJoin("Комплексы as kom", "kom.Код", "=", "$buildingTable.jk_num_1c")
            ->whereRaw($where);

        //dump($sub->pluck('orient', 'id')->toArray());
        $result = $sub->paginate(16);//->appends($q);

        return array('objects' => $result, 'req' => $query);
    }

    /**
     * @return array
     */
    public function getCountByPartner(): array {

        $building = new Building();
        $buildingTable = $building->getTable();
        $where = $this->buildWhere();

        $select = [
            'type_partner_id as id',
            'type_partner_name as name',
            'type_partner_turn_off as turn_off',
            'type_partner_logo as logo'
        ];

        $sub = $building
            ->select($select)//'t.type_partner_id', 't.type_partner_name'
            ->selectRaw("GROUP_CONCAT($buildingTable.id) as `ids`")
            ->selectRaw("COUNT($buildingTable.id) as `count_obj`")
            ->leftJoin("type_partner as t", "$buildingTable.developer", "=", "t.type_partner_id")
            ->whereRaw('t.type_partner_turn_off !="да"')
            ->whereRaw($where)
            ->groupBy('t.type_partner_id')
            ->orderBy('t.type_partner_name');


        //$sub = Abc::whereRaw($where)->groupBy(); // Eloquent Builder instance
        $resQuery = DB::table( DB::raw("({$sub->toSql()}) as sub") )
            ->mergeBindings($sub->getQuery());
            //->whereRaw("count_obj > 1")
            // ->count();
        $result = $resQuery->get()->toArray();



        //$other = DB::table( DB::raw("({$sub->toSql()}) as sub") )->select(
//            'something',
//            DB::raw('sum( qty ) as qty'),
//            'foo',
//        );
//        $other->mergeBindings( $sub );
//        $other->groupBy('something');
//        $other->groupBy('foo');
//        $other->groupBy('bar');
//        print $other->toSql();
//        $other->get();

        return $result;
    }

    /**
     * @param FindData $findDTO
     * @return array
     */
    private function getTypeJk(FindData $findDTO): array
    {
        $query = [];
        switch ($findDTO->type) {
            case 'likejk':
                $query['id'] = $findDTO->id;
                break;
            case 'likejkstreet':
                $query['street_like'] = $findDTO->req;
                break;
            case 'likejkcity':
                $query['city_like'] = $findDTO->req;
                break;
            case 'likejkregion':
                $query['region_like'] = $findDTO->req;
                break;
            case 'likejkdeveloper':
                $query['developer'] = $findDTO->id;
                break;
        }
        return $query;
    }

    /**
     * @param FindData $findDTO
     * @return array
     */
    private function getQueryParams(FindData $findDTO): array
    {
        $query = [];
        dump($findDTO);
        if ($findDTO->newjk_input == 1) {
            $query['newjk_input'] = 1;//$query['jk_is_new']
        }
        if ($findDTO->page) {
            $query['page'] = $findDTO->page;
        }
        if ($findDTO->complitejk_input == 1) {
            $query['complitejk_input'] = 1;//$query['jk_was_passed']
        }
        if ($findDTO->price_min) {
            $query['price_min'] = $findDTO->price_min;
        }
        if ($findDTO->price_max) {
            $query['price_max'] = $findDTO->price_max;
        }
        if ($findDTO->region) {
            $query['region'] = $findDTO->region;
        }
        if ($findDTO->city) {
            $query['city'] = $findDTO->city;
        }
        if ($findDTO->year) {
            $query['year'] = $findDTO->year;
        }
        if ($findDTO->rooms) {
            $query['rooms'] = $findDTO->rooms;
        }

        return $query;
    }

    /**
     * @param FindData $findDTO
     * @return array
     */
    public function mergeQuery(FindData $findDTO): array
    {
        return array_merge($this->getTypeJk($findDTO), $this->getQueryParams($findDTO));
    }
}
