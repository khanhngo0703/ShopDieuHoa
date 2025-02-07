<?php
include "shared/_header.php";

?>
<div class="iframe-form">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.9244039373093!2d105.8164542749293!3d21.035710580615344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab145bf89bd7%3A0xd94a869b494c04b6!2zMjg1IMSQ4buZaSBD4bqlbiwgVsSpbmggUGjDuiwgQmEgxJDDrG5oLCBIw6AgTuG7mWkgMTAwMDAwLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1682070434167!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<section id="contact" class="contact">

    <h1 class="section-header">Contact</h1>

    <div class="contact-wrapper">


        <form id="contact-form" class="form-horizontal" role="form">
            <h2 class="title-contact">LET US NOW!</h2>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" placeholder="USERS NAME" name="name" value="" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" placeholder="EMAIL" name="email" value="" required>
                </div>
            </div>

            <textarea class="form-control" rows="10" placeholder="MESSAGE" name="message" required></textarea>

            <button class="btn btn-primary send-button" id="submit" type="submit" value="SEND">
                <div class="alt-send-button">
                    <i class="fa fa-paper-plane"></i><span class="send-text">SEND</span>
                </div>

            </button>
        </form>

        <div class="direct-contact-container">
            <h2 class="title-contact">HEAD OFFICE</h2>

            <ul class="contact-list">
                <li class="list-item"><i class="fa fa-map-marker fa-2x"><span class="contact-text place">ĐỘI CẤN</a></span></i></li>

                <li class="list-item"><i class="fa fa-phone fa-2x"><span class="contact-text phone"><a href="tel:0356895656" title="Give me a call">0356895656</a></span></i></li>

                <li class="list-item"><i class="fa fa-envelope fa-2x"><span class="contact-text gmail"><a href="mailto:#" title="Send me an email">Phuongthao@gmail.com</a></span></i></li>

            </ul>

            <hr>
            <ul class="social-media-list">
                <li><a href="#" target="_blank" class="contact-icon">
                        <i class="fa-solid fa-headphones"></i></a>
                </li>
                <li><a href="#" target="_blank" class="contact-icon">
                        <i class="fa-solid fa-globe"></i></a>
                </li>
                <li><a href="#" target="_blank" class="contact-icon">
                        <i class="fa-solid fa-dove"></i></a>
                </li>
                <li><a href="#" target="_blank" class="contact-icon">
                        <i class="fa-brands fa-instagram"></i></a>
                </li>
            </ul>
            <hr>

        </div>

    </div>
</section>

<?php
include "shared/_footer.php";
?>