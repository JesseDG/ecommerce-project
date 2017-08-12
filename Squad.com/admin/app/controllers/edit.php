<?php 

class edit extends Controller{

    public function editTables(){//$str=""){

        $items = $this->model('item');
        $query_one = $items->findAll();
        
        $categ = $this->model('category');
        $query_two = $categ->findAll();

        $brands = $this->model('brand');
        $query_three = $brands->findAll();


		$this->view('editTables', ['allItems'=>$query_one, 'allBrands'=>$query_three, 'allCategories'=>$query_two]);
       // echo $str;
    }
    
    public function getItem($id){

        $_SESSION['updateItemID'] = $id;
        $item = $this->model('item');
        $query = $item->where(['item_id'=>$id]);
        $bName = self::getBrand($query[0]->brand_id);
        $cName = self::getCategory($query[0]->category_id);
        $this->viewService('items',['dataItem'=>$query,'itemCategory'=>$cName,'itemBrand'=>$bName]);
        
    }

    public function allBrands(){
        $brandModel = $this->model('brand');    
        $query = $brandModel->findAll();
        $brandsArr = array();
        foreach($query as $value){
            $brandsArr[] = $value->brand_name;
        }
        $this->viewService('brands',['brands'=>$brandsArr]);
        
    }
    public function allCategories(){
        $catModel = $this->model('category');    
        $query = $catModel->findAll();
        $catArr = array();
        foreach($query as $value){
            $catArr[] = $value->category_name;
        }
        $this->viewService('categories',['categories'=>$catArr]);
    }
    
    public function updateItem(){
        
        $item = $this->model('item');
        $cat  = $this->model('category');
        $brand = $this->model('brand');

        if(isset($_POST['submitItem'])){

            $queryitem = $item->where(['item_id'=>$_SESSION['updateItemID']]);
            $item = $queryitem[0];
            
            $item->item_name = $_POST['iname'];
            $item->item_description = $_POST['idescription'];
            if($_FILES['image']['tmp_name'] != "")
                $item->item_picture = file_get_contents($_FILES['image']['tmp_name']);
            $item->item_price = $_POST['iprice'];
            $item->item_stock = $_POST['istock'];
            $item->bought_date = $_POST['ib_date'];
            $item->status_item = $_POST['status'];

            $brandName = $_POST['newbrand'];
            $cateName = $_POST['newCategory'];

            $brandAssoc = $brand->where(['brand_name'=>$brandName]);
            $brandID = $brandAssoc[0]->brand_id;
            $catAssoc  = $cat->where(['category_name'=>$cateName]);
            $catID = $catAssoc[0]->category_id;

            $item->brand_id = $brandID;
            $item->category_id = $catID;

            $sql = "UPDATE item SET item_name = :item_name, 
                                    item_description = :item_description,";

            if(!empty($item->item_picture))         
                $sql.= " item_picture = :item_picture,";
            
            $sql.= " item_price = :item_price, 
                     item_stock = :item_stock,
                     bought_date = :bought_date,
                     status_item = :status_item,
                     category_id = :category_id,
                     brand_id = :brand_id
                     WHERE item_id = :item_id ";
            
            $query = $item->prepare($sql);

            $newArray = $item->toArray();

            $query->execute($newArray);

            //self::success($item->item_name);
            header('Location: ./editTables');
        }

    }
    
    public function updateBrand(){
        
        $brand = $this->model('brand');
        
        if(isset($_POST['submitBrand'])){
            
            $query = $brand->where(['brand_id'=>$_POST['brandID']]);
            $brand = $query[0];
            
            $brand->brand_name = $_POST['newBrand'];
            

            $sql = "UPDATE brand SET brand_name = :brand_name WHERE brand_id = :brand_id";
            
            $query = $brand->prepare($sql);
            $query->execute($brand->toArray());

            //self::success($brand->brand_name);
            header('Location: ./editTables');
        }
    
        
    }
    
    public function updateCategory(){
        
        
        $category = $this->model('category');
        
        if(isset($_POST['submitCategory'])){
            
            $query = $category->where(['category_id'=>$_POST['category']]);
            $category = $query[0];
            
            $category->category_name = $_POST['newCategory'];
            $category->status = $_POST['newStatus'];
            
            $sql = "UPDATE category SET category_name = :category_name, status = :status WHERE category_id = :category_id";

            $query = $category->prepare($sql);
            $query->execute($category->toArray());

            //self::success($category->category_name);
            header('Location: ./editTables');

        }
    }

    public function getCategoryStatus($value){

        $category = $this->model('category');
        $query = $category->where(['category_id'=>$value]);
        $itemStatus = $query[0]->status;

        echo $itemStatus;
    }

    public function success($object){

        $success = "<script>$(\"#dialog\").attr(\"title\",\"Success\");
                   $(\"#dialog p\").html(\"".$object." succesfully edited!\");
                   $(\"#dialog\").css(\"display\",\"block\");
                    $( function() {
                        $( \"#dialog\" ).dialog({
                            buttons:{
                                \"OK\":function(){
                                    $(\"#spanSubject\").val(\"\");
                                    $(\"#sendMsg\").val(\"\");
                                    $(this).dialog(\"close\")
                                }
                            }
                        });
                    });</script>";

        self::editTables($success);
    }
}
?>