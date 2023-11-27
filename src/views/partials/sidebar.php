<aside class="mt-10">
    <nav>
        <a href="<?=$base;?>">
            <div class="menu-item <?=($activeMenu=='home')?'active':'';?>">
                <div class="menu-item-icon">
                    <img src="<?=$base;?>/assets/images/home-run.png" width="16" height="16" />
                </div>
                <div class="menu-item-text">
                    Home
                </div>
            </div>
        </a>

        <?php if($loggedUser->type === "admin"):?>
        <a href="<?=$base;?>/perfil">
            <div class="menu-item <?=($activeMenu=='profile')?'active':'';?>">
                <div class="menu-item-icon">
                    <img src="<?=$base;?>/assets/images/user.png" width="16" height="16" />
                </div>
                <div class="menu-item-text">
                    Meu Perfil
                </div>
            </div>
        </a>

        <a href="<?=$base;?>/cadastro/admin">
            <div class="menu-item <?=($activeMenu=='admin')?'active':'';?>">
                <div class="menu-item-icon">
                    <img src="<?=$base;?>/assets/images/user.png" width="16" height="16" />
                </div>
                <div class="menu-item-text">
                    Administradores
                </div>
            </div>
        </a>

        <a href="<?=$base;?>/base">
            <div class="menu-item <?=($activeMenu=='database')?'active':'';?>">
                <div class="menu-item-icon">
                    <img src="<?=$base;?>/assets/images/db.png" width="16" height="16" />
                </div>
                <div class="menu-item-text">
                    Base de Dados
                </div>
            </div>
        </a>
        <?php endif;?>

        <div class="menu-splitter"></div>
        <a href="<?=$base;?>/config">
            <div class="menu-item <?=($activeMenu=='config')?'active':'';?>">
                <div class="menu-item-icon">
                    <img src="<?=$base;?>/assets/images/settings.png" width="16" height="16" />
                </div>
                <div class="menu-item-text">
                    Configurações
                </div>
            </div>
        </a>
        <a href="<?=$base;?>/sair">
            <div class="menu-item">
                <div class="menu-item-icon">
                    <img src="<?=$base;?>/assets/images/power.png" width="16" height="16" />
                </div>
                <div class="menu-item-text">
                    Sair
                </div>
            </div>
        </a>
    </nav>
</aside>