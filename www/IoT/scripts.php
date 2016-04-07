<script type="text/javascript">

    var vaughnsToken = "4b8d6fc4ec57c326e5fbe7ede37f7af6eb32d1d5";
    var coopersToken = "bd2d2aab5945061a2d9af12248099c2fd9c9191b";
    var cooperSparkCore = "55ff70066678505552540667";
    var vaughnsPhoton = "1f002b001247343432313031";
    var vaughnsCore = "55ff6f066678505540361367";
    var currToken = vaughnsToken;
    var currDevice = vaughnsPhoton;
    var currPerson = "vaughn";
    var functionName = "myFunction";

    function changeToken(selectID, formID) {
        currToken = document.getElementyById(selectID).value;
        if (currToken === vaughnsToken) {
            document.getElementById("vaughnDevice").style.display = "block";
            document.getElementById("cooperDevice").style.display = "none";
        }
        else if (currToken === coopersToken) {
            document.getElementById("vaughnDevice").style.display = "none";
            document.getElementById("cooperDevice").style.display = "block";
        }
        buildGetString(currToken, functionName, currDevice, formID);
    }

    function buildGetString(token, functionName, deviceID, formID) {
        var startOfString = "https://api.particle.io/v1/devices/";
        var middleOfString = "/" + functionName + "?access_token=";
        var getString = startOfString + currDevice + middleOfString + currToken;
        document.getElementyById(formID).action = getString;
        document.getElementById("forTesting").innerHTML = getString;

    }

    function changeDevice(selectID, formID) {
        currDevice = document.getElementyById(selectID).value;
        buildGetString(currToken, functionName, currDevice, formID);
    }

</script>