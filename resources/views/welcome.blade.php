<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="PixelFed is an activitypub based image sharing platform.">
  <title>Pixelfed - Federated Image Sharing</title>

  <meta property="og:site_name" content="Pixelfed">
  <meta property="og:title" content="Pixelfed">
  <meta property="og:type" content="article">
  <meta property="og:url" content="https://pixelfed.org">
  <meta property="og:description" content="Federated Image Sharing">

  <link rel="dns-prefetch" href="//pixelfed.nyc3.digitaloceanspaces.com">
  <link rel="dns-prefetch" href="//use.fontawesome.com">

  <link href="{{mix('css/app.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link rel="shortcut icon" type="image/png" href="/img/favicon.png?v=2">
  <link rel="apple-touch-icon" type="image/png" href="/img/favicon.png?v=2">
</head>

<body>

  <main role="main">
    <div>
      <header>
        <div class="navbar navbar-expand-lg navbar-light bg-transparent">
          <div class="container d-flex justify-content-between navbar-nav mr-auto my-4">
            <a href="/" class="navbar-brand d-flex align-items-center">
              <img src="/img/logo.svg" width="40px" class="mr-2">
              <strong translated class="text-uppercase font-ptsn">pixelfed</strong>
            </a>
            <div class="d-inline-flex align-items-center">
                {{-- <a href="/login" class="font-ptsn font-weight-bold text-muted mr-4">Login</a> --}}
                <a href="/join" class="font-ptsn font-weight-bold text-muted mr-4">Join</a>
                {{-- <div class="dropdown">
                  <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" translated>
                    文A
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="?lng=en" translated>English</a>
                    <a class="dropdown-item" href="?lng=ar" translated><bdi>عربى</bdi></a>
                    <a class="dropdown-item" href="?lng=ca" translated>Català</a>
                    <a class="dropdown-item" href="?lng=da" translated>Dansk</a>
                    <a class="dropdown-item" href="?lng=de" translated>Deutsch</a>
                    <a class="dropdown-item" href="?lng=es" translated>Español</a>
                    <a class="dropdown-item" href="?lng=eo" translated>Esperanto</a>
                    <a class="dropdown-item" href="?lng=fa" translated>فارسی</a>
                    <a class="dropdown-item" href="?lng=fr" translated>Français</a>
                    <a class="dropdown-item" href="?lng=gl" translated>Galego</a>
                    <a class="dropdown-item" href="?lng=he" translated>עברית</a>
                    <a class="dropdown-item" href="?lng=nl" translated>Nederlands</a>
                    <a class="dropdown-item" href="?lng=no" translated>Norsk</a>
                    <a class="dropdown-item" href="?lng=ms" translated>Melayu</a>
                    <a class="dropdown-item" href="?lng=oc" translated>Occitan</a>
                    <a class="dropdown-item" href="?lng=pl" translated>Polski</a>
                    <a class="dropdown-item" href="?lng=fi" translated>Suomi</a>
                    <a class="dropdown-item" href="?lng=sv" translated>Svenska</a>
                    <a class="dropdown-item" href="?lng=pt-br" translated>Português do Brasil</a>
                    <a class="dropdown-item" href="?lng=ru" translated>Русский</a>
                  </div>
                </div> --}}
            </div>
          </div>
        </div>
      </header>
      <div class="container py-5">
        <div class="my-5 text-center">
          <p class="display-4 font-weight-bold font-ptsn mb-0 animated fadeInUp">Photo Sharing. For Everyone.</p>
          <p class="h3 text-muted py-4 animated fadeInUp">A free and ethical photo sharing platform.</p>
          <p class="pt-5">
            <div class="d-inline-block cursor-pointer card card-body text-primary shadow-sm border-0 preview-btn mb-3" data-id="1"><i class="far fa-map fa-lg px-0"></i> <span class="d-block">Timeline</span></div>
            <div class="d-inline-block cursor-pointer card card-body text-dark shadow-sm border-0 mx-4 preview-btn mb-3" data-id="2"><i class="far fa-plus-square fa-lg px-0"></i> <span class="d-block">Compose</span></div>
            <div class="d-inline-block cursor-pointer card card-body text-dark shadow-sm border-0 preview-btn mb-3" data-id="3"><i class="far fa-compass fa-lg px-0"></i> <span class="d-block">Discover</span></div>
          </p>
        </div>
      </div>

      <div class="container text-center pb-5 mb-5  animated fadeInUp">
        <picture>
          <img src="https://pixelfed.nyc3.digitaloceanspaces.com/media/Screen%20Shot%202019-02-05%20at%206.34.59%20PM.png?v=2" class="img-fluid rounded shadow-lg" id="carousel_features_img_1">
          <img src="https://pixelfed.nyc3.cdn.digitaloceanspaces.com/media/Screen%20Shot%202019-05-14%20at%208.15.02%20PM.png" class="d-none img-fluid rounded shadow-lg" id="carousel_features_img_2">
          <img src="https://pixelfed.nyc3.cdn.digitaloceanspaces.com/media/Screen%20Shot%202019-05-14%20at%208.12.27%20PM.png" class="d-none img-fluid rounded shadow-lg" id="carousel_features_img_3">
        </picture>
      </div>

      <div class="bg-kashmir my-5 py-5 d-flex align-items-center" style="min-height: 100vh;">
        <div class="text-white text-center container py-5">
            <!-- <p class="display-4 font-ptsn">Features</p> -->
            <div class="row pt-5">
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Ad-Free</p>
                  <p class="lead mb-0">No ads in timelines, or anywhere</p>
                </div>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Chronological</p>
                  <p class="lead mb-0">Timelines properly ordered, no algorithms</p>
                </div>
              </div>
              <!-- <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Comments</p>
                  <p class="lead mb-0">Optional threaded conversations</p>
                </div>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Continuity</p>
                  <p class="lead mb-0">Create a new post across devices</p>
                </div>
              </div> -->
              <!-- <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Developer Friendly</p>
                  <p class="lead mb-0">Extend the platform with our open APIs</p>
                </div>
              </div> -->
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Discover</p>
                  <p class="lead mb-0">Explore new content and creators</p>
                </div>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Filters</p>
                  <p class="lead mb-0">Add optional filters to your photos</p>
                </div>
              </div>
                <!--  <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Help Center</p>
                  <p class="lead mb-0">A helpful resource for admins and users</p>
                </div>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Network</p>
                  <p class="lead mb-0">A <a href="#" class="text-white font-weight-bold">federated network</a> of millions</p>
                </div>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Optimized For Web</p>
                  <p class="lead mb-0">No mobile app required for the full experience</p>
                </div>
              </div> -->
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Photo Albums</p>
                  <p class="lead mb-0">Share your photos, one post at a time</p>
                </div>
              </div>
                <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Privacy Focused</p>
                  <p class="lead mb-0">No 3rd party analytics or tracking included</p>
                </div>
              </div>
              <!-- <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Safety Features</p>
                  <p class="lead mb-0">Tools to empower user experiences and safety</p>
                </div>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Self Hosted</p>
                  <p class="lead mb-0">You can run your own instance or join one</p>
                </div>
              </div>
              <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Stories</p>
                  <p class="lead mb-0">Ephemeral posts that disappear after 24h</p>
                </div>
              </div>
                 <div class="col-12 col-md-6 mb-5">
                <div class="card card-body bg-transparent border-light">
                  <p class="h3 font-ptsn">Video</p>
                  <p class="lead mb-0">You can run your own instance or join one</p>
                </div>
              </div> -->
            </div>
        </div>
      </div>

      <div class="d-block py-5"></div>
      <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="my-5 text-center">
          <p class="display-4 font-weight-bold font-ptsn mb-5">
            <span class="">Create.</span> 
            <span class="text-muted">Share. </span>
            <span style="color:#a0aec0">Discover.</span>
          </p>
          <p class="display-4 font-weight-bold font-ptsn mb-5">
            <span class="">Collect.</span> 
            <span class="text-muted">Follow. </span>
            <span style="color:#a0aec0">Explore.</span>
          </p>
          <p class="display-4 font-weight-bold font-ptsn mb-5">
            <span class="">Curate.</span> 
            <span class="text-muted">Comment. </span>
            <span style="color:#a0aec0">Like.</span>
          </p>
        </div>
      </div>
      <div class="d-block py-5"></div>
      <div class="bg-portrait mt-5 shadow">
        <div class="container-fluid">
          <div class="row" style="min-height: 100vh">
            <div class="col-12 col-md-5 bg-white d-flex align-items-center justify-content-center">
              <div class="p-5" style="color: #a0aec0;">
                <p class="h1 font-ptsn">Privacy</p>
                <p class="h1 font-ptsn">Safety</p>
                <p class="h1 font-ptsn">Security</p>
                <p class="h1 font-ptsn text-dark">For Everyone</p>
              </div>
            </div>
            <div class="col-12 col-md-7 d-flex align-items-center justify-content-center">
              <div class="p-3 p-md-5">
                <p>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>2FA</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Account Log</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Block Accounts</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Connected Devices</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Content Warnings</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Disable Comments</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Help Center</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Hidden Follower Count</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Mute Accounts</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Private Accounts</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Private Posts</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Reports</button>
                  <button class="btn btn-outline-secondary font-ptsn mb-3" disabled>Unlisted Posts</button>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-block py-5"></div>
      <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="my-5 text-center">
          <p class="display-4 font-weight-bold font-ptsn mb-5 pb-5">Built For The Open Web.</p>
        </div>
      </div>
      <div class="d-block py-5"></div>
      <div class="py-5">
        <div class="py-5 my-5 bg-skew d-flex align-items-center justify-content-center shadow" style="min-height: 40rem;">
          <div class="container text-center">
            <p class="display-4 font-ptsn">Open Source</p>
            <p class="py-5" style="color: #a0aec0;">
              <i class="fab fa-laravel fa-4x px-3"></i>
              <i class="fab fa-bootstrap fa-4x px-3"></i>
              <i class="fab fa-git fa-4x px-3"></i>
              <i class="fab fa-sass fa-4x px-3"></i>
              <i class="fab fa-vuejs fa-4x px-3"></i>
            </p>
            <p class="h3 font-ptsn">Run your <a href="https://docs.pixelfed.org/master/installation.html">own server</a>, or <a href="/join">join one</a></p>
          </div>
        </div>
      </div>
      <div class="d-block py-5"></div>
      <div class="container py-5 d-flex align-items-center justify-content-center" style="min-height: 100vh">
        <div class="my-5 text-center">
          <p class="display-4 font-weight-bold font-ptsn mb-0">A Network Of Millions.</p>
          <p class="h3 text-muted py-4">Follow your friends on other servers. <a href="https://fediverse.party/en/fediverse/" rel="nofollow noreferrer noopener">Learn more</a></p>
        </div>
      </div>
      <div class="d-block py-5"></div>
    </div>
  </main>
  <footer class="bg-white py-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md">
          <img src="/img/logo.svg" class="img-fluid mb-3" width="22px" height="22px">
          <small class="d-block text-muted font-ptsn">Pixelfed</small>
          <small class="d-block mb-3 text-muted">Made in 🇨🇦</small>
        </div>
        <div class="col-6 col-md">
          <h5 class="font-ptsn">Resources</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="/join">Join</a></li>
            <li><a class="text-muted" href="https://pixelfed.social/site/help" rel="nofollow noreferrer noopener">Help Center</a></li>
            <li><a class="text-muted" href="https://docs.pixelfed.org/master/installation.html">Install Pixelfed</a></li>
            <li><a class="text-muted" href="https://github.com/pixelfed/pixelfed/issues/new">Report an Issue</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5 class="font-ptsn">Links</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="https://write.as/pixelfed" rel="nofollow">Blog</a></li>
            <li><a class="text-muted" href="https://docs.pixelfed.org">Documentation</a></li>
            <li><a class="text-muted" href="https://mastodon.social/@Pixelfed" rel="nofollow noreferrer noopener">Mastodon</a></li>
            <li><a class="text-muted" href="https://twitter.com/@Pixelfed" rel="nofollow noreferrer noopener">Twitter</a></li>
          </ul>
        </div>
        <div class="col-6 col-md">
          <h5 class="font-ptsn">Support</h5>
          <ul class="list-unstyled text-small">
            <li><a class="text-muted" href="https://www.patreon.com/dansup">Patreon</a></li>
            <li><a class="text-muted" href="https://liberapay.com/pixelfed">Liberapay</a></li>
            <li><a class="text-muted" href="https://opencollective.com/pixelfed" rel="nofollow noreferrer noopener">Open Collective</a></li>
            <li><a class="text-muted" href="https://github.com/pixelfed/pixelfed">GitHub</a></li>
          </ul>
        </div>
      </div>
    </div>
  </footer>

<script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</body>
</html>
