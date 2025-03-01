<?php
// Include Twilio's PHP SDK (via Composer)
require_once 'vendor/autoload.php'; // Ensure you've installed the Twilio SDK via Composer

use Twilio\Rest\Client;

// Get data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

$phone = $data['phone'];
$message = $data['message'];

// Twilio credentials
$accountSid = 'AC381e57c15e2638079346b7cf90cab192';
$authToken = '782ee65980bebbcfe9e95811a5bdae16';
$twilioNumber = 'whatsapp:+919487436281'; // Your Twilio WhatsApp number

// Send message via Twilio API
$client = new Client($accountSid, $authToken);

try {
    $client->messages->create(
        'whatsapp:' . $phone,  // Send to user (Phone number should include country code, e.g., +123456789)
        [
            'from' => $twilioNumber,
            'body' => $message
        ]
    );

    // Return success response
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Return error response if something goes wrong
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>
