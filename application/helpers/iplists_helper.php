<?php

/** check valid IP * */
function check_ip($ip) {

    if (preg_match('/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])/', $ip)) {
        return TRUE;
    }

    return FALSE;
}

function clean_ip($ip) {
    $ip = trim($ip, "\x00..\x1F");

    return $ip;
}

function read_ipset($filename) {
    $ipsets = array();
    $handle = fopen($filename, "r");
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
            if (preg_match('/#/', $buffer)) {
                continue;
            }
            //IP address should be in the right format
            if (preg_match('/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])/', $buffer)) {
                array_push($ipsets,clean_ip($buffer));
            }
        }

        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }
    return $ipsets;
}
