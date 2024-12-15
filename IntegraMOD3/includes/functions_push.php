<?php
/**
 * PushNotificationHandler
 *
 * This class handles the integration of push notifications into phpBB 3.0.15  using Firebase Cloud Messaging (FCM) HTTP v1 API.
 * This class allows sending push notifications to users based on specific events within the IntegraMOD forum.
 *
 * @package IM_PushNotifications
 * @version 1.0
 * @author HelterSkelter
 * @license GNU General Public License v2
 */
 
/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

class PushNotification
{
/**
 * @var string $fcm_url The Firebase Cloud Messaging endpoint for sending notifications.
 */
private $fcm_url = 'https://fcm.googleapis.com/fcm/send';
 
/**
 * @var string $server_key The server key provided by Firebase for authentication.
 */
private $server_key;
 
/**
 * Constructor for the PushNotification class.
 *
 * Initializes the server key for FCM authentication.
 *
 * @param string $server_key Your Firebase server key.
 *
 * @throws Exception If the server key is not provided.
 *
 * @example
 * $push = new PushNotification('YOUR_FCM_SERVER_KEY');
 */
public function __construct($server_key)
{
    // Validate that the server key is provided.
    if (empty($server_key)) 
	{
        throw new Exception('FCM Server key must be provided.');
    }
 
// Assign the server key to the class property.
    $this->server_key = $server_key;
}
 
/**
 * Registers a user's device with FCM by saving the device token to the database.
 *
 * @param int    $user_id      The unique identifier of the phpBB user.
 * @param string $device_token The FCM device token for sending notifications.
 *
 * @return bool Returns true on successful registration, false otherwise.
 *
 * @throws Exception If there is an error during the database operation.
 *
 * @example
 * $push->register_device(1, 'fcm_device_token_here');
 */
public function register_device($user_id, $device_token)
{
    // Ensure user ID is a positive integer.
    if (!is_int($user_id) || $user_id <= 0) 
	{
        throw new Exception('Invalid user ID provided.');
    }
 
    // Ensure device token is a non-empty string.
    if (empty($device_token) || !is_string($device_token)) 
	{
        throw new Exception('Invalid device token provided.');
    }
 
    // Access the global phpBB database and user objects.
    global $db, $user;
 
    // Prepare SQL to insert or update the device token for the user.
    $sql = 'REPLACE INTO ' . USERS_TABLE . ' (user_id, user_fcm_token)
            VALUES (' . intval($user_id) . ', "' . $db->sql_escape($device_token) . '")';
 
    // Execute the SQL query.
    $result = $db->sql_query($sql);
 
    // Check if the query was successful.
    if ($result) 
	{
        // Return true indicating successful registration.
        return true;
    } 
	else 
	{
        // Throw an exception if the query failed.
        throw new Exception('Failed to register device token.');
    }
}
 
/**
 * Sends a push notification to a specific user or a group of users.
 *
 * @param array  $user_ids   An array of phpBB user IDs to receive the notification.
 * @param string $title  The title of the notification.
 * @param string $body   The body message of the notification.
 * @param array  $data   (Optional) Additional data to send with the notification.
 *
 * @return bool Returns true if the notification was sent successfully, false otherwise.
 *
 * @throws Exception If there is an error in sending the notification.
 *
 * @example
 * $push->send_notification(array(1,2,3), 'New Message', 'You have received a new message.');
 * $push->send_notification(array(1), 'Welcome', 'Thank you for registering!', array('key' => 'value'));
 */
public function send_notification($user_ids, $title, $body, $data = array())
{
    // Validate that user_ids is a non-empty array.
    if (!is_array($user_ids) || empty($user_ids)) 
	{
        throw new Exception('User IDs must be provided as a non-empty array.');
    }
 
    // Validate that title is a non-empty string.
    if (empty($title) || !is_string($title)) 
	{
        throw new Exception('Notification title must be a non-empty string.');
    }
 
    // Validate that body is a non-empty string.
    if (empty($body) || !is_string($body)) 
	{
        throw new Exception('Notification body must be a non-empty string.');
    }
 
    // Access the global phpBB database object.
    global $db;
 
    // Initialize an array to hold device tokens.
    $device_tokens = array();
 
    // Iterate through each user ID to retrieve their device tokens.
    foreach ($user_ids as $user_id) 
	{
        // Ensure the user ID is an integer.
        $user_id = intval($user_id);
 
        // Prepare SQL to select the device token of the user.
        $sql = 'SELECT user_fcm_token FROM ' . USERS_TABLE . ' WHERE user_id = ' . $user_id;
        $result = $db->sql_query($sql);
        $row = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);
 
        // If a device token exists, add it to the device_tokens array.
        if (!empty($row['user_fcm_token'])) 
		{
            $device_tokens[] = $row['user_fcm_token'];
        }
    }
 
    // If no device tokens are found, throw an exception.
    if (empty($device_tokens)) 
	{
        throw new Exception('No device tokens found for the specified users.');
    }
 
    // Prepare the notification payload.
    $payload = array(
        'registration_ids' => $device_tokens, // Targets multiple devices.
        'notification' => array(
            'title' => $title, // Notification title.
            'body'  => $body   // Notification body.
        )
    );
 
    // If additional data is provided, include it in the payload.
    if (!empty($data)) 
	{
        $payload['data'] = $data;
    }
 
    // Encode the payload as JSON.
    $json_payload = json_encode($payload);
 
    // Initialize cURL session.
    $ch = curl_init();
 
    // Set cURL options for the POST request to FCM.
    curl_setopt($ch, CURLOPT_URL, $this->fcm_url); // FCM endpoint.
    curl_setopt($ch, CURLOPT_POST, true); // Use POST method.
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: key=' . $this->server_key, // FCM server key.
        'Content-Type: application/json' // Content type.
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as string.
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL certificate verification.
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_payload); // Attach JSON payload.
 
    // Execute the cURL request and capture the response.
    $response = curl_exec($ch);
 
    // Check for cURL errors.
    if ($response === FALSE) 
	{
        $error = curl_error($ch);
        curl_close($ch); // Close cURL session.
        throw new Exception('cURL error while sending notification: ' . $error);
    }
 
    // Get HTTP response code.
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
 
    // Close the cURL session.
    curl_close($ch);
 
    // Decode the response JSON.
    $response_data = json_decode($response, true);
 
    // Check if the response contains 'success' key and it's greater than zero.
    if (isset($response_data['success']) && $response_data['success'] > 0) 
	{
        // Return true indicating successful notification send.
        return true;
    } 
	else 
	{
        // Extract error message from response.
        $error_message = isset($response_data['results'][0]['error']) ? $response_data['results'][0]['error'] : 'Unknown error';
        throw new Exception('Failed to send notification. HTTP Status Code: ' . $http_code . '. Error: ' . $error_message);
    }
}
 
    /**
     * Unregisters a user's device by removing the device token from the database.
     *
     * @param int $user_id The unique identifier of the phpBB user.
     *
     * @return bool Returns true on successful unregistration, false otherwise.
     *
     * @throws Exception If there is an error during the database operation.
     *
     * @example
     * $push->unregister_device(1);
     */
	public function unregister_device($user_id)
	{
		// Ensure user ID is a positive integer.
		if (!is_int($user_id) || $user_id <= 0) 
		{
			throw new Exception('Invalid user ID provided.');
		}
	 
		// Access the global phpBB database object.
		global $db;
	 
		// Prepare SQL to remove the device token for the user.
		$sql = 'UPDATE ' . USERS_TABLE . ' SET user_fcm_token = NULL WHERE user_id = ' . intval($user_id);
	 
		// Execute the SQL query.
		$result = $db->sql_query($sql);
	 
		// Check if the query was successful.
		if ($result) {
			// Return true indicating successful unregistration.
			return true;
		} else {
			// Throw an exception if the query failed.
			throw new Exception('Failed to unregister device token.');
		}
    }
}
 
/**
 * Example Usage of the PushNotification class.
 *
 * The following examples demonstrate how to use the PushNotification class to register devices,
 * send notifications, and unregister devices within phpBB 3.0.14.
 */
 
// Ensure this script is being run within the phpBB environment.
if (!defined('IN_PHPBB')) 
{
    exit;
}
 
try 
{
	// Initialize the PushNotification class with your FCM server key.
	// Replace 'YOUR_FCM_SERVER_KEY' with your actual Firebase server key.
	$push = new PushNotification('YOUR_FCM_SERVER_KEY');
	 
	/**
	 * Example 1: Registering a device for a user.
	 *
	 * Registers the device token 'abc123fcmtoken' for user with ID 1.
	 */
	$user_id = 1; // The phpBB user ID.
	$device_token = 'abc123fcmtoken'; // The FCM device token.
	$registration_success = $push->register_device($user_id, $device_token);
	 
	if ($registration_success) {
		echo "Device registered successfully for user ID {$user_id}.\n";
	}
	 
	/**
	 * Example 2: Sending a notification to multiple users.
	 *
	 * Sends a notification with the title 'New Announcement' and body 'We have updated our forum rules.'
	 * to users with IDs 1, 2, and 3.
	 */
	$target_user_ids = array(1, 2, 3); // Array of phpBB user IDs.
	$notification_title = 'New Announcement'; // Notification title.
	$notification_body = 'We have updated our forum rules.'; // Notification body.
	$additional_data = array('rule_version' => '2.0'); // Additional data payload.
	 
	$send_success = $push->send_notification($target_user_ids, $notification_title, $notification_body, $additional_data);
	 
	if ($send_success) {
		echo "Notification sent successfully to users: " . implode(', ', $target_user_ids) . ".\n";
	}
	 
	/**
	 * Example 3: Unregistering a device for a user.
	 *
	 * Unregisters the device token for user with ID 1.
	 */
	$unregister_user_id = 1; // The phpBB user ID to unregister.
	$unregister_success = $push->unregister_device($unregister_user_id);
	 
	if ($unregister_success) 
	{
		echo "Device unregistered successfully for user ID {$unregister_user_id}.\n";
	}
	 
} 
catch (Exception $e) 
{
/**
 * Error Handling
 *
 * Catches and displays any exceptions thrown during the push notification operations.
 */
    echo 'Error: ' . $e->getMessage();
}
 
?>