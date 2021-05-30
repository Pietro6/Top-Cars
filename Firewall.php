<html>

<head>

</head>

<body>
    <?php
    function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    function FireWall($packet) {
        $packets = str_split($packet);
        $acl = array("!", "\"", "\'", "|", "£", "$", "%", "\\", "(", ")", "[", "]", "{", "}", "/","=");
        foreach ($acl as $a) {
            foreach ($packets as $p) {
                if ($p == $a) {
                    alert("Carattere speciale non accettato");
                    return false;
                }
            }
        }
        return true;
    }
    ?>
    <body>
</html>