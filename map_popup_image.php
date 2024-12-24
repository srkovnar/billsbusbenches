<?php
    # This is for accessing marker images outside of the root directory.
    header('Content-Type: image/jpg');
    readfile("../map_popup_images/" . basename($_GET['img']));
    # Note that echo will not work in this type of PHP file, since it's an asset, not a script.
    # TODO: Detect the file type programmatically.
