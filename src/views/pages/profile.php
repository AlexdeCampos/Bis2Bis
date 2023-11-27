<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'profile', 'loggedUser'=>$loggedUser]);?>

    <section class="feed">

        <?=$render('perfil-header', ['user'=>$user, 'loggedUser'=>$loggedUser, 'feedCount' => count($feed['posts'])]);?>
        
        <div class="row">
            <div class="column pl-5">
                <?php if($user->id == $loggedUser->id): ?>
                <?=$render('feed-editor', ['user'=>$loggedUser]);?>
                <?php endif; ?>

                <?php foreach($feed['posts'] as $feedItem): ?>
                    <?=$render('feed-item', [
                        'data' => $feedItem,
                        'loggedUser' => $loggedUser
                    ]);?>
                <?php endforeach; ?>
                    
                <div class="feed-pagination">
                    <?php for($q=0;$q<$feed['pageCount'];$q++): ?>
                        <a class="<?=($q==$feed['currentPage']?'active':'')?>" href="<?=$base;?>/perfil/<?=$user->id;?>?page=<?=$q;?>"><?=$q+1;?></a>
                    <?php endfor; ?>
                </div>


            </div>
            
        </div>

    </section>

</section>
<?=$render('footer');?>