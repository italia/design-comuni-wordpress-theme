<?php

/**
 * Vocabolario controllato che raccoglie un subset dei vocaboli definiti in Eurovoc
 */
if(!function_exists("dci_argomenti_array")){
    function dci_argomenti_array() {
        $argomenti_arr = [
            'Accesso all\'informazione',
            'Acqua',
            'Agricoltura',
            'Animale domestico',
            'Aria',
            'Assistenza agli invalidi',
            'Assistenza sociale',
            'Associazioni',
            'Bilancio',
            'Commercio all\'ingrosso',
            'Commercio al minuto',
            'Commercio ambulante',
            'Comunicazione istituzionale',
            'Comunicazione politica',
            'Concorsi',
            'Covid-19',
            'Elezioni',
            'Estero',
            'Energie rinnovabili',
            'Foreste',
            'Formazione professionale',
            'Gemellaggi',
            'Gestione rifiuti',
            'Giustizia',
            'Igiene pubblica',
            'Immigrazione',
            'Sport',
            'Imposte',
            'Imprese',
            'Inquinamento' ,
            'Integrazione sociale',
            'Isolamento termico' ,
            'Istruzione',
            'Lavoro',
            'Matrimonio',
            'Mercato',
            'Mobilità sostenibile' ,
            'Morte',
            'Nascita',
            'Parcheggi',
            'Patrimonio culturale',
            'Pesca',
            'Piano di sviluppo',
            'Pista ciclabile',
            'Politica commerciale',
            'Polizia',
            'Prodotti alimentari',
            'Protezione civile' ,
            'Residenza' ,
            'Risposta alle emergenze',
            'Sistema giuridico',
            'Spazio Verde',
            'Sviluppo sostenibile',
            'Tassa sui servizi',
            'Tempo libero',
            'Trasparenza amministrativa',
            'Trasporto pubblico',
            'Turismo',
            'Urbanizzazione',
            'Viaggi',
            'Zone pedonali',
            'ZTL',
        ];
        return $argomenti_arr;
    }
}

/**
 * Classificazione multi livello dei tipi di Unità organizzativa che distingue tra macro ambiti di un'amministrazione locale
 */
if(!function_exists("dci_tipi_unita_organizzativa_array")){
    function dci_tipi_unita_organizzativa_array() {
        $tipi_unita_organizzativa_arr = [
            'struttura amministrativa' => [
                'area',
                'ufficio'
            ],
            'struttura politica' => [
                'giunta comunale',
                'consiglio comunale',
                'commissione'
            ],
            'altra struttura' => [
                'biblioteca',
                'museo',
                'azienda municipalizzata',
                'ente',
                'fondazione',
                'scuola',
                'centro culturale',
            ]
        ];
        return $tipi_unita_organizzativa_arr;
    }
}

/**
 * Classificazione delle materie dei Servizi pubblici, definita nel Vocabolario controllato sulle Materie dei servizi Pubblici
 */
if(!function_exists("dci_categorie_servizio_array")){
    function dci_categorie_servizio_array() {
        $categorie_servizio_arr = [
            'Agricoltura e pesca',
            'Ambiente',
            'Anagrafe e stato civile',
            'Appalti pubblici',
            'Autorizzazioni',
            'Catasto e urbanistica',
            'Cultura e tempo libero',
            'Educazione e formazione',
            'Giustizia e sicurezza pubblica',
            'Imprese e commercio',
            'Mobilità e trasporti',
            'Salute, benessere e assistenza',
            'Tributi, finanze e contravvenzioni',
            'Turismo',
            'Vita lavorativa'
        ];
        return $categorie_servizio_arr;
    }
}

/**
 * Classificazione delle Licenze dei dataset secondo il Vocabolario Controllato Licenze
 */
if(!function_exists("dci_licenze_array")){
    function dci_licenze_array() {
        $licenze_arr = [
            'licenza aperta' => [
                'pubblico dominio',
                'attribuzione',
                'effetto virale',
                'condivisione allo stesso modo - copyleft non compatibile',
            ],
            'non aperta' => [
                'solo uso non commerciale',
                'non opere derivate'
            ],
            'licenza sconosciuta',
        ];
        return $licenze_arr;
    }
}

/**
 * Classificazione dei Temi dei dati secondo il Vocabolario Controllato Temi dei dati
 */
if(!function_exists("dci_temi_dataset_array")){
    function dci_temi_dataset_array() {
        $temi_dataset_arr = [
            'agricoltura, pesca, silvicoltura e prodotti alimentari',
            'economia e Finanze',
            'istruzione, cultura e sport',
            'energia',
            'ambiente',
            'governo e settore pubblico',
            'salute',
            'tematiche internazionali',
            'giustizia, sistema giuridico e sicurezza pubblica',
            'popolazione e società',
            'regioni e città',
            'scienza e tecnologia',
            'trasporti',
        ];
        return $temi_dataset_arr;
    }
}

/**
 * Classificazione della Frequenza di aggiornamento secondo il Vocabolario Controllato Frequenza
 */
if(!function_exists("dci_frequenze_aggiornamento_array")){
    function dci_frequenze_aggiornamento_array() {
        $frequenze_aggiornamento_arr = [
            'altro',
            'annuale',
            'bidecennale',
            'biennale',
            'bimensile',
            'bimestrale',
            'bisettimanale',
            'continuo',
            'decennale',
            'due volte al giorno',
            'in continuo aggiornamento',
            'irregolare',
            'mai',
            'mensile',
            'ogni cinque anni',
            'ogni due ore',
            'ogni ora',
            'ogni quattro anni',
            'ogni tre ore',
            'quindicinale',
            'quotidiano',
            'sconosciuto',
            'semestrale',
            'settimanale',
            'tre volte a settimana',
            'tre volte al mese',
            'tre volte all\'anno',
            'tridecennale',
            'triennale',
            'trimestrale'
        ];
        return $frequenze_aggiornamento_arr;
    }
}

/**
 * Classificazione dei Tipi di Punti di contatto riprendendo le Linee Guida Cataloghi dei dati
 */
if(!function_exists("dci_tipi_punto_contatto_array")){
    function dci_tipi_punto_contatto_array() {
        $tipi_punto_contatto_arr = [
            'Indirizzo',
            'Email',
            'Telefono',
            'URL',
            'PEC',
            'Account' => [
                'Whatsapp',
                'Telegram',
                'Skype',
                'Linkedin',
                'Twitter',
            ]
        ];
        return $tipi_punto_contatto_arr;
    }
}

/**
 * Classificazione multi livello dei Documenti che sono di tipo Albo Pretorio
 */
if(!function_exists("dci_tipi_doc_albo_pretorio_array")){
    function dci_tipi_doc_albo_pretorio_array() {
        $tipi_doc_albo_pretorio_arr = [
            'Atto amministrativo' => [
                'Decreto' => [
                    'Decreto del Dirigente',
                    'Decreto del Sindaco'
                ],
                'Deliberazione' => [
                    'Deliberazione del Consiglio comunale',
                    'Deliberazione della Giunta comunale',
                    'Deliberazione del Commissario ad acta',
                    'Deliberazione del Consiglio circoscrizionale',
                    'Deliberazione dell\'Esecutivo circoscrizionale',
                    'Deliberazione di altri Organi'
                ],
                'Determinazione' => [
                    'Determinazione del Sindaco',
                    'Determinazione del Dirigente'
                ],
                'Ordinanza' => [
                    'Ordinanza del Dirigente',
                    'Ordinanza del Sindaco'
                ]
            ],
            'Atto autorizzativo' => [
                'Permesso a costruire' => [
                    'Permesso a costruire'
                ]
            ],
            'Atto dello stato civile' => [
                'Provvedimento di cancellazione per irreperibilità' => [
                    'Provvedimento di cancellazione per irreperibilità'
                ],
                'Pubblicazione cambio nome' => [
                    'Pubblicazione cambio nome'
                ],
                'Pubbicazione di matrimonio' => [
                    'Pubbicazione di matrimonio'
                ]
            ],
            'Atto generico' => [
                'Avviso' => [
                    'Avviso di deposito in casa comunale',
                    'Avviso/Manifesto'
                ],
                'Bando' => [
                    'Bando di concorso',
                    'Bando di gara',
                    'Bando di contributi e vantaggi economici'
                ]
            ],
            'Pubblicazione esterna' => [
                'Atto di terzi' => [
                    'Atto di terzi'
                ]
            ],
        ];
        return $tipi_doc_albo_pretorio_arr;
    }
}

/**
 *Classificazione degli Eventi della vita delle persone (Life Events), definita nel Vocabolario controllato degli eventi della vita delle persone. Aggiornato al 17/03/2022
 */
if(!function_exists("dci_eventi_vita_persone_array")){
    function dci_eventi_vita_persone_array() {
        $eventi_vita_persone_arr = [
            'Iscrizione Scuola/Università e/o richiesta borsa di studio',
            'Invalidità',
            'Ricerca di lavoro, avvio nuovo lavoro, disoccupazione',
            'Pensionamento',
            'Richiesta o rinnovo patente',
            'Registrazione o possesso veicolo',
            'Accesso al trasporto pubblico',
            'Compravendita/affitto casa/edifici/terreni, costruzione o ristrutturazione casa/edificio',
            'Cambio di residenza o domicilio',
            'Espatri oper lavoro, studio o pensionamento',
            'Richiesta passaporto, visto e assistenza viaggi internazionali',
            'Nascita di un bambino, richiesta adozioni',
            'Matrimonio e/o cambio stato civile',
            'Morte ed eredità',
            'Prenotazione e disdetta visite/esami',
            'Denuncia crimini',
            'Dichiarazione dei redditi, versamento e riscossione tributi/imposte e contributi',
            'Accesso ai luoghi della cultura',
            'Possesso, cura, smarrimento animale da compagnia'
        ];
        return $eventi_vita_persone_arr;
    }
}

/**
 *Classificazione degli Eventi della vita di un'impresa (Business Events), definita nel Vocabolario controllato degli eventi di business (evento della vita di un'impresa). Aggiornato al 17/03/2022
 */
if(!function_exists("dci_eventi_vita_impresa_array")){
    function dci_eventi_vita_impresa_array() {
        $eventi_vita_impresa_arr = [
            'Avvio impresa',
            'Avvio nuova attività professionale',
            'Richiesta licenze, permessi e certificati',
            'Registrazione impresa transfrontaliera',
            'Avviso e registrazione filiale',
            'Finanziamento impresa',
            'Gestione personale',
            'Pagamento iva, tasse e dogane',
            'Notifiche autorità',
            'Chiusura impresa e attività professionale',
            'Chiusura filiale',
            'Ristrutturazione impresa',
            'Vendita impresa',
            'Bancarotta',
            'Partecipazione ad appalti pubblici nazionali e transfrontalieri'
        ];
        return $eventi_vita_impresa_arr;
    }
}

/**
 *Classificazione multi livello dei Tipi di incarico che una persona può ricoprire presso un'amministrazione locale
 */
if(!function_exists("dci_tipi_incarico_array")){
    function dci_tipi_incarico_array() {
        $tipi_incarico_arr = [
            'politico',
            'amministrativo',
            'altro'
        ];
        return $tipi_incarico_arr;
    }
}

/**
 *Classificazione multi livello degli Stati di una Pratica
 */
if(!function_exists("dci_stati_pratica_array")){
    function dci_stati_pratica_array() {
        $stati_pratica_arr = [
            'Processo non avviato' => [
                'In bozza'
            ],
            'Processo in corso',
            'Processo sospeso' => [
                'Si richiede un’azione da parte dell\'utente',
                'Si richiede un\'azione da parte della Pubblica Amministrazione'
            ],
            'Processo concluso' => [
                'Esito positivo',
                'Esito negativo'
            ]
        ];
        return $stati_pratica_arr;
    }
}

/**
 * Classificazione multi livello delle Notizie pubblicate da un'amministrazione locale
 */
if(!function_exists("dci_tipi_notizia_array")){
    function dci_tipi_notizia_array() {
        $tipi_notizia_arr = [
            'Notizie',
            'Comunicati',
            'Avvisi'
        ];
        return $tipi_notizia_arr;
    }
}

/**
 * Classificazione multi livello dei Luoghi di interesse pubblico, definita nella Tassonomia dei luoghi pubblici di interesse culturale
 */
if(!function_exists("dci_luoghi_array")){
    function dci_luoghi_array() {
        $luoghi_arr = [
            'Architettura Militare e fortificata' => [
                'Castello',
                'Fortezza',
                'Mura',
                'Roccaforte',
                'Torre'
            ],
            'Architettura Residenziale' => [
                'Trullo',
                'Villa',
                'Palazzo'
            ],
            'Area archeologica' => [
                'Sito archeologico',
                'Parco archeologico'
            ],
            'Centro per la cultura'=>[
                'Acquario',
                'Anfiteatro',
                'Archivio',
                'Auditorium',
                'Biblioteca',
                'Cinema',
                'Galleria',
                'Museo',
                'Osservatorio',
                'Pinacoteca',
                'Planetario',
                'Scuola',
                'Teatro',
                'Università/Facoltà',
                'Parco Archeologico',
            ],
            'Edificio di culto'=>[
                'Abbazia',
                'Chiesa',
                'Campanile',
                'Battistero',
                'Convento',
                'Duomo',
                'Edicola',
                'Eremo',
                'Mausoleo',
                'Monastero',
                'Santuario',
                'Sinagoga',
                'Tempio',
                'Sepolcro',
                'Basilica',
                'Cappella',
                'Catacomba',
                'Cattedrale',
                'Cimitero'
            ],
            'Monumento o complesso monumentale' => [
                'Archi',
                'Colonna',
                'Complesso monumentale',
                'Monumento',
                'Obelisco'
            ],
            'Parco e giardino' => [
                'Belvedere',
                'Parco',
                'Giardino',
                'Viale'
            ],
            'Bellezza naturale' => [
                'Costa marittima',
                'Lago',
                'Corso d’acqua',
                'Montagna',
                'Ghiacciaio',
                'Riserva Naturale',
                'Foresta e bosco',
                'Vulcano',
            ],
            'Luogo per lo sport e il tempo libero' => [
                'Campo sportivo',
                'Piscina',
                'Stadio',
                'Terme',
                'Casinò',
                'Circolo sportivo',
                'Piazza'
            ],
            'Architettura commerciale' => [
                'Mercati',
                'farmacie'
            ],
            'Centro per l\'assistenza e la tutela sociale' => [
                'Casa di riposo',
                'Centro di accoglienza',
                'Ospedale'
            ],
            'Infrastruttura e impianto' => [
                'Centro di raccolta',
                'Acquedotto',
                'Aeroporto',
                'Porto'
            ],
            'Struttura ricettiva' => [
                'Albergo',
                'Foresteria',
                'Rifugio',
                'Rifugio per animali'
            ],
        ];
        return $luoghi_arr;
    }
}

/**
 * Classificazione multi livello degli Eventi di interesse pubblico, definita nella Tassonomia degli eventi di interesse pubblico
 */
if(!function_exists("dci_tipi_evento_array")){
    function dci_tipi_evento_array() {
        $tipi_evento_arr = [
            'Evento culturale'=> [
                'Manifestazione artistica' => [
                    'Festival',
                    'Mostra',
                    'Spettacolo teatrale',
                    'Spettacolo di danza',
                    'Manifestazione musicale',
                    'Visita guidata',
                    'Lettura (pubblica)',
                    'Proiezione cinematografica',
                    'Visita libera',
                ],
                'Evento di formazione' => [
                    'Scuola estiva/invernale',
                    'Webinar',
                    'Seminario',
                    'Laboratorio',
                    'Presentazione libro',
                    'Corso'
                ],
                'Conferenza e Summit' => [
                    'Convegno',
                    'Vertice',
                    'Congresso'
                ],
                'Giornata Informativa' => [
                    'Giornata aperta'
                ]
            ],
            'Evento sociale'=> [
                'Concorso e cerimonia' => [
                    'Cerimonia',
                    'Concorso/competizione'
                ],
                'Dibattito pubblico' => [
                    'Dibattito/dialogo pubblico',
                    'Forum'
                ],
                'Incontro con esperti' => [
                    'Riunione esperti',
                    'Hackathon / Datathon'
                ],
                'Raduno di comunità' => [
                    'Sfilata',
                    'Sagra',
                    'Torneo storico o Palio',
                    'Festa Patronale o dei santi',
                    'Mercatino',
                    'Commemorazione',
                ],
                'Evento religioso' => [
                    'Giubileo',
                    'Udienza giubiliare',
                    'Processione',
                    'Celebrazione religiosa',
                    'Lettura religiosa',
                    'Raduno religioso',
                    'Santificazione',
                ]
            ],
            'Evento politico'=> [
                'Incontro pubblico' => [
                    'Congresso o riunione di partito',
                    'Corteo o sciopero',
                    'Comizio elettorale'
                ]
            ],
            'Evento di affari o commerciale'=> [
                'Fiera o Salone' => [
                    'Fiera o Salone',
                    'Esposizione o Esposizione globale'
                ],
                'Riunione d\'affari' => [
                    'Riunione d’affari',
                    'Convention',
                    'Tavola rotonda'
                ],
                'Evento stagionale commerciale' => [
                    'Vendita di fine stagione'
                ]
            ],
            'Evento Sportivo'=> [
                'Manifestazione sportiva' => [
                    'Partita',
                    'Gara o Torneo o Competizione',
                    'Escursione',
                    'Galà sportivo',
                    'Corsa',
                    'Raduno sportivo',
                ]
            ]
        ];
        return $tipi_evento_arr;
    }
}

/**
 * Classificazione dei tipi di documento, definita nel Vocabolario Controllato Tipi di Documenti delle Pubbliche Amministrazioni
 */
if(!function_exists("dci_tipi_documento_array")){
    function dci_tipi_documento_array() {
        $tipi_documento_arr = [
            'Documento Albo Pretorio',
            'Modulistica',
            'Documento funzionamento interno',
            'Atto normativo',
            'Accordo tra enti',
            'Documento attività politica',
            'Documento (tecnico) di supporto',
            'Istanza',
            'Documento di programmazione e rendicontazione',
            'Dataset'
        ];
        return $tipi_documento_arr;
    }
}

/**
 * Plurali dei tipi di documento,
 */
if(!function_exists("dci_tipi_documento_plural_array")){
    function dci_tipi_documento_plural_array() {
        $tipi_documento_plural_arr = [
            'Documento Albo Pretorio' => 'Documenti Albo Pretorio',
            'Modulistica' => 'Modulistica',
            'Documento funzionamento interno' => 'Documenti funzionamento interno',
            'Atto normativo' => 'Atti normativi',
            'Accordo tra enti' => 'Accordi tra enti',
            'Documento attività politica' => 'Documenti attività politica',
            'Documento (tecnico) di supporto' => 'Documenti (tecnici) di supporto',
            'Istanza' => 'Istanze',
            'Documento di programmazione e rendicontazione' => 'Documenti di programmazione e rendicontazione',
            'Dataset' => 'Dataset'
        ];
        return $tipi_documento_plural_arr;
    }
}

/**
 * descrizioni dei termini della tassonomia Categorie di Servizio
 */
if(!function_exists('dci_get_categorie_servizio_descriptions_array')){
    function dci_get_categorie_servizio_descriptions_array(){
        $categorie_servizio_descriptions_arr = [
            'Anagrafe e stato civile' => 'Documenti d\'identità, cambio di residenza, servizi elettorali, cimiteriali e certificati per nascita, matrimoni e unioni civili.',
            'Cultura e tempo libero' => 'Luoghi della cultura e dell’arte, impianti sportivi e richieste di contributi per la cultura, lo spettacolo e lo sport.',
            'Vita lavorativa' => 'Lavoro, concorsi e selezioni, licenze, abilitazioni professionali e sicurezza sul lavoro.',
            'Appalti pubblici' => 'Gare d’appalto e avvisi per lavori, servizi e forniture al Comune.',
            'Catasto e urbanistica' => 'Piani urbanistici, piani paesaggistici e tutti i certificati per immobili, case, terreni ed edifici.',
            'Turismo' => 'Sostegno e sviluppo del turismo, strutture ricettive e informazioni turistiche.',
            'Mobilità e trasporti' => 'Parcheggi, viabilità, automobili e trasporto pubblico.',
            'Educazione e formazione' => 'Iscrizioni, agevolazioni e servizi per nidi, scuole e università.',
            'Giustizia e sicurezza pubblica' => 'Polizia municipale, tribunale e Protezione civile.',
            'Tributi, finanze e contravvenzioni' => 'Tasse e tributi su immobili, rifiuti, affissioni e pubblicità',
            'Ambiente' => 'Aree verdi e parchi, inquinamento, igiene urbana e rifiuti.',
            'Salute, benessere e assistenza' => 'Servizi santirari e di sostegno per minori, famiglie, anziani e persone con disabilità.',
            'Autorizzazioni' => 'Autorizzazioni, permessi, licenze, concessioni di suolo, passi carrabili e prestito di beni del Comune.',
            'Agricoltura e pesca' => 'Autorizzazioni e politiche alimentari per agricoltura e pesca.',
            'Imprese e commercio' => 'Avvio di un’attività, commercio, autorizzazioni e concessioni per attività produttive, mercati, incentivi e supporto alle imprese.'
        ];
        return $categorie_servizio_descriptions_arr;
    }
}

