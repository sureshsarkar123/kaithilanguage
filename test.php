<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaithi to Base64</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1>Convert Kaithi Text to Base64 Image</h1>
    
    <!-- Canvas where the Kaithi text will be rendered -->
    <canvas id="canvas" width="500" height="150"></canvas>
    
    <button id="generateBase64">Generate Base64</button>
    
    <p id="base64Output"></p>

    <script>
        $(document).ready(function () {
            const canvas = document.getElementById('canvas');
            const ctx = canvas.getContext('2d');

            // Step 1: Load Kaithi font (ensure Kaithi font is available on the page)
            const kaithiFontUrl = 'NotoSansKaithi-Regular.ttf'; // Change this to your Kaithi font URL

            // Load the font dynamically
            const font = new FontFace('Kaithi', `url(${kaithiFontUrl})`);
            font.load().then(function () {
                // Once the font is loaded, set it and render the text
                ctx.font = '48px Kaithi';  // Use the Kaithi font
                ctx.fillStyle = 'black';
                ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear canvas
                ctx.fillText("आपका टेक्स्ट", 50, 100);  // Write your text here

                // Step 2: When the button is clicked, generate the Base64 string
                $('#generateBase64').click(function () {
                    const base64Image = canvas.toDataURL(); // Converts canvas content to Base64
                    $('#base64Output').text(base64Image);  // Show Base64 string on the page
                });
            }).catch(function (error) {
                console.error('Error loading Kaithi font:', error);
            });
        });
    </script>

</body>
</html>
