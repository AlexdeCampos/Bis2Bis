<div class="box feed-item" data-id="<?=$data->id;?>">
    <div class="box-body">
        <div class="feed-item-head row mt-20 m-width-20">
            <div class="feed-item-head-photo">
                <a href="<?=$base;?>/perfil/<?=$data->user->id;?>"><img src="<?=$base;?>/media/avatars/<?=$data->user->avatar;?>" /></a>
            </div>
            <div class="feed-item-head-info">
                <a href="<?=$base;?>/perfil/<?=$data->user->id;?>"><span class="fidi-name"><?=$data->user->name;?></span></a>
                <span class="fidi-action">fez um post</span>
                <br/>
                <span class="fidi-date"><?=date('d/m/Y', strtotime($data->created_at));?></span>
            </div>
            <?php if($data->mine): ?>
            <div class="feed-item-head-btn">
                <img src="<?=$base;?>/assets/images/more.png" />
                <div class="feed-item-more-window">
                    <a href="<?=$base?>/post/<?=$data->id?>/delete">Excluir Post</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="feed-item-body mt-10 m-width-20">
            <?php if($data->content !== ''): ?>
                <?=nl2br($data->content);?>
            <?php endif;?>
            
            <?php if($data->image !== ''): ?>
                <?='<img src="'.$base.'/media/uploads/'.$data->image.'" />';?>
            <?php endif;?>
        </div>
        <div class="feed-item-buttons row mt-20 m-width-20">
            <div class="like-btn <?=($data->liked ? 'on':'');?>"><?=$data->likes_count;?></div>
        </div>
        
    </div>
</div>