<?php
if ($_POST['method'] == 'login') {
    $model = new User_model();
    $sessionData=array(
      "user_id"         => $_POST['user_id'],
      "device_id"       => $_POST['device_id'],
      "security_token"  => $_POST['security_token'],
      "login_type"      => 1
    );
    $this->session->set_userdata('zanomy_user_logged_in', $sessionData);
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    if ($user) {
        $error      = false;
        $code       = 200;
        $msg        = 'Attribute list.';
        $data       = array();
    } else {
        $error      = true;
        $code       = 201;
        $msg        = 'Attribute list.';
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addReview') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addReview';
    $strPost['user_id']     = $user['user_id'];
    $strPost['product_id']  = $_POST['product_id'];
    $strPost['order_id']  = $_POST['order_id'];
    $strPost['rating']      = $_POST['rating'];
    $strPost['review']      = $_POST['review'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}



if ($_POST['method'] == 'addToCart') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    if(isset($user) and $user){
        $loginUserId=$user['user_id'];
    }else{
        $loginUserId=$_COOKIE["zanomycookie"];
    }
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addToCart';
    $strPost['user_id']     = $loginUserId;
    $strPost['product_id']  = $_POST['product_id'];
    $strPost['item_id']     = $_POST['item_id'];
    $strPost['type']        = $_POST['type'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    /////////////////////////////////////////////////////////////////////
    $headerArr = ['user_id'=>$loginUserId,'lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path = 'getMyCart';
    $strPost['user_id'] = $loginUserId;
    $strPost['is_web'] = 1;
    $getMyCart = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $getMyCart= json_decode($getMyCart,TRUE);
    // echo '<pre/>';print_r($getMyCart);exit;
    if($getMyCart['error_code']==200){
        $user_cart=$getMyCart['data'];
    }else{
        $user_cart= array();
    }
    // echo '<pre/>';print_r($user_cart);exit;
    $addToCartType='2';
    $htmlData='';
    if(isset($user_cart['cart'][0]) and $user_cart['cart'][0]):
    $htmlData.='<a class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">';
        $htmlData.='<div class="shopcart">';
            $htmlData.='<span class="icon-c"><i class="fa fa-shopping-bag"></i></span>';
                $htmlData.='<div class="shopcart-inner">';
                    $htmlData.='<p class="text-shopping-cart">My cart</p>';
                        $htmlData.='<span class="total-shopping-cart cart-total-full">';
                            $htmlData.='<span class="items_cart">';
                                $htmlData.=count($user_cart['cart']);
                                    $htmlData.='</span><span class="items_cart2"> item(s)</span><span class="items_carts"> - ';
                                        $htmlData.=  $user_cart['total_amount'];
                                            $htmlData.=' LYD</span></span>';
                $htmlData.='</div>';
            $htmlData.='</div>';
        $htmlData.='</a>';
        $htmlData.='<ul class="dropdown-menu pull-right shoppingcart-box" role="menu">';
            $htmlData.='<li>';
                $htmlData.='<table class="table table-striped">';
                    $htmlData.='<tbody>';
                     if(isset($user_cart['cart']) and $user_cart['cart']): 
                        foreach($user_cart['cart'] as $cart):
                            $htmlData.='<tr>';
                                $htmlData.='<td class="text-center" style="width:70px">';
                                    $htmlData.='<a href="'.base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cart['name'])).'/'.$cart['product_id'].'/'.$cart['item_id']).'">';
                                        $htmlData.='<img src="'.$cart['images'][0]['image'].'" style="width:70px" alt="'.$cart['name'].'" title="'.$cart['name'].'" class="preview">';
                                    $htmlData.='</a>';
                                $htmlData.='</td>';
                                $htmlData.='<td class="text-left"> <a class="cart_product_name" href="'.base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cart['name'])).'/'.$cart['product_id'].'/'.$cart['item_id']).'">'.$cart['name'].'</a></td>';
                                $htmlData.='<td class="text-center">x'.$cart['cart_quentity'].'</td>';
                                $htmlData.='<td class="text-center">'.$cart['amount'].' LYD</td>';
                                $htmlData.='<td class="text-right">';
                                    $htmlData.='<a href="'.base_url('').'" class="fa fa-edit"></a>';
                                $htmlData.='</td>';
                                $htmlData.='<td class="text-right">';
                                    $htmlData.='<a class="fa fa-times fa-delete" onclick="addToCart(this,\''.$cart['product_id'].'\',\''.$cart['item_id'].'\',\''.$addToCartType.'\');"></a>';
                                $htmlData.='</td>';
                            $htmlData.='</tr>';
                            endforeach; endif;
                        $htmlData.='</tbody>';
                    $htmlData.='</table>';
                $htmlData.='</li>';
                $htmlData.='<li>';
                    $htmlData.='<div>';
                        $htmlData.='<table class="table table-bordered">';
                            $htmlData.='<tbody>';
                                $htmlData.='<tr>';
                                    $htmlData.='<td class="text-left"><strong>No of Item</strong></td>';
                                    $htmlData.='<td class="text-right">'.count($user_cart['cart']).'</td>';
                                $htmlData.='</tr>';
                                $htmlData.='<tr>';
                                    $htmlData.='<td class="text-left"><strong>Total</strong></td>';
                                    $htmlData.='<td class="text-right">'.($user_cart['total_amount']).' LYD</td>';
                                $htmlData.='</tr>';
                            $htmlData.=' </tbody>';
                        $htmlData.='</table>';
                        $htmlData.='<p class="text-right"> <a class="btn view-cart" href="'.base_url('my-cart').'"><i class="fa fa-shopping-cart"></i>View Cart</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-mega checkout-cart" href="'.base_url('address').'"><i class="fa fa-share"></i>Checkout</a></p>';
                    $htmlData.='</div>';
                $htmlData.='</li>';
            $htmlData.='</ul>';
            else: 
                $htmlData.='<a class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">';
                    $htmlData.='<div class="shopcart">';
                        $htmlData.='<span class="icon-c"><i class="fa fa-shopping-bag"></i></span>';
                        $htmlData.='<div class="shopcart-inner">';
                            $htmlData.='<p class="text-shopping-cart"> My cart </p>';
                            $htmlData.='<span class="total-shopping-cart cart-total-full">';
                                $htmlData.='<span class="items_cart">00.0</span><span class="items_cart2"> item(s)</span><span class="items_carts"> - 0 LYD</span>';
                            $htmlData.='</span>';
                        $htmlData.='</div>';
                    $htmlData.='</div>';
                $htmlData.='</a>';
            endif;
            //echo $htmlData;exit;
    /////////////////////////////////////////////////////////////////////
    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data,'htmlData'=>$htmlData));
}

if ($_POST['method'] == 'addToWishlist') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addToWishlist';
    $strPost['user_id']     = $user['user_id'];
    $strPost['product_id']  = $_POST['product_id'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'editProfile') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'editProfile';
    $strPost['user_id']     = $user['user_id'];
    $strPost['name']        = $_POST['name'];
    $strPost['email']       = $_POST['email'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'changeProfile') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'changePassword';
    $strPost['user_id']     = $user['user_id'];
    $strPost['old_password']= $_POST['old_password'];
    $strPost['password']    = $_POST['password'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addServiceReview') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                   = 'addServiceReview';
    $strPost['user_id']     = $user['user_id'];
    $strPost['service_id']  = $_POST['service_id'];
    $strPost['booking_id']  = $_POST['booking_id'];
    $strPost['rating']      = $_POST['rating'];
    $strPost['review']      = $_POST['review'];
    $strPost['is_web']      = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'addAddress') {
    $model = new Api_model();
    $user = $this->session->userdata('zanomy_user_logged_in');
    if(isset($user) and $user){
        $loginUserId=$user['user_id'];
    }else{
        $loginUserId=$_COOKIE["zanomycookie"];
    }
    //print_r($user);exit;
    $headerArr = ['user_id'=>'00','lang' => 'en', 'device_id' => '', 'security_token' => ''];
    $path                       = 'addAddress';
    $strPost['user_id']         = $loginUserId;
    $strPost['name']            = $_POST['name'];
    $strPost['postal_code']     = $_POST['postal_code'];
    $strPost['country_code']    = $_POST['country_code'];
    $strPost['mobile']          = $_POST['mobile'];
    $strPost['geo_address']     = $_POST['geo_address'];
    $strPost['street_address']  = $_POST['street_address'];
    $strPost['house_no']        = $_POST['house_no'];
    $strPost['country_id']      = $_POST['country'];
    $strPost['city_id']         = $_POST['city'];
    $strPost['lat']             = $_POST['lat'];
    $strPost['lng']             = $_POST['lng'];
    $strPost['is_web']          = "1";

    $returnData = $this->Api_model->apiCallHeader($path, $headerArr, $strPost);
    $returnData= json_decode($returnData,TRUE);
    //echo '<pre/>';print_r($returnData);exit;

    if ($returnData['error_code']==200) {
        $error      = false;
        $code       = 200;
        $msg        = $returnData['message'];
        $data       = $returnData['data'];
    } else {
        $error      = true;
        $code       = 201;
        $msg        = $returnData['message'];
        $data       = array();
    }
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
if ($_POST['method'] == 'save_location') {
    $model = new Api_model();
    $sessionData=array(
        "address"        => $_POST['address'],
        "lat"       => $_POST['lat'],
        "lng"  => $_POST['lng'],
    );

    $this->session->set_userdata('zanomy_location', $sessionData);
    $user = $this->session->userdata('zanomy_location');
    $error      = false;
    $code       = 200;
    $msg        = "Location saved.";
    $data       = array();
    //echo '<pre/>';print_r($user);exit;
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'changeLanguage') {
    $model = new User_model();
    $language   = $_POST['i'];
    $this->session->set_userdata('zanomy_language_session', $language);
    $session = $this->session->userdata('zanomy_language_session');
    $error      = false;
    $code       = 200;
    $msg        = 'Attribute list.';
    $data       = array();
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}

if ($_POST['method'] == 'changeHomePop') {
    $model = new User_model();
    $this->session->set_userdata('zanomy_home_pops_session', "save");
    $session = $this->session->userdata('zanomy_home_pops_session');
    $error      = false;
    $code       = 200;
    $msg        = 'Attribute list.';
    $data       = array();
    
    echo json_encode(array('error' => $error, 'error_code' => $code, 'message' => $msg, 'data' => $data));
}
?>
