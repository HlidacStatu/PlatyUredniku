

<div class="block whitetop">
    <div class="block-in">


        <div class="col-3">
            <a href="/">
            <h1>PlatyÚředníků.cz</h1>
            </a>
        </div>
        <div class="col-6 colwithmenu">


            <a class="item a <?php if($pageformenu == ""){ echo "aktivni"; } ?>" href="/"><i class="fa fa-home"></i></a>
            <a class="item a <?php if($pageformenu == "instituce"){ echo "aktivni"; } ?>" href="/instituce">Instituce</a>
            <a class="item a <?php if($pageformenu == "aktuality"){ echo "aktivni"; } ?>" href="/aktuality">Aktuality</a>
            <a class="item a <?php if($pageformenu == "o-projektu"){ echo "aktivni"; } ?>" href="/o-projektu">Informace o projektu</a>
            <a class="item a <?php if($pageformenu == "kontakty"){ echo "aktivni"; } ?>" href="/kontakty">Kontakty</a>

        </div>
        <div class="col-3">

            <form class="hledanitop" action="/hledani" method="get">
                <input name="q" value="" placeholder="hledejte...">
                <button type="submit" class="btn"><i class="fa fa-search"></i></button>

            </form>
            </div>

<a href="/hledani" class="btn searchbtn"><i class="fa fa-search"></i></a>
<a href="#respmenu" class="btn respmenu" onclick="$('.respmenuin').toggleClass('visible');"><i class="fa fa-bars"></i></a>

        <div class="respmenuin">


            <a class="item a <?php if($pageformenu == ""){ echo "aktivni"; } ?>" href="/"><i class="fa fa-home"></i></a>
            <a class="item a <?php if($pageformenu == "instituce"){ echo "aktivni"; } ?>" href="/instituce">Instituce</a>
            <a class="item a <?php if($pageformenu == "aktuality"){ echo "aktivni"; } ?>" href="/aktuality">Aktuality</a>
            <a class="item a <?php if($pageformenu == "o-projektu"){ echo "aktivni"; } ?>" href="/o-projektu">Informace o projektu</a>
            <a class="item a <?php if($pageformenu == "kontakty"){ echo "aktivni"; } ?>" href="/kontakty">Kontakty</a>

        </div>

        <div class="clear"></div>

    </div>
</div>