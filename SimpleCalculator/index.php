<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calc for IT.AZAVOD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="header clearfix">
        <h3 class="text-muted">Калькулятор для <span id="it">IT.</span><span id="az">AZAVOD</span></h3>
        <h3 class="text-muted">от Маркова Юрия</h3>
    </div>

    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <input class="textField" id="result" placeholder="0" readonly>
            <button class="btn btn-default clearBtn" type="submit">C</button>
        </div>
    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <button class="btn btn-default numberBtn" type="submit">7</button>
        <button class="btn btn-default numberBtn" type="submit">8</button>
        <button class="btn btn-default numberBtn" type="submit">9</button>
        <button id="divider" class="btn btn-default operatorBtn" type="submit">/</button>
    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <button class="btn btn-default numberBtn" type="submit">4</button>
        <button class="btn btn-default numberBtn" type="submit">5</button>
        <button class="btn btn-default numberBtn" type="submit">6</button>
        <button id="multiplier" class="btn btn-default operatorBtn" type="submit">x</button>
    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <button class="btn btn-default numberBtn" type="submit">1</button>
        <button class="btn btn-default numberBtn" type="submit">2</button>
        <button class="btn btn-default numberBtn" type="submit">3</button>
        <button id="subtractor" class="btn btn-default operatorBtn" type="submit">-</button>
    </div>
    <div class="col-sm-4 col-sm-offset-4">
        <button class="btn btn-default numberBtn" type="submit">0</button>
        <button class="btn btn-default floatBtn" type="submit">,</button>
        <button class="btn btn-default resultBtn" type="submit">=</button>
        <button id="adder" class="btn btn-default operatorBtn" type="submit">+</button>
    </div>

</div>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript">

    var isFloat = false; // Если вещественное число, то - true.
    var operator = '';
    var operatorPressed = false; // Если последним нажата кнопка оператора (+-/x) - true.
    var resultPressed = false; // Если последним нажата кнопка равно (=) - true.
    var firstOperand = '';
    var secondOperand = '';
    function ajaxGetResult(firstOperandAjax, secondOperandAjax, operatorAjax) {
        $.ajax({
            type: 'GET',
            url: 'controllers/CalcController.php',
            data: 'firstOperand=' + firstOperandAjax + '&secondOperand=' + secondOperandAjax + '&operator=' + operatorAjax,
            success: function (response) {
                $("#result").val(response);
                firstOperand = response;
            }
        });
    }
    ;
    $(document).ready(function () {
        $("#result").val('');
    });

    // Обработчик одной из кнопок цифр (0...9).
    $(".numberBtn").click(function () {
        if (operatorPressed) {
            $("#result").val('');
        }
        ;
        oldResult = $("#result").val();
        newResult = oldResult += $(this).html();
        $("#result").val(newResult);
        operatorPressed = false;
    });

    // Обработчик кнопки вещественного числа (,).
    $(".floatBtn").click(function () {
        if (!isFloat) {
            if ($("#result").val() == "" || operatorPressed) {
                $("#result").val(0 + $(this).html());
                operatorPressed = false;
            }
            else {
                $("#result").val($("#result").val() + $(this).html());
            }
            isFloat = true;
        }
    });

    // Обработчик одной из кнопок оператора (+-/x).
    $(".operatorBtn").click(function () {
        if (!operatorPressed && firstOperand != '') {
            secondOperand = $("#result").val();
            ajaxGetResult(firstOperand, secondOperand, operator);

        }
        ;
        operatorPressed = true;
        firstOperand = $("#result").val();
        operator = $(this).attr("id");
        isFloat = false;
        resultPressed = false;
    });

    // Обработчик кнопки равно (=).
    $(".resultBtn").click(function () {
        if (!resultPressed && firstOperand) {
            secondOperand = $("#result").val();
            ajaxGetResult(firstOperand, secondOperand, operator);
            resultPressed = true;
            operatorPressed = true;
        }
        ;
    });

    // Обработчик кнопки очистки (С).
    $(".clearBtn").click(function () {
        $("#result").val('');
    });

</script>
</body>
</html>