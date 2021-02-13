<!DOCTYPE html>
<html>
<body>

<p>Click the button labeled "Log Time" to store the time you pressed the button.</p>

<button onclick="LodCurrentTime()">Log Time</button>

<button onclick="lblTime"></button>

<script>
    function LogCurrentTime() {
        var date = new Date();
        var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
        var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
        var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
        time = hours + ":" + minutes + ":" + seconds;
        document.getElementById("lblTime").innerHTML = time;

    };
</script>

</body>
</html>
