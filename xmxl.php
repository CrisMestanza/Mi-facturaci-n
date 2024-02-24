<?xml version="1.0" encoding="ISO-8859-1" standalone="no"?>
<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"
    xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
    xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
    xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#"
    xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2"
    xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2"
    xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <ext:UBLExtensions>
        <ext:UBLExtension>
            <ext:ExtensionContent>
                <ds:Signature Id="FacturacionIntegralSign">
                    <ds:SignedInfo>
                        <ds:CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
                        <ds:SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" />
                        <ds:Reference URI="">
                            <ds:Transforms>
                                <ds:Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                            </ds:Transforms>
                            <ds:DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" />
                            <ds:DigestValue>o8k5wezVPoxKlzGcSGoHzEUIShQ=</ds:DigestValue>
                        </ds:Reference>
                    </ds:SignedInfo>
                    <ds:SignatureValue>
                        ZhrSLhARek+VhQQ2+v2lQypc+qpAo4c09JMboRbVVs5fBEXjkBifNwWIsCLtiFe05kLjL/Ju9h8ACSO7xhvbFPcViNLdkmmpSFVQwXr80IDoHLjBBu5OSwHFm9vPJOWTPd4lxix37a5v2RO3TtBqFdEW+SWcNbUatYavsySAZn9bm84J2PYkjFbtXP+TcpDVxMCWnDst1JiTL5r9bNf2q6cTz0BUEREsG6o96QNeQqoHrOw6S5XnhwaW7C1Z+ug55rvqinzz8uDiFSQOdW8+gI9e613OELwiLcOLf4D6ob+Vza9PgDylOmIE1XRZREiDce8NJ7h/DjXg+SwZJIW1xg==
                    </ds:SignatureValue>
                    <ds:KeyInfo>
                        <ds:X509Data>
                            <ds:X509Certificate>
                                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
                            </ds:X509Certificate>
                        </ds:X509Data>
                    </ds:KeyInfo>
                </ds:Signature>
            </ext:ExtensionContent>
        </ext:UBLExtension>
    </ext:UBLExtensions>
    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
    <cbc:CustomizationID>2.0</cbc:CustomizationID>
    <cbc:ID>F001-1</cbc:ID>
    <cbc:IssueDate>2023-10-17</cbc:IssueDate>
    <cbc:IssueTime>01:14:10</cbc:IssueTime>
    <cbc:InvoiceTypeCode listID="0101" listAgencyName="PE:SUNAT" listName="Tipo de Documento"
        listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01" name="Tipo de Operacion"
        listSchemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo51">01</cbc:InvoiceTypeCode>
    <cbc:Note languageLocaleID="1000">Doce con 00/100 soles</cbc:Note>
    <cbc:DocumentCurrencyCode listID="ISO 4217 Alpha" listName="Currency"
        listAgencyName="United Nations Economic Commission for Europe">PEN</cbc:DocumentCurrencyCode>
    <cac:Signature>
        <cbc:ID>10755184778</cbc:ID>
        <cac:SignatoryParty>
            <cac:PartyIdentification>
                <cbc:ID>10755184778</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name>
                    <![CDATA[PI�A JARAMILLO EDWIN RENATO]]>
                </cbc:Name>
            </cac:PartyName>
        </cac:SignatoryParty>
        <cac:DigitalSignatureAttachment>
            <cac:ExternalReference>
                <cbc:URI>10755184778</cbc:URI>
            </cac:ExternalReference>
        </cac:DigitalSignatureAttachment>
    </cac:Signature>
    <cac:AccountingSupplierParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID="6">10755184778</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyName>
                <cbc:Name>
                    <![CDATA[Impulse Wave]]>
                </cbc:Name>
            </cac:PartyName>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName>
                    <![CDATA[PI�A JARAMILLO EDWIN RENATO]]>
                </cbc:RegistrationName>
                <cac:RegistrationAddress>
                    <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI">220901</cbc:ID>
                    <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">0000
                    </cbc:AddressTypeCode>
                    <cbc:CityName>San Martin</cbc:CityName>
                    <cbc:CountrySubentity>San Martin</cbc:CountrySubentity>
                    <cbc:District>Tarapoto</cbc:District>
                    <cac:AddressLine>
                        <cbc:Line>Jr. Francisco Pizarro 950</cbc:Line>
                    </cac:AddressLine>
                    <cac:Country>
                        <cbc:IdentificationCode listID="ISO 3166-1"
                            listAgencyName="United Nations Economic Commission for Europe" listName="Country">PE
                        </cbc:IdentificationCode>
                    </cac:Country>
                </cac:RegistrationAddress>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingSupplierParty>
    <cac:AccountingCustomerParty>
        <cac:Party>
            <cac:PartyIdentification>
                <cbc:ID schemeID="6" schemeName="Documento de Identidad" schemeAgencyName="PE:SUNAT"
                    schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">10755184778</cbc:ID>
            </cac:PartyIdentification>
            <cac:PartyLegalEntity>
                <cbc:RegistrationName>
                    <![CDATA[PI�A JARAMILLO EDWIN RENATO]]>
                </cbc:RegistrationName>
            </cac:PartyLegalEntity>
        </cac:Party>
    </cac:AccountingCustomerParty>
    <cac:PaymentTerms>
        <cbc:ID>FormaPago</cbc:ID>
        <cbc:PaymentMeansID>Contado</cbc:PaymentMeansID>
    </cac:PaymentTerms>
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="PEN">0</cbc:TaxAmount>
        <cac:TaxSubtotal>
            <cbc:TaxableAmount currencyID="PEN">12.00</cbc:TaxableAmount>
            <cbc:TaxAmount currencyID="PEN">0.00</cbc:TaxAmount>
            <cac:TaxCategory>
                <cac:TaxScheme>
                    <cbc:ID schemeName="Codigo de tributos" schemeAgencyName="PE:SUNAT"
                        schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">9997</cbc:ID>
                    <cbc:Name>EXO</cbc:Name>
                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
    <cac:LegalMonetaryTotal>
        <cbc:LineExtensionAmount currencyID="PEN">12.00</cbc:LineExtensionAmount>
        <cbc:TaxInclusiveAmount currencyID="PEN">12.00</cbc:TaxInclusiveAmount>
        <cbc:AllowanceTotalAmount currencyID="PEN">0.00</cbc:AllowanceTotalAmount>
        <cbc:ChargeTotalAmount currencyID="PEN">0.00</cbc:ChargeTotalAmount>
        <cbc:PrepaidAmount currencyID="PEN">0.00</cbc:PrepaidAmount>
        <cbc:PayableAmount currencyID="PEN">12.00</cbc:PayableAmount>
    </cac:LegalMonetaryTotal>
    <cac:InvoiceLine>
        <cbc:ID>1</cbc:ID>
        <cbc:InvoicedQuantity unitCode="NIU">1.00</cbc:InvoicedQuantity>
        <cbc:LineExtensionAmount currencyID="PEN">12.00</cbc:LineExtensionAmount>
        <cac:PricingReference>
            <cac:AlternativeConditionPrice>
                <cbc:PriceAmount currencyID="PEN">12</cbc:PriceAmount>
                <cbc:PriceTypeCode listName="Tipo de Precio" listAgencyName="PE:SUNAT"
                    listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
            </cac:AlternativeConditionPrice>
        </cac:PricingReference>
        <cac:TaxTotal>
            <cbc:TaxAmount currencyID="PEN">0.00</cbc:TaxAmount>
            <cac:TaxSubtotal>
                <cbc:TaxableAmount currencyID="PEN">12.00</cbc:TaxableAmount>
                <cbc:TaxAmount currencyID="PEN">0.00</cbc:TaxAmount>
                <cac:TaxCategory>
                    <cbc:Percent>18</cbc:Percent>
                    <cbc:TaxExemptionReasonCode>20</cbc:TaxExemptionReasonCode>
                    <cac:TaxScheme>
                        <cbc:ID>9997</cbc:ID>
                        <cbc:Name>EXO</cbc:Name>
                        <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                    </cac:TaxScheme>
                </cac:TaxCategory>
            </cac:TaxSubtotal>
        </cac:TaxTotal>
        <cac:Item>
            <cbc:Description>
                <![CDATA[Cuaderno]]>
            </cbc:Description>
            <cac:SellersItemIdentification>
                <cbc:ID>C00-16</cbc:ID>
            </cac:SellersItemIdentification>
            <cac:CommodityClassification>
                <cbc:ItemClassificationCode>-</cbc:ItemClassificationCode>
            </cac:CommodityClassification>
        </cac:Item>
        <cac:Price>
            <cbc:PriceAmount currencyID="PEN">12</cbc:PriceAmount>
        </cac:Price>
    </cac:InvoiceLine>
</Invoice>