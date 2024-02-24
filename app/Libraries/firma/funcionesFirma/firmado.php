<?php

// require('efactura.php');
// $url= require('certificado/server_key.pem');
// echo $url;die;



function firmarXML($archivo){
        
        function firmar(DOMDocument $domDocument, $ruc=""){
                
                require APPPATH.'Libraries/firma/funcionesFirma/libreriaParaFirmar/xmlseclibs.php';
                
                $ReferenceNodeName = 'ExtensionContent';
       
                
              
                $privateKey = file_get_contents(APPPATH."Libraries/firma/certificado/server_key.pem");
                $publicKey = file_get_contents(APPPATH."Libraries/firma/certificado/server.pem");
        
                $objSign = new XMLSecurityDSig($ruc);
                $objSign->setCanonicalMethod(XMLSecurityDSig::C14N);
                $objSign->addReference(
                        $domDocument, 
                        XMLSecurityDSig::SHA1, 
                        array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'),
                        $options = array('force_uri' => true)
                );
                
                $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type'=>'private'));
                $objKey->loadKey($privateKey);
                
                
                $Node = $domDocument->getElementsByTagName($ReferenceNodeName)->item(1);
                if (!($Node)) $Node = $domDocument->getElementsByTagName($ReferenceNodeName)->item(0);
                $objSign->sign($objKey, $Node);
               
                $objSign->add509Cert($publicKey);
                $domDocument->formatOutput = true;
                return $domDocument->saveXML();        
        }
        
        
        
                
                $xmlstr = file_get_contents($archivo);
                
                $domDocument = new \DOMDocument();
               
                $domDocument->loadXML($xmlstr);
                
                $xml = firmar($domDocument, '');
                
                
                
                // $data ="Firmado";

                return $xml;
        }
           
              
