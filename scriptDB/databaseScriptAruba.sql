SET NAMES 'utf8mb4';
SET CHARACTER SET utf8mb4;

DROP TABLE IF EXISTS Utente;
DROP TABLE IF EXISTS ArgomentoVideo;
DROP TABLE IF EXISTS Argomento;
DROP TABLE IF EXISTS Video;
DROP TABLE IF EXISTS Materia;

CREATE TABLE IF NOT EXISTS Utente(
    id int UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(60) NOT NULL,
    cognome VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL,
    password VARCHAR(256) NOT NULL,
    CONSTRAINT emailKey UNIQUE(email),
    CONSTRAINT nomeCognomeUnique UNIQUE(nome,cognome)
);

SELECT "Tabella Utente Creata" as "";

CREATE TABLE IF NOT EXISTS Video(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(150) NOT NULL,
    descrizione TEXT,
    autore VARCHAR(50),
    durata TIME NOT NULL,
    image VARCHAR(200),
    link VARCHAR(200) NOT NULL,
    lingua VARCHAR(50) NOT NULL,
    CONSTRAINT linkUnique UNIQUE(link),
    CONSTRAINT titoloAutoreUnique UNIQUE(titolo,autore)
);

SELECT "Tabella Video Creata" as "";

CREATE TABLE IF NOT EXISTS Materia(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    CONSTRAINT nomeMateria UNIQUE(nome)
);

SELECT "Tabella Materia Creata" as "";

CREATE TABLE IF NOT EXISTS Argomento(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    materia INT UNSIGNED,
    CONSTRAINT Argomento_Materia FOREIGN KEY (materia) REFERENCES Materia(id) ON DELETE SET NULL ON UPDATE CASCADE
);

SELECT "Tabella Argomento Creata" as "";

CREATE TABLE IF NOT EXISTS ArgomentoVideo(
    video INT UNSIGNED NOT NULL,
    argomento INT UNSIGNED NOT NULL,
    CONSTRAINT videoFK FOREIGN KEY (video) REFERENCES Video(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT argomentoFK FOREIGN KEY (argomento) REFERENCES Argomento(id) ON DELETE CASCADE ON UPDATE CASCADE
);

SELECT "Tabella ArgomentoVideo Creata" as "";

INSERT INTO Utente(nome,cognome,email,password) VALUES ("admin","","doc-inf@itisvallauri.edu.it","108b95a0efb0f7a8a1ac4176281e565795fc4ccd5d0be9cd713983e5ca0cad9e");

SELECT "Utenti inseriti con successo" as "";

INSERT INTO Materia(nome) VALUES ('Biologia'),
                                ('Scienze della Terra'),
                                ('Chimica');

SELECT "Materie inserite" as "";

INSERT INTO Video(titolo,descrizione,autore,durata,image,link,lingua) VALUES ('WHAT HAPPENS INSIDE YOUR BODY?','Descrizione: Have you ever wondered how little we know about our bodies? The human body is an amazing and unique machine that triggers thousands of processes every second. Today, we\'re about to look at all the processes that are going on in the very depths of man!
    What is the easiest way to get in? 0:44
    40,000 bacteria in the human mouth 1:37
    He\'s waking up! 3:15
    The circulatory system 3:33
    The collective lens 4:33
    The human ear 5:33
    The human brain 6:03

    Interesting facts about the human body:
    - An interesting fact, people who live in cities have more hair in their noses than those who live in the countryside, and it\'s thicker and stiffer. 
    - 8 to 30% of people around the world gnash their teeth while sleeping, it\'s called bruxism.
    - There are about 40,000 bacteria in the human mouth, but most of them aren\'t harmful. 
    - An adult person performs around 23,000 inhalations and exhalations a day.
    - When sneezing, the speed of air flow reaches 60 miles per hour!
    - Our heart pumps around 182 million liters of blood during our lifetime.
    - The cornea and lens are pretty much collective lenses, so they invert the image when it reaches the retina of the eye. 
    - 100,000 chemical reactions occur in our brain every single second.
    - When a person swallows, the larynx usually closes in order to prevent food from getting into the respiratory tract. But while talking, the larynx might remain open.
','BRIGHT SIDE','00:08:06','https://img.youtube.com/vi/kw9EJbezlK4/0.jpg','https://www.youtube.com/watch?v=kw9EJbezlK4','inglese'),
('Virtual Plant Cell: Cell Explore, 2018','See www.plantenergy.edu.au/outreach/resources for materials to support classroom use of VPC: Cell Explore. Note, this is a curriculum-aligned resource.
VPC: Cell Explore - immerse yourself in the inner world of a plant cell. Learn about the key organelles and structures that make up plant cells. 
Virtual Plant Cell (VPC) is a suite of educational virtual reality experiences created by the ARC Centre of Excellence in Plant Energy Biology. Explore and learn about the sub-microscopic inner world of a plant. www.plantenergy.edu.au/VPC',
'Plant Energy Biology','00:05:57','https://img.youtube.com/vi/rmgf0VDDlH8/0.jpg','https://www.youtube.com/watch?v=rmgf0VDDlH8','Inglese'),
('Panorama Inside a Cell','Descrizione: Tech demo for a 360° medical panorama animation illustrating the organelles inside a  cell.','Ribosome Studio','00:00:46','https://img.youtube.com/vi/HhuMYEyhPmY/0.jpg','https://www.youtube.com/watch?v=HhuMYEyhPmY','Inglese'),
('Beginnings of a Human Cell','A 3D animation about the functions and molecular components of a human cell as the cell is signaled to divide after conception.','St. Jude Children\'s Research Hospital ','00:03:06','https://img.youtube.com/vi/GdQBe2Efl9w/0.jpg','https://www.youtube.com/watch?v=GdQBe2Efl9w','Inglese'),
('360° Guided Tour of the Cell','Take a short, narrated trip through a cell to see the nucleus, DNA, ribosomes, mitochondria, and more in this immersive Virtual Reality video!

HOW TO: If you are watching on an Android mobile device, you can view the animation in stereoscopic 3D by clicking the Google Cardboard icon in the lower right (Google Cardboard required). If you are watching on an iOS device (iPhone or iPad), you must download and launch the YouTube app to see the interactive video. If you are watching on a desktop browser, use the control pad in the top left corner to navigate the full 360° view (or click and drag with your mouse). To eliminate blurriness, go to Settings (gear in bottom right corner) and set Quality to the highest possible level. ',
'Nucleus Medical Media','00:01:12','https://img.youtube.com/vi/rKS-vvhMV6E/0.jpg','https://www.youtube.com/watch?v=rKS-vvhMV6E','Inglese'),
('VR 360 Animation - Inside the Human Body','A VR 360 demo animation produced by SciencePicture.Co featuring scenes inside the human body. 

Best viewed in VR on Oculus, Vive, Google Cardboard or similar devices.','Science Picture Company','00:01:05','https://img.youtube.com/vi/j_1spv3n7jA/0.jpg','https://www.youtube.com/watch?v=j_1spv3n7jA','Inglese'),
('Chapter 1: Introduction to the Animal Cell','This is the first sample video in the AP Biology VR series, created in collaboration with the School of Interactive Computing at Georgia Tech. For more such sample videos, be sure to follow our YouTube channel!','Inspirit','00:05:30','https://img.youtube.com/vi/PzxxEVdM1xI/0.jpg','https://www.youtube.com/watch?v=PzxxEVdM1xI','Inglese'),
('The Nucleus and the Endoplasmic Reticulum','Check out free interactive science labs at https://www.inspiritvr.com
___________________________________________________________________________
This is the second sample video in the AP Biology VR series, created in collaboration with the School of Interactive Computing at Georgia Tech. For more such sample videos, be sure to follow our YouTube channel!','Inspirit','00:06:18','https://img.youtube.com/vi/s1NzeCxAp7w/0.jpg','https://www.youtube.com/watch?v=s1NzeCxAp7w','Inglese'),
('Introduction to the DNA','Check out free interactive science labs at https://www.inspirit.academy/
___________________________________________________________________________
This is the sixth sample video in the AP Biology VR series, created in collaboration with the School of Interactive Computing at Georgia Tech. For more such sample videos, be sure to follow our YouTube channel!','Inspirit','00:04:03','https://img.youtube.com/vi/xoSWNLSnj1g/0.jpg','https://www.youtube.com/watch?v=xoSWNLSnj1g','Inglese'),
('Visit the ALBA Synchrotron in 360º','Visit ALBA like you were here! Move the screen to rotate 360º and look at everything the synchrotron has to offer you. You\'ve never had the accelerator tunnel and the beamlines so close!','ALBA Synchrotron','00:46:02','https://img.youtube.com/vi/hqnaYgImUmE/0.jpg','https://youtu.be/hqnaYgImUmE','Inglese'),
('Green Tomorrow: oceani di plastica, la minaccia da affrontare subito','L\'aggressione della plastica ai nostri mari: 150 milioni di tonnellate già accumulate negli oceani. Ogni anno 8 milioni di tonnellate in più','euronews','00:02:14','https://img.youtube.com/vi/pfszWkTKxOY/0.jpg','https://www.youtube.com/watch?v=pfszWkTKxOY','Italiano'),
('VR 360 EARTHQUAKE SURVIVAL - Natural Disaster: Up-close 360 video','an you escape from a huge Earthquake Disaster?
This video is a virtual simulation. A real workout that will tell you what to do in case of a Earthquake!

An earthquake (also known as a quake, tremor or temblor) is the shaking of the surface of the Earth resulting from a sudden release of energy in the Earth\'s lithosphere that creates seismic waves. Earthquakes can range in intensity, from those that are so weak that they cannot be felt, to those violent enough to propel objects and people into the air and wreak destruction across entire cities. The seismicity, or seismic activity, of an area is the frequency, type, and size of earthquakes experienced over a particular time period. The word tremor is also used for non-earthquake seismic rumbling.

At the Earth\'s surface, earthquakes manifest themselves by shaking and displacing or disrupting the ground. When the epicenter of a large earthquake is located offshore, the seabed may be displaced sufficiently to cause a tsunami. Earthquakes can also trigger landslides and, occasionally, volcanic activity.

In its most general sense, the word earthquake is used to describe any seismic event—whether natural or caused by humans—that generates seismic waves. Earthquakes are caused mostly by rupture of geological faults but also by other events such as volcanic activity, landslides, mine blasts, and nuclear tests. An earthquake\'s point of initial rupture is called its hypocenter or focus. The epicenter is the point at ground level directly above the hypocenter.','BRIGHT SIDE VR 360 VIDEOS','00:01:24','https://img.youtube.com/vi/rVdZ4ges9rU/0.jpg','https://www.youtube.com/watch?v=rVdZ4ges9rU','Inglese'),
('Ercolano - L\'Eruzione - video 360° App 3D','Oggi, 27 giugno 2020,  vi presentiamo il nuovo video a 360° elaborato da TimeLooper per la nostra nuova App 3d realizzata da D\'Uva . Nel secondo capitolo ritorniamo nel 79 d.c. durante l\'eruzione del Vesuvio, quando la colonna vulcanica collassò su sé stessa ed il primo di una serie di flussi piroclastici investì Herculaneum.. ','Parco Archeologico di Ercolano','00:02:43','https://img.youtube.com/vi/ZOZNjNVwaZY/0.jpg','https://www.youtube.com/watch?v=ZOZNjNVwaZY','Italiano'),
('TSUNAMI-HIT SCHOOL VR/360 Video','Tsunami-hit school 360° Animation - Experience in [3D, VR, 4K] Video','VR Planet','00:03:13','https://img.youtube.com/vi/6t6KKK9yXdg/0.jpg','https://www.youtube.com/watch?v=6t6KKK9yXdg','Inglese'),
('How the Earth was Formed #360 #4k','This 4K 360 VR video is a very immersive 3D animated educational presentation of how the earth was form. A great educational video as well as a fantastic video to demonstrate the strength of using VR for educational and training purposes in schools','Virtasia tv','00:01:46','https://img.youtube.com/vi/zw-IIkxv6G4/0.jpg','https://youtu.be/zw-IIkxv6G4','Inglese');

/*('','','','','https://img.youtube.com/vi//0.jpg','','Inglese');*/
/*('','','','',LOAD_FILE(@img10),'','Inglese');*/

SELECT 'INSERIMENTO DEI VIDEO COMPLETATO' as '';

INSERT INTO Argomento(id,nome,materia) VALUES (1,"Cell",1), (2,"cellula",1), 
(3,"The circulatory system",1),(4,"The collective lens",1),(5,"The human ear",1),
(6,"The human brain",1),(7,"Human Body",1),(8,"Corpo Umano",1),(9,"Il Nucleo",1),
(10,"The Nucleus",1), (11,"Reticolo Endoplasmatico",1),(12,"Endoplasmic Reticulum",1),
(13,"DNA",1),(14,"ALBA Synchrotron",3),(15,"Sincrotrone",3),(16,"Inquinamento",2),
(17,"Inquinamento plastiche",2),(18,"EARTHQUAKE",2),(19,"Terremoto",2),
(20,"Ercolano",2), (21,"Eruzione",2),(22,"Tsunami",2),(23,"Formazione della Terra",2),
(24,"How the Earth was Formed",2), (25,"EARTHQUAKES",2),(26,"Terremoti",2),
(27,"Cellule",1),(28,"plastica",2),(29,"vulcano",2),(30,"vulcani",2);

SELECT 'INSERIMENTO DEGLI ARGOMENTI COMPLETATO' as '';

INSERT INTO ArgomentoVideo(video, argomento) VALUES (1,1), (1,2), (1,3), (1,4), 
(1,5), (1,6), (2,1), (2,2), (3,1), (3,2), (4,1), (4,2), (5,1), (5,2), (6,7), 
(6,8), (7,1), (7,2), (8,9), (8,10), (8,11), (8,12), (9,13), (10,14), (10,15), 
(11,16), (11,17), (12,18), (12,19), (13,20), (13,21), (14,22), (15,23), (15, 24),
 (12,25), (12,26), (1,27), (2,27), (3,27), (4,27), (5,27), (11,28), (13,29), 
 (13,30);

SELECT 'ASSOCIAZIONE DEGLI ARGOMENTI AI VIDEO COMPLETATO' as '';

    
    

