<?php
    function genDays()
    {
        $days = "";
        for ($i = MIN_DAY; $i <= MAX_DAY; $i++)
        {
            $days = $days . '<option value="' . $i . '">' . $i .'</option>';
        }
        return $days;
    }

    function genYears()
    {
        $years = "";
        for ($i = MAX_YEAR; $i >= MIN_YEAR; $i--)
        {
            $years = $years . '<option value="' . $i . '">' . $i .'</option>';
        }
        return $years;
    }
