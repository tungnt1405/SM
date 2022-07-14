<?php

if (!function_exists('dd')) {
    function dd($data)
    {
        highlight_string("<?php\n " . var_export($data, true) . "?>");
        echo '<script>document.getElementsByTagName("code")[0].getElementsByTagName("span")[1].remove() ;document.getElementsByTagName("code")[0].getElementsByTagName("span")[document.getElementsByTagName("code")[0].getElementsByTagName("span").length - 1].remove() ; </script>';
        exit;
    }
}
if (!function_exists('ddd')) {
    function ddd($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit;
    }
}