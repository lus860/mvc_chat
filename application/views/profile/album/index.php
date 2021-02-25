 <?php if(count($album) == 0 ){?>
<style>
    #footer {
        position: fixed; /* Фиксированное положение */
        left: 0; bottom: 0; /* Левый нижний угол */
        padding: 10px; /* Поля вокруг текста */
        background: #39b54a; /* Цвет фона */
        color: #fff; /* Цвет текста */
        width: 100%; /* Ширина слоя */
    }
</style>
 <?php }?>
<div class="container" style="margin-top: 150px;margin-bottom: 50px!important;">
    <a class="btn btn-lg btn-primary" href="/album/create<?php if(isset($_SESSION['user_id']))echo'?id='.$_SESSION['user_id']?>" role="button" style="margin-bottom: 30px!important;">Add image</a>
    <hr>
    <?php if(isset($errors)) {
        foreach ($errors as $error) {?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $error ?>
            </div>
        <?php } }?>
    <div class="row">
        <?php if(count($album) > 0 ){
            foreach ($album as $img) {?>
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                    <div class="plants-box">
                        <figure><img src="<?php if(isset($img->img) && file_exists(IMAGES.'album/'.$_SESSION['user_id'].'/'.$img->img)){ echo '/images/album/'.$_SESSION['user_id'].'/'.$img->img;} ?>" alt="img" style="height: 200px;width: 140px"></figure>
                        <a class="btn btn-lg btn-primary" href="image/delete<?php echo'?id='.$img->id?>" role="button" style="max-width: 200px">Delete</a>
                    </div>
                </div>
            <?php } } else {?>

            <h1 style="margin-left: 20px">Your album is empty</h1>
        <?php } ?>
    </div>
</div>