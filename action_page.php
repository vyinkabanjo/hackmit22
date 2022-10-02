<html>
<head>
    <title>QR Scan</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="users.css" />
<body>

Welcome <?php echo $_POST["uname"]; ?><br>
Scan Out or In a box:
<body>
    <div class="wrapper">
        <div class="profile-card">
            <div id="qr-reader" style="width:500px"></div>
            <div id="qr-reader-results"></div>
        </div>
    </div>
</body>
<script src="https://unpkg.com/html5-qrcode@2.2.1/html5-qrcode.min.js"></script>
<script>
    function docReady(fn) {
        // see if DOM is already available
        if (document.readyState === "complete"
            || document.readyState === "interactive") {
            // call on next available tick
            setTimeout(fn, 1);
        } else {
            document.addEventListener("DOMContentLoaded", fn);
        }
    }

    docReady(function () {
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                console.log(`Scan result ${decodedText}`, decodedResult);
                resultContainer.innerHTML += `<div>[${countResults}] - ${decodedText}</div>`;
                var e = decodedText;

                //now append to csv file using php
                document.getElementById('box_id').value=e
                document.forms[0].submit()
                
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });
        html5QrcodeScanner.render(onScanSuccess);
    });
</script>

<form action="update_box.php" id="update_box" method="post">
<div class="form_section">Submit box to update</div>
<div class="form_section">
<input xmlns="http://www.w3.org/1999/xhtml" class="text" id="box_id"
       name="box_id_field" tabindex="1" type="text" value="" />
</div>
<div class="form_section">etc</div>
<div xmlns="http://www.w3.org/1999/xhtml" class="buttons">
    <button type="submit" class="" name="" id="go" tabindex="3">Go</button>
    <button type="submit" class="" name="cancel" 
            id="cancel" tabindex="4">Cancel</button>
</div>
</form>

</body>
</html>