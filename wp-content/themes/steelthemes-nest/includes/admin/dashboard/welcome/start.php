<?php
/*
 ** ==============================
 ** Welcome to theme page start
 ** ==============================
*/
class Welcometotheme{
    public function __construct() {
        // Add the action in the constructor or any appropriate method
        add_action( 'wp_loaded', array( $this, 'check_site_reset' ) );
    }
    public function activate_theme()
    {
        // Check if the necessary functions exist
        if (
            method_exists($this, "decrypt_token") &&
            method_exists($this, "verify_purchase_code") &&
            method_exists($this, "store_purchase_details") &&
            method_exists($this, "get_details") &&
            method_exists($this, "deactivate_theme") &&
            method_exists($this, "store_purchase_details_delete") &&
            method_exists($this, "theme_activation_page") 
        ) {
            // Call function1 and function2
            $this->decrypt_token();
            $this->verify_purchase_code();
            $this->store_purchase_details();
            $this->get_details();
            $this->deactivate_theme();
            $this->store_purchase_details_delete();
            $this->theme_activation_page();
        } else {
            // Display a notice if any function is missing
            echo "One or more required functions are missing.";
        }
    }
    private function decrypt_token($encryptedTokenCode, $secretKey)
    {
        $cipher = "AES-256-CBC";
        $ivLength = openssl_cipher_iv_length($cipher);
        $decodedToken = base64_decode($encryptedTokenCode);
        $iv = substr($decodedToken, 0, $ivLength);
        $encrypted = substr($decodedToken, $ivLength);
        $decrypted = openssl_decrypt(
            $encrypted,
            $cipher,
            $secretKey,
            OPENSSL_RAW_DATA,
            $iv
        );
        return $decrypted;
    }
    private function verify_purchase_code($code, $item_id, $current_domain)
    {
        // Retrieve the token code from the token endpoint
        $manageall_endpoint = "https://themepanthers.com/validate.php";
        $response = wp_remote_get($manageall_endpoint);
        if (!is_wp_error($response)) {
            $response_code = wp_remote_retrieve_response_code($response);
            if ($response_code === 200) {
                $encryptedTokenCode = wp_remote_retrieve_body($response);
                $secretKey = "fkdslfdksflsdmfsdfldsmfsl"; // Your own secret key
                $decryptedTokenCode = $this->decrypt_token(
                    $encryptedTokenCode,
                    $secretKey
                );
            } else {
                // Handle specific response code errors
                throw new Exception(
                    "Token retrieval failed with response code: " .
                        $response_code
                );
            }
        } else {
            // Handle general WP_Error
            throw new Exception(
                "Token retrieval failed: " . $response->get_error_message()
            );
        }
        $code = trim($code);
        if (
            !preg_match(
                "/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i",
                $code
            )
        ) {
            throw new Exception("Invalid purchase code");
        }
        $url = "https://api.envato.com/v3/market/author/sale?code={$code}&item_id={$item_id}";
        $args = [
            "headers" => [
                "Authorization" => "Bearer " . $decryptedTokenCode,
                "User-Agent" => "Purchase code verification script",
            ],
        ];
        $response = wp_remote_get($url, $args);
        if (is_wp_error($response)) {
            throw new Exception(
                "Failed to connect: " . $response->get_error_message()
            );
        }
        $license_data = json_decode(wp_remote_retrieve_body($response), true);
        if (is_array($license_data) && isset($license_data["error"])) {
            throw new Exception($license_data["error"]["message"]);
        }
        return $license_data;
    }
    private function store_purchase_details(
        $purchaseCode,
        $domain,
        $customerName,
        $boughtDateFormatted,
        $itemName
    ) {
        $purchaseCodeExists = $this->get_details($purchaseCode);
        if ($purchaseCodeExists) {
            echo "The purchase code is already used.";
            return;
        }
        $purchaseDetails = [
            "purchaseCode" => $purchaseCode,
            "domain" => $domain,
            "customerName" => $customerName,
            "boughtDate" => $boughtDateFormatted,
            "itemName" => $itemName,
        ];

        // Convert the purchase details array to JSON
        $dataJson = json_encode($purchaseDetails);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://themepanthers.com/store.php"); // Replace with the actual URL of store.php
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            echo "cURL error: " . curl_error($ch);
        }
        curl_close($ch);
        // Debug the response
        // var_dump($response);
        // Process the response from store.php
        $responseData = json_decode($response, true);
        if (isset($responseData["success"])) {
            if ($responseData["success"]) {
                echo "";
            } else {
                echo "Failed to store purchase details: " .
                    $responseData["message"];
            }
        }
    }
    private function get_details($purchaseCode)
    {
        $checkPurchaseURL =
            "https://themepanthers.com/check-purchase.php?purchase_code=" .
            urlencode($purchaseCode);
        $response = wp_remote_get($checkPurchaseURL);
        if (!is_wp_error($response)) {
            $response_code = wp_remote_retrieve_response_code($response);
            if ($response_code === 200) {
                $responseData = json_decode(
                    wp_remote_retrieve_body($response),
                    true
                );
                return $responseData["exists"];
            } else {
                throw new Exception(
                    "Failed to check the purchase code. Response code: " .
                        $response_code
                );
            }
        } else {
            throw new Exception(
                "Failed to connect to the purchase code validation endpoint: " .
                    $response->get_error_message()
            );
        }
    }
    public function check_site_reset() {
        // Check if the database has been reset
        if ( isset( $_GET['page'] ) && $_GET['page'] === 'reset-site-options' ) {
            // Assuming 'reset-site-options' is the URL parameter when the site is reset.
            // Add your own condition based on how you reset the site.
            $this->remove_purchase_code_details_on_reset();
        }
    }

    // Function to remove purchase code details from the database
    public function remove_purchase_code_details_on_reset() {
        // Get the purchase code from the database
        $purchaseCode = get_option( "purchase_code" );

        if ( $purchaseCode ) {
            try {
                $this->store_purchase_details_delete( $purchaseCode );
                echo "Purchase details removed successfully.";
            } catch ( Exception $e ) {
                echo "Failed to remove purchase details: " . $e->getMessage();
            }
        }
    }

    public function deactivate_theme()
    {
        $purchaseCode = get_option("purchase_code");
        // Remove the stored data
        delete_option("purchase_code");
        delete_option("purchase_domain");
        delete_option("customer_name");
        delete_option("itemname"); 
        delete_option("bought_date");
        delete_option("supported_until");
        try {
            $this->store_purchase_details_delete($purchaseCode);
            echo "Successfully deactivated.";
        } catch (Exception $e) {
            echo "Failed to deactivate: " . $e->getMessage();
        }
    }
    private function store_purchase_details_delete($purchaseCode)
    {
        // Prepare the purchase code
        $purchaseDetails = [
            "purchaseCode" => $purchaseCode,
        ];
        // Convert the purchase details to JSON
        $dataJson = json_encode($purchaseDetails);
        // Define the endpoint URL to delete the purchase details
        $storeEndpoint = "https://themepanthers.com/store-delete.php"; // Update with the correct URL of your store-delete.php file
        // Create the request arguments
        $args = [
            "method" => "POST",
            "headers" => [
                "Content-Type" => "application/json",
            ],
            "body" => $dataJson,
        ];
        // Send the request to delete the purchase details
        $response = wp_remote_post($storeEndpoint, $args);
        if (!is_wp_error($response)) {
            $response_code = wp_remote_retrieve_response_code($response);
            if ($response_code === 200) {
                // Delete the purchase details from the database
                global $wpdb;
                $table_name = $wpdb->prefix . "purchase_details";

                $wpdb->delete($table_name, ["purchaseCode" => $purchaseCode]);

                echo "Purchase details deleted successfully.";
            } else {
                // Handle specific response code errors
                throw new Exception(
                    "Failed to delete purchase details: " . $response_code
                );
            }
        } else {
            // Handle general WP_Error
            throw new Exception(
                "Failed to delete purchase details: " .
                    $response->get_error_message()
            );
        }
    }
    // Other class methods and properties
    public function theme_activation_page()
    {
        if (isset($_GET["action"]) && $_GET["action"] === "deactivate") {
            $this->deactivate_theme();
            exit();
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $purchaseCode = isset($_POST["purchase-code-input"])
                    ? trim($_POST["purchase-code-input"])
                    : "";
                $current_domain = parse_url(get_site_url(), PHP_URL_HOST);
                $item_id = 37772027;
                // Check if the purchase code exists in the database
                $purchaseCodeExists = $this->get_details($purchaseCode);
                if ($purchaseCodeExists) {
                    echo "The purchase code is already used.";
                    return;
                }
                $response = $this->verify_purchase_code(
                    $purchaseCode,
                    $item_id,
                    $current_domain
                );
                if ($response["item"]["id"] !== $item_id) {
                    throw new Exception(
                        "The purchase code provided is for a different item"
                    );
                }
                // Store the purchase details
                $customerName = $response["buyer"];
                $itemname = $response["item"]["name"];
                $boughtDate = new DateTime($response["sold_at"]);
                $supportedUntil = new DateTime($response["supported_until"]);
                $boughtDateFormatted = $boughtDate->format("Y-m-d H:i:s");
                $supportedUntilFormatted = $supportedUntil->format(
                    "Y-m-d H:i:s"
                );
                $this->store_purchase_details(
                    $purchaseCode,
                    $current_domain,
                    $customerName,
                    $boughtDateFormatted,
                    $itemname
                );
                // Update other necessary options
                update_option("purchase_code", $purchaseCode);
                update_option("itemname", $itemname);
                update_option("purchase_domain", $current_domain);
                update_option("customer_name", $customerName);
                update_option("bought_date", $boughtDateFormatted);
                update_option("supported_until", $supportedUntilFormatted);
                echo "Theme activated successfully.<br>";
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        // Check if the theme is activated
        $isActivated = get_option("purchase_code") ? true : false;
        $enable_custom_feature = get_theme_mod('enable_custom_feature', false);
        $customizer_url = admin_url( 'customize.php' );
        if (!$isActivated && $enable_custom_feature == false) {
            // Display the activation form
            echo '
            <h2>'.esc_html__("Activate your Theme here", "steelthemes-nest") .'</h2>
                <form method="POST">
                    <label for="purchase-code-input"> ' .
                esc_html__("Enter your purchase code:", "steelthemes-nest") .
                '</label><br>
                    <input type="text" name="purchase-code-input" id="purchase-code-input" required><br>
                    <input type="submit" name="activate-theme" value="' .
                esc_html__("Activate Theme", "steelthemes-nest") .
                '">
                </form>
                <p style="padding:10px 0 0 0;">'. esc_html__("To Enable staging site without purchase code go to apperance -- customize -- Staging Site", "steelthemes-nest").'
                <a target="_blank" href="' . esc_url( $customizer_url ) . '" class="customizer-button">'. esc_html__("Click Here to enable staging", "steelthemes-nest").'</a></p>';
                echo '  <p style="padding:10px 0 0 0;">'.esc_html__('You can learn how to find your purchase key' , 'steelthemes-nest') .' <a href="'.esc_url('https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code').'" target="_blank">'.esc_html__('Click Here' , 'steelthemes-nest').'</a></p>';
        }
        elseif($enable_custom_feature == true){
            echo '<p>'. esc_html__("Disable Staging site opton to enter the pruchase code and make site Live.", "steelthemes-nest").'</p>';
            echo '<strong>'. esc_html__("To Disable staging site go to apperance -- customize -- Staging Site", "steelthemes-nest").' <a target="_blank" href="' . esc_url( $customizer_url ) . '" class="customizer-button">'. esc_html__("Click Here to Disable staging", "steelthemes-nest").'</a></strong>';
        }
        // Display the deactivate button if the theme is activated
     

        if ($isActivated) {
            $purchaseCode = get_option("purchase_code");
            $itemname = get_option("itemname");
            $current_domain = get_option("purchase_domain");
            $customerName = get_option("customer_name");
            $boughtDate = get_option("bought_date");
            $supportedUntil = get_option("supported_until");
            // Output the option values within the specified <div> element
            if (!empty($purchaseCode)) {
                echo '<ul class="stored_data">';
                echo '<li><b>' . esc_html__('Purchase Code:', 'steelthemes-nest') . '</b>' . $purchaseCode . '</li>';
                echo '<li><b>' . esc_html__('Item Name:', 'steelthemes-nest') . '</b>' . $itemname . '</li>';
                echo '<li><b>' . esc_html__('Domain Name:', 'steelthemes-nest') . '</b>' . $current_domain . '</li>';
                echo '<li><b>' . esc_html__('Customer Name:', 'steelthemes-nest') . '</b>' . $customerName . '</li>';
                echo '<li><b>' . esc_html__('Bought Date:', 'steelthemes-nest') . '</b>' . $boughtDate . '</li>';
                echo '<li><b>' . esc_html__('Supported Until:', 'steelthemes-nest') . '</b>' . $supportedUntil . '</li>';
                echo "</ul>";
                echo '<ul class="for_customers_alert">';
                echo '<li>' . esc_html__('Do not reset or delete the theme without deactivating it.', 'steelthemes-nest') . '</li>';
                echo '<li>' . esc_html__('To migrate the site from one domain to another, use a migration plugin such as Duplicator or All-in-One Migration, or any plugin you prefer.', 'steelthemes-nest') . '</li>';
                echo '<li>' . esc_html__('After migration, deactivate the theme, and once migration is completed on the new domain, activate the theme again.', 'steelthemes-nest') . '</li>';
                echo '<li>' . esc_html__('If you received this message -> The purchase code is already used ->', 'steelthemes-nest') . ' <a  target="_blank" href="https://steelthemes.ticksy.com/submit/#100019994">' . esc_html__('Contact support. Our team will help you immediately.', 'steelthemes-nest') . '</a></li>';
                echo '</ul>'; 
            }
            echo '<a href="admin.php?page=nest&action=deactivate" class="button button-primary">' .
                esc_html__("Deactivate Theme", "steelthemes-nest") .
                "</a>";
        }
    } 
}
new Welcometotheme();
