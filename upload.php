<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload page</title>
</head>
<body>
    <form action="#" method="POST" enctype="multipart/form-data">
        <label for="title">Title: </label>
        <input type="text" id="title" name="title">
        <br>
        <label for="maintext">Main Text: </label>
        <input type="text" id="maintext" name="maintext">
        <br>
        <label for="imagepath">Image</label>
        <input type="file" id="imagepath" name="imagepath">
        <br>
        <label for="tags">Tags: </label>
        <input type="text" name="tags" id="tags">
        <input type="submit" value="Visa" name="visa">
    </form>
    <?php
    include "config.php";

        if(isset($_POST['visa'])){
            $title = $_POST['title'];
            $maintext = $_POST['maintext'];
            $tags = $_POST['tags'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["imagepath"]["name"]);
            move_uploaded_file($_FILES["imagepath"]["tmp_name"], $target_file);
            echo "<br> $title <br> $maintext <br> $tags <br>";
            echo $target_file;

            if($title == "" || $maintext == "" || $tags == "" )
            {
                die('We are sorry, but there appears to be a problem with the form you submitted.'); 
            }
            else
            {
                $sql = "INSERT INTO `postdata`(`title`, `maintext`, `imagepath`, `tags`) 
                VALUES ('$title','$maintext','$target_file','$tags')";
                $result = $conn->query($sql);

                if ($result == TRUE) 
                {
                    echo "New record created successfully.";
                }
                else
                {
                    echo "Error:". $sql . "<br>". $conn->error;
                }
            }
        }
    ?>
<!-- The plan was to rewrite this code to instead append the saved info from the 'postdata' Database and create cards that are the posts on the main page, but studying for other tests led to it being unfinished-->
<script>
    function pickedCity()
    {
        city = document.getElementById("City").value;
        fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=7ba920976a59594dd2b187296bee4343`)
        .then(location => location.json())
        .then(json => {
            createPost(json)
            console.log(json)
        }           
    )}

    function createPost(info)
        {
            var divcard = document.createElement("div");
            divcard.setAttribute("class", "card p-3 m-2");
            divcard.setAttribute("style", "width: 20rem");

            var cardtitle = document.createElement("h5");
            cardtitle.setAttribute("class", "card-title text-center fs-2");
            cardtitle.innerText = info.name;
            divcard.appendChild(cardtitle);

            var flexdiv = document.createElement("div");
            flexdiv.setAttribute("class", "d-flex align-items-center justify-content-center");
            divcard.appendChild(flexdiv);

            var cardtextWeather = document.createElement("p");
            cardtextWeather.setAttribute("class", "card-text text-center fs-3");
            cardtextWeather.innerText = Math.trunc(info.main.temp) + "°C";
            flexdiv.appendChild(cardtextWeather);

            var imgcard = document.createElement("img");
            imgcard.setAttribute("src", "http://openweathermap.org/img/wn/" + info.weather[0].icon + "@4x.png");
            imgcard.setAttribute("class", "img-fluid");
            imgcard.setAttribute("alt", info.weather[0].description);
            flexdiv.appendChild(imgcard);

            var cardtextFeel = document.createElement("p");
            cardtextFeel.setAttribute("class", "card-text");
            cardtextFeel.innerText = "Feels like: " + Math.trunc(info.main.feels_like) + "°C";
            divcard.appendChild(cardtextFeel);

            var flexdiv2 = document.createElement("div");
            flexdiv2.setAttribute("class", "d-flex justify-content-between");
            divcard.appendChild(flexdiv2);

            var cardtextMax = document.createElement("p");
            cardtextMax.setAttribute("class", "card-text");
            cardtextMax.innerText = "Max temp: " + Math.trunc(info.main.temp_max) + "°C";
            flexdiv2.appendChild(cardtextMax);

            var cardtextMin = document.createElement("p");
            cardtextMin.setAttribute("class", "card-text");
            cardtextMin.innerText = "Min temp: " + Math.trunc(info.main.temp_min) + "°C";
            flexdiv2.appendChild(cardtextMin);

            var flexdiv3 = document.createElement("div");
            flexdiv3.setAttribute("class", "d-flex justify-content-between");
            divcard.appendChild(flexdiv3);

            var cardtextWindDeg = document.createElement("p");
            cardtextWindDeg.setAttribute("class", "card-text");
            cardtextWindDeg.innerText = "Wind degree: " + info.wind.deg + "°";
            flexdiv3.appendChild(cardtextWindDeg);

            var cardtextWindSpeed = document.createElement("p");
            cardtextWindSpeed.setAttribute("class", "card-text");
            cardtextWindSpeed.innerText = "Wind speed: " + Math.trunc(info.wind.speed) + " m/s";
            flexdiv3.appendChild(cardtextWindSpeed);

            var card = document.body.appendChild(divcard);
            return card;
        }
</script>

</body>
</html>