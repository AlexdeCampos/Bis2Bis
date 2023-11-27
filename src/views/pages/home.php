<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'home', 'loggedUser'=>$loggedUser]);?>

    <section class="feed mt-10">
        
        <div class="row">
            <div class="column pr-5">
                <?php if($loggedUser->type === 'admin'):?>
                    <?=$render('feed-editor', ['user'=>$loggedUser]);?>
                <?php endif;?>
                <?php foreach($feed['posts'] as $feedItem): ?>
                    <?=$render('feed-item', [
                        'data' => $feedItem,
                        'loggedUser' => $loggedUser
                    ]);?>
                <?php endforeach; ?>
                    
                <div class="feed-pagination">
                    <?php for($q=0;$q<$feed['pageCount'];$q++): ?>
                        <a class="<?=($q==$feed['currentPage']?'active':'')?>" href="<?=$base;?>/?page=<?=$q;?>"><?=$q+1;?></a>
                    <?php endfor; ?>
                </div>

            </div>
        </div>

    </section>
</section>
<?=$render('footer');?>