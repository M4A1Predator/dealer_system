var url = document.URL;
var q = location.search.substring(1);

$('[id^="menuCat"]').click(function (){
    catId = $(this).attr('id').substring('menuCat'.length);
    
    if (url.indexOf('?') != -1) {
        url = url.substring(0, url.indexOf('?'));
    }
    url += '?';
    //newUrl = url+"&cats="+catId+'--';
    newUrl = window.location.origin+"/shop/product?cats="+catId+'--&m=category';
    window.location.replace(newUrl);
    //console.log(newUrl);
});

$('[id^="menuBrand"]').click(function (){
    brandName = $(this).attr('id').substring('menuBrand'.length);
    
    if (url.indexOf('?') != -1) {
        url = url.substring(0, url.indexOf('?'));
    }
    url += '?';
    newUrl = window.location.origin+"/shop/product?brands="+brandName+'--&m=brand';
    window.location.replace(newUrl);
    
    console.log(catId);
});