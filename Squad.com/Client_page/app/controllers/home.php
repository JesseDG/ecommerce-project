<?php

class Home extends Controller
{
	public function index()
	{

		/*$item = $this->model('item');
		$query = $item->where(['category_id'=>1]);
		$count = 1;
		$count2 = 1;

		$str = '<div class="col-sm-9 padding-right">
					<div class="features_items"><div class="page1" id="page' . $count2 . '">';
		$pagination = '<ul class="paginationDisplay" style="text-align:center;"><li class="pagination" value="' . $count2 . '"><a href="">' . $count2 . '</a></li>';

		foreach ($query as $item) {
			if($count%2 == 0)
			{
				$count2++;
				$str .= '</div><div class="page' . $count2 . '" id="page' . $count2 . '" style="display:none;">';
				$pagination .= '<li class="pagination" value="' . $count2 . '"><a href="">' . $count2 . '</a></li>';
				
			}
			$item_name = $item->item_name;
			$str .= '<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<a class="displayDetails" value="' . $item->item_id . '"><img src="data:image/jpg;base64,' . base64_encode($item->item_picture) .'" width="100" height="200"/></a>
							<h2>' . $item->item_price . '</h2>
							<p>' . $item_name . '</p>
							<button  href="" class="addToCart btn btn-default" value="'.$item->item_id.'">Add to cart</button>
							<button  href="" class="addToWishlist btn btn-default" value="'.$item->item_id.'">Add to wishlist</button>
						</div>
					
					</div>
					
				</div>
			</div>';
			echo $count;
			$count++;*/

			

		

		self::displayIndex(1);

		

		
	}

	public function displayBrand()
	{
		$str2 = '';
		$brand = $this->model('brand');
		$displaybrand = $brand->findAll();

		foreach($displaybrand as $itemBrand)
		{
			$item = $this->model('item');
			$query = $item->where(['brand_id'=>$itemBrand->brand_id]);
			$counter = count($query);

			$str2 .= '<li id="' . $itemBrand->brand_id . '"><a href="home/brand/' .  $itemBrand->brand_id . '/1"> <span class="pull-right">(' . $counter .')</span>' . $itemBrand->brand_name . '</a></li>';
			
		}

		return $str2;
	}
	public function displayPage($pageNumber, $query, $pagination)
	{
		$displayNum = 9;
		$skipNmb = ($pageNumber-1)*$displayNum;

		$item = $this->model('item');
		/*$query = $item->prepare("select * FROM item limit $skipNmb,$displayNum");
		echo "select * FROM item limit $skipNmb,$displayNum";*/
		//$query = $item->prepare("select * FROM item");
		$query->execute($item->toArray());
		$query->setFetchMode(PDO::FETCH_CLASS, "item");
        $returnVal = [];
        while($rec = $query->fetch()){
            $returnVal[] = $rec;
        }

		$str = '<div class="col-sm-9 padding-right">
					<div class="features_items">';
		
		
		foreach ($returnVal as $item) {
			//var_dump($item);
			$item_name = $item->item_name;
			$str .= '<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<a class="displayDetails" style="cursor:pointer" value="' . $item->item_id . '"><img src="data:image/jpg;base64,' . base64_encode($item->item_picture) .'" width="100" height="200"/></a>
							<h2>' . $item->item_price . '</h2>
							<p>' . $item_name . '</p>
							<button  href="" onclick="clickCart(this)" class="addToCart btn btn-default" value="'.$item->item_id.'">Add to cart</button>
							<button  href="" onclick="clickWishlist(this)"class="addToWishlist btn btn-default" value="'.$item->item_id.'">Add to wishlist</button>
						</div>
					
					</div>
					
				</div>
			</div>';

			

		}/*
		$query2 = $item->prepare("select count(*) FROM item");
		$query2->execute($item->toArray());
		$query2->setFetchMode(PDO::FETCH_NUM);
        $returnVal = [];
		$rec = $query2->fetch();
        $number = 0;
        if($rec){
	        $number = ceil($rec[0]/$displayNum);
        }
        var_dump($number);*/
		
/*
		$pagination = '<ul class="paginationDisplay" style="text-align:center;">';
		for($i = 1; $i <= $number; $i++)
		{
			$pagination .= '<li class="pagination" value="' . $i . '"><a href="home/displayIndex/' . $i . '">' . $i . '</a></li>';
		}

		$pagination .= '</ul>';
		*/

		$str .= '</div>' . $pagination .'</div>';
		$str2 = self::displaybrand();
		$str3 = self::displayCategory();


		

		$this->view('home/index', ['str' => $str, 'str2' => $str2, 'str3' => $str3]);


	}
	public function displayIndex($pageNumber)
	{
		$displayNum = 9;
		$skipNmb = ($pageNumber-1)*$displayNum;
		$item = $this->model('item');
		$query = $item->prepare("select * FROM item limit $skipNmb,$displayNum");
		$pagination = '<ul class="paginationDisplay" style="text-align:center;">';
		$query2 = $item->prepare("select count(*) FROM item");
		$query2->execute($item->toArray());
		$query2->setFetchMode(PDO::FETCH_NUM);
        $returnVal = [];
		$rec = $query2->fetch();
        $number = 0;
        if($rec){
	        $number = ceil($rec[0]/$displayNum);
        }
        
		for($i = 1; $i <= $number; $i++)
		{
			$pagination .= '<li class="pagination" value="' . $i . '"><a href="home/displayIndex/' . $i . '">' . $i . '</a></li>';
		}

		$pagination .= '</ul>';

		self::displayPage($pageNumber,$query, $pagination);

	}
	public function category($category_id, $pageNumber)
	{
		$displayNum = 9;
		$skipNmb = ($pageNumber-1)*$displayNum;
		$item = $this->model('item');

		$query = $item->prepare("select * FROM item where category_id = $category_id limit $skipNmb,$displayNum");

		$pagination = '<ul class="paginationDisplay" style="text-align:center;">';
		$query2 = $item->prepare("select count(*) FROM item where category_id = $category_id");
		$query2->execute($item->toArray());

        $query2->setFetchMode(PDO::FETCH_NUM);
        $returnVal = [];
		$rec = $query2->fetch();
        $number = 0;
        if($rec){
	        $number = ceil($rec[0]/$displayNum);
        }
        
		for($i = 1; $i <= $number; $i++)
		{
			$pagination .= '<li class="pagination" value="' . $i . '"><a href="home/category/' . $category_id . '/' .  $i . '">' . $i . '</a></li>';
		}

		$pagination .= '</ul>';

		self::displayPage($pageNumber,$query, $pagination);
	}
	public function brand($brand_id, $pageNumber)
	{
		$displayNum = 9;
		$skipNmb = ($pageNumber-1)*$displayNum;
		$item = $this->model('item');

		$query = $item->prepare("select * FROM item where brand_id = $brand_id limit $skipNmb,$displayNum");

		$pagination = '<ul class="paginationDisplay" style="text-align:center;">';
		$query2 = $item->prepare("select count(*) FROM item where brand_id = $brand_id");
		$query2->execute($item->toArray());

        $query2->setFetchMode(PDO::FETCH_NUM);
        $returnVal = [];
		$rec = $query2->fetch();
        $number = 0;
        if($rec){
	        $number = ceil($rec[0]/$displayNum);
        }
        
		for($i = 1; $i <= $number; $i++)
		{
			$pagination .= '<li class="pagination" value="' . $i . '"><a href="home/brand/' . $brand_id . '/' .  $i . '">' . $i . '</a></li>';
		}

		$pagination .= '</ul>';

		self::displayPage($pageNumber, $query, $pagination);
	}

	public function displayCategory()
	{

		$str3 = '';
		
		$category = $this->model('category');
		$displaycategory = $category->where(['status'=>'Available']);

		foreach($displaycategory as $itemCategory)
		{
			$item = $this->model('item');
			$query = $item->where(['category_id'=>$itemCategory->category_id]);
			$counter = count($query);
			$str3 .= '<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="home/category/' .  $itemCategory->category_id . '/1" id="' . $itemCategory->category_id . '">' . $itemCategory->category_name . '<span class="pull-right">(' . $counter .')</span></a></h4>
								</div>
							</div>';

		}
		return $str3;
	}
	
	public function test()
	{
		echo 'test';
	}

	
}