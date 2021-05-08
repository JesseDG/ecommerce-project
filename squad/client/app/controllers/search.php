<?php

/**
 * Created by PhpStorm.
 * User: Cyclon
 * Date: 2016-11-24
 * Time: 1:05 AM
 */
class search extends Controller
{

    public function searchFilter()
    {
        $category = $this->model('category');
        $queryAll = $category->where(['status'=>"Available"]);
        echo json_encode($queryAll);
    }

    public function SearchProduct(){

        try{
            $product = $_POST['productSent'];
            $productModel = $this->model('item');


            $sql = "SELECT * FROM item WHERE status_item = 'Available' and item_name LIKE '%$product%'";
            $stmt = $productModel->prepare($sql);
            $stmt->execute($productModel->toArray());
            //$product = $stmt[0];
            //var_dump($product);
            $stmt->setFetchMode(PDO::FETCH_CLASS, "item");
            $returnVal = [];
            while($rec = $stmt->fetch()){
                $returnVal[] = $rec;
            }

            if(sizeof($returnVal) == 0){
                echo 'No product found';
            }
            else{
                echo self::displaySearch($returnVal);
            }


        }
        catch(PDOException $e){

            echo "No product found";
        }
            
    }

    public function displaySearch($query){

        $str = '';
        foreach ($query as $item) {
            $item_name = $item->item_name;
            $str .= '<div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="data:image/jpg;base64,' . base64_encode($item->item_picture) .'" width="100" height="200"/>
                                    <h2>' . $item->item_price . '</h2>
                                    <p>' . $item_name . '</p>
                                    <button  href="" class="addToCart btn btn-default" value="'.$item->item_id.'">Add to cart</button>
                                    <button  href="" class="addToWishlist btn btn-default" value="'.$item->item_id.'">Add to wishlist</button>
                                </div>
                            </div>  
                        </div>
                    </div>';
            

        }

        return $str;
    }

}