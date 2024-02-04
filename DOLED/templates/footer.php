<footer>


  <link rel="stylesheet" type="text/css" href="css/main.css">


  <div class="footer-content">
    <div class="footer-section" id="map-link" href="#">
      <h3>ADRESSE</h3>
      <p>Résidence INES</p>
      <p>Hay Qods</p>
      <p>Benslimane</p>
    </div>

    <script>
      document.getElementById('map-link').addEventListener('click', function (event) {
        event.preventDefault();
        var googleMapsUrl = 'https://www.google.com/maps?q=Résidence+INES,+Hay+Qods,+Benslimane';
        window.location.href = googleMapsUrl;
      });
    </script>

    <div class="footer-section">
      <h3>CONTACT</h3>
      <p>06 61 21 50 48</p>
      <p>boukhizzousmc@ymail.com</p>
    </div>
    <div class="footer-section">
      <h3>HORAIRES</h3>
      <p>Lundi - Samedi: 08h30 - 13h00</p>
      <p>14h00 18h00</p>
    </div>
  </div>



  <div class="footer-nav">
    <h3>NAVIGATION</h3>
    <nav>
      <ul>
        <li><a href="index.php?view=accueil">Accueil</a></li>
        <li><a href="index.php?view=produits">Produits</a></li>
        <li><a href="index.php?view=contact">Contact</a></li>
      </ul>
    </nav>
  </div>
  <div class="footer-products">
    <h3>NOS PRODUITS</h3>
    <p>Câbles</p>
    <p>Lumières</p>
    <p>Interrupteurs</p>
  </div>
  <div class="footer-about">
    <h3>A PROPOS</h3>
    <p>Mentions légales</p>
    <p>Protection des données</p>
    <p>Cookies</p>
  </div>

  <div class="footer-copyright">
    <p>DOLED © 2022</p>
  </div>

</footer>