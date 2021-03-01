<!-- end header -->
<section >
    <div id="main_slider" class="carousel slide banner-main" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row marginii">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="carousel-caption ">
                                <?php if(isset($_SESSION['user_id'])){?>
                                <h1><?php if(isset($_SESSION['first_name'])) echo $_SESSION['first_name'].' ' ; if(isset($_SESSION['last_name'])) echo $_SESSION['last_name'] ?></h1>
                                <h3>Email: <strong class="color"><?php if(isset($_SESSION['email'])) echo $_SESSION['email']?></strong></h3>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                                <a class="btn btn-lg btn-primary" href="/profile<?php if(isset($_SESSION['user_id']))echo'?id='.$_SESSION['user_id']?>" role="button">Edit Profile</a>
                                <?php } else { ?>
                                    <h1>Please register to create a profile</h1>
                                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using</p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <div class="img-box">
                                <figure><img src="<?php if(!empty($_SESSION['prof_img']) && file_exists('images/profile/'.$_SESSION['prof_img'])){ echo 'images/profile/'.$_SESSION['prof_img'];} else{ echo 'images\profile\\'."default.jpg"; }?>" alt="img" style="width: 100%;height: 100%"></figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- plant -->
<div id="plant" class="plants">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="titlepage">
                    <h2>All profile</h2>
                    <span>looking at its layout. The point of using Lorem Ipsumletters, as opposed to usingl</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php if (count($users) >0 ) {
                foreach ($users as $user) {
                    if(isset($_SESSION['user_id']) && $user->id == $_SESSION['user_id']){
                        continue;
                    }?>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="plants-box">
                            <figure><img src="<?php if(isset($user->prof_img) && file_exists('images/profile/'.$user->prof_img)){ echo 'images/profile/'.$user->prof_img;} else{ echo "images/profile/default.jpg"; }?>" alt="img" style="height: 250px"></figure>
                            <h3><?php echo $user->first_name ?><br><?php echo $user->last_name ?></h3>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a page   when looking at its layout.</p>
                            <a class="btn btn-lg btn-primary" href="message<?php echo'?id='.$user->id?>" role="button" style="padding: 5px;margin-right: 6px;margin-bottom: 5px!important;">message</a>
                            <a class="btn btn-lg btn-primary" href="albumUser<?php echo'?id='.$user->id?>" role="button" style="padding: 5px;margin-right: 0px;margin-bottom: 5px!important;">view album</a>
                        </div>
                    </div>
                <?php } } ?>
        </div>
    </div>
</div>
<!-- end plant -->
<!-- about -->
<div id="about" class="about">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="Nursery-img">
                        <figure>
                            <img src="/images/contactimg.jpg" alt="img"/>
                            <div class="text-box">
                                <h3>Best Green Nursery</h3>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <div class="about-box">
                    <div class="titlepage">
                        <h2>About US</h2>
                        <span>
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using
                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like
                            readable English. Many desktop publishing packages and It is a long established fact that a reader will be distracted by the readable content of
                            a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English. Many desktop publishing packages and web pageweb page
                        </span>
                        <span id="read-more-span" style="display: none;">
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using
                            Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like
                            readable English. Many desktop publishing packages and It is a long established fact that a reader will be distracted by the readable content of
                            a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using
                            'Content here, content here', making it look like readable English. Many desktop publishing packages and web pageweb page
                        </span>
                        <div class="read-more" id="read-more" style="margin-top: 25px">
                            <button type="button" class="btn btn-light">Read More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end about -->
<!--Gallery -->
<div id="gallery" class="Gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2><?php if(isset($_SESSION['user_id'])) { ?> Our Album <?php } else {?> Please register to create an album <?php } ?></h2>
                </div>
            </div>
        </div>
    </div>
    <?php if(isset($_SESSION['user_id'])) { ?>
    <div class="container-fluid margin-r-l">
        <div style="margin-bottom: 20px">
            <a class="btn btn-lg btn-primary" href="/album/create<?php if(isset($_SESSION['user_id']))echo'?id='.$_SESSION['user_id']?>" role="button">Add image</a>
            <a class="btn btn-lg btn-primary" href="/album<?php if(isset($_SESSION['user_id']))echo'?id='.$_SESSION['user_id']?>" role="button">View Album</a>
        </div>
        <div class="row" >
            <?php if(count($album) > 0 ){
            foreach ($album as $img) {?>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 thumb">
                <div class="Gallery-box">
                    <figure>
                        <a href="<?php if(isset($img->img) && file_exists(IMAGES.'album/'.$_SESSION['user_id'].'/'.$img->img)){ echo '/images/album/'.$_SESSION['user_id'].'/'.$img->img;} ?>" class="fancybox" rel="ligthbox">
                            <img  src="<?php if(isset($img->img) && file_exists(IMAGES.'album/'.$_SESSION['user_id'].'/'.$img->img)){ echo '/images/album/'.$_SESSION['user_id'].'/'.$img->img;} ?>" class="zoom img-fluid "  alt="" style="height: 500px!important;">
                        </a>
                        <span class="hoverle">
                     <a href="<?php if(isset($img->img) && file_exists(IMAGES.'album/'.$_SESSION['user_id'].'/'.$img->img)){ echo '/images/album/'.$_SESSION['user_id'].'/'.$img->img;} ?>" class="fancybox" rel="ligthbox">View</a>
                     </span>
                    </figure>
                </div>
            </div>
            <?php } } else {?>
                <h1 style="margin-left: 20px">Your album is empty</h1>
            <?php } ?>

        </div>
    </div>
    <?php } ?>
    <!-- end Gallery -->
    <!--contact -->
    <div id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 paddimg-right">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <form method="POST" action="<?php echo URL_ROOT.'/mail/send'?>">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control <?php  if(isset($_SESSION['errors_mail']['mess']['name_error'])) :?> is-invalid <?php endif ?>" placeholder="Name" type="text" name="name" value="<?php if (isset($_SESSION['errors_mail']['mess']['name'])) echo $_SESSION['errors_mail']['mess']['name']  ?>">
                                        <?php  if (isset($_SESSION['errors_mail']['mess']['name_error'])) :?>
                                            <span class="text-danger" role="alert">
                                        <strong><?php echo $_SESSION['errors_mail']['mess']['name_error'] ?></strong>
                                    </span>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control<?php  if (isset($_SESSION['errors_mail']['mess']['email_error'])) :?> is-invalid <?php endif ?>" placeholder="Email" type="text" name="email" value="<?php if (isset($_SESSION['errors_mail']['mess']['email']) ) echo $_SESSION['errors_mail']['mess']['email'] ?>">
                                        <?php  if (isset($_SESSION['errors_mail']['mess']['email_error'])) :?>
                                            <span class="text-danger" role="alert">
                                        <strong><?php echo $_SESSION['errors_mail']['mess']['email_error'] ?></strong>
                                    </span>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input class="form-control<?php  if (isset($_SESSION['errors_mail']['mess']['subject_error'])) :?> is-invalid <?php endif ?>" placeholder="Subject" type="text" name="subject" value="<?php if (isset($_SESSION['errors_mail']['mess']['subject'])) echo $_SESSION['errors_mail']['mess']['subject']  ?>">
                                        <?php  if (isset($_SESSION['errors_mail']['mess']['subject_error'])) :?>
                                            <span class="text-danger" role="alert">
                                        <strong><?php echo $_SESSION['errors_mail']['mess']['subject_error'] ?></strong>
                                    </span>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <textarea class="textarea <?php  if ($_SESSION['errors_mail']['mess']['message_error']) :?> is-invalid <?php endif ?>" placeholder="Message" type="text" name="message" ><?php if (isset($_SESSION['errors_mail']['mess']['message'])) echo $_SESSION['errors_mail']['mess']['message']  ?></textarea>
                                        <?php  if (isset($_SESSION['errors_mail']['mess']['message_error'])) :?>
                                            <span class="text-danger" role="alert">
                                        <strong><?php echo $_SESSION['errors_mail']['mess']['message_error'] ?></strong>
                                    </span>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <input type="submit" class="profile-edit-btn" name="submit" value="Send Mail" style="width: 100%">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="map_section">
                                <figure><img src="/images/map.jpg"></figure>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 paddimg-left">
                    <div class="Nursery-img">
                        <figure>
                            <img src="/images/contactimg.jpg" alt="img"/>
                            <div class="text-box">
                                <h3>Best Green Nursery</h3>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
