<!DOCTYPE html>
<html>
  <head>
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <div class="contact-container">
      <h1>Nous contacter</h1>
      <form action="index.php?view=send_email" method="post">
        <label for="name">Nom:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Envoyer">
      </form>
    </div>
  </body>
</html>
