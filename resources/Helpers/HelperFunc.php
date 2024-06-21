<?php

declare(strict_types=1);



function debug_to_console($data)
{
    $output = $data;

    if (is_array($output)) $output = implode(",", $output);

    echo "<script>console.log('Debug Objects: " . $output . "') </script>";
}
