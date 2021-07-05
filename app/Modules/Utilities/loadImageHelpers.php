<?php
function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }

        $url .= ' />';
    }
    return $url;
}

function map_storage_path_to_link($path = null)
{
    if (!$path) {
        return url('storage');
    }

    $dirs = explode('/', $path);
    if ($dirs[0] === 'public') {
        $dirs[0] = 'storage';
    }

    return implode('/', $dirs);
}
function map_storage_path_to_link_relative($path = null)
{
    if (!$path) {
        return 'storage';
    }

    $dirs = explode('/', $path);
    if ($dirs[0] === 'public') {
        $dirs[0] = 'storage';
    }

    return url(implode('/', $dirs));
}

function resize_image_url($path, $type)
{

    $path = explode('/', $path);
    $end = end($path);

    return route('imagecache', [$type, $end]);
}

function getFavIcon()
{
    if (config('systemSetting.favicon_icon') != null) {
        return map_storage_path_to_link(config('systemSetting.favicon_icon'));
    }
}
function getFrontendPrimaryLogo()
{
    if (config('systemSetting.frontend_primary_logo') != null) {
        return map_storage_path_to_link(config('systemSetting.frontend_primary_logo'));
    }
}
function getFrontendSecondaryLogo()
{
    if (config('systemSetting.frontend_secondary_logo') != null) {
        return map_storage_path_to_link(config('systemSetting.frontend_secondary_logo'));
    }
}
function getFrontendFooterLogo()
{
    if (config('systemSetting.frontend_footer_logo ') != null) {
        return map_storage_path_to_link(config('systemSetting.frontend_footer_logo'));
    }
}
function getAdminDashboardLogo()
{
    if (config('systemSetting.admin_dashboard_logo ') != null) {
        return map_storage_path_to_link(config('systemSetting.admin_dashboard_logo '));
    }
}
