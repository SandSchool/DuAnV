function deleteCategory(category) {
    var check = confirm("Bạn chắc chắn muốn xóa không?");
    if(check){
        window.location.href = `category/delete/${category}`;
    }
}

function deleteProduct(product) {
    var check = confirm("Bạn chắc chắn muốn xóa không?");
    if(check){
        window.location.href = `product/delete/${product}`;
    }
}
