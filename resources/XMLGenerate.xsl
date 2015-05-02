<?xml version="1.0" encoding="UTF-8" ?>

<xsd:schema xmlns:xsd="http://www.w3.org/2001/XMLSchema">

    <!-- On définit deux valeurs pour l'élément socialLinks (c'est tout en bas ...)  -->
    <xsd:simpleType name="rs">
        <xsd:restriction base="xsd:string">
            <xsd:enumeration value="Facebook" />
            <xsd:enumeration value="Twitter" />
        </xsd:restriction>
    </xsd:simpleType>

    <xsd:element name="socialLink">
        <xsd:complexType>
            <xsd:simpleContent>
                <xsd:extension base="xsd:anyURI" >
                    <xsd:attribute name="type" type="rs"/>
                </xsd:extension>
            </xsd:simpleContent>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="jeuSimilaire">
        <xsd:complexType>
            <xsd:sequence>
                <xsd:element name="libelleJeu" type="xsd:string"/>
                <xsd:element name="urlJeu" type="xsd:anyURI"/>
            </xsd:sequence>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="sousTitres">
        <xsd:complexType>
            <xsd:sequence>
                <xsd:element name="sousTitre" type="xsd:string" maxOccurs="unbounded"/>
            </xsd:sequence>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="audios">
        <xsd:complexType>
            <xsd:sequence>
                <xsd:element name="audio" type="xsd:string" maxOccurs="unbounded"/>
            </xsd:sequence>
        </xsd:complexType>
    </xsd:element>
    <xsd:element name="configurationPc">
        <xsd:complexType>
            <xsd:sequence>
                <xsd:element name="systeme" type="xsd:string"/>
                <xsd:element name="ram" type="xsd:string"/>
                <xsd:element name="disqueDur" type="xsd:string"/>
                <xsd:element name="cpu" type="xsd:string"/>
                <xsd:element name="gpu" type="xsd:string"/>
                <xsd:element name="connexion" type="xsd:string"/>
                <xsd:element name="directX" type="xsd:nonNegativeInteger"/>
            </xsd:sequence>
            <xsd:attribute name="type" type="xsd:string"/>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="note">
        <xsd:simpleType>
            <xsd:restriction base="xsd:nonNegativeInteger">
                <xsd:minInclusive value="0"/>
                <xsd:maxInclusive value="5"/>
            </xsd:restriction>
        </xsd:simpleType>
    </xsd:element>

    <xsd:element name="point">
        <xsd:complexType>
            <xsd:simpleContent>
                <xsd:extension base="xsd:string" >
                    <xsd:attribute name="type" type="xsd:string"/>
                </xsd:extension>
            </xsd:simpleContent>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="notation">
        <xsd:complexType>
            <xsd:simpleContent>
                <xsd:extension base="xsd:decimal" >
                    <xsd:attribute name="source" type="xsd:string"/>
                </xsd:extension>
            </xsd:simpleContent>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="price">
        <xsd:complexType>
            <xsd:simpleContent>
                <xsd:extension base="xsd:decimal" >
                    <xsd:attribute name="vendeur" type="xsd:string"/>
                    <xsd:attribute name="type" type="xsd:string"/>

                    <xsd:attribute name="devise" type="xsd:string"/>

                </xsd:extension>
            </xsd:simpleContent>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="lien">
        <xsd:complexType>
            <xsd:simpleContent>
                <xsd:extension base="xsd:string" >
                    <xsd:attribute name="type" type="xsd:anyURI"/>
                </xsd:extension>
            </xsd:simpleContent>
        </xsd:complexType>
    </xsd:element>

    <xsd:element name="societe">
        <xsd:complexType>
            <xsd:simpleContent>
                <xsd:extension base="xsd:string" >
                    <xsd:attribute name="activite" type="xsd:string"/>
                </xsd:extension>
            </xsd:simpleContent>
        </xsd:complexType>
    </xsd:element>

    <!-- Schema XML -->
    <xsd:element name="jeuxVideo">
        <xsd:complexType>
            <xsd:sequence>
                <xsd:element name="jeu">
                    <xsd:complexType>
                        <xsd:sequence>
                            <xsd:attribute name="id" type="xsd:string"/>
                            <xsd:element name="titre" type="xsd:string"/>
                            <!-- Sociétés = éditeurs, développeurs etc ... -->
                            <xsd:element name="societes">
                                <xsd:complexType>
                                    <xsd:sequence>
                                        <xsd:element ref="societe" maxOccurs="unbounded"/>
                                    </xsd:sequence>
                                </xsd:complexType>
                            </xsd:element>
                            <xsd:element name="genres">
                                <xsd:complexType>
                                    <xsd:sequence>
                                        <xsd:element name="genre" maxOccurs="unbounded"  type="xsd:string"/>
                                    </xsd:sequence>
                                </xsd:complexType>
                            </xsd:element>

                            <!-- Les liens en rapport avec le jeu (site officiel, fansite etc ...)  -->
                            <xsd:element name="liens">
                                <xsd:complexType>
                                    <xsd:sequence>
                                        <xsd:element ref="lien" maxOccurs="unbounded"/>
                                    </xsd:sequence>
                                </xsd:complexType>
                            </xsd:element>
                            <xsd:element name="modeJeu" type="xsd:string" maxOccurs="unbounded"/>
                            <xsd:element name="description" type="xsd:string"/>


                            <!-- Plateformes : pc, ps4, xbox ...  -->
                            <xsd:element name="plateformes">
                                <xsd:complexType>
                                    <xsd:sequence>
                                        <xsd:element name="plateforme">
                                            <xsd:complexType>
                                                <xsd:sequence>
                                                    <xsd:element name="resume" type="xsd:string"/>
                                                    <xsd:element name="dateSortie" type="xsd:date"/>


                                                    <!-- On peut avoir plusieurs prix : par type (neuf, occasion) et par vendeur (magasin, web)  -->
                                                    <xsd:element name="prices">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element ref="price" maxOccurs="unbounded"/>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>

                                                    <!-- Un jeu peut être noté par plusieurs acteurs (presse, chroniqueur etc ...) -->
                                                    <xsd:element name="notes">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element ref="notation" maxOccurs="unbounded"/>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>
                                                    <xsd:element name="pegi" type="xsd:positiveInteger"/>


                                                    <!-- Points positifs/négatifs d'un jeu (type = positif or negatif) -->
                                                    <xsd:element name="points">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element ref="point" maxOccurs="unbounded"/>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>

                                                    <!-- Regroupe les illustrations (images, vidéos) -->
                                                    <xsd:element name="medias">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element name="media" maxOccurs="unbounded">
                                                                    <xsd:complexType>
                                                                        <xsd:sequence>

                                                                            <!-- Libelle : intitulé du média  -->
                                                                            <xsd:element name="libelle" type="xsd:string"/>
                                                                            <xsd:element name="url" type="xsd:anyURI"/>
                                                                            <xsd:element name="alt" type="xsd:string"/>
                                                                        </xsd:sequence>
                                                                        <xsd:attribute name="type" type="xsd:string"/>
                                                                        <xsd:attribute name="cible" type="xsd:string"/>
                                                                    </xsd:complexType>
                                                                </xsd:element>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>
                                                    <xsd:element name="commentaires">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element name="commentaire" maxOccurs="unbounded">
                                                                    <xsd:complexType>
                                                                        <xsd:sequence>
                                                                            <xsd:element name="auteur" type="xsd:string"/>
                                                                            <xsd:element name="date" type="xsd:dateTime"/>

                                                                            <!-- On part du principe qu'un commentaire  doit etre accompagné d'une note allant de 0 à 5 -->

                                                                            <xsd:element ref="note"/>
                                                                            <xsd:element name="contenu" type="xsd:string"/>
                                                                        </xsd:sequence>
                                                                    </xsd:complexType>
                                                                </xsd:element>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>


                                                    <!-- Plusieurs config pc : minimale, recommandée, max  -->
                                                    <xsd:element name="configurationsPc">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element ref="configurationPc" minOccurs="0" maxOccurs="unbounded"/>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>

                                                    <xsd:element name="langues">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element ref="audios"/>
                                                                <xsd:element ref="sousTitres"/>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>
                                                    <xsd:element name="astuces">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element name="astuce" maxOccurs="unbounded"/>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>
                                                    <xsd:element name="jeuxSimilaires">
                                                        <xsd:complexType>
                                                            <xsd:sequence>
                                                                <xsd:element ref="jeuSimilaire" maxOccurs="unbounded"/>
                                                            </xsd:sequence>
                                                        </xsd:complexType>
                                                    </xsd:element>
                                                </xsd:sequence>


                                                <!-- Type de plateforme  -->
                                                <xsd:attribute name="type" type="xsd:string"/>
                                            </xsd:complexType>
                                        </xsd:element>
                                    </xsd:sequence>
                                </xsd:complexType>
                            </xsd:element>



                            <!-- Liens sociaux du jeu (Facebook ou Twitter)  -->
                            <xsd:element name="socialLinks">
                                <xsd:complexType>
                                    <xsd:sequence>
                                        <xsd:element ref="socialLink" maxOccurs="unbounded"/>
                                    </xsd:sequence>
                                </xsd:complexType>
                            </xsd:element>
                        </xsd:sequence>

                    </xsd:complexType>
                </xsd:element>
            </xsd:sequence>
        </xsd:complexType>
    </xsd:element>
</xsd:schema>
