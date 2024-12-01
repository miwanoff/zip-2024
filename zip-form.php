<?php
$error = "";
if (isset($_POST['createzip'])) {
    $post = $_POST;
    $file_folder = "files/";
    if (extension_loaded('zip')) {
        if (isset($post['files']) and count($post['files']) > 0) {
            $zip = new ZipArchive();
            $zip_name = time() . ".zip";
            if ($zip->open($zip_name, ZIPARCHIVE::CREATE) !== true) {
                $error .= "* Sorry ZIP creation failed at this time";
            }
            foreach ($post['files'] as $file) {
                $zip->addFile($file_folder . $file);
            }
            $zip->close();
            if (file_exists($zip_name)) {
                header('Content-type: application/zip');
                header('Content-Disposition: attachment; filename="' . $zip_name . '"');
                readfile($zip_name);
                unlink($zip_name);
            }
        } else {
            $error .= "* Please select file to zip ";
        }

    } else {
        $error .= "* You dont have ZIP extension";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form name="zips" method="post" action="zip-form.php">
        <input type="checkbox" name="files[]" value="icon.png" />icon.png<br />
        <input type="checkbox" name="files[]" value="im2.jpg" />im2.jpg<br />
        <input type="checkbox" name="files[]" value="str.docx" />str.docx<br />
        <input type="submit" name="createzip" value="Download as ZIP" /><br />
        <input type="reset" name="reset" value="Reset" />
    </form>
</body>

</html>