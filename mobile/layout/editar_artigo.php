<?php include("cabecalho.php"); ?>
<style type="text/css">
@media (max-width:700px) {
  img#avatarLogin {
    display: none;
  }
}      

#uploadavatar{
    display:none;
}


      </style>

<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Editar o Artigo</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

        
      
   <div class="content-boxed">
            <div class="content bottom-0">
                <div class="contact-form">
                    <form action="" method="post" class="contactForm">
                        <fieldset>

                            <div class="form-field form-name">
                               <label class="contactNameField color-theme" for="contactNameField">Imagem de Destaque:<span></span></label>
                               
                                <a href="javascript:void(0);" id="upload_link2">
                                                   <img src="http://www.placehold.it/600x400/EFEFEF/AAAAAA&amp;text=sem+imagem+em+destaque" alt="" id="theavatar" class="avatar img-square img-responsive" width="100%">
                                              </a>
                                                 
                                           <input id="uploadavatar" name="avatar" type="file"/>
                                               <a href="javascript:void(0);" id="upload_link"><small class="online">Alterar a Imagem em Destaque</small></a>


                               
                               
                            </div>
                           
                           
                            <div class="form-field form-name">
                               <label class="contactNameField color-theme" for="contactNameField">T&iacute;tulo:<span></span></label>
                                <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField" required="required" />
                            </div>
                            

                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Categoria:</label>
                                <select name="estado" style="width:100%; border: 1px solid #e4e4e4; height: 45px;" class="contactField round-small">
                                   <option value="7">Amor</option>
                                </select>
                            </div>
                           <br>
                           
                           
                             <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Tags:<span></span></label>
                                <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField" required="required" />
                            </div>
                            
                           
                           
                           
                           <div class="form-field form-text">
                              <label class="contactMessageTextarea color-theme" for="contactMessageTextarea">Conte&uacute;do: <span></span></label>
                                <textarea name="contactMessageTextarea" class="contactTextarea round-small" id="contactMessageTextarea"></textarea>
                            </div>
                           

                           <div class="form-button">
                                <input type="submit" class="button bg-highlight button-m button-full round-small bottom-0 shadow-huge contactSubmitButton" value="Enviar para publicar"/>
                            </div>
                        </fieldset>
                    </form>			
                </div>
            </div>
        </div>

   
        
    </div>
<?php include("footer.php"); ?>