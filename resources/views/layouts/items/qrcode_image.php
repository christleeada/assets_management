<?php

// Retrieve the base64-encoded QR code from the database
$base64QrCode = $_GET['qrcode'];

// Decode the base64-encoded QR code to a binary string
$qrCodeData = base64_decode($base64QrCode);

// Create a GD image resource from the binary string
$qrCodeImage = imagecreatefromstring($qrCodeData);

// Output the image as PNG
header('Content-Type: image/png');
imagepng($qrCodeImage);

// Free up memory
imagedestroy($qrCodeImage);
