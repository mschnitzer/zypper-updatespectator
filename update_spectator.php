<?php
 // the list of all updateable packages
 $packages = array();

 // the shell command for the script. The script can be executed as a
 // normal user without root privileges but then we cannot update all
 // repositories - the timeout is needed if "zypper ref" hangs in
 // a "do you want to trust this certificate?"- loop.
 $shell_cmd = 'timeout 15 zypper ref 2> /dev/null ; zypper list-updates';

 $out = explode("\n", shell_exec($shell_cmd));
 $start = false;
 $skip = false;

 foreach ($out as $o) {
     if ($start == false) {
         if ($o == 'No updates found.') {
             // when no updates were found, just exit with 1
             exit(1);
         }

         if (strstr($o, 'S | Repository')) {
             // switch to the "data collecting" mode
             $start = true;

             // skip the next line (the next line is just a part of the table without any useful data)
             $skip = true;
         }
     }
     else {
         if ($skip == true) {
             $skip = false;
         }
         else {
             // split the table entries
             $data = explode('|', $o);

             // check if the data of the table has the correct length
             if (count($data) == 6) {
                 // create a new entry in the array
                 $packages[] = array(
                     'repository' => trim($data[1]),
                     'name' => trim($data[2]),
                     'installed_version' => trim($data[3]),
                     'available_version' => trim($data[4]),
                     'arch' => trim($data[5])
                 );
             }
         }
     }
 }

 // this line is just for the demo effect
 print_r($packages);
?>
