
itemBrandOrig = '';
itemCatOrig = '';
var app = angular.module('loadItemInfo',[]);
app.controller('itemCtrl', function($scope, $http){

    $scope.myfunction = function(){

        $idSelected = $('#selectItem').find(":selected").val();
        $url = 'edit/getItem/' + $idSelected;
        $http.get($url)
            .success(function(response){
                $('#selectBrand').html('');
                $('#selectCategory').html('');

                $scope.item = response;

                $scope.itemName = $scope.item.item_name;
                $scope.itemDesc = $scope.item.item_description;
                $scope.image = $scope.item.item_picture;
                $scope.itemPrice = $scope.item.item_price;
                $scope.itemStock = $scope.item.item_stock;
                $scope.itemDate = $scope.item.bought_date;
                itemBrandOrig = $scope.item.brand_name;
                itemCatOrig = $scope.item.category_name;
                statusItem = $scope.item.item_status;

                $('#statusOptions option').each(function(){

                    if($(this).text() === statusItem)
                        $(this).prop('selected',true);
                    return;

                });

                callAjaxOne();
                callAjaxTwo();

            });
        }

});

function callAjaxOne(){
    
 brands = '';
    $.ajax({
      url:'edit/allBrands',
      type:'GET',
      async:false,
      success: function(result){
        jsonbrands = result;    
        brands = JSON.parse(jsonbrands);
        masterBrands = brands;
        var select = document.getElementById('selectBrand');
            for(var i=0; i < masterBrands.length; ++i)  
            {
                 var opt = document.createElement('option');
                 if(itemBrandOrig === masterBrands[i]){
                     opt.selected = true;
                 }
                 opt.value = masterBrands[i];
                 opt.innerHTML = masterBrands[i];
                 select.appendChild(opt);
            }
       }
    });
}

function callAjaxTwo(){
    
     categories = '';
    $.ajax({
      url:'edit/allCategories',
      type:'GET',
      async:false,
      success: function(result){
        jsonCat = result;    
        categories = JSON.parse(jsonCat);
        masterCats = categories;
        var select = document.getElementById('selectCategory');
            for(var i=0; i < masterCats.length; ++i)  
            {
                 var opt = document.createElement('option');
                 if(itemCatOrig === masterCats[i]){
                     opt.selected = true;
                 }
                 opt.value = masterCats[i];
                 opt.innerHTML = masterCats[i];
                 select.appendChild(opt);
            }
       }
    });

}


$(document).ready(function(){

    $("#statusCategory").change(function() {
        var value = $(this).find(":selected").val();
        var textSelected = $("option:selected",this).text();
        url = 'edit/getCategoryStatus/'+value;
        $('#newCategory').val(textSelected);
        $.get( url, function(data){
            $('#statusCategoryOptions option').each(function(){
                if($(this).text().trim() == data.toString().trim()) {
                    $(this).prop('selected', true);
                    return;
                }
            });
        });
    })
});



messageID = '';
subjectName = '';
userName = '';
function expand(e){

    messageID = $(e).attr("id");
    subjectID = "#subject"+messageID;
    userID = "#user"+messageID;

    var panelID = "#expand"+messageID;

    $content = $(panelID);

    $content.slideToggle(500,function(){
        if($content.is(":visible")){

            subjectName = $(subjectID).text();
            console.log(subjectName);
            userName = $(userID).text();
            return "Collapse";
        }
        else{
            return "Expand";
        }
    });




    $("#click" + messageID).click(function () {

        textareaObject =  $("#replyMessage"+messageID);
        if(checkText(textareaObject)) {

            repliedMessage = textareaObject.val();

                $.post(
                    "inbox/sendMessage",
                    {
                        subject: subjectName,
                        user: userName,
                        message: messageID,
                        content: repliedMessage
                    },
                    function(data) {

                        $parent = $("#"+messageID).parent();
                        $parent.hide('slow',function () {
                            $this.remove();
                        })
                    }
                );

        }
        else{
            $(textareaObject).attr("placeholder",'Please type some text before sending');
        }
    });
}


function checkText(e){
    return $(e).val().trim().length != 0;
}


