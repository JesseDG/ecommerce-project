<?php
$out = array();

foreach($data['dataItem'] as $item){
    
    $itemID = $item->item_id;
    $itemName = $item->item_name;
    $itemDescription = $item->item_description;
    $itemPicture = $item->item_picture;
    $itemPrice = $item->item_price;
    $itemStock = $item->item_stock;
    $itemCat = $item->category_id;
    $itemBrand = $item->brand_id;
    $itemDate = $item->bought_date;
    $itemStatus = $item->status_item;

    $out = array(
        'item_id' => $itemID,
        'item_name' => $itemName,
        'item_description' => $itemDescription,
        'item_picture' => base64_encode($itemPicture),
        'item_price' => $itemPrice,
        'item_stock' => $itemStock,
        'category_name' => $data['itemCategory'],
        'brand_name' => $data['itemBrand'],
        'bought_date' => $itemDate,
        'item_status' => $itemStatus
    );

}

echo json_encode($out) ;



?>
