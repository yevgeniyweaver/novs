<?php

/**
 * crumbs
 */
namespace App\Helpers;
use \Exception;

class Crumbs

{
    /**
     * crumbs
     * (default value: array())
     * @var array
     * @access private
     * @static
     */

    private static $crumbs = array();
    private static $shablon = '';
    /**
     * clear function.
     * @access public
     * @static
     * @return void
     */

    public static function clear(): void {

        self::$crumbs = array();

    }


    /**
     * get function.
     * @access public
     * @static
     * @return array crumbs
     */

    public static function get()
    {

        return self::$crumbs;

    }

    /**
     * @param string $title
     * @param string $url
     * @return bool
     * @throws Exception
     */
    public static function add(string $title, string $url)
    {

        $array = array($title, $url);

        if(is_array($array) && count($array) == 2){

            array_push(self::$crumbs ,array('title' => $array[0],
                'url' => $array[1]
            ));

            return true;

        } else {

            throw new \Exception("Input to crumbs:add must be an array of 2 elements (array(title, url))!");

        }
    }

    public static function fromNodes($nodes, $sliceLink, $exclude = [])
    {
        // $link = trim($link,'/');
        // $linkFragments = explode('/', $link);
        foreach($nodes as $v){

            if(!in_array($v['tree_link'],$exclude) ){
                self::add( $v['tree_title'], str_replace($sliceLink,'',$v['tree_link']));
            }
        }

        return $result;
    }


    public static function fromNodeLink($link)
    {
        $link = trim($link,'/');
        $linkFragments = explode('/', $link);

        foreach($linkFragments as $v){
            self::add(array(
                'title'=>
                    'url'
            ));
        }
        return $result;
    }

    /**
     * add function.
     * @access public
     * @static
     * @param array array({title}, {url})
     * @return boolean TRUE | exception Breadcrumb_Exception
     */

    public static function Render()
    {
        $crumbs = self::$crumbs;
        ob_start();
        include (resource_path('views').'/chunk/crumbs.blade.php');

        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }

    public static function count(): int {
        return count(self::$crumbs);
    }
}

