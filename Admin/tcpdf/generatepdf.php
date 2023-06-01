<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
 

require_once('tcpdf.php');
require_once('bd.php');




$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PartageaonsNosBiens');
$pdf->SetTitle('Commande');
$pdf->SetSubject('Commande');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

$pdf->SetHeaderData('logo.png');


$pdf->setFooterData(array(0,64,0), array(0,64,128));

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->setFontSubsetting(true);

$pdf->SetFont('dejavusans', '', 14, '', true);

if (isset($_GET['commande_id']) && isset($_GET['produit_id'])) {
  $commande_id = $_GET['commande_id'];
  $produit_id = $_GET['produit_id'];

  $sql = "SELECT c.commande_id, c.type, c.utilisateur_id, cp.produit_id, cp.prix_vente, cp.quantite, c.nom, c.prenom, c.telephone, c.email, c.wilaya, c.adresse_postale FROM commande AS c INNER JOIN commande_produit AS cp ON c.commande_id = cp.commande_id WHERE c.commande_id = :commande_id AND cp.produit_id = :produit_id";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':commande_id', $commande_id, PDO::PARAM_INT);
  $stmt->bindValue(':produit_id', $produit_id, PDO::PARAM_INT);
  $stmt->execute();

  
  // Fetch the result as an associative array
  $res = $stmt->fetch(PDO::FETCH_ASSOC);

  // Access the fetched variables
  $type = $res['type'];
  $utilisateur_id = $res['utilisateur_id'];
  $produit_id = $res['produit_id'];
  $quantite = $res['quantite'];
  $prix_vente = $res['prix_vente'];
  $nom = $res['nom'];
  $prenom = $res['prenom'];
  $telephone = $res['telephone'];
  $email = $res['email'];
  $wilaya = $res['wilaya'];
  $adresse_postale = $res['adresse_postale'];

  // Calculate the total price
  $prix_total = $prix_vente * $quantite;
}


$pdf->AddPage();

$html = <<<EOD

<div >
<h1>Facture de la commande</h1>
<br>
<p style="font-size:12px;"><strong>Commande ID:</strong> $commande_id</p>

<h3>Les informations du produit:</h3>
<hr>

      <p style="font-size:12px;"><strong>Type:</strong> {$res['type']}</p>
      <p style="font-size:12px;"><strong>Produit ID:</strong> {$res['produit_id']}</p>
      <p style="font-size:12px;"><strong>Prix unitaire:</strong> {$res['prix_vente']}</p>
      <p style="font-size:12px;"><strong>Quantité:</strong> {$res['quantite']}</p>
      <p style="font-size:12px;"><strong>Prix total:</strong> $prix_total</p>
      <br>

  <h3>Les informations du client:</h3>
  <hr>

  <table>

  <tr>
    <td class="div2" style=" width:50%; flex: 1; text-align: left;">   
      <p style="font-size:12px;"><strong>Utilisateur ID:</strong> {$res['utilisateur_id']}</p>
      <p style="font-size:12px;"><strong>Nom:</strong> {$res['nom']}</p>
      <p style="font-size:12px;"><strong>Prénom:</strong> {$res['prenom']}</p>
      <p style="font-size:12px;"><strong>Téléphone:</strong> {$res['telephone']}</p>
      <p style="font-size:12px;"><strong>Email:</strong> {$res['email']}</p>
      <p style="font-size:12px;"><strong>Wilaya:</strong> {$res['wilaya']}</p>
      <p style="font-size:12px;"><strong>Adresse postale:</strong> {$res['adresse_postale']}</p>
    </td>
    <td class="div1" style=" width:50%; flex: 1; text-align: center; ">
    <div style="width:10%; flex: 1; display: flex;">
        <p style="font-size:12px;"><strong>Wilaya:</strong><br> 
        <strong style="font-weight: bold; font-size:90px;">{$res['wilaya']}</strong>
      </p>

    </div>
  </td>
  </tr>
</table>


</div>

EOD;



if ($res['type'] == 'partagee') {

    $html = <<<EOD
    
<div >
<h1>Facture de la commande</h1>
<br>
<p style="font-size:12px;"><strong>Commande ID:</strong> $commande_id</p>

<h3>Les informations du produit:</h3>
<hr>

      <p style="font-size:12px;"><strong>Type:</strong> {$res['type']}</p>
      <p style="font-size:12px;"><strong>Produit ID:</strong> {$res['produit_id']}</p>
      <p style="font-size:12px;"><strong>Prix unitaire:</strong> {$res['prix_vente']}</p>
      <p style="font-size:12px;"><strong>Quantité:</strong> {$res['quantite']}</p>
      <p style="font-size:12px;"><strong>Prix total:</strong> $prix_total</p>
      <br>

  <h3>Les informations du client:</h3>
  <hr>

  <table>

  <tr>
    <td class="div2" style=" width:50%; flex: 1; text-align: left;">   
      <p style="font-size:12px;"><strong>Utilisateur ID:</strong> {$res['utilisateur_id']}</p>
      <p style="font-size:12px;"><strong>Nom:</strong> {$res['nom']}</p>
      <p style="font-size:12px;"><strong>Prénom:</strong> {$res['prenom']}</p>
      <p style="font-size:12px;"><strong>Téléphone:</strong> {$res['telephone']}</p>
      <p style="font-size:12px;"><strong>Email:</strong> {$res['email']}</p>
      <p style="font-size:12px;"><strong>Wilaya:</strong> {$res['wilaya']}</p>
      <p style="font-size:12px;"><strong>Adresse postale:</strong> {$res['adresse_postale']}</p>
    </td>
    <td class="div1" style=" width:50%; flex: 1; text-align: center; ">
    <div style="width:10%; flex: 1; display: flex;">
        <p style="font-size:12px;"><strong>Wilaya:</strong><br> 
        <strong style="font-weight: bold; font-size:90px;">{$res['wilaya']}</strong>
      </p>

    </div>
  </td>
  </tr>
</table>


</div>
<br><br><br><br><br>
    <br><h1>Contrat d'achat partagé:</h1>
    <br>
    <table style="border-collapse: collapse; margin-top: 10px;"><thead><tr><th><strong>Les membres</strong></th><th><strong>Signatures</strong></th></tr></thead>
    <hr>
    <tbody>
    <tr><td></td><td></td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    <tr><td>.........................................</td><td>.....................</td></tr>
    <br>
    </tbody></table>
    <br>
    <br>


    <strong>Détails du contrat:</strong>
    <hr>

    <p>........................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................</p>



    </div>
EOD;


}

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('commande.pdf', 'I');

