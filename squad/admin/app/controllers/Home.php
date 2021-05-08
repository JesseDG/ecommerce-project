<?php 

class Home extends Controller{

	public function index(){

	    self::insertAdmins();

	   if(!isset($_SESSION['admin']))
          self::login();
        else{


            
            $allOrders = self::getAllOrders();
            $this->view('main', ['allOrders'=>$allOrders]);
        }

	}
    
    public function getNumbers(){
            $msg = $this->model('message');
            $n_order = $this->model('orders');
            $new_orders = $n_order->where(['status'=>Controller::paid]);
            $cancelledOrders = $n_order->where(['status'=>Controller::cancelled]);
        
            $items = $this->model('item');

            //Count the number of new messages
            $nmb_msg = $msg->where(['recipient_id'=>Controller::admin, 'isReplied'=>Controller::notReplied]);
            $count_msg = count($nmb_msg);

            //Count the number of new orders
            $count_orders = count($new_orders);
            //Count the number of cancellations
            $count_cancellation = count($cancelledOrders);
        
            //count items less than or equal to 10
            $sql = "select * from item where item_stock = 10 or item_stock < 10";
            $queryItems = $items->prepare($sql);
            $queryItems->execute();
            
            $queryItems->setFetchMode(PDO::FETCH_CLASS, "item");

            $returnVal = [];
            while($rec = $queryItems->fetch()){
                $returnVal[] = $rec;
            }
        
            $countItems = count($returnVal);
        
            $alerts = $count_cancellation + $countItems;
        
        
            $nmb = array('newMessages'=>$count_msg, 'orders'=>$count_orders,'alerts'=>$alerts);
        
            echo json_encode($nmb);
    }

	public function login(){

	    $administrator = $this->model('administrator');
        $this->view('login', []);

        if(isset($_POST['submit'])){

            $administrator->admin_name = $_POST['uname'];
            $administrator->password = $_POST['upass'];
            $query = $administrator->where(['admin_name'=>$administrator->admin_name]);
            $hash_pass = $query[0]->password;
            if( password_verify($administrator->password, $hash_pass) ) {
                $_SESSION['admin'] = $administrator->admin_name;
                header('Location: home/index');
            }
        }
    }

    public function logout(){

        session_unset();
        session_destroy();
        header('location:./login');

    }


    /*TEMPORARY CODE*/
    public function insertAdmins(){

        $admins = $this->model('administrator');
        $returnedRows = $admins->findAll();

        if(empty($returnedRows)){

            $admins->admin_name = "Danny";
            $admins->password = password_hash("1234",PASSWORD_BCRYPT);
            $admins->insert();
            $admins->admin_name = "Jesse";
            $admins->password = password_hash("4567",PASSWORD_BCRYPT);
            $admins->insert();
        }
    }
    
    public function getAllOrders(){

        $ordersObj = $this->model('orders');
        $saleObj = $this->model('sale');
        $itemObj = $this->model('item');

        $allorders = array();
        $queryOrders = $ordersObj->findAll();

        foreach ($queryOrders as $currentOrder) {

            //order id
            $orderID = $currentOrder->ID;
                $itemId = $currentOrder->item_id;
                $queryItem = $itemObj->where(['item_id'=>$itemId]);
            
            //item name
            $itemName = $queryItem[0]->item_name;
            
            //quantity
            $qty = $currentOrder->quantity;
            
            //price
            $price = $currentOrder->bought_price;
            
            //order status
            $ordersStatus = $currentOrder->status;
            
            //sale id
            $saleID = $currentOrder->sale_id;
                $querySale = $saleObj->where(['sale_id'=>$saleID]);

            //checkout date
            $checkout = $querySale[0]->checkout_date;
            if($checkout == "")
                $checkout = 'N/A';

            //total sale
            $total = $querySale[0]->total;


            $assoc = array('orderID'=>$orderID,'itemName'=>$itemName,'qty'=>$qty,'price'=>$price,'status'=>$ordersStatus,'checkout'=>$checkout,'saleID'=>$saleID,'total'=>$total);
            $allorders[] = $assoc;

        }
        //$this->view('orders',['allOrders'=>$allorders]);
        return $allorders;

    }
    

}

?>