<!-- 
    NAME: ASHRAF DIAB
    PHONE: 01020869595
    EMAIL: ashraf.diab22.ad@gmail.com
-->

<!-- ============================================================ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task | Ashraf Diab</title>

    <!-- CSS file -->
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <!-- Start container -->
    <div class="container">
        <!-- Start error div (hidden div -> shown if there is an error) -->
        <div class="error" id="err-div"></div>
        <!-- End error div -->

        <!-- Start form -->
        <form class="form">
            <!-- Start input div -->
            <div class="group">
                <input type="number" id="num1" name="num1" class="input" placeholder="First Number">
            </div>
            <!-- End input div -->
            
            <!-- Start input div -->
            <div class="group">
                <input type="number" id="num2" name="num2" class="input" placeholder="Second Number">
            </div>
            <!-- End input div -->

            <!-- Start button div -->
            <div class="group">
                <!-- <button onclick="sendRequest()" class="btn">Calculate</button> -->
                <input type="submit" class="btn" value="Calculate">
            </div>
            <!-- End button div -->
        </form>
        <!-- End form -->

        <!-- Start results div -->
        <div class="results">
            <div class="result">
                <div class="res">Summation</div>
                <div class="res" id="sumRes">0</div>
            </div>
            <div class="result">
                <div class="res">Multplication</div>
                <div class="res" id="mulRes">0</div>
            </div>
            <div class="result">
                <div class="res">Subtraction</div>
                <div class="res" id="subRes">0</div>
            </div>
            <div class="result">
                <div class="res">Division</div>
                <div class="res" id="divRes">0</div>
            </div>
        </div>
        <!-- End results div -->

    </div>
    <!-- End container -->
</body>
</html>

<!-- jQuery CDN -->
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>
    /**
     * function to send ajax request with form data to api.php
    */
    $(function () {
        $('form').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: "api.php",
                data: $('form').serialize(),
                success: (data) => {
                    console.log(data);
                    $('#err-div').html('');
                    let sumRes = data.sum;
                    let mulRes = data.mult;
                    let subRes = data.sub;
                    let divRes = data.div;
                    document.getElementById('sumRes').innerHTML = sumRes;
                    document.getElementById('mulRes').innerHTML = mulRes;
                    document.getElementById('subRes').innerHTML = subRes;
                    document.getElementById('divRes').innerHTML = divRes;
                },
                error: (data, error) => {
                    console.log(data.responseText);
                    let errorShow = '<div class="danger">'+data.responseText+'</div>';
                    $('#err-div').html(errorShow);
                }
            });
        });
    });
</script>
