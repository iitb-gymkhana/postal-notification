<?php
session_start();
require 'config.php';
require 'common.php';

require_once 'vendor/autoload.php';

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'wq4sQWBYiTazeUIysQsfreiqV09eifC2XkBz7WZ1',
    'clientSecret'            => '',
    'redirectUri'             => 'https://gymkhana.iitb.ac.in/~hostels/pns/login.php',
    'urlAuthorize'            => 'https://gymkhana.iitb.ac.in/sso/oauth/authorize/',
    'urlAccessToken'          => 'https://gymkhana.iitb.ac.in/sso/oauth/token/',
    'urlResourceOwnerDetails' => 'https://gymkhana.iitb.ac.in/sso/user/api/user/?fields=username'
]);

function ldap2hostel($host, $ldap) {
	foreach ($host as &$h) {
                if ($h->hallmgr == $ldap) {
                       return $h;
                }
        }
}

// Catch errors
if (isset($_GET['error'])) {
    echo "Error occured during authentication";
    exit;
}

// Login with SSO
if (!isset($_GET['code'])) {
    $options = [
        'scope' => ['basic ldap']
    ];
    $authorizationUrl = $provider->getAuthorizationUrl($options);
    header('Location: ' . $authorizationUrl);
    exit;
} else {
    try {
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        $resourceOwner = $provider->getResourceOwner($accessToken);
        $user = $resourceOwner->toArray();

        // Login
        if ($user != null && $user['username'] != null) {
            $username = $user['username'];

            if (ldap2hostel($hostels, $username)) {
                $_SESSION['user'] = $username;
                header("location:index.php");
            } else {
                echo "No matching user found for $username. Try to log out of SSO and try again.";
            }
        } else {
            echo "Failed to get user profile from SSO";
        }
    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        exit($e->getMessage());
    }
}

?>
