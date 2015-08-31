<?php
/**
 * Created by PhpStorm.
 * User: Workstation
 * Date: 8/23/2015
 * Time: 7:48 PM
 */

class Oauth extends CI_Controller
{
    private $twitter_consumer_key = "DihIjvV8u74SPsOaXDbOWN7rE";
    private $twitter_secret_key = "5qtbYY22XGnRJzj7M6gzHYBMztHqnZwYrAKNASuZ9UmKLfkPuJ";

    public function __construct()
    {
        parent::__construct();
    }

    public function facebook_auth()
    {
        $this->load->library("FacebookAuth");

        $fb = new Facebook\Facebook([
            'app_id' => '400987613433600',
            'app_secret' => '2e4c483ea56dd2b9be87242321ec32cb',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email','public_profile','publish_actions','user_friends','user_about_me','user_birthday'];
        $login_url = $helper->getLoginUrl('http://jagamana.besaba.com/oauth/facebook_oauth', $permissions);

        redirect($login_url);
    }

    public function facebook_oauth()
    {
        $this->load->library("FacebookAuth");

        $fb = new Facebook\Facebook([
            'app_id' => '400987613433600',
            'app_secret' => '2e4c483ea56dd2b9be87242321ec32cb',
            'default_graph_version' => 'v2.2',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (!isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId("400987613433600");

        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
        }

        $this->session->set_userdata('fb_access_token', (string) $accessToken);

        try {
            // Returns a `Facebook\FacebookResponse` object
            $fb->setDefaultAccessToken($this->session->userdata('fb_access_token'));
            $response = $fb->get('/me?fields=name,email,bio,birthday,gender,picture');
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();

        $this->load->model("UserModel", "user_model");
        $this->user_model->register_via_facebook($user);
        redirect("dashboard");
    }

    public function twitter_auth()
    {
        $this->load->library("TwitterAuth");

        # The TwitterOAuth instance
        $twitteroauth = new TwitterOAuth($this->twitter_consumer_key, $this->twitter_secret_key);

        # Requesting authentication tokens, the parameter is the URL we will be redirected to
        $request_token = $twitteroauth->getRequestToken('http://jagamana.besaba.com/oauth/twitter_oauth');
pretty_print($request_token);
        # Saving them into the session
        $this->session->set_userdata("oauth_token", $request_token['oauth_token']);
        $this->session->set_userdata("oauth_token_secret", $request_token['oauth_token_secret']);

        # If everything goes well..
        if ($twitteroauth->http_code == 200)
        {
            # Let's generate the URL and redirect
            $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
            //redirect($url);
        }
        else
        {
            # It's a bad idea to kill the script, but we've got to know when there's an error.
            die('Something wrong happened.');
        }
    }

    public function twitter_oauth()
    {
        $this->load->library("TwitterAuth");

        $verifier = $this->input->get("oauth_verifier");

        $token = $this->session->userdata("oauth_token");
        $secret = $this->session->userdata("oauth_token_secret");

        if (!empty($verifier) && !empty($token) && !empty($secret))
        {
            # TwitterOAuth instance, with two new parameters we got in twitter_login.php
            $twitteroauth = new TwitterOAuth($this->twitter_consumer_key, $this->twitter_secret_key, $token, $secret);

            # Let's request the access token
            $access_token = $twitteroauth->getAccessToken($verifier);

            # Save it in a session var
            $this->session->set_userdata("access_token", $access_token);

            # Let's get the user's info
            $user_info = $twitteroauth->get('account/verify_credentials');

            if (isset($user_info->error))
            {
                # Something is wrong, go back to square 1
                redirect("oauth/twitter_auth");
            }
            else
            {
                # Let user model handle the rest
                $this->load->model("UserModel", "user_model");
                $this->user_model->register_via_twitter($user_info, $access_token);
                redirect("dashboard");
            }
        }
        else
        {
            # Something is missing, go back to square 1
            redirect("oauth/twitter_auth");
        }
    }

}