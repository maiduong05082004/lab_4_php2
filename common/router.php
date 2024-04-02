<?php

use App\Controllers\CustomerController;
use Phroute\Phroute\RouteCollector;
use Phroute\Phroute\Dispatcher;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];
$router = new RouteCollector();
/*request method: 
- get: kéo dữ liệu từ sv về
- post: đẩy dữ liệu lên sv (thêm mới/update)
- delete: xoá dữ liệu
- any: request nào cũng dùng được 

$route: '/', '/products'
$handler: hàm xử lý
*/
// filter check đăng nhập
$router->filter('auth', function(){
    if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
        header('location: ' . BASE_URL . 'login');die;
    }
});

// khu vực cần quan tâm -----------
$router->get('/',function(){
    return "đây là trang chủ"; 
 });
// Khu vực định nghĩa ra các đường dẫn
//cách định nghĩa :
//$router->phương thức http('tên route',hàm xử lý)  (cấu hình = ' ') để thành dạng chuỗi
 $router->group(
    ['prefix'=>'customers'],
    function($router){
        $router->get('list_customers',[CustomerController::class,'list']);
        $router->get('add_customers',[CustomerController::class,'add']);
        $router->post('add_customers',[CustomerController::class,'store']);
        $router->get('detail_customers',[CustomerController::class,'detail']);
        
    }
);
// khu vực cần quan tâm -----------

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
try{
    $dispatcher = new Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;

}catch(Phroute\Phroute\Exception\HttpRouteNotFoundException $e){
    echo "404 file not fouch";
}

?>