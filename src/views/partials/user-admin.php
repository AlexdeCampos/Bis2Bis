<div class="box feed-item mt-5" data-id="<?=$user->id;?>">
    <div class="box-body">
        <div class="feed-item-head row mt-10 m-width-20">
            <div class="feed-item-head-photo">
                <img src="<?=$base;?>/media/avatars/<?=$user->avatar;?>" />
            </div>
            <div class="feed-item-head-info">
                <a href="<?=$base;?>/perfil/<?=$user->id;?>"><span class="fidi-name"><?=$user->name;?></span></a>
                <br/>
                <span class="fidi-date"><?=$user->email;?></span>
            </div>
        </div>
    </div>
</div>