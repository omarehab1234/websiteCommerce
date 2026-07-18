<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Cilantro</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{asset('css/contact.css')}}">
</head>
<body>
<x-navbar/>

<!-- HERO -->
<header class="contact-hero">
    <span class="eyebrow"><span class="dot"></span> We're here for you</span>
    <h1 class="display-fraunces">Let's get <span class="accent">fresh</span> together</h1>
    <p>
        Visit one of our featured branches or reach out anytime. Great food starts
        with a great conversation, and we&apos;d love to have one with you.
    </p>

    <div class="quick-chips">
        <a href="tel:01020768622"><i class="bi bi-telephone-fill"></i> Call us</a>
        <a href="mailto:omarehab06@gmail.com"><i class="bi bi-envelope-fill"></i> hello@cilantro.com</a>
        <a href="https://wa.me/201020768622" target="_blank"><i class="bi bi-whatsapp"></i> WhatsApp</a>
    </div>
</header>

<!-- BRANCHES -->
<main class="container branches pb-2">
    <div class="row g-4">

        <!-- Branch 1 -->
        <div class="col-md-6 col-lg-4">
            <div class="branch-card">
                <div class="branch-icon"><i class="bi bi-shop"></i></div>
                <h4>Terrace Mall</h4>
                <span class="branch-area">Shorouk City</span>

                <div class="branch-line">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Terrace Mall, El Sadat Road</span>
                </div>
                <div class="branch-line">
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:01015361298" class="text-decoration-none text-reset">010 15361298</a>
                </div>

                <div class="branch-cta">
                    <a href="https://maps.google.com/?q=Cilantro+Terrace+Mall+Shorouk"
                       target="_blank" class="btn">
                        <i class="bi bi-map-fill"></i> Get Directions
                    </a>
                </div>
            </div>
        </div>

        <!-- Branch 2 -->
        <div class="col-md-6 col-lg-4">
            <div class="branch-card">
                <div class="branch-icon"><i class="bi bi-shop"></i></div>
                <h4>CFC Mall</h4>
                <span class="branch-area">New Cairo</span>

                <div class="branch-line">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Cairo Festival City Mall</span>
                </div>
                <div class="branch-line">
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:01278354907" class="text-decoration-none text-reset">012 78354907</a>
                </div>

                <div class="branch-cta">
                    <a href="https://maps.google.com/?q=Cilantro+CFC+Mall"
                       target="_blank" class="btn">
                        <i class="bi bi-map-fill"></i> Get Directions
                    </a>
                </div>
            </div>
        </div>

        <!-- Branch 3 -->
        <div class="col-md-6 col-lg-4">
            <div class="branch-card">
                <div class="branch-icon"><i class="bi bi-shop"></i></div>
                <h4>Korba</h4>
                <span class="branch-area">Heliopolis</span>

                <div class="branch-line">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>Korba, Heliopolis</span>
                </div>
                <div class="branch-line">
                    <i class="bi bi-telephone-fill"></i>
                    <a href="tel:01281979697" class="text-decoration-none text-reset">012 81979697</a>
                </div>

                <div class="branch-cta">
                    <a href="https://maps.google.com/?q=Cilantro+Korba"
                       target="_blank" class="btn">
                        <i class="bi bi-map-fill"></i> Get Directions
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- CTA BANNER -->
    <section class="contact-cta">
        <h2>Have a question or a big order?</h2>
        <p>Our team replies fast. Drop us a line and we&apos;ll help you plan the perfect fresh experience.</p>
        <a href="mailto:hello@cilantro.com" class="btn btn-mustard">
            <i class="bi bi-envelope-paper-fill"></i> Send us a message
        </a>
    </section>
</main>


</body>
</html>