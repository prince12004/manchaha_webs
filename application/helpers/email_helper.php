<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('send_mail')) {
    /**
     * Send Email Helper
     *
     * @param array $emailData - Required keys: to, subject, message
     * @param array $headers - Optional additional headers
     * @param array $attachments - Optional array of file paths (unsupported in `mail()`)
     * @return bool - True on success, False on failure
     */
    function send_mail($emailData, $headers = [])
    {
        // Validate required fields
        if (empty($emailData['to']) || empty($emailData['subject']) || empty($emailData['message'])) {
            log_message('error', 'Email data is missing required fields (to, subject, or message).');
            return false;
        }

        // Default Headers
        $defaultHeaders = [
            'From' => 'Info@mnnchaha.com',
            'Reply-To' => 'Info@mnnchaha.com',
            'MIME-Version' => '1.0',
            'Content-Type' => 'text/html; charset=UTF-8'
        ];

        // Merge custom headers
        $headers = array_merge($defaultHeaders, $headers);

        // Convert headers to string format
        $headersString = '';
        foreach ($headers as $key => $value) {
            $headersString .= $key . ': ' . $value . "\r\n";
        }

        // Send the email using PHP's mail() function
        $sent = mail(
            $emailData['to'],            // Recipient's email
            $emailData['subject'],       // Email subject
            $emailData['message'],       // Email body
            $headersString               // Headers as a string
        );

        if ($sent) {
            return true;
        } else {
            log_message('error', 'Email failed to send using PHP mail().');
            return false;
        }
    }
}
