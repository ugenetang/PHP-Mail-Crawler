<?php

// Set your email credentials and server details
$email = 'your_email@example.com';
$password = 'your_email_password';
$server = '{imap.example.com:993/imap/ssl}INBOX';

// Connect to the IMAP server
$inbox = imap_open($server, $email, $password);

if (!$inbox) {
    die('Unable to connect to the mail server: ' . imap_last_error());
}

// Search for all emails in the inbox
$emails = imap_search($inbox, 'ALL');

if ($emails) {
    // Loop through each email
    foreach ($emails as $emailNumber) {
        // Fetch the email header and body
        $header = imap_headerinfo($inbox, $emailNumber);
        $body = imap_fetchbody($inbox, $emailNumber, 1);

        // Display email information
        echo "Subject: " . $header->subject . "<br>";
        echo "From: " . $header->fromaddress . "<br>";
        echo "Date: " . $header->date . "<br>";
        echo "Body: " . $body . "<br><br>";
    }
} else {
    echo "No emails found in the inbox.";
}

// Close the connection
imap_close($inbox);

?>
