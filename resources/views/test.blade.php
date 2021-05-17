<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FiveOne Socket.io</title>
    <style>
        .cropit-preview {
            /* You can specify preview size in CSS */
            width: 960px;
            height: 540px;
        }

        .image-wrapper {
            position: relative;
            height: 250px;
            width: 250px;
            margin: 0 auto;
            border-radius: 100%;
            overflow: hidden;
        }

        .image-wrapper img {
            height: 100%;
            width: 100%;
        }
        .image-wrapper .image-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background-color: rgba(255, 0, 0,.25);
            color: #fff;
            display: none;
        }
        .image-wrapper:hover .image-overlay {
            display: block;
        }
        .image-wrapper .image-overlay .content {
            position: absolute;
            top: 50%;
            left: 50%;
            height: 20px;
            width: 150px;
            margin-top: -10px;
            margin-left: -75px;
        }
    </style>
</head>
<body>
<div class="image-wrapper">
  <span class="image-overlay">
    <span class="content">I'm an overlay.</span>
  </span>
    <img src="http://placekitten.com/g/1280/800">
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

</script>

</body>
</html>