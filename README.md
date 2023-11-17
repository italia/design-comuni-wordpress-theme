# ![developers.italia](https://avatars1.githubusercontent.com/u/15377824?s=36&v=4 "developers.italia") Design Comuni Italia

[![Join the #design siti comuni channel](https://img.shields.io/badge/Slack%20channel-%23design_siti_comuni-blue.svg)](https://developersitalia.slack.com/messages/design-siti-comuni/)

## **Un sito per i Comuni Italiani**

### I primi passi con il tema Wordpress (1.7.5)

**Design Comuni Italia** è il tema WordPress che permette di aderire al [modello di sito istituzionale dei Comuni Italiani](https://designers.italia.it/modello/comuni/), progettato dal Dipartimento per la trasformazione digitale.

## **Installazione e supporto**

### **Come scaricare il tema**

Per scaricare il progetto esegui il seguente comando git:

- git clone https://github.com/italia/design-comuni-wordpress-theme.git

Se già usi una vecchia versione del tema e vuoi aggiornarla, esegui il comando:

- git pull.

### Come inserire il tema all'interno di un'installazione WordPress

Una volta scaricato il repository, inserisci la cartella all'interno del progetto WordPress al seguente percorso:

- `wp-content > themes `.

> È raccomandata l'installazione del tema come _"child"_ in modo tale da poterlo aggiornare facilmente senza compromettere le personalizzazioni locali. [Vedi la guida ufficiale](https://developer.wordpress.org/themes/advanced-topics/child-themes/#1-create-a-child-theme-folder) su come installare un tema _"child"_.


Se il tema viene scaricato come file `.zip` puoi estrarre l'archivio e inserirlo allo stesso percorso oppure caricare direttamente il file `.zip` da backoffice al seguente percorso:

- `Aspetto > Temi > Aggiungi nuovo > Carica tema` (o apri la seguente url: {{host}}/wp-admin/theme-install.php).

### Aggiornamento libreria Bootstrap Italia

Se si desidera aggiornare la libreria Bootstrap Italia è possibile lanciare il seguente comando nella folder di installazione del tema (è necessario avere installato una versione di node >= 14.18.0):

```node
 npm install
```

### Come abilitare il tema

Una volta inserita la cartella o caricato file `.zip`come descritto al punto precedente, apri il backoffice e naviga al seguente percorso:

- `Aspetto > Temi ` (o apri la seguente url: {{host}}/wp-admin/themes.php).

Abilita poi il tema **Design Comuni Italia** cliccando sul bottone `Attiva`.

### **Supporto tecnico ed editoriale**

Sul [canale Slack #design-siti-comuni](http://developersitalia.slack.com/messages/design-siti-comuni/) puoi confrontarti sulle risorse e trovare le risposte a tutte le domande riguardo problemi tecnici o l’architettura dei contenuti.

È necessario avere un’utenza Slack di Developers Italia. [Attivala adesso](https://slack.developers.italia.it/).

## **Indice**

- [Cos'è e cosa fa](#cosè-e-cosa-fa)
- [Le pagine del modello](#le-pagine-del-modello)
- [Da dove iniziare](#da-dove-iniziare)
- [Relazioni tra i contenuti](#relazioni-tra-i-contenuti)
- [I diversi content type](#i-diversi-content-type)
- [Personalizzazione](#personalizzazione)
- [Servizi esterni](#servizi-esterni)
- [La community di riferimento](#la-community-di-riferimento)
- [FAQ](#faq)
- [Licenze software dei componenti di terze parti](#licenze-software-dei-componenti-di-terze-parti)
- [Segnalazione bug](#segnalazione-bug)
- [Come contribuire](#come-contribuire)

### **Cos'è e cosa fa**

Il tema Design Comuni Italia è un’applicazione di WordPress, il sistema di gestione di contenuti (CMS), che consente di creare un sito web comunale sulla base del [modello Comuni](https://designers.italia.it/modello/comuni/), creato nell’ambito del progetto Designers Italia dal Dipartimento per la trasformazione digitale.

Il tema WordPress è stato progettato per aderire rapidamente al modello di sito comunale. Il tema, infatti, imposta automaticamente lo stile grafico del sito, le aree del sito, i layout delle pagine e il menu di navigazione. Il compito dei redattori rimane, quindi, quello di curare i contenuti delle pagine, risparmiando così tempo e risorse nella progettazione e realizzazione del sito.

### **Le pagine del modello**

Tramite il tema WordPress, è possibile creare automaticamente le seguenti pagine:

- _Homepage_, pagine di primo livello (_Amministrazione_, _Novità_, _Servizi_ e _Vivere il Comune_), _Documenti e dati_ e pagina _Argomenti_ (pagina lista), tramite il menu Configurazione;

- le pagine foglia _Notizia_, _Scheda servizio_, _Evento_, _Luogo_, _Documento pubblico_, _Dataset_, _Unità organizzativa_, _Persona pubblica_, tramite le voci nella barra a sinistra.

**Attenzione:** Per le pagine _Documento pubblico_, _Unità organizzativa_, _Persona pubblica_, _Luogo_ e le _pagine lista_, è possibile l'inserimento dei contenuti, ma la resa grafica della pagina non apparirà in automatico. È necessario creare un template .php manualmente e inserirlo nella root del tema.


### **Da dove iniziare**

Consigliamo di cominciare a creare i diversi contenuti in questo ordine:

- punti di contatto;
- persone pubbliche;
- luoghi;
- unita organizzative;

Una volta iniziato il lavoro sulle prime 4 tipologie di contenuto suggerite, si può continuare con:

- documenti pubblici;
- dataset;
- eventi;
- notizie;
- fasi;
- servizi;


### **Relazioni tra i contenuti**

I siti WordPress presentano una serie di tipologie di contenuto (content type) che sono in relazione tra loro. Ogni tipologia di contenuto viene creata attraverso una “scheda” nel backend di WordPress, che presenta i vari campi dove aggiungere i contenuti per creare la pagina.

Questa impostazione permette di combinare i vari elementi per la creazione delle pagine, così che i contenuti vengano creati soltanto una volta e poi riutilizzati, se necessario, in varie parti del sito. Una volta comprese le relazioni tra le tipologie di contenuti, sarà facile creare le pagine del sito.

Alcune relazioni tra tipologie di contenuti, sono:

- Unità Organizzative - Persone Pubbliche;
- Unità Organizzative - Luoghi;
- Eventi - Luoghi;
- Eventi - Persone Pubbliche;
- Eventi - Unità Organizzative.

Questo significa, ad esempio, che ogni pagina di un Evento può presentare una relazione con contenuti come i luoghi e le persone pubbliche.

**Attenzione!** Dal punto di vista pratico, è necessario che i contenuti che si vuole collegare vengano creati in un ordine preciso: prima i content type che fungono da contenuti di dettaglio e poi il content type contenitore (es. prima i punti di contatto, i luoghi e le persone e solo dopo l'unità organizzativa che li referenzia).

Per collegare tra loro diverse tipologie di contenuto, quindi:

1. crea la scheda o le schede dei contenuti di dettaglio;
2. crea la scheda del contenuto contenitore;
3. associa, tramite l’apposito campo, le schede contenuto di dettaglio alla scheda contenuto.

Per associare nuovi contenuti di dettaglio ad altri già esistenti:

1. crea la nuova scheda di contenuto di dettaglio;
2. entra nella scheda del contenuto contenitore e, tramite l’apposito campo, associa la scheda del contenuto di dettaglio.

### **Personalizzazione**

Nell’area di configurazione è possibile (e talvolta necessario) personalizzare alcuni caratteristiche del sito, come i contenuti da mostrare in evidenza o nella homepage.

L’area di configurazione è divisa in tab per le diverse aree del sito.

Cliccando su `Configurazione`, è possibile definire:

- **Configurazione Comune**: le impostazioni di base del Comune, come il nome, lo stemma, il link alla regione di apartenenza;
- **Home Page**: i contenuti e gli argomenti in evidenza in homepage;
- **Socialmedia**: i link ai canali social del Comune, che compariranno nell'header e nel footer;
- **Footer**: la sezione contatti presente nel footer e i link alla privacy policy e alla media policy;
- **Amministrazione**: i contenuti in evidenza nella pagina Amministrazione;
- **Novità**: i contenuti e gli argomenti in evidenza nella pagina Novità;
- **Servizi**: i contenuti in evidenza nella pagina Servizi;
- **Documenti e Dati**: i contenuti e gli argomenti in evidenza nella pagina Documenti e Dati;
- **Vivere il Comune**: i contenuti in evidenza nella pagina Vivere il Comune;
- **Argomenti**: gli argomenti in evidenza nella pagina Argomenti;
- **Assistenza e Contatti**: le informazioni utili per contattare il comune, come il numero verde;
- **Link Utili**: i link utili che compaiono in homepage nella sezione di ricerca;
- **Ricerca**: i contenuti suggeriti nella pagina di ricerca globale.

È possibile personalizzare i colori del sito, tramite file CSS. Invece di modificare il file css originale del tema, si consiglia di creare un file CSS in sovrascrittura (esempio: comini-custom.css) che contiene la personalizzazione dei colori. In questo modo, le modifiche verranno mantenute nel tempo con gli aggiornamenti del tema.

### **Servizi esterni**

Il tema Wordpress è realizzato per supportare il collegamento a API esterne per quel che concerne le funzionalità di valutazione, prenotazione appuntamento e richiesta di assistenza. Ogni amministrazione comunale dovrà quindi provvedere ad integrare i form forniti con il tema con un servizio esterno realizzato a propria discrezione andando a modificare i file che andremo ad elencare di seguito. Per l'effettivo inserimento dei file all'interno del progetto si può agire in due modi

- se vogliamo che i file siano minificati per un incremento delle performance del sito è necessario avviare un processo di build tramite `npm` dopo la modifica del file, come verrà descritto in seguito. Assicurarsi di aver installato [Node.js](https://nodejs.org/it/download/) almeno della versione 16.x e installato le dipendenze con il comando

```sh
npm install
```

successivamente occorre lanciare il comando per minificare e rendere disponibile il file

```sh
npm run build
```

- se non abbiamo modo di minificare il file (scelta sconsigliata) possiamo copiare e incollare i file da `assets-src` verso `assets` così come sono e modificarli.

**_Valutazione_**

Al termine del processo di valutazione viene creato un payload nel seguente formato:

```json
{
  "title": "Assistenza",
  "star": "2",
  "radioResponse": "Alcune indicazioni non erano chiare",
  "freeText": "Maggiori dettagli",
  "page": "http://api.wordpresscomuni.local:8080/servizi/assistenza/"
}
```

Il file da modificare per integrare un servizio esterno si trova all'interno della cartella del tema in:

- `assets-src > js > rating.js `.

**_Prenotazione appuntamento_**

Per funzionare correttamente, la chiamata che restituisce le date disponibili dovrà rispettare il seguente formato:

```json
[
  {
    "startDate": "2022-07-04T09:00",
    "endDate": "2022-07-04T09:45"
  },
  {
    "startDate": "2022-07-04T09:45",
    "endDate": "2022-07-04T10:30"
  },
  {
    "startDate": "2022-07-05T09:45",
    "endDate": "2022-07-05T10:30"
  }
]
```

Al termine della procedura per la prenotazione viene creato un payload nel seguente formato:

```json
{
  "office": {
    "id": "117",
    "name": "Ufficio ambiente"
  },
  "place": {
    "nome": "Municipalità 1",
    "indirizzo": "Via Roma 1",
    "apertura": "lun, mar, mer 10:00 -12:00",
    "id": "id-luogo-123"
  },
  "appointment": {
    "startDate": "2022-07-04T09:00",
    "endDate": "2022-07-04T09:45"
  },
  "service": {
    "id": "101",
    "name": "Iscrizione alla Scuola dell’infanzia"
  },
  "moreDetails": "Dettagli aggiuntivi",
  "name": "Mario",
  "surname": "Rossi",
  "email": "mario.rossi@mail.com"
}
```

Il file da mofificare per integrare un servizio esterno si trova all'interno della cartella del tema in:

- `assets-src > js > booking.js `.

**_Richiesta di assistenza_**

Al termine della richiesta assistenza viene creato un payload nel seguente formato:

```json
{
  "title": "ticket_2022-07-15T12:47:02.560Z",
  "nome": "Mario",
  "cognome": "Rossi",
  "email": "mario@rossi.it",
  "categoria_servizio": "2248",
  "servizio": "Pagamento multa",
  "dettagli": "test",
  "privacyChecked": "true"
}
```

Il file da mofificare per integrare un servizio esterno si trova all'interno della cartella del tema in:

- `assets-src > js > assistenza.js `.

### **La community di riferimento**

Scopri i canali della community dove confrontarti sulle risorse del modello:

- [Forum Italia](https://forum.italia.it/) - unisciti alla discussione sul design dei servizi digitali con gli esperti del settore;
- [Canale Slack](http://developersitalia.slack.com/) - dialoga e collabora in tempo reale con la community di Designers Italia;
- [GitHub](https://github.com/italia/design-comuni-wordpress-theme) - il repository GitHub del tema WordPress “Design Comuni Italia”.

### **F.A.Q**

➔ **Chi gestisce il sito?**

L’uso del tema non impatta le modalità con cui viene abitualmente gestito il sito comunale.

➔ **Non ho WordPress. Cosa devo fare?**

Puoi passare a [WordPress](https://it.wordpress.org/) in qualunque momento, oppure usare le [altre risorse per la creazione del sito comunale](https://designers.italia.it/modello/comuni/).

➔ **Quali sono i benefici dell’uso del tema WordPress?**

L’adozione del tema WordPress, pronto all’uso, ti permette di:

- usare configurazioni preimpostate, risparmiando tempo sugli aspetti più tecnici della creazione di un sito;
- dedicare più tempo alla cura dei contenuti e alla loro organizzazione, puntando sulla qualità.

**➔ Posso fare dei cambiamenti al sito?**

WordPress è un ambiente pensato per modificare con semplicità ogni aspetto del sito.

➔ **È consigliato fare cambiamenti al sito?**

Il tema WordPress copre già tutte le esigenze di base.

WordPress permette di aggiungere innumerevoli funzionalità, per far fronte alle esigneze dei singoli Comuni. Quando si sviluppa una nuova funzionalità, è opportuno condividerla con il resto della comunità tramite [Forum Italia](https://forum.italia.it/), [GitHub](https://github.com/italia/design-comuni-wordpress-theme) o il [progetto Porte Aperte sul Web](https://www.porteapertesulweb.it/).

È sconsigliato apportare modifiche strutturali al sito, come modificare la classificazione delle informazioni o la struttura di navigazione. Modifiche di questo tipo possono impedire di beneficiare di evoluzioni future del prodotto, a cause di problematiche di aggiornamento del tema. Puoi segnalare necessità di questo tipo direttamente alla community di Designers Italia tramite i vari canali di contatto. I feedback ricevuti verranno raccolti e considerati per le successive evoluzioni del modello.

### **Bootstrap Italia**

Design Comuni Italia rispetta le nuove linee guida di design dell’Agenzia per l’Italia digitale rilasciare dal [**Team per la Trasformazione Digitale**](https://teamdigitale.governo.it/) e le caratteristiche per i servizi web della Pubblica Amministrazione contenute nel Piano triennale per l’informatica nella Pubblica Amministrazione 2017/2019.

Nel tema vengono integrate le componenti di [**Bootstrap Italia**](https://italia.github.io/bootstrap-italia/).

---

## Licenze software dei componenti di terze parti

### Componenti distribuiti con i template

Di seguito elencati i componenti distribuiti con il tema WordPress:

- [CMB2](https://github.com/CMB2/CMB2) © Justin Sternberg, licenza GNU GPL v3.0;
- [CMB2-conditional-logic](https://github.com/awran5/CMB2-conditional-logic/) © Ahmed Khalil, licenza GNU GPL v2.0;
- [CMB2-field-Leaflet-Geocoder](https://github.com/villeristi/CMB2-field-Leaflet-Geocoder) © Ville Ristimäki, licenza MIT;
- [cmb-field-select2](https://github.com/mustardBees/cmb-field-select2) © Phil Wylie, licenza GNU GPL v3.0;
- [cmb2-attached-posts](https://github.com/CMB2/cmb2-attached-posts) © Justin Sternberg, licenza GNU GPL v3.0;
- [cmb2-field-type-font-awesome](https://github.com/serkanalgur/cmb2-field-faiconselect) © Serkan Algur, licenza GNU GPL v3.0;
- [TGM-Plugin-Activation](https://github.com/TGMPA/TGM-Plugin-Activation) © Gary Jones, licenza GNU GPL v2.0;
- [Parsedown](http://parsedown.org) © Aidan Woods, licenza MIT;

## Segnalazione bug

Vuoi segnalare un bug o fare una richiesta?

Prima di tutto assicurati che sia un problema relativo al tema WordPress e non a plugin installati o impostazioni del CMS, poi dai un'occhiata a come creare una [issue](https://github.com/italia/bootstrap-italia/blob/master/CONTRIBUTING.md#creare-una-issue) ed infine, se lo ritieni necessario, apri la issue [in questo repository](https://github.com/italia/design-comuni-wordpress-theme/issues).

## Come contribuire

Vorresti dare una mano contribuendo allo sviluppo del tema?

Se non l'hai già fatto, inizia spendendo qualche minuto per approfondire la tua conoscenza su l'[Architettura dell'Informazione dei siti web dei Comuni Italiani (ODS 65KB)](https://designers.italia.it/files/resources/modelli/comuni/adotta-il-modello-di-sito-comunale/definisci-architettura-e-contenuti/Architettura-informazione-sito-Comuni.ods) e fai riferimento alle [indicazioni su come contribuire](https://github.com/italia/design-comuni-wordpress-theme/blob/main/CONTRIBUTING.md).

A questo punto, è necessario scaricare una copia in locale del tema tramite il comando `git fork https://github.com/italia/design-comuni-wordpress-theme.git` da terminale o cliccando sul pulsante Fork <br>
![fork](https://user-images.githubusercontent.com/69706/188419656-21fa5b0e-c52a-4168-a1d1-8ea9a149da6a.png)

Una volta terminate le modifiche, è necessario aprire una _pull request_ per sottoporle alla revisione del team. 

---

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published
by the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>
