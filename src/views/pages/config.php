<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'config', 'loggedUser'=>$loggedUser]);?>

    <section class="feed mt-10">

        <h1>Configurações</h1>

        <?php if(!empty($flash)): ?>
            <div class="flash"><?php echo $flash; ?></div>
        <?php endif; ?>

        <form class="config-form" method="POST" enctype="multipart/form-data" action="<?=$base;?>/config">

            <label>
                Novo Avatar:<br/>
                <input type="file" name="avatar" /><br/>
                <img class="image-edit" src="<?=$base;?>/media/avatars/<?=$user->avatar; ?>" />
            </label>
            <hr/>

            <label>
                Nome Completo:<br/>
                <input type="text" name="name" value="<?=$user->name;?>" />
            </label>
         
            <label>
                E-mail:<br/>
                <input type="email" name="email" value="<?=$user->email;?>" />
            </label>

            <hr/>

            <label>
                Nova Senha:<br/>
                <input type="password" name="password" />
            </label>

            <label>
                Confirmar Nova Senha:<br/>
                <input type="password" name="password_confirm" />
            </label>

            <button class="button">Salvar</button>

        </form>

    </section>

</section>
<?=$render('footer');?>