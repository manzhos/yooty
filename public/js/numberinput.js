$(function() {

    (function quantityProducts() {
        var $quantityArrowMinus = $(".quantity-arrow-minus");
        var $quantityArrowPlus = $(".quantity-arrow-plus");
        var $quantityNum = $(".quantity-num");

        $quantityArrowMinus.click(quantityMinus);
        $quantityArrowPlus.click(quantityPlus);

        function quantityMinus() {
            if ($quantityNum.val() > 5) {
                $quantityNum.val(+$quantityNum.val() - 1);
            }
        }

        function quantityPlus() {
            $quantityNum.val(+$quantityNum.val() + 1);
        }
    })();


    var sum=0;
    var totalSum, dataBudget;

    // read data from main Cost input and print Total
    function cost() {
        dataBudget = parseInt(document.getElementById("Budget").value);
        totalSum = dataBudget + sum;
        document.getElementById("CostSum").innerHTML = totalSum;
    }

    cost();

    // check additional paymanets
    $('#Livraison').on('click', function () {
        if ( $(this).is(':checked') ) {
            sum += 3;
            minSum = sum;
        } else {
            sum -= 3;
            minSum = sum;
        }
        totalSum = dataBudget + sum;
        document.getElementById("CostSum").innerHTML = totalSum;
    })

    $('#meilleurs').on('click', function () {
        if ( $(this).is(':checked') ) {
            sum += 3;
            minSum = sum;
        } else {
            sum -= 3;
            minSum = sum;
        }
        totalSum = dataBudget + sum;
        document.getElementById("CostSum").innerHTML = totalSum;
    })

    $('#professeurs').on('click', function () {
        if ( $(this).is(':checked') ) {
            sum += 3;
            minSum = sum;
        } else {
            sum -= 3;
            minSum = sum;
        }
        totalSum = dataBudget + sum;
        document.getElementById("CostSum").innerHTML = totalSum;
    })

    $('#reactifs').on('click', function () {
        if ( $(this).is(':checked') ) {
            sum += 3;
            minSum = sum;
        } else {
            sum -= 3;
            minSum = sum;
        }
        totalSum = dataBudget + sum;
        document.getElementById("CostSum").innerHTML = totalSum;
    })

    // check changes in main Cost
    $('#plus').on('click', function () {
        dataBudget++;
        totalSum = dataBudget + sum;
        document.getElementById("CostSum").innerHTML = totalSum;
    })

    $('#minus').on('click', function () {
        if ( dataBudget > 5 ) dataBudget--;
        totalSum = dataBudget + sum;
        document.getElementById("CostSum").innerHTML = totalSum;
    })

});
