<?php
    define("ACCURACY", 4); //Количество знаков после запятой
    define("EVEN_CLASS", "even");
    define("DEFAULT_DEGREES", 10);
    define("DEFAULT_MINUTES", 6);
    define("FULL_RING", 360);
    define("HALF_RING", 180);
    define("FULL_MINUTE", 60);

    $degInterval = complainInputNumbers($_GET['degrees']) ? $_GET['degrees'] : DEFAULT_DEGREES;
    $minuteInterval = complainInputNumbers($_GET['minutes']) ? $_GET['minutes'] : DEFAULT_MINUTES;

    $headerPath = "/html/header.html";
    $footerPath = "/html/footer.html";

    function complainInputNumbers($data)
    {
        $isNorm = isset($data) && !empty($data) && !preg_match('/[^0-9]/', $data);
        return $isNorm;
    }

    function gradToRad($grad)
    {
        return M_PI * $grad / HALF_RING;
    }

    function min2deg($min)
    {
        return $min / FULL_MINUTE;
    }

    function createFirstLine($minuteInterval)
    {
        $firstLine = "<tr><th>0&deg;</th>";
        for($i = 0; $i <= FULL_MINUTE; $i += $minuteInterval)
        {
            $firstLine = $firstLine . "<th>" . $i . "′</th>";
        }
        $firstLine = $firstLine . "</tr>";
        return $firstLine;
    }

    function createTableLine($angle, $minInterval, $lineClass)
    {
        $currLine = "<tr class=" . $lineClass . "><th>" . $angle . "&deg;</th>";
        for($i = 0; $i <= FULL_MINUTE; $i += $minInterval)
        {
            $currAngle = gradToRad($angle + min2deg($i));
            $currLine = $currLine . "<td>" . round(sin($currAngle), ACCURACY)  . "</td>";
        }
        $currLine = $currLine . "</tr>";
        return $currLine;
    }

    function showSinTable($degInterval, $minInterval)
    {
        echo createFirstLine($minInterval);
        for ($i = $degInterval; $i <= FULL_RING; $i += $degInterval)
        {
            echo createTableLine($i, $minInterval, EVEN_CLASS);
            $i += $degInterval;
            echo createTableLine($i, $minInterval, '');
        }
    }


    include($headerPath);
    showSinTable($degInterval, $minuteInterval);
    include($footerPath);
