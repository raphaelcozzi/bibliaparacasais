<?php include("cabecalho.php"); ?>
<div class="page-content header-clear-small">   
        
        <div data-height="150" class="caption caption-margins round-medium">
            <div class="caption-center right-15 top-15 text-right">
                <a href="#" class="back-button button button-xs button-round-medium bg-highlight">Voltar</a>
            </div>
            <div class="caption-center left-15 text-left">
                <h1 class="color-white bolder">Fale Conosco</h1>
                <p class="under-heading color-white opacity-90 bottom-0">
                 Entre em contato conosco
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
                           <strong class="color-theme font-16">Possui alguma d&uacute;vida?</strong><br>
                           Siga nossa p&aacute;gina e receba novidades e esclare&ccedil;a suas d&uacute;vidas.<br>
                           Voc&ecirc; tamb&eacute;m pode entrar em contato via Skype em tempo real.
                        </p>
                        
                        <div class="divider bottom-0"></div>
                        <div class="link-list link-list-1">
                            <a href="tel:+1 234 567 8900">
                                <i class="fa fa-phone color-green1-dark"></i>
                                <span>+1 234 567 8900</span>
                                <em class="bg-highlight">LIGAR</em>
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-whatsapp color-whatsapp"></i>
                                <span>+1 234 567 8900</span>
                            </a>
                           
                            <a href="mailto:mail@domain.com">
                                <i class="fa fa-envelope color-blue2-dark"></i>
                                <span>info@bibliaparacasais.com.br</span>
                                <em class="bg-highlight">EMAIL</em>
                                <i class="fa fa-angle-right"></i>
                            </a>
                            <a href="#">
                                <i class="fab fa-facebook color-facebook"></i>
                                <span>https://www.facebook.com/bibliaparacasais-668300016974075/</span>
                                <i class="fa fa-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   
   <div class="content-boxed">
            <div class="content bottom-0">
                <div class="contact-form">
                    <div class="formSuccessMessageWrap" id="formSuccessMessageWrap">
                        <div class="shadow-large round-large bg-gradient-green1">
                            <h1 class="color-white center-text top-30"><i class="fa fa-check-circle fa-3x shadow-small round-image"></i></h1>
                            <h2 class="color-white bold center-text top-20">Mensagem Enviada</h2>
                            <p class="color-white under-heading boxed-text-large bottom-40">Entraremos em contato em breve.</p>
                        </div>
                    </div>
                    <form action="" method="post" class="contactForm">
                        <fieldset>
                            
                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Nome:<span>(obrigat&oacute;rio)</span></label>
                                <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField" required="required" />
                            </div>
                            <div class="form-field form-email">
                                <label class="contactEmailField color-theme" for="contactEmailField">E-mail: <span>(obrigat&oacute;rio)</span></label>
                                <input type="text" name="contactEmailField" value="" class="contactField round-small requiredField requiredEmailField" id="contactEmailField"  required="required" />
                            </div>


                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Telefone:</label>
                                <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField" />
                            </div>
                            <div class="form-field form-name">
                                <label class="contactNameField color-theme" for="contactNameField">Assunto:<span>(obrigat&oacute;rio)</span></label>
                                <input type="text" name="contactNameField" value="" class="contactField round-small requiredField" id="contactNameField"  required="required" />
                            </div>

                           
                            <div class="form-field form-text">
                                <label class="contactMessageTextarea color-theme" for="contactMessageTextarea">Mensagem: <span>(obrigat&oacute;rio)</span></label>
                                <textarea name="contactMessageTextarea" class="contactTextarea round-small requiredField" id="contactMessageTextarea"></textarea>
                            </div>
                            <div class="form-button">
                                <input type="submit" class="button bg-highlight button-m button-full round-small bottom-0 shadow-huge contactSubmitButton" value="Enviar Mensagem" data-formId="contactForm" />
                            </div>
                        </fieldset>
                    </form>			
                </div>
            </div>
        </div>

   
        
    </div>
   
<?php include("footer.php"); ?>