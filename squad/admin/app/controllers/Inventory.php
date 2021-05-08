<?php 

class Inventory extends Controller{

    public function index(){

        $items = $this->model('item');
        $allItems = $items->findAll();

        $cat_name_arr = array();
        $brand_name_arr = array();

        $brand = $this->model('brand');
        $category = $this->model('category');

        foreach ($allItems as $item){

            $catID = $item->category_id;
            $queryC = $category->where(['category_id'=>$catID]);
            $cat_name = $queryC[0]->category_name;
            $cat_name_arr[] = $cat_name;

            $brandID = $item->brand_id;
            $queryB = $brand->where(['brand_id'=>$brandID]);
            $brandName = $queryB[0]->brand_name;
            $brand_name_arr[] = $brandName;

        }
        $this->view('inventory_table',['items' => $allItems, 'cat_names'=>$cat_name_arr, 'brand_names' => $brand_name_arr]);
    }
    
}
?>