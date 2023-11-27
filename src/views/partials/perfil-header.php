<div class="row">
    <div class="box flex-1 border-top-flat">
        <div class="box-body">
            <div class="profile-info m-20 row">
                <div class="profile-info-avatar">
                    <a href="<?=$base;?>/perfil/<?=$user->id;?>">    
                        <img src="<?=$base;?>/media/avatars/<?=$user->avatar;?>" />
                    </a>
                </div>
                <div class="profile-info-name">
                    <div class="profile-info-name-text">
                        <a href="<?=$base;?>/perfil/<?=$user->id;?>">
                            <?=$user->name;?>
                        </a>
                    </div>
                </div>
                <div class="profile-info-data row">
                    <div class="profile-info-item m-width-20">
                        <a href="<?=$base;?>/perfil/<?=$user->id;?>/fotos">
                            <div class="profile-info-item-n"><?=$feedCount;?></div>
                            <div class="profile-info-item-s">Posts</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>