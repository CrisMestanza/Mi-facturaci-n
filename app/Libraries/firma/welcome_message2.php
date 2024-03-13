<?php
function mostrar(){
    echo "Hola";
}
//Lo que esta en mayuscula lleno
// $id, $nombreCliente
function generarXML($data) {
  
    $id= $data['rucDni'];
    $nombreCliente= $data['razonSocialCliente'];

    $dom = new DOMDocument('1.0', 'ISO-8859-1');
    $dom->xmlStandalone = false;

    $root = $dom->createElement('Invoice'); 
    $dom->appendChild($root);

    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns', 'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:ccts', 'urn:un:unece:uncefact:documentation:2');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:ds', 'http://www.w3.org/2000/09/xmldsig#');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:ext', 'urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:qdt', 'urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:udt', 'urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2');
    $root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');

    $ext1 = $dom->createElement('ext:UBLExtensions');
    $root->appendChild($ext1);
    $ext2 = $dom->createElement('ext:UBLExtension');
    $ext1->appendChild($ext2);
    $extcontent = $dom->createElement('ext:ExtensionContent',"");
    $ext2->appendChild($extcontent);
    $ublversion = $dom->createElement('cbc:UBLVersionID',"2.1");
    $root->appendChild($ublversion);
    $customizationid = $dom->createElement('cbc:CustomizationID',"2.0");
    $root->appendChild($customizationid);
    $boletaid = $dom->createElement('cbc:ID','TESTEOBOLETAID'); 
    $root->appendChild($boletaid);
    $fechaissue = $dom->createElement('cbc:IssueDate',$data['fechaEmision']);//'TESTEOFECHA'
    $root->appendChild($fechaissue);
    $horaissue = $dom->createElement('cbc:IssueTime', $data['hora']);//'TESTEOHORA'
    $root->appendChild($horaissue);
    $invoicetype = $dom->createElement('cbc:InvoiceTypeCode',$data['tipoComprobante']);//'AQUI VA EL TIPO DE DOCUMENTO SI ES BOLETA O FACTURA EL NUM'
    $root->appendChild($invoicetype);

    $invoicetype->setAttribute('listID','AQUI VA EL CODIGO DEL TIPO DE INVOICE, 0101 para ventas');
    $invoicetype->setAttribute('listAgencyName','PE:SUNAT');
    $invoicetype->setAttribute('listName',$data['tipoComprobante']);//'Tipo de Documento'
    $invoicetype->setAttribute('listURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01');
    $invoicetype->setAttribute('name','Tipo de Operacion');
    $invoicetype->setAttribute('listSchemeURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo51');

    $note = $dom->createElement('cbc:Note',$data['canLetras']);//'AQUI VA LA CANTIDAD EN LETRAS'
    $root->appendChild($note);

    $note->setAttribute('languageLocaleID','1000');

    $currency = $dom->createElement('cbc:DocumentCurrencyCode','PEN');//AQUI VA LA ABREVIATURA DE LA MONEDA
    $root->appendChild($currency);

    $currency->setAttribute('listID','ISO 4217 Alpha');
    $currency->setAttribute('listName','Currency');
    $currency->setAttribute('listAgencyName','United Nations Economic Commission for Europe');

    $signaturediv = $dom->createElement('cac:Signature');
    $root->appendChild($signaturediv);
    $idsig = $dom->createElement('cbc:ID',$data['rucEmisor']);//'AQUI VA LA RUC DE LA MUA EMPRESA'
    $signaturediv->appendChild($idsig);
    $signatorparty = $dom->createElement('cac:SignatoryParty');
    $signaturediv->appendChild($signatorparty);
    $partyid = $dom->createElement('cac:PartyIdentification');
    $signatorparty->appendChild($partyid);
    $idpart = $dom->createElement('cbc:ID',$data['rucEmisor']);//'OTRA VEZ LA RUC AQUI'
    $partyid->appendChild($idpart);
    $partyname = $dom->createElement('cac:PartyName');
    $signatorparty->appendChild($partyname);
    $namepart = $dom->createElement('cbc:Name');
    $partyname->appendChild($namepart);
    $cdatasigpart = $dom->createCDATASection($data['razonSocialEmisor']);//'AQUI VA EL NOMBRE DE LA EMPRESA'
    $namepart->appendChild($cdatasigpart);
    $dsa = $dom->createElement('cac:DigitalSignatureAttachment');
    $signaturediv->appendChild($dsa);
    $externalref = $dom->createElement('cac:ExternalReference');
    $dsa->appendChild($externalref);
    $uriextref = $dom->createElement('cbc:URI',$data['rucEmisor']);//'AQUI RUC OTRA VEZ'
    $externalref->appendChild($uriextref);

    $accountingSupplierParty = $dom->createElement('cac:AccountingSupplierParty');
    $party = $dom->createElement('cac:Party');
    $partyIdentification = $dom->createElement('cac:PartyIdentification');
    $partyIdentificationID = $dom->createElement('cbc:ID',$data['rucEmisor']);//'LA RUC DE LA EMPRESA'
    $partyIdentificationID->setAttribute('schemeID', '6'); //Por si acaso
    $partyIdentification->appendChild($partyIdentificationID);
    $partyName = $dom->createElement('cac:PartyName');
    $partyNameText = $dom->createCDATASection($data['razonSocialEmisor']);//'AQUI VA EL NOMBRE DE LA EMPRESA'
    $partyName->appendChild($dom->createElement('cbc:Name'))->appendChild($partyNameText);

    $root->appendChild($accountingSupplierParty);
    $accountingSupplierParty->appendChild($party);
    $party->appendChild($partyIdentification);
    $party->appendChild($partyName);

    
    $partyLegalEntity = $dom->createElement('cac:PartyLegalEntity');
    $party->appendChild($partyLegalEntity);
    $registrationName = $dom->createCDATASection($data['razonSocialEmisor']);//'AQUI VA EL NOMBRE DE LA EMPRESA'
    $partyLegalEntity->appendChild($dom->createElement('cbc:RegistrationName'))->appendChild($registrationName);

    $registrationAddress = $dom->createElement('cac:RegistrationAddress');
    $partyLegalEntity->appendChild($registrationAddress);

    $registrationAddressID = $dom->createElement('cbc:ID',$data['ubigueo']);//'AQUI VA EL UBIGEO DE LA EMPRESA'
    $registrationAddressID->setAttribute('schemeName', $data['ubigueo']);//'Ubigeos'
    $registrationAddressID->setAttribute('schemeAgencyName', 'PE:INEI');
    $registrationAddress->appendChild($registrationAddressID);

    $atp = $dom->createElement('cbc:AddressTypeCode','0000');
    $atp->setAttribute('listAgencyName', 'PE:SUNAT');
    $atp->setAttribute('listName','Establecimientos anexos');

    $registrationAddress->appendChild($atp);

    $registrationAddress->appendChild($dom->createElement('cbc:CityName', $data['provincia']));//'PROVINCIA'
    $registrationAddress->appendChild($dom->createElement('cbc:CountrySubentity',$data['departamento']));//'DEPARTAMENTO'
    $registrationAddress->appendChild($dom->createElement('cbc:District', $data['distrito']));//'DISTRITO'

    $addressLine = $dom->createElement('cac:AddressLine');
    $addressLine->appendChild($dom->createElement('cbc:Line', $data['direccion']));//'DIRECCION DE LA MUAEMPRESA'
    $registrationAddress->appendChild($addressLine);
    
    $country = $dom->createElement('cac:Country');
    $registrationAddress->appendChild($country);

    $idcodecountry = $dom->createElement('cbc:IdentificationCode','PE');
    $idcodecountry->setAttribute('listID', 'ISO 3166-1');
    $idcodecountry->setAttribute('listAgencyName', 'United Nations Economic Commission for Europe');
    $idcodecountry->setAttribute('listName','Country');

    $country->appendChild($idcodecountry);

    $root2 = $dom->createElement('cac:AccountingCustomerParty');
    $root->appendChild($root2);

    $party = $dom->createElement('cac:Party');
    $root2->appendChild($party);

    $partyIdentification = $dom->createElement('cac:PartyIdentification');
    $party->appendChild($partyIdentification);

    $idElement = $dom->createElement('cbc:ID', $id);
    $idElement->setAttribute('schemeID', '1'); //Aca hay uno
    $idElement->setAttribute('schemeName',$data['rucDni']);//'Documento de Identidad'
    $idElement->setAttribute('schemeAgencyName', 'PE:SUNAT');
    $idElement->setAttribute('schemeURI', 'urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06');
    $partyIdentification->appendChild($idElement);

    $partyLegalEntity = $dom->createElement('cac:PartyLegalEntity');
    $party->appendChild($partyLegalEntity);

    $cdatapartylegal = $dom->createCDATASection($nombreCliente);
    $registrationName = $dom->createElement('cbc:RegistrationName');
    $registrationName->appendChild($cdatapartylegal);
    $partyLegalEntity->appendChild($registrationName);

    $paymentterms = $dom->createElement('cac:PaymentTerms');
    $root->appendChild($paymentterms);

    $paymentterms->appendChild($dom->createElement('cbc:ID','FormaPago'));
    $paymentterms->appendChild($dom->createElement('cbc:PaymentMeansID','Contado'));

    $taxtotal = $dom->createElement('cac:TaxTotal');
    $root->appendChild($taxtotal);

    $taxamount = $dom->createElement('cbc:TaxAmount',0);//'AQUI VA EL TOTAL GRAVADO, O SEA CUANDO IMPUESTO HAY'
    $taxtotal->appendChild($taxamount);

    $taxamount->setAttribute('currencyID','PEN');//'AQUI VA LA ABREVIATURA DE LA MONEDA, POR EJ PEN'

    $taxsubtotal = $dom->createElement('cac:TaxSubtotal');
    $taxtotal->appendChild($taxsubtotal);

    $taxableamount = $dom->createElement('cbc:TaxableAmount',$data['ventaTotal']);//'MONTO DE VENTA TOTAL'
    $taxableamount->setAttribute('currencyID','PEN');//'AQUI VA LA ABREVIATURA DE LA MONEDA, POR EJ PEN'
    $taxsubtotal->appendChild($taxableamount);

    $taxamountchild = $dom->createElement('cbc:TaxAmount',0);//'AQUI VA TOTAL IGV'
    $taxamountchild->setAttribute('currencyID','PEN');//'AQUI VA LA ABREVIATURA DE LA MONEDA'
    $taxsubtotal->appendChild($taxamountchild);

    $taxcategory = $dom->createElement('cac:TaxCategory');
    $taxsubtotal->appendChild($taxcategory);

    $taxscheme = $dom->createElement('cac:TaxScheme');
    $taxcategory->appendChild($taxscheme);

    $taxidscheme = $dom->createElement('cbc:ID','9997');
    $taxidscheme->setAttribute('schemeName','Codigo de tributos');
    $taxidscheme->setAttribute('schemeAgencyName','PE:SUNAT');
    $taxidscheme->setAttribute('schemeURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05');
    $taxscheme->appendChild($taxidscheme);

    $taxscheme->appendChild($dom->createElement('cbc:Name','EXO'));//Leer
    $taxscheme->appendChild($dom->createElement('cbc:TaxTypeCode','VAT'));//Leer

    $legalmonetary = $dom->createElement('cac:LegalMonetaryTotal');
    $root->appendChild($legalmonetary);

    $lineextension = $dom->createElement('cbc:LineExtensionAmount',$data['ventaTotal']);//'TOTAL DE LA VENTA'
    $lineextension->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA, POR EJ PEN'
    $legalmonetary->appendChild($lineextension);

    $taxinclusive = $dom->createElement('cbc:TaxInclusiveAmount',$data['ventaTotal']);//'TOTAL DE LA VENTA'
    $taxinclusive->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA, POR EJ PEN'
    $legalmonetary->appendChild($taxinclusive);

    $allowancetotal = $dom->createElement('cbc:AllowanceTotalAmount',00);//'00 veo q le ponen siempre xd'
    $allowancetotal->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA, POR EJ PEN'
    $legalmonetary->appendChild($allowancetotal);

    $chargetotal = $dom->createElement('cbc:ChargeTotalAmount',00);//'00 veo q le ponen siempre xd'
    $chargetotal->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA, POR EJ PEN'
    $legalmonetary->appendChild($chargetotal);

    $prepaidamount = $dom->createElement('cbc:PrepaidAmount',00);//'00 veo q le ponen siempre xd, es anticipo xd'
    $prepaidamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA, POR EJ PEN'
    $legalmonetary->appendChild($prepaidamount);

    $payableamount = $dom->createElement('cbc:PayableAmount',$data['ventaTotal']);//'TOTAL DE LA VENTA'
    $payableamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA, POR EJ PEN'
    $legalmonetary->appendChild($payableamount);

    /*esto de manera recursiva por todas las lineas del invoice*/
    foreach ($data['productos'] as $indice=>$producto) {

    $invoiceline = $dom->createElement('cac:InvoiceLine');
    $root->appendChild($invoiceline);

    $invoiceline->appendChild($dom->createElement('cbc:ID',$indice+1));//'AQUI VA EL NUMERO D INVOICE, 1 AL COMENZAR Y +1 POR CADA LINEA'

    $invoicequantity = $dom->createElement('cbc:InvoicedQuantity',$producto['cantidadprod']);//'AQUI VA LA CANTIDAD DEL PRODUCTO, 2 decimales'
    $invoicequantity->setAttribute('unitCode','AQUI VA EL CODIGO D LA UNIDAD SEGUN DB'); //Faltaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
    $invoiceline->appendChild($invoicequantity);

    $lineextensionamount = $dom->createElement('cbc:LineExtensionAmount',$producto['subtotal']);//'AQUI VA CUANTO SALE EL SUBTOTAL DE ESTE PRODUCTO, con dos decimales'
    $lineextensionamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA'
    $invoiceline->appendChild($lineextensionamount);

    $pricingreference = $dom->createElement('cac:PricingReference');
    $invoiceline->appendChild($pricingreference);

    $alternativecondition = $dom->createElement('cac:AlternativeConditionPrice');
    $pricingreference->appendChild($alternativecondition);

    $altpriceamount = $dom->createElement('cbc:PriceAmount',$producto['preciounit']);//'AQUI VA EL PRECIO UNITARIO DEL PRODUCTO, CON UN DECIMAL SI TUVIERA, SINO EL NUMERO ENTERO SOLO'
    $altpriceamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA'
    $alternativecondition->appendChild($altpriceamount);

    $altpricetypecode = $dom->createElement('cbc:PriceTypeCode','01');
    $altpricetypecode->setAttribute('listName','Tipo de Precio');
    $altpricetypecode->setAttribute('listAgencyName','PE:SUNAT');
    $altpricetypecode->setAttribute('listURI','urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16');
    $alternativecondition->appendChild($altpricetypecode);

    $invtaxtotal = $dom->createElement('cac:TaxTotal');
    $invoiceline->appendChild($invtaxtotal);

    $tttaxamount = $dom->createElement('cbc:TaxAmount','0.00');
    $tttaxamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE MONEDA'
    $invtaxtotal->appendChild($tttaxamount);

    $tttaxsubtotal = $dom->createElement('cac:TaxSubtotal');
    $invtaxtotal->appendChild($tttaxsubtotal);

    $tsttaxableamount = $dom->createElement('cbc:TaxableAmount',$producto['subtotal']);//'PRECIO SUBTOTAL DEL PRODUCTO, 2 DECIMALES'
    $tsttaxableamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA'
    $tttaxsubtotal->appendChild($tsttaxableamount);

    $tstaxamount = $dom->createElement('cbc:TaxAmount','0.00');
    $tstaxamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA'
    $tttaxsubtotal->appendChild($tstaxamount);

    $tstaxcategory = $dom->createElement('cac:TaxCategory');
    $tttaxsubtotal->appendChild($tstaxcategory);

    $tstaxcategory->appendChild($dom->createElement('cbc:Percent','18'));
    $tstaxcategory->appendChild($dom->createElement('cbc:TaxExemptionReasonCode','20'));

    $tctaxscheme = $dom->createElement('cac:TaxScheme');
    $tstaxcategory->appendChild($tctaxscheme);

    $tctaxscheme->appendChild($dom->createElement('cbc:ID','9997'));
    $tctaxscheme->appendChild($dom->createElement('cbc:Name','EXO'));
    $tctaxscheme->appendChild($dom->createElement('cbc:TaxTypeCode','VAT'));

    $invoiceitem = $dom->createElement('cac:Item');
    $invoiceline->appendChild($invoiceitem);

    $descripcionpro = $dom->createCDATASection($producto['nomproducto']);//'NOMRBE DE PRODUCTO'
    $descripcion = $dom->createElement('cbc:Description');
    $descripcion->appendChild($descripcionpro);
    $invoiceitem->appendChild($descripcion);

    $iditemseller = $dom->createElement('cac:SellersItemIdentification');
    $invoiceitem->appendChild($iditemseller);
    $iditemseller->appendChild($dom->createElement('cbc:ID','AQUI VA EL ID DEL PRODUCTO SEGUN NUESTRA DB'));//Faltaaaaaaaaa

    $iditemsunat = $dom->createElement('cac:CommodityClassification');
    $invoiceitem->appendChild($iditemsunat);
    $iditemsunat->appendChild($dom->createElement('cbc:ItemClassificationCode','-'));

    $price = $dom->createElement('cac:Price');
    $invoiceitem->appendChild($price);

    $ppriceamount = $dom->createElement('cbc:PriceAmount',$producto['preciounit']);//'AQUI VA PRECIO UNITARIO, CON UN SOLO DECIMAL SI TUVIERA'
    $ppriceamount->setAttribute('currencyID','PEN');//'ABREVIATURA DE LA MONEDA'
    $price->appendChild($ppriceamount);
    }
    //Termina del producto
    
    // Formatea el XML para que sea legible
    $dom->formatOutput = true;

    // Devuelve el XML como una cadena
    return $dom->saveXML();
    
}

// Variables que deseas reemplazar


?>
