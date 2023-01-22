    
    <?php require __DIR__ .'/header.php'; ?>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <!-- <img src="https://source.unsplash.com/2400x700/?jewellery" class="d-block w-100" alt="..."> -->
                <img src="/Management/banner1.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <!-- <img src="https://source.unsplash.com/2400x700/?cosmetic" class="d-block w-100" alt="..."> -->
                <img src="/Management/banner2.jfif" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <!-- <img src="https://source.unsplash.com/2400x700/?Necklace" class="d-block w-100" alt="..."> -->
                <img src="/Management/banner3.jfif" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container my-3">
        <h2 class="text-center my-3">iShopping - Browse Categories</h2>

        <div class="row my-3">
            <!-- Fetch all categories -->
            <?php

            $sql = "SELECT  p.* FROM `product` as p join categories as cat on cat.id=p.categories_id WHERE cat.status=1 and  p.status=1";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $name = $row['name'];

                $price = $row['price'];
                $image = $row['image'];
                $desc = $row['description'];
                $qty = $row['qty'];

                echo '
<div    class="col-md-4 my-2">
<form action="/Management/insertCart.php" method="POST">
                <div class="card" style="width: 18rem;">
            <img src="/Management/media/product/' . $image . '" class="card-img-top" alt="...">
            <div class="card-body text-center">
            <h5 class="card-title"><a name="name">Item: ' . $name . '</a></h5>
           <input type="hidden" name="name" value="' . $name . '">
           <input type="hidden" name="id" value="' . $id . '">
            <p name="desc" class="card-text">Descriptiion: ' . $desc . '</p>

            <p name="price" class="card-text">Price: ' . $price . '</p>
           <input type="hidden" name="price" value="' . $price . '">
           <input type="hidden" name="limit" value="' . $qty . '">
<div style="display: flex;
    align-items: center;">
<label>Quantity:&nbsp</label>
<input class="form-control input-default my-3 text-center" name="qty" type="number" min="1" max="' . $qty . '" value="1" >
            </div>
            <button type="submit" name="add cart" class="btn btn-primary">Add To Cart</button>
</div>
            </div>

</form>
            </div>';
            }
            ?>
        </div>
    </div>
    <!-- <button type="submit" class="btn btn-danger">Buy Now</button> 
            <a href="threadlist.php?catid=' . $id . '" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">Add To Cart</a>

-->
