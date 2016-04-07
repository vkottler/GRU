<html>
    <head>
    <?php include 'scripts.js'; ?>
    </head>
    <body>
        <select onchange="changeToken('changeToken', 'iotForm')" id="changeToken">
        <option value="4b8d6fc4ec57c326e5fbe7ede37f7af6eb32d1d5" selected>Vaughn</option>
        <option value="bd2d2aab5945061a2d9af12248099c2fd9c9191b">Cooper</option>
        </select>

        <select onchange="changeDevice('vaughnDevice', 'iotForm')" id="vaughnDevice">
        <option value="55ff6f066678505540361367">Spark Core</option>
        <option value="1f002b001247343432313031" selected>Photon</option>
        </select>

        <select style="display:none" onchange="changeDevice('cooperDevice', 'iotForm')" id="cooperDevice">
        <option value="55ff70066678505552540667" selected>Spark Core</option>
        </select>
        Name of Function: <input type="text" id="functionInput" value="myFunction" onkeyup="updateFunction('functionInput', 'iotForm')">
        <form id="iotForm" action="https://api.particle.io/v1/devices/1f002b001247343432313031/myFunction?access_token=4b8d6fc4ec57c326e5fbe7ede37f7af6eb32d1d5" method="POST">
        Value to send: <input type="text" name="args">
        <input type="Submit" value="Send Over Cloud">
        </form>
        <br><br>
        Current Form Get String:
        <div id="forTesting">https://api.particle.io/v1/devices/1f002b001247343432313031/myFunction?access_token=4b8d6fc4ec57c326e5fbe7ede37f7af6eb32d1d5</div>

    </body>
</html>