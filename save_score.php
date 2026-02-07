<?php
header('Content-Type: application/json');

if (isset($_POST['name']) && isset($_POST['score'])) {
    $name = strip_tags($_POST['name']);
    $score = (int)$_POST['score'];
    
    if (empty($name)) {
        echo json_encode(['success' => false, 'error' => 'Namn får inte vara tomt']);
        exit;
    }
    
    $data = $name + ":" + $score + "\n";
    $filename = 'scores.txt';
    
    // Försök att skriva till filen
    if (file_put_contents($filename, $data, FILE_APPEND | LOCK_EX) !== false) {
        echo json_encode(['success' => true, 'message' => 'Sparat!']);
    } else {
        // Om det misslyckas, försök skapa filen med andra rättigheter
        echo json_encode(['success' => false, 'error' => 'Kunde inte spara till filen. Kontrollera filrättigheter.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Namn och poäng krävs']);
}
?>