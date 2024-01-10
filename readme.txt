
  _   _                   _
 | \ | | _____      _____| | ___| |_| |_ ___ _ __  / ___| _   _ ___| |_ ___ _ __ ___  
 |  \| |/ _ \ \ /\ / / __| |/ _ \ __| __/ _ \ '__| \___ \| | | / __| __/ _ \ '_ ` _ \ 
 | |\  |  __/\ V  V /\__ \ |  __/ |_| ||  __/ |     ___) | |_| \__ \ ||  __/ | | | | |
 |_| \_|\___| \_/\_/ |___/_|\___|\__|\__\___|_|    |____/ \__, |___/\__\___|_| |_| |_|
             | |__  _   _                                 |___/                       
             | '_ \| | | |                                                            
             | |_) | |_| |                                                            
        _    |_.__/ \__, |    _             __  __                                    
       / \   _ __   |___/ ___| | ___  ___  |  \/  | __ ___   ___ __ ___  ___          
      / _ \ | '_ \ / _` |/ _ \ |/ _ \/ __| | |\/| |/ _` \ \ / / '__/ _ \/ __|         
     / ___ \| | | | (_| |  __/ | (_) \__ \ | |  | | (_| |\ V /| | | (_) \__ \         
    /_/   \_\_| |_|\__, |\___|_|\___/|___/ |_|  |_|\__,_| \_/ |_|  \___/|___/         
          __   ____|___/_  / | / _ \                                                  
          \ \ / / _ \ '__| | || | | |                                                 
           \ V /  __/ |    | || |_| |                                                 
            \_/ \___|_|    |_(_)___/                                                  
                                                                                      

* Newsletter System Version 1.0 by Angelos Mavros
* Written on September 2022 for PHP 5.2.17.
* Tested on nginx/1.20.2 with PHP ver7.4.30 & 10.4.26-MariaDB.
* All rights reserved.
* Check on https://www.github.com/djopensource for the latest version.
* The credentials of the admin panel are "cheese" for username and "burger" for password.


Known Bugs:
-----------
bounced.php
- unsubscribes only the last address of the array (but sometimes works)
- "empty trash bin" doesn't work
- only the 1st (or the last) bounced email is detected
