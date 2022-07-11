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
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use View;
use Illuminate\Support\Facades\Crypt;


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

    if(count($datos)==0){
      Session::flash('message', "No existe el usuario ingresado.");
      return Redirect::back();
    }else{
      if ($request->password == Crypt::decryptString($datos[0]->password) ) {
        
        session([
          'userName' => $datos[0]->displayName,
          'userEmail' => $datos[0]->mail,
          'userTimeZone' => "Chile",
          'department' => $datos[0]->id_subcontratista
        ]);
        return redirect("/welcome");
      } else {
        Session::flash('message', "La contraseña ingresada es incorrecta.");
        return Redirect::back();
      }
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
                  'mail' => $request->correo_usuario,
                  'password' => Crypt::encryptString($request->password),
                  'id_subcontratista' => $request->id_subcontratista,
              ]);
    Session::flash('message', "Se creo correctamente el usuario.");
    Session::flash('verificar', 1);
    return Redirect::back();
  }

  public function recuperar(){
    return View("auth.recuperar");
  }

  public function recuperar_pass(Request $request){

    
    $PASS = DB::table("usuarios")->where("mail","=",$request->email)->get();


    if(count($PASS)>0){

      $transport = new Swift_SmtpTransport('smtp.office365.com', 587, 'tls');
      $transport->setUsername('noreply@jej.cl')->setPassword('Jejsa2021');
  
      $mailer = new Swift_Mailer($transport);
  
      $message = new Swift_Message('Recuperación de Contraseña');
  
      $view = View::make('notificacion',[
        'password' => Crypt::decryptString($PASS[0]->password),
    ]);
  
      $html = $view->render();
  
      $message
          ->setFrom(['noreply@jej.cl' => 'Sistema de Reportes'])
          ->setTo([$request->email => 'Solicitante'])
          ->setSubject('Recuperación de Contraseña')
          ->setBody($html, 'text/html');
  
      $result = $mailer->send($message);
  
  
      Session::flash('message', "!Enhorabuena! Revisa tu casilla de correo electronico.");
      return Redirect::back();
    }else{
      Session::flash('message', "No existe el correo solicitado.");
      return Redirect::back();
    }
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
      return redirect('/signin');
    }

    if (!isset($providedState) || $expectedState != $providedState) {
      return redirect('/welcome')
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
