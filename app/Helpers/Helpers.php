<?php

function quote($value)
{
    if (is_array($value)) {
        foreach ($value as &$val) {
            $val = quote($val);
        }
        return implode(', ', $value);
    }
    return _quote($value);
}

function _quote($value): string
{
    return "'" . addcslashes($value, "\000\n\r\\'\"\032") . "'";
}

function qv($value)
{
    return quote($value);
}
