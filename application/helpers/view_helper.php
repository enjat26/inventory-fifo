<?php
use Jenssegers\Blade\Blade;
if (!function_exists('view')) 
{
    // Parameter pertama adalah nama view
    // Parameter kedua adalah data dalam bentuk array
    function view($view, $data = [])
    {
        $ci =& get_instance();
        $ci->load->library('session');
        // Path folder views
        $viewDirectory = VIEWPATH;
        // Path folder cache
        $cacheDirectory = APPPATH . 'cache';
        
        $blade = new Blade($viewDirectory, $cacheDirectory);
        echo $blade->make($view, $data);
    }
}
?>