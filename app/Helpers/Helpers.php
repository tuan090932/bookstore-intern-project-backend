<?php

if (!function_exists('formatVND'))
{
    function formatVND($number)
    {
        return number_format($number, 0, ',', '.') . '₫';
    }
}
