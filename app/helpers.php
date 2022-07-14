<?php


use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Debug\Dumper;

if (!function_exists('putJSON')) {
    function putJSON($data)
    {
//        $this->disableLayout = true;
//        $this->rendered = true;
//        die(json_encode($data,JSON_UNESCAPED_UNICODE));
    }
}

if (!function_exists('putAjax')) {
    function putAjax($data)
    {
//        $this->disableLayout = true;
//        $this->rendered = true;
//        die($data);
    }
}




if (! function_exists('vd1')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function vd1(...$args)
    {
        foreach ($args as $x) {
            //(new Dumper)->dump($x);
            dump($x);
        }

        die(1);
    }
}
if (!function_exists('vd')) {

    function vd($var = false, $showHtml = false, $showFrom = true)
    {
        echo "\n<pre>\n";
        $var = print_r($var, true);
        if ($showHtml) {
            $var = str_replace('<', '&lt;', str_replace('>', '&gt;', $var));
        }
        echo $var . "\n</pre>\n";
    }
}

if (!function_exists('e')) {
    /**
     * Escape HTML special characters in a string.
     *
     * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
     * @return string
     */
    function eMy($value)
    {
        if ($value instanceof Htmlable) {
            return $value->toHtml();
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}

if (!function_exists('htmlСut')) {

    function htmlСut($html, $size)
    {
        $symbols = strip_tags($html);
        //vd1($symbols);
        $symbols_len = strlen($symbols);

        if ($symbols_len < strlen($html)) {
            $strip_text = stripWords($html, $size);

            if ($symbols_len > $size)
                $strip_text = $strip_text . "...";

            $final_text = closeTags($strip_text);
        } elseif ($symbols_len > $size)
            $final_text = substr($html, 0, $size) . "...";
        else
            $final_text = $html;

        return $final_text;
    }
}

if (!function_exists('threePointCut')) {

    function threePointCut($html, $size)
    {
        //$symbols = strip_tags($html);
        $symbols_len = mb_strlen($html);


        if ($symbols_len > $size)
            $final_text = mb_substr($html, 0, $size, 'UTF-8') . "...";
        else
            $final_text = $html;

        return $final_text;
    }
}

if (!function_exists('stripWords')) {
    function stripWords($string, $count)
    {
        $splice_pos = null;

        $ar = preg_split("/(<.*?>|\\s+)/s", $string, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($ar as $i => $s) {
            if (substr($s, 0, 1) != "<") {
                $count -= strlen($s);
                if ($count <= 0) {
                    $splice_pos = $i;
                    break;
                }
            }
        }

        if (isset($splice_pos)) {
            array_splice($ar, $splice_pos + 1);
            return implode('', $ar);
        } else {
            return $string;
        }
    }
}

if (!function_exists('closeTags')) {
    function closeTags($html)
    {
        $not_close = array('br', 'img');
        preg_match_all("#<([a-z0-9]+)([^>]*)(?<!/)>#iu", $html, $result);
        $openedtags=[];
        foreach ($result[1] as $v) {
            if (!in_array($v, $not_close)) {
                $openedtags[] = $v;
            }
        }
        preg_match_all("#</([a-z0-9]+)>#iu", $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened)
            return $html;
        $openedtags = array_reverse($openedtags);
        for ($i = 0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags))
                $html .= '</' . $openedtags[$i] . '>';
            else
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
        return $html;
    }
}

//
//public static function gOne($nodePid, $type=false)
//{
//    $optMd5 = md5($nodePid.$type);
//
//    //$gOneRes = K_redis::get()->hGetAll('tree:gOne:'.$optMd5);
//
//    if(!empty($gOneRes)){
//        return $gOneRes;
//
//    }
//    $nodePid = self::prepLink($nodePid);
//
//    if (!$type){
//        if (!$parentNodeData){
//            $parentNodeData = K_Tree::getNode($nodePid);
//        }
//        $type = $parentNodeData['tree_type'];
//    }
//
//    $key_field = is_numeric($nodePid) ? 'tree_id' : 'tree_link';
//
//    $result = array();
//    $data   = array();
//    $rData  = array();
//
//    $query = new K_Db_Query();
//    $result = $query->q('SELECT `tr`.*, `ty`.* FROM `tree` AS `tr` LEFT JOIN `type_'.$type.'` AS `ty` ON tr.tree_id  = ty.type_'.$type.'_id  WHERE tr.'.$key_field.' = "'.$nodePid.'"');
////		var_dump('SELECT `tr`.*, `ty`.* FROM `tree` AS `tr` LEFT JOIN `type_'.$type.'` AS `ty` ON tr.tree_id  = ty.type_'.$type.'_id  WHERE tr.'.$key_field.' = "'.$nodePid.'"');
//
//
//    // если найденная нода не соответствует типу запрашиваемой ноды возвращяем false
//    if(	!$result || $result[0]['tree_type']!=$type){
//        return false;
//    }
//    for ($i = 0; $i < sizeof($result); $i++)
//    {
//        $data[$i] = $result[$i]->toArray();
//
//        foreach ($data[$i] as $typeField => $typeValue)
//        {
//            $rData[$i][str_replace('type_'.$type.'_', '', $typeField)] = $typeValue;
//        }
//    }
//    K_Redis::get()->hMSet('tree:gOne:'.$optMd5, $rData[0]);
//    K_Redis::get()->setTimeout('tree:gOne:'.$optMd5, 300);
//    return $rData[0];
//}
