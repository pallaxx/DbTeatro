<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $Nomedb='dbTeatro';
  //Initializate connection
  $conn = mysqli_connect($servername, $username, $password);
  $sql = "CREATE DATABASE IF NOT EXISTS ".$Nomedb;
  if(!mysqli_query($conn, $sql))
  {
    die("<h1>Error creating Database: ". mysqli_error($conn) ."</h1> ");
  } 
  //Update connection
  $conn = mysqli_connect($servername, $username, $password, $Nomedb);
    


  //RAGIONAMENTO
  // Il metodo a cui mi sono ispirato e' in base alla mia esperienza e a come questi tipi di problemi vengono risolti nella virta quotidiana
  // ho ricreato cioe' che piu' logicamente cio' che assomiglia al mondo del cinema.
  // Il cliente acquista un biglietto per una determinato spettacolo ad un determinato teatro (da qui l'idea di creare l'entita programmazioni)
  // che a sua volta e' collegata appunto ad una entita che contiene tutti i teatri dell'Emilia Romagna (Anche se un domani si volesse ampliare il db per piu' localita' e' possibile farlo anche con queste associazioni)
  // e collega l'entita che contiene ogni spettacolo che il teatro vuole vendere.
  // Attributi scelti in base alla consegna data e alle funzionalita' del sito finale come la scelta di aggiungere piu' dati nell'entita Persone
  // per comodita di inserimento del codice fiscale (automatizzato sia direttamente sia inversamente (Inserendo codice fiscale si ottengono i dati della persona) 
  // oppure (inserendo i dati della persona si ottiene il codice fiscale)). 
  
  // DECISIONI EFFETTUATE
  // Spettacoli e Teatri sono una N a N collegate con l'entita Programmazione
  // L'entita Programmazione possiede un id per collegare l'entita Biglietti con essa in un'associazione (Programmazione)1 a (Biglietti)N
  // All'interno dell'entita Biglietti abbiamo una chiave esterna che puo essere null che collega l'entita Persone con l'associazione 1(Persona) a N(Biglietti)


  //Create Table
  $sql = "CREATE TABLE IF NOT EXISTS `Spettacoli` (
    IdSpettacolo	INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      Nome VARCHAR(30) NOT NULL,
      NomeRegista	VARCHAR(30) NOT NULL,
      NomeCompagnia VARCHAR(50) NOT NULL,
      NomeAttore VARCHAR(50) NOT NULL
  );";
  mysqli_query($conn, $sql);
  
  $sql = "CREATE TABLE IF NOT EXISTS `Teatri`(
    IdTeatro INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      Nome VARCHAR(30) NOT NULL,
      Citta VARCHAR(30) NOT NULL,
      Indirizzo VARCHAR(50) NOT NULL,
      Telefono VARCHAR(50) NOT NULL,
      SitoWeb VARCHAR(50) NOT NULL
  )";
  mysqli_query($conn, $sql);

  $sql = "CREATE TABLE IF NOT EXISTS `Persone`(
    CodiceFiscale	VARCHAR(30) PRIMARY KEY,
  	  Nome	VARCHAR(30) NOT NULL,
      Cognome	VARCHAR(30) NOT NULL,
      DataNascita DATE NOT NULL,
      LuogoNascita VARCHAR(50) NOT NULL,
      Telefono VARCHAR(50) NOT NULL,
      Pagamento VARCHAR(50) NOT NULL
  )";
  mysqli_query($conn, $sql);

  $sql = "CREATE TABLE IF NOT EXISTS `Biglietti`(
   IdBiglietto INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Posto VARCHAR(30) NOT NULL,
    Tipo VARCHAR(30) NOT NULL,
    Costo VARCHAR(30) NOT NULL,
    Fk_IdProgrammazione INT(6) UNSIGNED NOT NULL,
    Fk_CodiceFiscale VARCHAR(30),
    FOREIGN KEY (Fk_IdProgrammazione) REFERENCES Programmazioni(IdProgrammazione),
    FOREIGN KEY (Fk_CodiceFiscale) REFERENCES Persone(CodiceFiscale)
  )";
  mysqli_query($conn, $sql);

  $sql = "CREATE TABLE IF NOT EXISTS `Programmazioni`(
    IdProgrammazione INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Fk_IdSpettacolo INT(6) UNSIGNED NOT NULL,
    Fk_IdTeatro INT(6) UNSIGNED NOT NULL,
    FOREIGN KEY (Fk_IdSpettacolo) REFERENCES Spettacoli(IdSpettacolo),
    FOREIGN KEY (Fk_IdTeatro) REFERENCES Teatri(IdTeatro),
  )";
  mysqli_query($conn, $sql);


?>