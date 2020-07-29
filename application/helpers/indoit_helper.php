<?php
if ( ! function_exists('element')) {
	
    function indoit_get_ip_address()
    {
        $ci = &get_instance();

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
        //return $ci->input->ip_address();
    }

    function indoit_get_mac_address()
    {
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $macAddr="UNKNOWN";

        #run the external command, break output into lines
        // $arp=`arp -a $ipAddress`;
        // $lines=explode("\n", $arp);

        // #look for the output line describing our IP address
        // foreach($lines as $line)
        // {
        //    $cols=preg_split('/\s+/', trim($line));
        //    if ($cols[0]==$ipAddress)
        //    {
        //        $macAddr=$cols[1];
        //    }
        // }
        return $macAddr;
    }
}

?>