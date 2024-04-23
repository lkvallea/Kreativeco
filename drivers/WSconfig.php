<?php
function getDevice($user_agent)
{
    if (strpos($user_agent, 'Android') !== FALSE)
        return 'and';
    elseif (strpos($user_agent, 'iPhone') !== FALSE)
        return 'iph';
    elseif (strpos($user_agent, 'iPad') !== FALSE)
        return 'ipa';
    elseif (strpos($user_agent, 'iPod') !== FALSE)
        return "ipo";
    elseif (strpos($user_agent, 'samsung') !== FALSE)
        return 'smg';
    elseif (strpos($user_agent, 'Tablet') !== FALSE)
        return 'tbl';
    elseif (strpos($user_agent, 'Mobile') !== FALSE)
        return "mob";
    elseif (strpos($user_agent, 'Macintosh') !== FALSE)
        return 'mac';
    elseif (strpos($user_agent, 'Windows') !== FALSE)
        return 'pc';
    else
        return 'Otr';
}

function getBrowser($user_agent)
{
    if (strpos($user_agent, 'MSIE') !== FALSE)
        return 'Internet-explorer';
    elseif (strpos($user_agent, 'Edge') !== FALSE) // Microsoft Edge
        return 'Microsoft-Edge';
    elseif (strpos($user_agent, 'Trident') !== FALSE) // IE 11
        return 'Internet-explorer';
    elseif (strpos($user_agent, 'Opera Mini') !== FALSE)
        return "Opera-Mini";
    elseif (strpos($user_agent, 'OPR') !== FALSE)
        return "Opera";
    elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
        return "Opera";
    elseif (strpos($user_agent, 'Firefox') !== FALSE)
        return 'Mozilla-Firefox';
    elseif (strpos($user_agent, 'Chrome') !== FALSE)
        return 'Google-Chrome';
    elseif (strpos($user_agent, 'Safari') !== FALSE)
        return "Safari";
    else
        return 'Other';
}

function getClientIP($user_agent)
{
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $user_agent)) {
        return $user_agent["HTTP_X_FORWARDED_FOR"];
    } else if (array_key_exists('REMOTE_ADDR', $user_agent)) {
        return $user_agent["REMOTE_ADDR"];
    } else if (array_key_exists('HTTP_CLIENT_IP', $user_agent)) {
        return $user_agent["HTTP_CLIENT_IP"];
    }
    return 's/n';
}


function getClass($action)
{
    $user = [
        'createUser',
        'getAllUser'
    ];
    
    $log = [
        'logIn',
        'logout'
    ];

    $blog = [
        'newPost',
        'editPost',
        'deletePost',
        'getAllPost'
    ];
    if (in_array($action, $log)) {
        return include ('../class/cLog.php');
    } elseif (in_array($action, $blog)) {
        return include ('../class/cBlog.php');
    } elseif (in_array($action, $user)) {
        return include ('../class/cUser.php');
    } 
}

