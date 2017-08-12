<?php

class rankSellers extends Controller{

    public function index(){

        $orders = $this->model('orders');
        $items = $this->model('item');
        
        $sellers = array();
        $allItems = $items->findAll();
        

        foreach($allItems as $item){
            
            $itemName = $item->item_name;
            $query = $orders->where(['item_id'=>$item->item_id]);
            $size = sizeOf($query);
            $assoc = array('itemName'=>$itemName,'size'=>$size);
            $sellers[] = $assoc;            
        }
        
        $this->view('sellers',['sellers'=>$sellers]);

    }
}

?>