<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/3/2015
 * Time: 10:12 AM
 */

if (!function_exists('permalink'))
{
    function permalink($str, $add = null, $isStriped = true, $isCapitalized = false)
    {
        $permalink = preg_replace('/[^[a-zA-z0-9 ]/','',$str);

        if($isCapitalized){
            $permalink = ucwords($permalink);
        }
        else{
            $permalink = strtolower($permalink);
        }

        if($isStriped){
            $permalink = preg_replace('/\s+/','-',$permalink);
        }
        else{
            $permalink = preg_replace('/\s+/','',$permalink);
        }

        if($add != null){
            $permalink .= "-$add";
        }

        return $permalink;
    }

    function permalink_id($permalink)
    {
        return end(explode("-",$permalink));
    }
}
