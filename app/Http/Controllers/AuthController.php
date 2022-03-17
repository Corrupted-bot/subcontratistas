<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use App\TokenStore\TokenCache;
use Hash;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{

  public function login()
  {

    try {

      $viewData = $this->loadViewData();
      $viewData['userEmail'] = $viewData['userEmail'];
      return redirect("/welcome");
    } catch (\Throwable $th) {

        return View("auth.login");
      
    }
  }

  public function IniciarSesion(Request $request){

    $datos = DB::table("usuarios")
    ->where("mail","=",$request->username)
    ->get();


    if (Hash::check($request->password,$datos[0]->password )) {
      session([
        'userName' => $datos[0]->displayName,
        'userEmail' => $datos[0]->mail,
        'userTimeZone' => "Chile",
        'department' => "Externo"
      ]);
      return redirect("/welcome");
    } else {
      return View("auth.login");
    }

  }


  public function CerrarSesion(){

    session()->forget('userName');
    session()->forget('userEmail');
    session()->forget('userTimeZone');
    session()->forget('department');
    return redirect("/");
  }

  public function registrar(){



    $viewData = $this->loadViewData();
    try {
        $viewData['userEmail'] = $viewData['userEmail'];
        return View("auth.register",$viewData);
    } catch (\Throwable$th) {
        return redirect("/");
    }

  }

  public function registrarUsuario(Request $request){
    DB::table('usuarios')->insert([
                  'displayName' => $request->name,
                  'mail' => $request->correo,
                  'password' => bcrypt($request->password),
              ]);
    Session::flash('message', "Se creo correctamente el usuario.");
    Session::flash('verificar', 1);
    return Redirect::back();
  }



  public function signin()
  {
    // Initialize the OAuth client
    $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
      'clientId'                => config('azure.appId'),
      'clientSecret'            => config('azure.appSecret'),
      'redirectUri'             => config('azure.redirectUri'),
      'urlAuthorize'            => config('azure.authority') . config('azure.authorizeEndpoint'),
      'urlAccessToken'          => config('azure.authority') . config('azure.tokenEndpoint'),
      'urlResourceOwnerDetails' => '',
      'scopes'                  => config('azure.scopes')
    ]);

    $authUrl = $oauthClient->getAuthorizationUrl();

    // Save client state so we can validate in callback
    session(['oauthState' => $oauthClient->getState()]);

    // Redirect to AAD signin page
    return redirect()->away($authUrl);
  }

  public function callback(Request $request)
  {
    // Validate state
    $expectedState = session('oauthState');
    $request->session()->forget('oauthState');
    $providedState = $request->query('state');

    if (!isset($expectedState)) {
      // If there is no expected state in the session,
      // do nothing and redirect to the home page.
      return redirect('/welcome');
    }

    if (!isset($providedState) || $expectedState != $providedState) {
      return redirect('/')
        ->with('error', 'Invalid auth state')
        ->with('errorDetail', 'The provided auth state did not match the expected value');
    }

    // Authorization code should be in the "code" query param
    $authCode = $request->query('code');
    if (isset($authCode)) {
      // Initialize the OAuth client
      $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId'                => config('azure.appId'),
        'clientSecret'            => config('azure.appSecret'),
        'redirectUri'             => config('azure.redirectUri'),
        'urlAuthorize'            => config('azure.authority') . config('azure.authorizeEndpoint'),
        'urlAccessToken'          => config('azure.authority') . config('azure.tokenEndpoint'),
        'urlResourceOwnerDetails' => '',
        'scopes'                  => config('azure.scopes')
      ]);

      try {
        // Make the token request
        $accessToken = $oauthClient->getAccessToken('authorization_code', [
          'code' => $authCode
        ]);

        $graph = new Graph();
        $graph->setAccessToken($accessToken->getToken());

        $user = $graph->createRequest('GET', '/me?$select=displayName,mail,mailboxSettings,userPrincipalName,department')
          ->setReturnType(Model\User::class)
          ->execute();

        $tokenCache = new TokenCache();
        $tokenCache->storeTokens($accessToken, $user);

        return redirect('/welcome');
      } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
        return redirect('/')
          ->with('error', 'Error requesting access token')
          ->with('errorDetail', json_encode($e->getResponseBody()));
      }
    }

    return redirect('/')
      ->with('error', $request->query('error'))
      ->with('errorDetail', $request->query('error_description'));
  }

  public function signout()
  {
    $tokenCache = new TokenCache();
    $tokenCache->clearTokens();
    return redirect('https://login.microsoftonline.com/common/oauth2/v2.0/logout?post_logout_redirect_uri=http://localhost:8000/');
  }
}
