 <!-- Contact Section -->
 <section id="contact" class="contact section">

     <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
         <h2>Contacto</h2>
         <p>Informações para contato</p>
     </div><!-- End Section Title -->

     <div class="container" data-aos="fade-up" data-aos-delay="100">

         <div class="row gy-4">

             <div class="col-lg-6">
                 <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                     data-aos-delay="200">
                     <i class="bi bi-geo-alt"></i>
                     <h3>Endereço</h3>
                     <p>Rua Comandante Arguelless, nº 103. Prenda</p>     
                     <p>Rua da Liberdade, 94 - Vila Alice - Luanda/Angola</p>     
                 </div>
             </div><!-- End Info Item -->

             <div class="col-lg-3 col-md-6">
                 <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                     data-aos-delay="300">
                     <i class="bi bi-telephone"></i>
                     <h3>Telemóvel (Call Center)</h3>
                     <p>+244 932 896 190</p>     
                 </div>
             </div><!-- End Info Item -->

             <div class="col-lg-3 col-md-6">
                 <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                     data-aos-delay="400">
                     <i class="bi bi-envelope"></i>
                     <h3>Horário</h3>
                     <p>Seg-Sex, 7h:30-17h00, helpdesk 24/7</p>
                 </div>
             </div><!-- End Info Item -->

         </div>

         <div class="row gy-4 mt-1">
             <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                 <iframe
                     src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                     frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen="" loading="lazy"
                     referrerpolicy="no-referrer-when-downgrade"></iframe>
             </div><!-- End Google Maps -->

             <div class="col-lg-6">
                 <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                     data-aos-delay="400">
                     <div class="row gy-4">

                         <div class="col-md-6">
                             <input type="text" name="name" class="form-control" placeholder="Digite teu Nome"
                                 required="">
                         </div>

                         <div class="col-md-6 ">
                             <input type="email" class="form-control" name="email" placeholder="Digite teu Email"
                                 required="">
                         </div>

                         <div class="col-md-12">
                             <input type="text" class="form-control" name="subject" placeholder="Assunto"
                                 required="">
                         </div>

                         <div class="col-md-12">
                             <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                         </div>

                         <div class="col-md-12 text-center">
                             <button type="submit">Enviar Mensagem</button>
                         </div>

                     </div>
                 </form>
             </div><!-- End Contact Form -->

         </div>

     </div>

 </section><!-- /Contact Section -->
