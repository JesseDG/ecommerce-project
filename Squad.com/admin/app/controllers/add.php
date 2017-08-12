<?php

class add extends Controller{
    
   public function addingItem(){
        
        $item = $this->model('item');
        $cat  = $this->model('category');
        $brand = $this->model('brand');

        $allCategories = $cat->findAll();
        $allBrands = $brand->findAll();

        
       if(isset($_POST['submit'])){
            
            $item->item_name         = $_POST['iname'];
            $item->item_description  = $_POST['idescription'];
            $item->item_picture      = file_get_contents($_FILES['image']['tmp_name']);
            $item->item_price        = $_POST['iprice'];
            $item->item_stock        = $_POST['istock'];
            $item->bought_date       = $_POST['ib_date'];
            $item->status_item       = $_POST['istatus'];

            //get the name of the brand and category
            $brand_name = $_POST['ibrand'];
            $cat_name   = $_POST['icategory'];

            //get the id from the database through the name
            $brandAssoc = $brand->where(['brand_name'=>$brand_name]);
            $brandID = $brandAssoc[0]->brand_id;
            $catAssoc  = $cat->where(['category_name'=>$cat_name]);
            $catID = $catAssoc[0]->category_id;

            $item->brand_id = $brandID;
            $item->category_id = $catID;

            //check if they are not empty and if image is valid
            if( $item->isEmpty() && $item->checkImage($_FILES['image']['tmp_name']) ){
                $item->insert();

            }
        }
        $allItems = $item->findAll();



        $this->view('addItem',['items'=>$allItems, 'categories'=>$allCategories, 'brands'=>$allBrands]);

    }
    
    public function addingCategory(){

        $category = $this->model('category');


        if(isset($_POST['submit'])){

            $category->category_name = $_POST['cname'];
            $category->status = $_POST['status'];

            if($category->isEmpty()) {
                $category->insert();
            }
            
        }
        $categories = $category->findAll();
        $this->view('addCategory',['categories'=>$categories]);
    }
    
    public function addingBrand(){
        
        $brand = $this->model('brand');

        if( isset($_POST['submit'])){

            $brand->brand_name = $_POST['bname'];

            if ($brand->isEmpty()){
                $brand->insert();
            }
        }
        $brands = $brand->findAll();
        $this->view('addBrand',['brands'=>$brands]);
    }

}


?>