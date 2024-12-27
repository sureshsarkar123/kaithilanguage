<?php
// Example Kaithi text
$kaithi_text = "𑂃 𑂄 𑂅"; // Replace with actual Kaithi input or paste it here

// Ensure proper UTF-8 encoding
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Kaithi&display=swap" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <title>Hindi to Kaithi Converter</title>
</head>
<body>
   <style>
    body {
    font-family: 'Noto Sans Devanagari', sans-serif; /* Replace with Kaithi-supporting font if found */
}

.noto-sans-kaithi-regular {
  font-family: "Noto Sans Kaithi", serif;
  font-weight: 400;
  font-style: normal;
}

/* Container for alignment */
.container {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 650px;
  box-sizing: border-box;
  margin: auto;
}

/* Label styling */
label {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 8px;
  display: inline-block;
}

/* Textarea styling */
textarea {
  width: 95%;
  padding: 12px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 6px;
  resize: vertical;
  outline: none;
  transition: border-color 0.3s ease;
}

/* Focus state for textarea */
textarea:focus {
  border-color: #007bff;
  box-shadow: 0 0 8px rgba(0, 123, 255, 0.25);
}

/* Placeholder text styling */
textarea::placeholder {
  color: #999;
}
#kaithiText{
color: #000000;
}

   </style> 

<section>
<div class="container">
<form action="" method="post">
    <label for="textarea">Enter your hindi text:</label>
    <textarea id="textarea" name="hindi_text" rows="8" placeholder="Enter Hindi text..."></textarea>

    <button type="button" id="download-pdf" style="margin-top: 20px;">Download PDF</button>

    <p id="kaithiText" class="noto-sans-kaithi-regular"></p>
    <!-- <button type="submit">Convert</button> -->
    </form>
  </div>
</section>

<!-- <form action="" method="post">
    <input type="text" name="hindi_text" placeholder="Enter Hindi text">
    <button type="submit">Convert</button>
</form> -->



<?php 
header('Content-Type: text/html;charset=utf-8');

//Hindi to Kaithi converter start ==================================================
    // $hindi_to_kaithi_map = array(
    //     'क' => '𑂍',  // Hindi 'क' -> Kaithi '𑂃'
    //     'ख' => '𑂎',  // Hindi 'ख' -> Kaithi '𑂄'
    //     'ग' => '𑂏',  // Hindi 'ग' -> Kaithi '𑂅'
    //     'घ' => '𑂐',  // Hindi 'घ' -> Kaithi '𑂆'
    //     'ङ' => '𑂑',  // Hindi 'ङ' -> Kaithi '𑂇'
    //     'च' => '𑂒',  // Hindi 'च' -> Kaithi '𑂈'
    //     'छ' => '𑂓',  // Hindi 'छ' -> Kaithi '𑂉'
    //     'ज' => '𑂔',  // Hindi 'ज' -> Kaithi '𑂊'
    //     'झ' => '𑂕',  // Hindi 'झ' -> Kaithi '𑂋'
    //     'ञ' => '𑂖',  // Hindi 'ञ' -> Kaithi '𑂌'
    //     'ट' => '𑂗',  // Hindi 'ट' -> Kaithi '𑂍'
    //     'ठ' => '𑂘',  // Hindi 'ठ' -> Kaithi '𑂎'
    //     'ड' => '𑂙',  // Hindi 'ड' -> Kaithi '𑂏'
    //     'ढ' => '𑂛',  // Hindi 'ढ' -> Kaithi '𑂐'
    //     'ण' => '𑂝',  // Hindi 'ण' -> Kaithi '𑂑'
    //     'त' => '𑂞',  // Hindi 'त' -> Kaithi '𑂒'
    //     'थ' => '𑂟',  // Hindi 'थ' -> Kaithi '𑂓'
    //     'द' => '𑂠',  // Hindi 'द' -> Kaithi '𑂔'
    //     'ध' => '𑂡',  // Hindi 'ध' -> Kaithi '𑂕'
    //     'न' => '𑂢',  // Hindi 'न' -> Kaithi '𑂖'
    //     'प' => '𑂣',  // Hindi 'प' -> Kaithi '𑂗'
    //     'फ' => '𑂤',  // Hindi 'फ' -> Kaithi '𑂘'
    //     'ब' => '𑂥',  // Hindi 'ब' -> Kaithi '𑂙'
    //     'भ' => '𑂦',  // Hindi 'भ' -> Kaithi '𑂚'
    //     'म' => '𑂧',  // Hindi 'म' -> Kaithi '𑂛'
    //     'य' => '𑂨',  // Hindi 'य' -> Kaithi '𑂜'
    //     'र' => '𑂩',  // Hindi 'र' -> Kaithi '𑂝'
    //     'ल' => '𑂪',  // Hindi 'ल' -> Kaithi '𑂞'
    //     'व' => '𑂫',  // Hindi 'व' -> Kaithi '𑂟'
    //     'श' => '𑂬',  // Hindi 'श' -> Kaithi '𑂠'
    //     'ष' => '𑂭',  // Hindi 'ष' -> Kaithi '𑂡'
    //     'स' => '𑂮',  // Hindi 'स' -> Kaithi '𑂢'
    //     'ह' => '𑂯',  // Hindi 'ह' -> Kaithi '𑂣'
    //     'ळ' => 'ळ',  // Hindi 'ळ' -> Kaithi '𑂤'
    //     'क्ष' => '𑂭', // Hindi 'क्ष' -> Kaithi '𑂥'
    //     'त्र' => '𑂞𑂹𑂩', // Hindi 'त्र' -> Kaithi '𑂞𑂹𑂩'
    //     'ज्ञ' => '𑂖', // Hindi 'ज्ञ' -> Kaithi '𑂦'
        
    //     // Vowel mapping:
    //     'अ' => '𑂃',  // Hindi 'अ' -> Kaithi '𑂩'
    //     'आ' => '𑂄',  // Hindi 'आ' -> Kaithi '𑂪'
    //     'इ' => '𑂅',  // Hindi 'इ' -> Kaithi '𑂫'
    //     'ई' => '𑂆',  // Hindi 'ई' -> Kaithi '𑂬'
    //     'उ' => '𑂇',  // Hindi 'उ' -> Kaithi '𑂭'
    //     'ऊ' => '𑂈',  // Hindi 'ऊ' -> Kaithi '𑂮'
    //     'ऋ' => '𑂩𑂱',  // Hindi 'ऋ' -> Kaithi '𑂯'
    //     'ए' => '𑂉',  // Hindi 'ए' -> Kaithi '𑂰'
    //     'ऐ' => '𑂊',  // Hindi 'ऐ' -> Kaithi '𑂱'
    //     'ओ' => '𑂋',  // Hindi 'ओ' -> Kaithi '𑂲'
    //     'औ' => '𑂌',  // Hindi 'औ' -> Kaithi '𑂳'
    //     'अं' => '𑂃𑂁',  // Hindi 'अं' -> Kaithi '𑂴'
    //     'अः' => '𑂃𑂂',  // Hindi 'अः' -> Kaithi '𑂵'

    //     // matra hinhi to kaithi 
    //     'ा' => '𑂰',  // Hindi 'अ' -> Kaithi '𑂩'
    //     'ि' => '𑂱',  // Hindi 'आ' -> Kaithi '𑂪'
    //     'ी' => '𑂲',  // Hindi 'इ' -> Kaithi '𑂫'
    //     'ु' => '𑂳',  // Hindi 'ई' -> Kaithi '𑂬'
    //     'ू' => '𑂴',  // Hindi 'उ' -> Kaithi '𑂭'
    //     'ृ' => 'ृ',  // Hindi 'ऊ' -> Kaithi '𑂮'
    //     'ॄ' => 'ॄ',  // Hindi 'ऋ' -> Kaithi '𑂯'
    //     'े' => '𑂵',  // Hindi 'ए' -> Kaithi '𑂰'
    //     'ै' => '𑂶',  // Hindi 'ऐ' -> Kaithi '𑂱'
    //     'ो' => '𑂷',  // Hindi 'ओ' -> Kaithi '𑂲'
    //     'ौ' => '𑂸',  // Hindi 'औ' -> Kaithi '𑂳'
    //     'ं' => '𑂁',  // Hindi 'अं' -> Kaithi '𑂴'
    //     'ः' => '𑂂',  // Hindi 'अः' -> Kaithi '𑂵'
        

        
    //     // spacial matra 
    //     'र्' => '𑂩𑂹',  // Hindi 'र्' -> Kaithi '𑂩𑂹'
    //     'ॉ' => 'ॉ',  // Hindi 'ॉ' -> Kaithi 'ॉ'
    //     '्' => '𑂹',  // Hindi '्' -> Kaithi '𑂹'
    //     'रि' => '𑂩𑂱',  // Hindi 'रि' -> Kaithi '𑂩𑂱'
    //     'ाँ' => '𑂰𑂀',  // Hindi 'ाँ' -> Kaithi '𑂰𑂀'


    //     // Numerals
    //     '0' => '𑁦',  // Hindi '0' -> Kaithi '𑁦'
    //     '1' => '𑁧',  // Hindi '1' -> Kaithi '𑁧'
    //     '2' => '𑁨',  // Hindi '2' -> Kaithi '𑁨'
    //     '3' => '𑁩',  // Hindi '3' -> Kaithi '𑁩'
    //     '4' => '𑁪',  // Hindi '4' -> Kaithi '𑁪'
    //     '5' => '𑁫',  // Hindi '5' -> Kaithi '𑁫'
    //     '6' => '𑁬',  // Hindi '6' -> Kaithi '𑁬'
    //     '7' => '𑁭',  // Hindi '7' -> Kaithi '𑁭'
    //     '8' => '𑁮',  // Hindi '8' -> Kaithi '𑁮'
    //     '9' => '𑁯',  // Hindi '9' -> Kaithi '𑁯'
    // );

    // function hindi_to_kaithi($hindi_text) {
    //     global $hindi_to_kaithi_map;
    //     $kaithi_text = strtr($hindi_text, $hindi_to_kaithi_map);
    //     return $kaithi_text;
    // }

    // if(isset($_POST['hindi_text']) && !empty($_POST['hindi_text'])){
    //     $hindi_text = $_POST['hindi_text'];
    //     $kaithi_text = hindi_to_kaithi($hindi_text);
    //     echo '<h1 class="noto-sans-kaithi-regular">'.$kaithi_text.'</h1>';  // Output the converted text
    // }
//Hindi to Kaithi converter end ==================================================


// Kaithi to Hindi converter start ==================================================
    // $kaithi_to_hindi_map = array(
    //     '𑂍' => 'क',  // Kaithi '𑂃' -> Hindi 'क'
    //     '𑂎' => 'ख',  // Kaithi '𑂄' -> Hindi 'ख'
    //     '𑂏' => 'ग',  // Kaithi '𑂅' -> Hindi 'ग'
    //     '𑂐' => 'घ',  // Kaithi '𑂆' -> Hindi 'घ'
    //     '𑂑' => 'ङ',  // Kaithi '𑂇' -> Hindi 'ङ'
    //     '𑂒' => 'च',  // Kaithi '𑂈' -> Hindi 'च'
    //     '𑂓' => 'छ',  // Kaithi '𑂉' -> Hindi 'छ'
    //     '𑂔' => 'ज',  // Kaithi '𑂊' -> Hindi 'ज'
    //     '𑂕' => 'झ',  // Kaithi '𑂋' -> Hindi 'झ'
    //     '𑂖' => 'ञ',  // Kaithi '𑂌' -> Hindi 'ञ'
    //     '𑂗' => 'ट',  // Kaithi '𑂍' -> Hindi 'ट'
    //     '𑂘' => 'ठ',  // Kaithi '𑂎' -> Hindi 'ठ'
    //     '𑂙' => 'ड',  // Kaithi '𑂏' -> Hindi 'ड'
    //     '𑂛' => 'ढ',  // Kaithi '𑂐' -> Hindi 'ढ'
    //     '𑂝' => 'ण',  // Kaithi '𑂑' -> Hindi 'ण'
    //     '𑂞' => 'त',  // Kaithi '𑂒' -> Hindi 'त'
    //     '𑂟' => 'थ',  // Kaithi '𑂓' -> Hindi 'थ'
    //     '𑂠' => 'द',  // Kaithi '𑂔' -> Hindi 'द'
    //     '𑂡' => 'ध',  // Kaithi '𑂕' -> Hindi 'ध'
    //     '𑂢' => 'न',  // Kaithi '𑂖' -> Hindi 'न'
    //     '𑂣' => 'प',  // Kaithi '𑂗' -> Hindi 'प'
    //     '𑂤' => 'फ',  // Kaithi '𑂘' -> Hindi 'फ'
    //     '𑂥' => 'ब',  // Kaithi '𑂙' -> Hindi 'ब'
    //     '𑂦' => 'भ',  // Kaithi '𑂚' -> Hindi 'भ'
    //     '𑂧' => 'म',  // Kaithi '𑂛' -> Hindi 'म'
    //     '𑂨' => 'य',  // Kaithi '𑂜' -> Hindi 'य'
    //     '𑂩' => 'र',  // Kaithi '𑂝' -> Hindi 'र'
    //     '𑂪' => 'ल',  // Kaithi '𑂞' -> Hindi 'ल'
    //     '𑂫' => 'व',  // Kaithi '𑂟' -> Hindi 'व'
    //     '𑂬' => 'श',  // Kaithi '𑂠' -> Hindi 'श'
    //     '𑂭' => 'ष',  // Kaithi '𑂡' -> Hindi 'ष'
    //     '𑂮' => 'स',  // Kaithi '𑂢' -> Hindi 'स'
    //     '𑂯' => 'ह',  // Kaithi '𑂣' -> Hindi 'ह'
    //     'ळ' => 'ळ',  // Kaithi '𑂤' -> Hindi 'ळ'
    //     '𑂭' => 'क्ष', // Kaithi '𑂥' -> Hindi 'क्ष'
    //     '𑂞𑂹𑂩' => 'त्र', // Kaithi '𑂥' -> Hindi 'क्ष'
    //     '𑂖' => 'ज्ञ', // Kaithi '𑂦' -> Hindi 'ज्ञ'
        
    //     // Vowel mapping:
    //     '𑂃' => 'अ',  // Kaithi '𑂩' -> Hindi 'अ'
    //     '𑂄' => 'आ',  // Kaithi '𑂪' -> Hindi 'आ'
    //     '𑂅' => 'इ',  // Kaithi '𑂫' -> Hindi 'इ'
    //     '𑂆' => 'ई',  // Kaithi '𑂬' -> Hindi 'ई'
    //     '𑂇' => 'उ',  // Kaithi '𑂭' -> Hindi 'उ'
    //     '𑂈' => 'ऊ',  // Kaithi '𑂮' -> Hindi 'ऊ'
    //     '𑂩𑂱' => 'ऋ',  // Kaithi '𑂯' -> Hindi 'ऋ'
    //     '𑂉' => 'ए',  // Kaithi '𑂰' -> Hindi 'ए'
    //     '𑂊' => 'ऐ',  // Kaithi '𑂱' -> Hindi 'ऐ'
    //     '𑂋' => 'ओ',  // Kaithi '𑂲' -> Hindi 'ओ'
    //     '𑂌' => 'औ',  // Kaithi '𑂳' -> Hindi 'औ'
    //     '𑂃𑂁' => 'अं',  // Kaithi '𑂴' -> Hindi 'अं'
    //     '𑂃𑂂' => 'अः',  // Kaithi '𑂵' -> Hindi 'अः'
        

    //     // Khaithi matra to hindi matra:
    //     '𑂰' => 'ा',  // Kaithi '𑂰' -> Hindi ''ा'
    //     '𑂱' => 'ि',  // Kaithi '𑂱' -> Hindi ''ि'
    //     '𑂲' => 'ी',  // Kaithi '𑂲' -> Hindi ''ी'
    //     '𑂳' => 'ु',  // Kaithi '𑂳' -> Hindi ''ु'
    //     '𑂴' => 'ू',  // Kaithi '𑂴' -> Hindi ''ू'
    //     'ृ' => 'ृ',  // Kaithi 'ृ' -> Hindi ''ृ'
    //     'ृ' => 'ॄ',  // Kaithi 'ृ' -> Hindi ''ॄ'
    //     '𑂵' => 'े',  // Kaithi '𑂵' -> Hindi ''े'
    //     '𑂶' => 'ै',  // Kaithi '𑂶' -> Hindi ''ै'
    //     '𑂷' => 'ो',  // Kaithi '𑂷' -> Hindi ''ो'
    //     '𑂸' => 'ौ',  // Kaithi '𑂸' -> Hindi ''ौ'
    //     '𑂁' => 'ं',  // Kaithi '𑂁' -> Hindi ''ं'
    //     '𑂂' => 'ः',  // Kaithi '𑂂' -> Hindi ''ः'

    //     // spacial matra 
    //     '𑂩𑂹' => 'र्',  // Kaithi '𑂵' -> Hindi 'र्'
    //      'ॉ' => 'ॉ',  // Kaithi 'ॉ' -> Hindi 'ॉ'
    //      '𑂹' => '्',  // Kaithi '𑂹' -> Hindi '्'
    //      '𑂩𑂱' => 'रि',  // Kaithi '𑂹' -> Hindi '्'
    //      '𑂰𑂀' => 'ाँ',  // Kaithi '𑂰𑂀' -> Hindi 'ाँ'

    //     // Numerals
    //     '𑁦' => '0',  // Kaithi '𑁦' -> Hindi '0'
    //     '𑁧' => '1',  // Kaithi '𑁧' -> Hindi '1'
    //     '𑁨' => '2',  // Kaithi '𑁨' -> Hindi '2'
    //     '𑁩' => '3',  // Kaithi '𑁩' -> Hindi '3'
    //     '𑁪' => '4',  // Kaithi '𑁪' -> Hindi '4'
    //     '𑁫' => '5',  // Kaithi '𑁫' -> Hindi '5'
    //     '𑁬' => '6',  // Kaithi '𑁬' -> Hindi '6'
    //     '𑁭' => '7',  // Kaithi '𑁭' -> Hindi '7'
    //     '𑁮' => '8',  // Kaithi '𑁮' -> Hindi '8'
    //     '𑁯' => '9',  // Kaithi '𑁯' -> Hindi '9'
    // );

    // function kaithi_to_hindi($kaithi_text) {
    //     global $kaithi_to_hindi_map;
    //     $hindi_text = strtr($kaithi_text, $kaithi_to_hindi_map);
    //     return $hindi_text;
    // }


    // if(isset($_POST['kaithi_text']) && !empty($_POST['kaithi_text'])){
    // $kaithi_text = $_POST['kaithi_text'];
    // $hindi_text = kaithi_to_hindi($kaithi_text);
    // echo $hindi_text;
    // }
// Kaithi to Hindi converter end ==================================================

?>

<!-- <form action="" method="post">

    <input type="text" class="noto-sans-kaithi-regular" name="kaithi_text" placeholder="Enter kaithi text">
    <button type="submit">Convert</button>
</form> -->

<script>
    $(document).ready(function(){
        // Define the hindiToKaithiConverter function
        function hindiToKaithiConverter(hindiText) {
            let hindi_to_kaithi_map =  {
                'क' : '𑂍',  // Hindi 'क' -> Kaithi '𑂃'
                'ख' : '𑂎',  // Hindi 'ख' -> Kaithi '𑂄'
                'ग' : '𑂏',  // Hindi 'ग' -> Kaithi '𑂅'
                'घ' : '𑂐',  // Hindi 'घ' -> Kaithi '𑂆'
                'ङ' : '𑂑',  // Hindi 'ङ' -> Kaithi '𑂇'
                'च' : '𑂒',  // Hindi 'च' -> Kaithi '𑂈'
                'छ' : '𑂓',  // Hindi 'छ' -> Kaithi '𑂉'
                'ज' : '𑂔',  // Hindi 'ज' -> Kaithi '𑂊'
                'झ' : '𑂕',  // Hindi 'झ' -> Kaithi '𑂋'
                'ञ' : '𑂖',  // Hindi 'ञ' -> Kaithi '𑂌'
                'ट' : '𑂗',  // Hindi 'ट' -> Kaithi '𑂍'
                'ठ' : '𑂘',  // Hindi 'ठ' -> Kaithi '𑂎'
                'ड' : '𑂙',  // Hindi 'ड' -> Kaithi '𑂏'
                'ढ' : '𑂛',  // Hindi 'ढ' -> Kaithi '𑂐'
                'ण' : '𑂝',  // Hindi 'ण' -> Kaithi '𑂑'
                'त' : '𑂞',  // Hindi 'त' -> Kaithi '𑂒'
                'थ' : '𑂟',  // Hindi 'थ' -> Kaithi '𑂓'
                'द' : '𑂠',  // Hindi 'द' -> Kaithi '𑂔'
                'ध' : '𑂡',  // Hindi 'ध' -> Kaithi '𑂕'
                'न' : '𑂢',  // Hindi 'न' -> Kaithi '𑂖'
                'प' : '𑂣',  // Hindi 'प' -> Kaithi '𑂗'
                'फ' : '𑂤',  // Hindi 'फ' -> Kaithi '𑂘'
                'ब' : '𑂥',  // Hindi 'ब' -> Kaithi '𑂙'
                'भ' : '𑂦',  // Hindi 'भ' -> Kaithi '𑂚'
                'म' : '𑂧',  // Hindi 'म' -> Kaithi '𑂛'
                'य' : '𑂨',  // Hindi 'य' -> Kaithi '𑂜'
                'र' : '𑂩',  // Hindi 'र' -> Kaithi '𑂝'
                'ल' : '𑂪',  // Hindi 'ल' -> Kaithi '𑂞'
                'व' : '𑂫',  // Hindi 'व' -> Kaithi '𑂟'
                'श' : '𑂬',  // Hindi 'श' -> Kaithi '𑂠'
                'ष' : '𑂭',  // Hindi 'ष' -> Kaithi '𑂡'
                'स' : '𑂮',  // Hindi 'स' -> Kaithi '𑂢'
                'ह' : '𑂯',  // Hindi 'ह' -> Kaithi '𑂣'
                'ळ' : 'ळ',  // Hindi 'ळ' -> Kaithi '𑂤'
                'क्ष' : '𑂭', // Hindi 'क्ष' -> Kaithi '𑂥'
                'त्र' : '𑂞𑂹𑂩', // Hindi 'त्र' -> Kaithi '𑂞𑂹𑂩'
                'ज्ञ' : '𑂖', // Hindi 'ज्ञ' -> Kaithi '𑂦'
                
                // Vowel mapping:
                'अ' : '𑂃',  // Hindi 'अ' -> Kaithi '𑂩'
                'आ' : '𑂄',  // Hindi 'आ' -> Kaithi '𑂪'
                'इ' : '𑂅',  // Hindi 'इ' -> Kaithi '𑂫'
                'ई' : '𑂆',  // Hindi 'ई' -> Kaithi '𑂬'
                'उ' : '𑂇',  // Hindi 'उ' -> Kaithi '𑂭'
                'ऊ' : '𑂈',  // Hindi 'ऊ' -> Kaithi '𑂮'
                'ऋ' : '𑂩𑂱',  // Hindi 'ऋ' -> Kaithi '𑂯'
                'ए' : '𑂉',  // Hindi 'ए' -> Kaithi '𑂰'
                'ऐ' : '𑂊',  // Hindi 'ऐ' -> Kaithi '𑂱'
                'ओ' : '𑂋',  // Hindi 'ओ' -> Kaithi '𑂲'
                'औ' : '𑂌',  // Hindi 'औ' -> Kaithi '𑂳'
                'अं' : '𑂃𑂁',  // Hindi 'अं' -> Kaithi '𑂴'
                'अः' : '𑂃𑂂',  // Hindi 'अः' -> Kaithi '𑂵'

                // matra hinhi to kaithi 
                'ा' : '𑂰',  // Hindi 'अ' -> Kaithi '𑂩'
                'ि' : '𑂱',  // Hindi 'आ' -> Kaithi '𑂪'
                'ी' : '𑂲',  // Hindi 'इ' -> Kaithi '𑂫'
                'ु' : '𑂳',  // Hindi 'ई' -> Kaithi '𑂬'
                'ू' : '𑂴',  // Hindi 'उ' -> Kaithi '𑂭'
                'ृ' : 'ृ',  // Hindi 'ऊ' -> Kaithi '𑂮'
                'ॄ' : 'ॄ',  // Hindi 'ऋ' -> Kaithi '𑂯'
                'े' : '𑂵',  // Hindi 'ए' -> Kaithi '𑂰'
                'ै' : '𑂶',  // Hindi 'ऐ' -> Kaithi '𑂱'
                'ो' : '𑂷',  // Hindi 'ओ' -> Kaithi '𑂲'
                'ौ' : '𑂸',  // Hindi 'औ' -> Kaithi '𑂳'
                'ं' : '𑂁',  // Hindi 'अं' -> Kaithi '𑂴'
                'ः' : '𑂂',  // Hindi 'अः' -> Kaithi '𑂵'
                

                
                // spacial matra 
                'र्' : '𑂩𑂹',  // Hindi 'र्' -> Kaithi '𑂩𑂹'
                'ॉ' : 'ॉ',  // Hindi 'ॉ' -> Kaithi 'ॉ'
                '्' : '𑂹',  // Hindi '्' -> Kaithi '𑂹'
                'रि' : '𑂩𑂱',  // Hindi 'रि' -> Kaithi '𑂩𑂱'
                'ाँ' : '𑂰𑂀',  // Hindi 'ाँ' -> Kaithi '𑂰𑂀'


                // Numerals
                '0' : '𑁦',  // Hindi '0' -> Kaithi '𑁦'
                '1' : '𑁧',  // Hindi '1' -> Kaithi '𑁧'
                '2' : '𑁨',  // Hindi '2' -> Kaithi '𑁨'
                '3' : '𑁩',  // Hindi '3' -> Kaithi '𑁩'
                '4' : '𑁪',  // Hindi '4' -> Kaithi '𑁪'
                '5' : '𑁫',  // Hindi '5' -> Kaithi '𑁫'
                '6' : '𑁬',  // Hindi '6' -> Kaithi '𑁬'
                '7' : '𑁭',  // Hindi '7' -> Kaithi '𑁭'
                '8' : '𑁮',  // Hindi '8' -> Kaithi '𑁮'
                '9' : '𑁯',  // Hindi '9' -> Kaithi '𑁯'
            };

            let kaithiText = '';
            
            // Iterate through each character in the Hindi text
            for (let i = 0; i < hindiText.length; i++) {
                let hindiChar = hindiText[i];
                kaithiText += hindi_to_kaithi_map[hindiChar] || hindiChar; // If no mapping, keep the original character
            }
            
            $("#kaithiText").text(kaithiText)
            // return kaithiText;
        }


        $('#textarea').on('keyup', function(){
            hindiToKaithiConverter($(this).val());
        });



$('#download-pdf').on('click', function() {
    var kaithiText = $('#kaithiText').text();
    
    if (kaithiText) {
        alert(kaithiText);
        return;
    }

});


    });
</script>


</body>
</html>