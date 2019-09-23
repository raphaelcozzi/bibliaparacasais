<?php include("cabecalho.php"); ?>
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Meu Perfil</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                   Meus dados, prefer&ecirc;ncias e informa&ccedil;&otilde;es
                </p>
            </div>
            <div class="caption-overlay bg-black opacity-70"></div>
            <div class="caption-bg bg-20"></div>
        </div>    

        
   <div class="content-boxed content-boxed-full">
            <div class="content bottom-0">
                <div class="contact-information last-column">
                    <div class="container top-20">
                        <p class="contact-information">
                           <strong class="color-theme font-16">Meus Dados</strong>
                        </p>
                        <div class="divider bottom-0"></div>
                        <div class="link-list link-list-1">
                            <a href="#">
                                <i class="fa fa-graduation-cap color-black"></i>
                                <span>Cursos Inscrito</span><i class="fa fa-angle-right"></i>
                            </a>

                            <a href="#">
                                <i class="fa fa-pencil-alt color-black"></i>
                                <span>Meus Artigos</span><i class="fa fa-angle-right"></i>
                            </a>
                           <a href="#">
                                <i class="fa fa-pencil-alt color-black"></i>
                                <span>Novo Artigo</span><i class="fa fa-angle-right"></i>
                            </a>

                            <a href="#">
                                <i class="fa fa-bookmark color-black"></i>
                                <span>Artigos Salvos</span><i class="fa fa-angle-right"></i>
                            </a>

                            <a href="#">
                                <i class="fa fa-bookmark color-black"></i>
                                <span>Cursos Salvos</span><i class="fa fa-angle-right"></i>
                            </a>

                           
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
   <div class="content-boxed">
            <div class="content bottom-0">
                <div class="contact-form">
                    <form action="" method="post" class="contactForm">
                        <fieldset>
                            
                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Nome:<span></span></label>
                                <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField" required="required" />
                            </div>
                            <div class="form-field form-email">
                                <label class="contactEmailField color-theme" for="contactEmailField">E-mail: <span></span></label>
                                <input type="text" name="contactEmailField" value="" class="contactField round-small requiredField requiredEmailField" id="contactEmailField"  required="required" />
                            </div>


                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Telefone:</label>
                                <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField" />
                            </div>
                           

                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Estado:</label>
                                <select name="estado" style="width:100%;  border: 1px solid #e4e4e4; height: 45px;" class="contactField round-small"">
                                   <option value="7">Rio de Janeiro</option>
                                </select>
                            </div>
                           <br>
                           
                           
                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Cidade:</label>
                                <select name="estado" style="width:100%;  border: 1px solid #e4e4e4; height: 45px;" class="contactField round-small"">
                                   <option value="6779">Rio de Janeiro</option>
                                </select>
                            </div>
                           <br>
                           
                           
                           <div class="form-field form-text">
                                <label class="contactMessageTextarea color-theme" for="contactMessageTextarea">Sobre mim: <span></span></label>
                                <textarea name="contactMessageTextarea" class="contactTextarea round-small" id="contactMessageTextarea"></textarea>
                            </div>
                           
                    <div class="form-field form-name">
                      <label class="contactNameField color-theme" for="contactNameField">Senha:</label>
                        <input type="password" placeholder="Senha" class="contactField round-small requiredField">
                    </div>          
                    <div class="form-field form-name">
                       <label class="contactNameField color-theme" for="contactNameField">Confirme sua senha:</label>
                        <input type="password" placeholder="Confirme sua senha" class="contactField round-small requiredField">
                    </div>                                
                            <div class="form-button">
                                <input type="submit" class="button bg-highlight button-m button-full round-small bottom-0 shadow-huge contactSubmitButton" value="Salvar Dados" data-formId="contactForm" />
                            </div>
                        </fieldset>
                    </form>			
                </div>
            </div>
        </div>

   
        
    </div>
   
<?php include("footer.php"); ?>