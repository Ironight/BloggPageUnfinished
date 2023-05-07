<?php
session_start();
include "config.php";
include 'header.php';
?>
<form action="" method="POST">
<fieldset>
    <input type="submit" name="back" value="Go Back">
    <input type="submit" name="post" value="Create a Post">
    <button class="col text-center rounded border border-5" onclick="pickedCity()">Create a card!</button>
</fieldset>
</form>

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

<?php
echo "Right now the session name is " . $_SESSION['name'] . "<br>"; 
if($_SESSION['name'] != NULL){
    echo "<a href='logout.php'>Log Out</a>";
}
if($_SESSION['name'] == NULL){
    header('logout.php');
}
if (isset($_POST['back'])) {
    header('Location: signup.php');
}
if (isset($_POST['post'])) {
    header('Location: upload.php');
}
include 'footer.php';
?>
