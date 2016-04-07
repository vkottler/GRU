<script type="text/javascript">

    var vaughnsToken = "4b8d6fc4ec57c326e5fbe7ede37f7af6eb32d1d5";
    var coopersToken = "bd2d2aab5945061a2d9af12248099c2fd9c9191b";
    var cooperSparkCore = "55ff70066678505552540667";
    var vaughnsPhoton = "1f002b001247343432313031";
    var vaughnsCore = "55ff6f066678505540361367";
    var currToken = vaughnsToken;
    var currDevice = vaughnsPhoton;
    var functionName = "myFunction";

    function changeToken(selectID, formID) {
        currToken = document.getElementById(selectID).value;
        if (currToken === vaughnsToken) {
            document.getElementById("vaughnDevice").style.display = "inline";
            document.getElementById("cooperDevice").style.display = "none";
            changeDevice("vaughnDevice", formID);
        }
        else if (currToken === coopersToken) {
            document.getElementById("vaughnDevice").style.display = "none";
            document.getElementById("cooperDevice").style.display = "inline";
            changeDevice("cooperDevice", formID);
        }
        buildGetString(currToken, functionName, currDevice, formID);
    }

    function buildGetString(token, functionName, deviceID, formID) {
        var startOfString = "https://api.particle.io/v1/devices/";
        var middleOfString = "/" + functionName + "?access_token=";
        var getString = startOfString + currDevice + middleOfString + currToken;
        document.getElementById(formID).action = getString;
        document.getElementById("forTesting").innerHTML = getString;

    }

    function updateFunction(id, formID) {
        functionName = document.getElementById(id).value;
        buildGetString(currToken, functionName, currDevice, formID);
    }

    function changeDevice(selectID, formID) {
        currDevice = document.getElementById(selectID).value;
        buildGetString(currToken, functionName, currDevice, formID);
    }

</script>