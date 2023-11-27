<?=$render('header', ['loggedUser'=>$loggedUser]);?>

<section class="container main">
    <?=$render('sidebar', ['activeMenu'=>'database', 'loggedUser'=>$loggedUser]);?>
    <section class="feed mt-10">
        <h1>Dump de base</h1>
            <input class="button generate-bkp mt-10" type="button" value="Gerar novo dump da base de dados" />
    </section>
</section>
<?=$render('footer');?>

<script type="text/javascript">
document.querySelector('.generate-bkp').addEventListener('click', async function(obj){
    let req = await fetch('/ajax/generateBkp', {
        method: 'POST',
        });

    let json = await req.json();


    //Código para fazer o download do arquivo
    var link = document.createElement("a");
    link.setAttribute('download', name);
    link.href = json.file;
    document.body.appendChild(link);
    link.click();
    link.remove();
});
</script>