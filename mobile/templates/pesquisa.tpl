<!-- BEGIN main -->

<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="javascript:void(0);" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Pequisa</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   Pequise sobre artigos e trechos da b&iacute;blia em geral.
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

        <div class="search-page">
            
            <div class="content-boxed content-boxed-full shadow-large bottom-15">
                    <form action="pesquisa" method="post" name="pesquisa">
                <div class="search search-header">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="O que voc&ecirc; procura?" name="q" value="{q}" required="required" >
                    <a href="#" onClick="document.pesquisa.submit();" class="disabled"><i class="fa fa-times-circle color-red2-dark"></i></a>
                </div><br>
                                 <div style="margin-left:20px; white-space: nowrap; width: 100%;">
                                   <input type="radio" name="tipo" value="artigos" {artigosSelected}> &nbsp;Em Artigos &nbsp;&nbsp;&nbsp;
                                   <input type="radio" name="tipo" value="biblia" {bibliaSelected}> &nbsp;Na B&iacute;blia
                                 </div><br>
                    </form>
            </div>

            
                   {listagem_pesquisa}
               {botao_mais}

            <div class="search-trending content-boxed shadow-large">
                <div class="content bottom-15">
                   <h5 class="bold">O que a b&iacute;blia diz sobre:</h5>
                  <ul class="bottom-15">
                     <li><a href="#" onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=amor';">Amor<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=paz';">Paz<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=paz';">Paz<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=fe';">F&eacute;<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=cura';">Cura<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=casamento';">Casamento<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=ressurreicao';">Ressurei&ccedil;&atilde;o<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=medo';">Medo<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=forca';">For&ccedil;a<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=esperanca';">Esperan&ccedil;a<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=ansiedade';">Ansiedade<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=perdao';">Perd&atilde;o<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=alegria';">Alegria<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=criancas';">Crian&ccedil;as<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=confianca';">Confian&ccedil;a<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=oracao';">Ora&ccedil;&atilde;o<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=graca';">Gra&ccedil;a<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=sabedoria';">Sabedoria<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=preocupacao';">Preocupa&ccedil;&atilde;o<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=raiva';">Raiva<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="#"  onclick="javascript:location='index.php?module=pesquisa&method=main&tipo=biblia&q=santo+espirito';">Santo Esp&iacute;rito<i class="fa fa-angle-right"></i></a></li>                        
                  </ul>
                </div>
            </div>

        </div>
        
    </div>


<!-- END main -->