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

<div class="container mx-auto" style="margin-top: 150px;margin-bottom: 80px;margin-left: auto; margin-right: auto!important;">
    <div class="" >
        <?php if(isset($errors)) {
            foreach ($errors as $error) {?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $error ?>
                </div>
            <?php } }?>
        <div id="msg"></div>
        <form method="POST" id="image-form" action="<?php echo URL_ROOT.'/album/add'?>" enctype="multipart/form-data">
            <input name="image[]" type="file" multiple="multiple" class="file">
            <div class="input-group my-3">
                <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                <div class="input-group-append">
                    <button type="button" class="browse btn btn-primary">Browse...</button>
                </div>
            </div>
            <div class="col-6" style="margin-top: 50px!important;">
                <input type="submit" class="profile-edit-btn" name="submit" value="Add Image"/>
            </div>
        </form>
    </div>

</div>




