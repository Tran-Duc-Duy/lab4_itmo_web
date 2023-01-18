<?php
// đọc file xml
$dom = new DOMDocument();
$dom->load('files/data.xml');
// lấy thẻ products
$products = $dom->getElementsByTagName('products')->item(0);
$product=$products->getElementsByTagName('product');
// lấy id cuối cùng
$index = $product->length;
// tăng id lên 1
$id=$product[$index-1]->getElementsByTagName('id')->item(0)->nodeValue+1;

// xử lý form, sau khi nhấn button submit
if(isset($_POST['sbm'])){
    // lấy dữ liệu từ form
    $prd_name = $_POST['prd_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    // tạo thẻ product
    $new_prd = $dom->createElement('product');
    // tạo thẻ con của product
    $node_id = $dom->createElement('id',$id);
    // thêm thẻ con vào thẻ product
    $new_prd->appendChild($node_id);
    // tạo thẻ con của product
    $node_name = $dom->createElement('name',$prd_name);
    // thêm thẻ con vào thẻ product
    $new_prd->appendChild($node_name);

    $node_price = $dom->createElement('price',$price);
    $new_prd->appendChild($node_price);

    $node_description = $dom->createElement('description',$description);
    $new_prd->appendChild($node_description);
    // thêm thẻ product vào thẻ products
    $products->appendChild($new_prd);

    $dom->formatOutput=true;
    // lưu file xml
    $dom->save('files/data.xml')or die('Error');
    // chuyển hướng về trang list
    header('location: index.php?page_layout=list');
}
?>

<div class="container-fuild">
    <div class="card">
        <div class="card-header">
            <h2>Add products</h2>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Product's Name</label>
                    <input type="text" name="prd_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Product's Price</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Product's description</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
                <button name="sbm" class="btn btn-success" type="submit">Add</button>
            </form>
        </div>
    </div>
</div>