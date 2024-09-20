<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;

$s3Client = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
        'key'    => 'your account key',
        'secret' => 'your account secret key'
    ]
]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["anyfile"]) && $_FILES["anyfile"]["error"] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["anyfile"]["name"];
        $filetype = $_FILES["anyfile"]["type"];
        $filesize = $_FILES["anyfile"]["size"];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

        $maxsize = 10 * 1024 * 1024;
        if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

        if (in_array($filetype, $allowed)) {
            if (file_exists("uploads/" . $filename)) {
                echo $filename . " already exists.";
            } else {
                if (move_uploaded_file($_FILES["anyfile"]["tmp_name"], "uploads/" . $filename)) {
                    $bucket = 's3-join';
                    $file_Path = __DIR__ . '/uploads/' . $filename;
                    $key = basename($file_Path);

                    try {
                        $result = $s3Client->putObject([
                            'Bucket' => $bucket,
                            'Key'    => $key,
                            'Body'   => fopen($file_Path, 'r'),
                            'ACL'    => 'public-read',
                        ]);

                        echo "Image uploaded successfully. Image path is: " . $result->get('ObjectURL');
                        $urls3 = $result->get('ObjectURL');

                        $name = $_POST["name"];

                        $servername = "database-1.ct6sya4y0gq9.us-east-1.rds.amazonaws.com";
                        $username = "admin";
                        $password = "Pass1234";
                        $dbname = "images";

                        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        // Check connection
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Assuming 'id' is an auto-incrementing primary key
                        $sql = "INSERT INTO posts(name, url) VALUES('$name', '$urls3')";

                        if (mysqli_query($conn, $sql)) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }

                        mysqli_close($conn);

                    } catch (Aws\S3\Exception\S3Exception $e) {
                        echo "There was an error uploading the file.\n";
                        echo $e->getMessage();
                    }

                    echo "Your file was uploaded successfully.";
                } else {
                    echo "File is not uploaded";
                }
            }
        } else {
            echo "Error: There was a problem uploading your file. Please try again.";
        }
    } else {
        echo "Error: " . $_FILES["anyfile"]["error"];
    }
}