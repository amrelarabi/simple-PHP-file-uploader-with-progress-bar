<html>
<head>
    <title>File uploader</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/dropzone.js"></script>
    <link rel="stylesheet" href="./assets/css/dropzone.css">
    <link rel="stylesheet" href="./assets/css/custom.css">
</head>
<body>
<div class="wrapper">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="dropzone" id="file_upload">
        <div class="fallback">
            <input name="file" type="file" multiple />
        </div>
    </form>
    <progress id="progress" value="0" max="100"></progress>
    <div id="file_uploaded"></div>
</div>


<?php
$ds          = DIRECTORY_SEPARATOR;
$storeFolder = 'uploads';
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
    $targetFile =  $targetPath. $_FILES['file']['name'];
    move_uploaded_file($tempFile,$targetFile);
}
?>
</body>
<script>
    Dropzone.autoDiscover = false;
    $(document).ready(function (){
        $(function() {
            let myDropzone = new Dropzone("#file_upload");
            myDropzone.on("uploadprogress", function(file, progress) {
                $("#progress").val(progress);
                $("#file_uploaded").text(progress+' %');
            });
            myDropzone.on("complete", function (){
                $("#file_uploaded").text('File uploaded Successfully');
            });

        })
    })
</script>
</html>