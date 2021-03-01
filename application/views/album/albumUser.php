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


<div id="gallery" class="Gallery" style="margin-top: 150px;margin-bottom: 50px!important;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2><?php echo 'Album '.$user['first_name'].' '.$user['last_name'].'\'s ' ; if (count($album) == 0) :?> is empty <?php endif;?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid margin-r-l">
        <div class="row">
            <?php if (count($album) > 0) {
                foreach ($album as $img) { ?>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 thumb">
                        <div class="Gallery-box">
                            <figure>
                                <a href="<?php if (isset($img->img) && file_exists(IMAGES . 'album/' . $img->user_id . '/' . $img->img)) {
                                    echo '/images/album/' . $img->user_id . '/' . $img->img;
                                } ?>" class="fancybox" rel="ligthbox">
                                    <img src="<?php if (isset($img->img) && file_exists(IMAGES . 'album/' . $img->user_id . '/' . $img->img)) {
                                        echo '/images/album/' . $img->user_id . '/' . $img->img;
                                    } ?>" class="zoom img-fluid " alt="" style="height: 500px!important;">
                                </a>
                                <span class="hoverle">
                     <a href="<?php if (isset($img->img) && file_exists(IMAGES . 'album/' . $img->user_id . '/' . $img->img)) {
                         echo '/images/album/' . $img->user_id . '/' . $img->img;
                     } ?>" class="fancybox" rel="ligthbox">View</a>
                     </span>
                            </figure>
                        </div>
                    </div>
                <?php }
            } ?>

        </div>
    </div>
</div>