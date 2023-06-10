<!DOCTYPE html>
<html>
<head>
  <title>ShortestURL - URL Shortener</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      padding: 20px;
    }
    .text-center {
      text-align: center;
    }
  </style>
</head>
<body>
  <h1 class="text-center">ShortestURL - URL Shortener</h1>

  <div class="container">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" target="_blank">
      <div class="mb-3">
        <label for="original-url" class="form-label">Enter the URL to be shortened:</label>
        <input type="url" id="original-url" class="form-control" name="original-url" required>
      </div>
      <button type="submit" class="btn btn-primary">Shorten</button>
    </form>
  </div>

  <br>

  <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $originalUrl = $_POST["original-url"];
      $id = generateRandomId(5);
      $shortUrl = "https://s.tiiny.site/?g=" . $id;

      $file = fopen("links.txt", "a");
      if ($file) {
        fwrite($file, $id . ": " . $originalUrl . "\n");
        fclose($file);

        echo '<div id="short-url-container" class="container">
              <p>Short URL: <a id="short-url" href="' . $shortUrl . '">' . $shortUrl . '</a></p>
              <p>ID: ' . $id . '</p>
            </div>';
      } else {
        echo '<div class="alert alert-danger" role="alert">
                Error storing URL.
              </div>';
      }
    }

    function generateRandomId($length) {
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      $result = "";
      for ($i = 0; $i < $length; $i++) {
        $result .= $chars[mt_rand(0, strlen($chars) - 1)];
      }
      return $result;
    }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
