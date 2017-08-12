<?php

/**
 * Created by PhpStorm.
 * User: Cyclon
 * Date: 2016-11-20
 * Time: 11:07 PM
 */
class viewOrders extends Controller
{

    public function index(){

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