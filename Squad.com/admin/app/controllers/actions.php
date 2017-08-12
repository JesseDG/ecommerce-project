<?php

class actions extends Controller{
    
    
    public function index(){
        
        $orders = $this->model('orders');
        $items = $this->model('item');

        $queryCancelledOrders = $orders->where(['status'=>Controller::cancelled]);
        //get necessary info for the new cancelled orders
        $user = $this->model('user');
        $item = $this->model('item');
        $sale = $this->model('sale');
        
        $arr = [];
        
        foreach($queryCancelledOrders as $c_order){
            
            $orderID = $c_order->ID;
            $status = $c_order->status;
            
            //get item name
            $itemId = $c_order->item_id;
            $query = $item->where(['item_id'=>$itemId]);
            $itemName = $query[0]->item_name;
            
            //get sale id to get the user id
            $saleId = $c_order->sale_id;
            $query = $sale->where(['sale_id'=>$saleId]);
            
            $userId = $query[0]->user_id;
            $query = $user->where(['user_id'=>$userId]);
            $userName = $query[0]->email;
            
            $assoc = array('id'=>$orderID,'status'=>$status,'itemName'=>$itemName,'user'=>$userName);
            $arr[] = $assoc;
        }
        
        
        
        $sql = "select * from item where item_stock = 10 or item_stock < 10";
        $queryItems = $items->prepare($sql);
        $queryItems->execute();

        $queryItems->setFetchMode(PDO::FETCH_CLASS, "item");

        $returnVal = [];
        while($rec = $queryItems->fetch()){
            $returnVal[] = $rec;
        }

        $this->view("action",['itemsLess'=>$returnVal,'cancels'=>$arr]);
        
    }
    
    public function getPaidOrders(){
        
        $orders = $this->model('orders');
        $items = $this->model('item');
        
        $queryPaidOrders = $orders->where(['status'=>Controller::paid]);
        
        echo '{"records":'.json_encode($queryPaidOrders).'}';

    }
    
    public function getProcessCancellation(){
        
        $orders = $this->model('orders');
        $items = $this->model('item');
        $queryCancelledProcessOrders = $orders->where(['status'=>Controller::cancellationProcess]);
        
        echo '{"records":'.json_encode($queryCancelledProcessOrders).'}';
    }
    
    public function updateOrder(){
        
        $orderId = $_POST['id'];
        $status = $_POST['status'];

        $orders = $this->model('orders');
        $query = $orders->where(['ID'=>$orderId]);
        $orders = $query[0];

        if($status == Controller::cancellationCompleted){

            $sale_id = $orders->sale_id;
            $price = $orders->bought_price;

            $sale = $this->model('sale');
            $query = $sale->where(['sale_id'=>$sale_id]);
            $sale = $query[0];
            $sale->total = $sale->total - $price;
            $query = $sale->prepare("update sale set total = :total, payment_id = :payment_id, checkout_date = :checkout_date, user_id = :user_id, status = :status where sale_id = :sale_id");
            $query->execute($sale->toArray());
        }

        
        $orders->status = $status;
        
        $sql = "UPDATE orders SET item_id = :item_id,quantity = :quantity,sale_id = :sale_id,bought_price = :bought_price,status = :status WHERE ID = :ID";
        
        $stmt = $orders->prepare($sql);
        $stmt->execute($orders->toArray());

    }

    
}
?>