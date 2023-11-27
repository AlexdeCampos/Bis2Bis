<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'admin', 'loggedUser'=>$loggedUser]);?>
    <section class="feed mt-10">
        <h1>Administradores</h1>
        <form method="POST" action="<?=$base;?>/cadastro/admin" class="admin-user-form">
            <?php if(!empty($flash)): ?>
                <div class="flash"><?php echo $flash; ?></div>
            <?php endif; ?>

            <input placeholder="Digite o Nome Completo" class="input" type="text" name="name" />

            <input placeholder="Digite o E-mail" class="input" type="email" name="email" />

            <input placeholder="Digite a Senha" class="input" type="password" name="password" />

            <input class="button" type="submit" value="Fazer cadastro" />
        </form>

        <div class="row mt-20">
            <div class="column pr-5">
            <?php foreach($userList["users"] as $user): ?>
                    <?=$render('user-admin', 
                    ["user" => $user])?>
                <?php endforeach; ?>

                <div class="feed-pagination">
                    <?php for($q=0;$q<$userList['pageCount'];$q++): ?>
                        <a class="<?=($q==$userList['currentPage']?'active':'')?>" href="<?=$base;?>/perfil/<?=$user->id;?>?page=<?=$q;?>"><?=$q+1;?></a>
                    <?php endfor; ?>
                </div>
            </div>  
        </div>
    </section>
</section>
<?=$render('footer');?>