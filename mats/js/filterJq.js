var cats = $('[name^="cat"]');
var brands = $('[name^="brand"]');
var filtBtn = $('#filtBtn');
var q = location.search.substring(1);

filtBtn.click(function (){
    filterProduct();
});

var catId = '';
var bId = '';

function filterProduct() {
    catId = '';
    bId = '';
    for(var i=0;i<cats.length;i++){
        //console.log( cats[i]['name']+" : "+cats[i]['checked']);
        if (cats[i]['checked']) {
            catId += cats[i]['name'].substring(3)+'--';
        }
    }
    
    for(var i=0;i<brands.length;i++){
        //console.log( cats[i]['name']+" : "+cats[i]['checked']);
        if (brands[i]['checked']) {
            bId += brands[i]['name'].substring(5)+'--';
        }
    }
    console.log(catId+" : "+bId);
    
    /*if (document.URL.indexOf('?') != -1) {
        newUrl = document.URL.substring(0, document.URL.indexOf('?')+1);
        
    }else{
        newUrl = document.URL+'?';
    }*/
    newUrl = window.location.protocol+"//"+hostname+"/shop/product?";
    newUrl += "&cats="+catId+"&brands="+bId;
    console.log(newUrl);
    
    window.location.replace(newUrl);
}

function searchProduct() {
    
}
