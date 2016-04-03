<html>
    <head>

    </head>
    <script type="text/javascript">
    var vaughnsToken = "4b8d6fc4ec57c326e5fbe7ede37f7af6eb32d1d5";
    var coopersToken = "bd2d2aab5945061a2d9af12248099c2fd9c9191b";
    var cooperSparkCore = "55ff70066678505552540667";
    var vaughnsPhoton = "1f002b001247343432313031";
    var vaughnsCore = "55ff6f066678505540361367";
    var currToken = "";
    var currDevice = "";

    function changeToken(selectID, formID) {
        currToken = document.getElementyById(selectID).value;
        // TODO: build string for action field
        // document.getElementById(formID).action = "";
    }

    function changeDevice(selectID, formID) {
        currDevice = document.getElementyById(selectID).value;
        // TODO: build string for action field
        // document.getElementById(formID).action = "";
    }

    </script>
    <body>
        <select onchange="changeToken('changeToken', 'iotForm')" id="changeToken">
        <option value=""></option>
        </select>

        <select onchange="changeDevice('changeDevice', 'iotForm')" id="changeDevice">
        <option value=""></option>
        </select>

        <form action = "" method="POST">
        <input type="Submit" value="Send Over Cloud" id="iotForm">
        </form>

    </body>
</html>