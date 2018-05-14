<?php
namespace frontend\controllers;
class ComponentsController extends \core\web\Controller{

  public function beforeAction( $actionId, $params = [] ){
    $result = \frontend\components\SessionValidator::isValid();
    if( $result['success'] == false ){
      if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){
        header("Content-Location: /login"); exit();
      } else {
        header("Location: /login"); exit();
      }
    }
    if( !isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) ){
      header("Location: /"); exit();
    }
    return true;
  }

  public $notifications = [
    "1" => [
      "id" => 1,
      "title" => "My first notification",
      "description" => "test content",
      "icon" => "warning"
    ],
    "2" => [
      "id" => 2,
      "title" => "My second notification",
      "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec auctor mollis sapien et eleifend. Mauris sagittis fermentum eleifend. Duis aliquet arcu id est hendrerit facilisis. Nullam eget feugiat ex. Integer congue diam vitae lorem condimentum venenatis. Aenean eleifend luctus velit vitae scelerisque. Proin elementum mattis tortor eu elementum. Ut finibus in diam ut faucibus. Aenean eget turpis ac odio sagittis commodo. Duis vel dui dolor. Nulla sit amet sodales erat. Pellentesque sit amet metus non justo ultrices pharetra sed eu nisi.

Duis porta laoreet sem sit amet mollis. Maecenas tincidunt nibh sit amet convallis congue. Suspendisse lacinia posuere turpis. Mauris tempor eros dignissim mattis bibendum. Quisque nec facilisis sem, sit amet faucibus libero. Vestibulum lobortis erat enim, a placerat felis laoreet vel. Vestibulum feugiat tellus quam, quis feugiat ligula bibendum id. Integer accumsan lacus et lorem posuere bibendum. Nunc rutrum orci id finibus porttitor. Proin volutpat risus ut erat scelerisque suscipit. Suspendisse est leo, tristique eget purus in, malesuada dapibus nisi. Mauris non nunc eleifend, dictum magna vel, aliquet leo. In auctor urna in magna fringilla bibendum. Proin a tempor ex. Duis commodo mi et lectus convallis eleifend. Phasellus id ante vel quam egestas ornare vitae eget ligula.

Fusce finibus non nibh cursus accumsan. Ut venenatis elit non elit laoreet porttitor. Integer imperdiet et leo et fringilla. Etiam quis imperdiet lacus, a sollicitudin orci. Pellentesque vel leo interdum, tempor ligula ac, posuere lacus. Etiam eget purus nec velit lacinia fermentum. Maecenas in egestas dolor. Duis a pellentesque quam, ac pretium neque. Cras porta, mi eu semper euismod, nulla tellus commodo tellus, sit amet molestie nisi augue eu quam. Vivamus in commodo nunc, et cursus tortor. Aenean quis viverra erat, quis accumsan urna. Suspendisse eget bibendum lectus, a elementum massa. Duis pharetra nibh sit amet est egestas, et hendrerit nisi porttitor.

Morbi vehicula volutpat erat et mattis. Nullam vel lacus sed mi porttitor auctor. Morbi elementum at mi eget facilisis. Praesent posuere condimentum consectetur. Integer varius velit enim, ut rutrum velit commodo eget. Vivamus hendrerit commodo ante, ac laoreet quam vehicula eu. Nullam pellentesque tristique varius. In sollicitudin, tellus quis posuere rhoncus, nunc metus commodo ex, ac sodales lacus massa id libero. Proin elementum, turpis maximus convallis efficitur, nulla libero finibus enim, id condimentum sapien ante sit amet dolor. Suspendisse sed enim a leo volutpat sagittis. Nulla faucibus, lorem ut congue lobortis, magna mauris convallis ex, in tincidunt nisl nisl ac lorem. Nulla mollis varius faucibus. Aenean at lacus tempus, auctor est in, bibendum leo.

Mauris facilisis dui tristique felis euismod consequat. In tempor in massa nec dapibus. Aliquam nec euismod ipsum, in molestie velit. Curabitur gravida nisl sit amet nunc venenatis vehicula. Proin auctor rhoncus tellus, cursus facilisis ante tincidunt ut. Nulla facilisi. Phasellus in libero in ipsum molestie lacinia non et metus. Nulla aliquam interdum odio id accumsan. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus commodo mollis volutpat. Aliquam erat volutpat. Sed efficitur, diam et pulvinar auctor, mi leo ultricies tellus, quis euismod arcu tortor at arcu. Aenean convallis orci urna, id tempus quam lacinia vel.",
      "icon" => "info"
    ],
    "3" => [
      "id" => 3,
      "title" => "Portal V0.00.01",
      "description" => "<h1>Hoorah!</h1>",
      "icon" => "info"
    ]
  ];

  public function actionDashboard(){

    $notification = null;

    if( !isset( \Core::$app->session["user"]["logged_in"] ) ) {
      \Core::$app->session["user"]["logged_in"] = true;
      $notification = [
        "title" => [
          "img" => "/environments/frontend/assets/img/dnovo-icon.png",
          "label" => "Dnovo"
        ],
        "content" => [
          "title" => "Welkom bij Novosync",
          "description" => "Succesvol ingelogd",
          "img" => "/environments/frontend/assets/img/dnovo-icon.png",
        ],
        "options" => [
          "dismiss" => "1"
        ]
      ];
    }


    return $this->renderPartial( "dashboard", [
      "notification" => $notification
    ] );
  }
  public function actionSites(){
    return $this->renderPartial( "sites" );
  }
  public function actionJobs(){
    return $this->renderPartial( "jobs" );
  }
  public function actionNotifications(){
    return $this->renderPartial( "notifications", [
      "notifications" => json_decode( json_encode( $this->notifications ) )
    ] );
  }
  public function actionNotificationsView( $id ){
    if( isset( $this->notifications[ $id ] ) ){
      return $this->renderPartial( "notifications/view", [
        'notification' => json_decode( json_encode( $this->notifications[ $id ] ) )
      ] );
    }
    return $this->renderPartial( "notifications/404" );

  }
  public function actionSettings(){
    return $this->renderPartial( "settings" );
  }

  public function actionError(){
    echo 'err'; exit();
  }


  public function actionAjaxGenerateApiToken(){

    $token = \Core::$app->security->generateToken( 32, "-", 4, [] );
    \Core::$app->session["user"]["token"] = $token;
     echo json_encode( [
        "success" => true,
        "data" => [
          "message" => "Token generated",
          "token" => $token
        ]
    ] ); exit();
  }
  public function actionAjaxUpdateDeveloperMode(){
    $developer = boolval( $_GET['developer'] );
    \Core::$app->session['user']['developer'] = $developer;
    echo json_encode( [
       "success" => true,
       "data" => [
         "message" => "Updated developer mode to {$developer}",
       ]
   ] ); exit();
  }
}
?>
