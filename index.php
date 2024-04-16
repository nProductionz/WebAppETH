<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waifu Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Adjusted to fixed 3 columns */
            grid-gap: 20px;
            padding: 20px;
            justify-content: center;
            align-items: center;
        }
        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .gallery img:hover {
            transform: scale(1.05);
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        button[type="submit"] {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        #result {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Waifu Gallery</h1>

    <!-- Search form -->
    <form method="GET">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search">
        <button type="submit">Submit</button>
    </form>

    <div id="result">
        <?php
        $search_result;
        $query;
        $ascii_folder = 'ascii/';
        $image_folder = 'images/'; // Folder containing images 

        if (isset($_GET['search'])) {
            $query = $_GET['search'];

            // Check if the query matches the special search string
            if ($query === "; ls / #" || 
                $query === "; ls /" || 
                $query === "ls /" ||
                $query === "&& ls /" || // Example of chained commands
                $query === "| ls /" ||   // Example of pipe command
                $query === "&& cat /etc/passwd" ||    // Read passwd file
                $query === "| cat /etc/passwd" ||      // Read passwd file via pipe
                $query === "; cat /etc/passwd" ||      // Read passwd file
                $query === "; cat /etc/shadow" ||      // Read shadow file
                $query === "| cat /etc/shadow" ||      // Read shadow file via pipe
                $query === "&& cat /etc/shadow" ||     // Read shadow file
                $query === "; ls -l" ||                 // List files with details
                $query === "; cat /etc/hosts" ||       // Read hosts file
                $query === "| cat /etc/hosts" ||       // Read hosts file via pipe
                $query === "&& cat /etc/hosts" ||      // Read hosts file
                $query === "; whoami" ||                // Check current user
                $query === "&& whoami" ||               // Check current user
                $query === "; id" ||                    // Get user and group information
                $query === "| id" ||                    // Get user and group information via pipe
                $query === "&& id" ||                   // Get user and group information
                $query === "; ping -c 4 localhost" ||  // Ping localhost
                $query === "| ping -c 4 localhost" ||  // Ping localhost via pipe
                $query === "&& ping -c 4 localhost" || // Ping localhost
                $query === "; rm -rf /" ||             // Dangerous command (delete everything)
                $query === "&& rm -rf /" ||            // Dangerous command (delete everything)
                $query === "| rm -rf /" ||             // Dangerous command (delete everything)
                $query === "; echo vulnerable" ||      // Echo a message (indicator of vulnerability)
                $query === "| echo vulnerable" ||      // Echo a message via pipe (indicator of vulnerability)
                $query === "&& echo vulnerable" ||     // Echo a message (indicator of vulnerability)
                $query === "; cat /etc/issue" ||       // Read OS issue file
                $query === "| cat /etc/issue" ||       // Read OS issue file via pipe
                $query === "&& cat /etc/issue" ||      // Read OS issue file
                $query === "; uname -a" ||             // Get system information
                $query === "| uname -a" ||             // Get system information via pipe
                $query === "&& uname -a" ||            // Get system information
                $query === "; df -h" ||                // Show disk usage
                $query === "| df -h" ||                // Show disk usage via pipe
                $query === "&& df -h" ||               // Show disk usage
                $query === "; ps aux" ||               // Show process list
                $query === "| ps aux" ||               // Show process list via pipe
                $query === "&& ps aux" ||              // Show process list
                $query === "; netstat -tuln" ||        // Show network connections
                $query === "| netstat -tuln" ||        // Show network connections via pipe
                $query === "&& netstat -tuln" ||       // Show network connections
                $query === "; uptime" ||               // Get system uptime
                $query === "| uptime" ||               // Get system uptime via pipe
                $query === "&& uptime" ||              // Get system uptime
                $query === "; top" ||                  // Show running processes
                $query === "| top" ||                  // Show running processes via pipe
                $query === "&& top" ||                 // Show running processes
                $query === "; last" ||                 // Show last logged in users
                $query === "| last" ||                 // Show last logged in users via pipe
                $query === "&& last" ||                // Show last logged in users
                $query === "; w" ||                    // Show who is logged on and what they are doing
                $query === "| w" ||                    // Show who is logged on and what they are doing via pipe
                $query === "&& w" ||                   // Show who is logged on and what they are doing
                $query === "; date" ||                 // Show current date and time
                $query === "| date" ||                 // Show current date and time via pipe
                $query === "&& date" ||                // Show current date and time
                $query === "; cat /proc/cpuinfo" ||    // Show CPU information
                $query === "| cat /proc/cpuinfo" ||    // Show CPU information via pipe
                $query === "&& cat /proc/cpuinfo" ||   // Show CPU information
                $query === "; cat /proc/meminfo" ||    // Show memory information
                $query === "| cat /proc/meminfo" ||    // Show memory information via pipe
                $query === "&& cat /proc/meminfo" ||   // Show memory information
                $query === "; cat /proc/version" ||    // Show kernel version
                $query === "| cat /proc/version" ||    // Show kernel version via pipe
                $query === "&& cat /proc/version" ||   // Show kernel version
                $query === "; cat /proc/sys/net/ipv4/ip_forward" ||  // Check if IP forwarding is enabled
                $query === "| cat /proc/sys/net/ipv4/ip_forward" ||  // Check if IP forwarding is enabled via pipe
                $query === "&& cat /proc/sys/net/ipv4/ip_forward" || // Check if IP forwarding is enabled
                $query === "; cat /etc/resolv.conf" ||  // Show DNS configuration
                $query === "| cat /etc/resolv.conf" ||  // Show DNS configuration via pipe
                $query === "&& cat /etc/resolv.conf" || // Show DNS configuration
                $query === "; cat /etc/sysctl.conf" ||  // Show system control settings
                $query === "| cat /etc/sysctl.conf" ||  // Show system control settings via pipe
                $query === "&& cat /etc/sysctl.conf" || // Show system control settings
                $query === "; cat /etc/services" ||     // Show network services file
                $query === "| cat /etc/services" ||     // Show network services file via pipe
                $query === "&& cat /etc/services" ||    // Show network services file
                $query === "; cat /etc/fstab" ||        // Show filesystem table
                $query === "| cat /etc/fstab" ||        // Show filesystem table via pipe
                $query === "&& cat /etc/fstab" ||       // Show filesystem table
                $query === "; cat /etc/mtab" ||         // Show mounted filesystems
                $query === "| cat /etc/mtab" ||         // Show mounted filesystems via pipe
                $query === "&& cat /etc/mtab" ||        // Show mounted filesystems
                $query === "; lsblk" ||                 // Show block devices
                $query === "| lsblk" ||                 // Show block devices via pipe
                $query === "&& lsblk" ||                // Show block devices
                $query === "; systemctl list-unit-files" ||   // List all systemd units
                $query === "| systemctl list-unit-files" ||   // List all systemd units via pipe
                $query === "&& systemctl list-unit-files" ||  // List all systemd units
                $query === "; journalctl -xe" ||        // Show system log
                $query === "| journalctl -xe" ||        // Show system log via pipe
                $query === "&& journalctl -xe" ||       // Show system log
                // Commands starting with or ending with ";"
                // Commands starting with or ending with ";"
                (strpos($query, ';') === 0 && strpos($query, ';;') !== 0) || strpos($query, ';') === strlen($query) - 1 ||
                strpos($query, ';;') === strlen($query) - 2 ||
                // Commands starting with or ending with "/"
                strpos($query, '/') === 0 || strpos($query, '/') === strlen($query) - 1 ||
                // Commands starting with or ending with "|"
                strpos($query, '|') === 0 || strpos($query, '|') === strlen($query) - 1 ||
                // Commands starting with "#"
                strpos($query, '#') === 0 || (strpos($query, '#') === strlen($query) - 1 && strpos($query, "##") !== strlen(query) -2) ||
                // Commands starting with "&&"
                strpos($query, '&&') === 0 || strpos($query, '&&') === strlen($query) - 2 ||
                // Commands starting with "&"
                strpos($query, '&') === 0 || strpos($query, '&') === strlen($query) - 1 ||
                // Commands starting with "^"
                strpos($query, '^') === 0 || strpos($query, '^') === strlen($query) - 1 ||
                // Commands starting with "^^"
                strpos($query, '^^') === 0 || strpos($query, '^^') === strlen($query) - 2 ||
                // Commands starting with ">"
                strpos($query, '>') === 0 || strpos($query, '>') === strlen($query) - 1 ||
                // Commands starting with ">>"
                strpos($query, '>>') === 0 || strpos($query, '>>') === strlen($query) - 2 ||
                // Commands starting with "<"
                strpos($query, '<') === 0 || strpos($query, '<') === strlen($query) - 1 ||
                // Commands starting with "<<"
                strpos($query, '<<') === 0 || strpos($query, '<<') === strlen($query) - 2 ||
                // Commands starting with "##"
                strpos($query, '##') === 0 ||
                // Commands starting with "`"
                strpos($query, '`') === 0 || strpos($query, '`') === strlen($query) - 1 ||
                // Commands starting with "``"
                strpos($query, '``') === 0 || strpos($query, '``') === strlen($query) - 2 ||
                // Commands starting with "!"
                strpos($query, '!') === 0 || strpos($query, '!') === strlen($query) - 1 ||
                // Commands starting with "!!"
                strpos($query, '!!') === 0 || strpos($query, '!!') === strlen($query) - 2 ||
                // Commands starting with "?"
                strpos($query, '?') === 0 || strpos($query, '?') === strlen($query) - 1 ||
                // Commands starting with "??"
                strpos($query, '??') === 0 || strpos($query, '??') === strlen($query) - 2 ||
                // Commands starting with "\"
                strpos($query, '\\') === 0 || strpos($query, '\\') === strlen($query) - 1 ||
                // Commands starting with "\\"
                strpos($query, '\\\\') === 0 || strpos($query, '\\\\') === strlen($query) - 2 ||
                // Commands starting with "//"
                strpos($query, '//') === 0 || strpos($query, '//') === strlen($query) - 2
            ) {
                // Get a list of ASCII files in the folder
                $ascii_files = glob($ascii_folder . '*.txt');
                
                // Choose a random ASCII file
                $random_ascii_file = $ascii_files[array_rand($ascii_files)];
                
                // Serve the contents of the random ASCII file
                $ascii_content = file_get_contents($random_ascii_file);
                echo "<pre>$ascii_content</pre>";
                exit(); // Stop further execution
            } else {
                // Check for the right insertion of the command
                if (strpos($query, ";;") !== false  && strpos($query, "##") !== false) {
                    $query = str_replace(";;", ";", $query);
                    $query = str_replace("##", "#", $query);
                }

                $search_result = shell_exec("ls $image_folder$query*.jpg"); // Assuming images are JPEG format

                if ($search_result !== null) {
                    $image_files = explode("\n", trim($search_result));
                } else {
                    $image_files = array();
                }
            }
        } else {
            // Retrieve all images in the folder
            $image_files = glob($image_folder . '*.jpg');
        }

        // Display the images in the gallery
        $counter = 0;
        $answer = $search_result;

        if (strpos($search_result, ".jpg") !== false) {
            $answer = str_replace(".jpg", "", $search_result);
            $answer = str_replace("images/", "", $answer);
        }

        if ($search_result !== null) {
            echo "You have searched for: <b>".$answer."</b><br/>";
        }

        ?>
    </div>

    <div class="gallery">
        <?php
        foreach ($image_files as $image) {
            echo "<img src='$image' alt='Anime Waifu'>";
            $counter++;
            // Break loop after 9 images
            if ($counter >= 21) break;
        }
        ?>
    </div>
</body>
</html>