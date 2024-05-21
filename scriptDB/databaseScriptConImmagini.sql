DROP DATABASE IF EXISTS Visori;

CREATE DATABASE Visori;
USE VISORI;

SET @imageDir = 'C:/Users/andre/Documents/ProgettoVisori/ContenutiDatabase/images/';

CREATE TABLE Video(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(50) NOT NULL,
    descrizione TEXT,
    autore VARCHAR(50),
    durata TIME NOT NULL,
    image BLOB,
    link VARCHAR(200) NOT NULL,
    lingua VARCHAR(50) NOT NULL
);

SELECT "Tabella Video Creata" as "";

CREATE TABLE Materia(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    CONSTRAINT nomeMateria UNIQUE(nome)
);

SELECT "Tabella Materia Creata" as "";

CREATE TABLE Argomento(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL,
    materia INT UNSIGNED,
    CONSTRAINT Argomento_Materia FOREIGN KEY (materia) REFERENCES Materia(id) ON DELETE SET NULL ON UPDATE CASCADE
);

SELECT "Tabella Argomento Creata" as "";

CREATE TABLE ArgomentoVideo(
    video INT UNSIGNED NOT NULL,
    argomento INT UNSIGNED NOT NULL,
    CONSTRAINT videoFK FOREIGN KEY (video) REFERENCES Video(id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT argomentoFK FOREIGN KEY (argomento) REFERENCES Argomento(id) ON DELETE CASCADE ON UPDATE CASCADE
);

SELECT "Tabella ArgomentoVideo Creata" as "";

INSERT INTO Materia(nome) VALUES ('Biologia'),
                                ('Scienze della Terra'),
                                ('Chimica');

SELECT "Materie inserite" as "";

SET @img1 = CONCAT( @imageDir, 'WHAT_HAPPENS INSIDE_YOUR BODY.jpg');
SET @img2 = CONCAT( @imageDir, 'Virtual_Plant_Cell.jpg');
SET @img3 = CONCAT( @imageDir, 'Panorama_Inside_a_Cell.jpg');
SET @img4 = CONCAT( @imageDir, 'Beginnings_of_a_Human_Cell.jpg');
SET @img5 = CONCAT( @imageDir, '360_Guided_Tour_of_the_Cell.jpg');
SET @img6 = CONCAT( @imageDir, 'Inside_the_Human_Body.jpg');
SET @img7 = CONCAT( @imageDir, 'Introduction_to_the_Animal_Cell.jpg');
SET @img8 = CONCAT( @imageDir, 'The_Nucleus_and_the_Endoplasmic_Reticulum.jpg');
SET @img9 = CONCAT( @imageDir, 'Introduction_to_the_DNA.jpg');
/*SET @img10 = CONCAT( @imageDir, 'Introduction_to_the_Animal_Cell.jpg');*/

INSERT INTO Video(titolo,descrizione,autore,durata,image,link,lingua) VALUES ('WHAT HAPPENS INSIDE YOUR BODY?','Descrizione: Have you ever wondered how little we know about our bodies? The human body is an amazing and unique machine that triggers thousands of processes every second. Today, we\'re about to look at all the processes that are going on in the very depths of man!
    What is the easiest way to get in? 0:44
    40,000 bacteria in the human mouth 1:37
    He’s waking up! 3:15
    The circulatory system 3:33
    The collective lens 4:33
    The human ear 5:33
    The human brain 6:03

    Interesting facts about the human body:
    - An interesting fact, people who live in cities have more hair in their noses than those who live in the countryside, and it’s thicker and stiffer. 
    - 8 to 30% of people around the world gnash their teeth while sleeping – it’s called bruxism.
    - There are about 40,000 bacteria in the human mouth, but most of them aren\'t harmful. 
    - An adult person performs around 23,000 inhalations and exhalations a day.
    - When sneezing, the speed of air flow reaches 60 miles per hour!
    - Our heart pumps around 182 million liters of blood during our lifetime.
    - The cornea and lens are pretty much collective lenses, so they invert the image when it reaches the retina of the eye. 
    - 100,000 chemical reactions occur in our brain every single second.
    - When a person swallows, the larynx usually closes in order to prevent food from getting into the respiratory tract. But while talking, the larynx might remain open.
','BRIGHT SIDE','00:08:06',LOAD_FILE(@img1),'https://www.youtube.com/watch?v=kw9EJbezlK4','inglese'),
('Virtual Plant Cell: Cell Explore, 2018','See www.plantenergy.edu.au/outreach/resources for materials to support classroom use of VPC: Cell Explore. Note, this is a curriculum-aligned resource.
VPC: Cell Explore - immerse yourself in the inner world of a plant cell. Learn about the key organelles and structures that make up plant cells. 
Virtual Plant Cell (VPC) is a suite of educational virtual reality experiences created by the ARC Centre of Excellence in Plant Energy Biology. Explore and learn about the sub-microscopic inner world of a plant. www.plantenergy.edu.au/VPC',
'Plant Energy Biology','00:05:57',LOAD_FILE(@img2),'https://www.youtube.com/watch?v=rmgf0VDDlH8','Inglese'),
('Panorama Inside a Cell','Descrizione: Tech demo for a 360° medical panorama animation illustrating the organelles inside a  cell.','Ribosome Studio','00:00:46',LOAD_FILE(@img3),'https://www.youtube.com/watch?v=HhuMYEyhPmY','Inglese'),
('Beginnings of a Human Cell','A 3D animation about the functions and molecular components of a human cell as the cell is signaled to divide after conception.','St. Jude Children\'s Research Hospital ','00:03:06',LOAD_FILE(@img4),'https://www.youtube.com/watch?v=GdQBe2Efl9w','Inglese'),
('360° Guided Tour of the Cell','Take a short, narrated trip through a cell to see the nucleus, DNA, ribosomes, mitochondria, and more in this immersive Virtual Reality video!

HOW TO: If you are watching on an Android mobile device, you can view the animation in stereoscopic 3D by clicking the Google Cardboard icon in the lower right (Google Cardboard required). If you are watching on an iOS device (iPhone or iPad), you must download and launch the YouTube app to see the interactive video. If you are watching on a desktop browser, use the control pad in the top left corner to navigate the full 360° view (or click and drag with your mouse). To eliminate blurriness, go to Settings (gear in bottom right corner) and set Quality to the highest possible level. ',
'Nucleus Medical Media','00:01:12',LOAD_FILE(@img5),'https://www.youtube.com/watch?v=rKS-vvhMV6E','Inglese'),
('VR 360 Animation - Inside the Human Body','A VR 360 demo animation produced by SciencePicture.Co featuring scenes inside the human body. 

Best viewed in VR on Oculus, Vive, Google Cardboard or similar devices.','Science Picture Company','00:01:05',LOAD_FILE(@img6),'https://www.youtube.com/watch?v=j_1spv3n7jA','Inglese'),
('Chapter 1: Introduction to the Animal Cell','This is the first sample video in the AP Biology VR series, created in collaboration with the School of Interactive Computing at Georgia Tech. For more such sample videos, be sure to follow our YouTube channel!','Inspirit','',LOAD_FILE(@img7),'00:05:30','Inglese'),
('The Nucleus and the Endoplasmic Reticulum','Check out free interactive science labs at https://www.inspiritvr.com
___________________________________________________________________________
This is the second sample video in the AP Biology VR series, created in collaboration with the School of Interactive Computing at Georgia Tech. For more such sample videos, be sure to follow our YouTube channel!','Inspirit','00:06:18',LOAD_FILE(@img8),'https://www.youtube.com/watch?v=s1NzeCxAp7w','Inglese'),
('Introduction to the DNA','Check out free interactive science labs at https://www.inspirit.academy/
___________________________________________________________________________
This is the sixth sample video in the AP Biology VR series, created in collaboration with the School of Interactive Computing at Georgia Tech. For more such sample videos, be sure to follow our YouTube channel!','Inspirit','00:04:03',LOAD_FILE(@img9),'https://www.youtube.com/watch?v=xoSWNLSnj1g','Inglese');


/*('Visit the ALBA Synchrotron in 360º','','','',LOAD_FILE(@img9),'','Inglese');*/
/*('','','','',LOAD_FILE(@img10),'','Inglese');*/

SELECT 'INSERIMENTO DEI VIDEO COMPLETATO' as '';

INSERT INTO Argomento(nome,materia) VALUES ("The Cell",1), ("La cellula",1), 
("The circulatory system",1),("The collective lens",1),("The human ear",1),
("The human brain",1),("Human Body",1),("Corpo Umano",1),("Il Nucleo",1),
("The Nucleus",1), ("Reticolo Endoplasmatico",1),("Endoplasmic Reticulum",1),
("DNA",1),("ALBA Synchrotron",3),("Sincrotrone",3),("Inquinamento",2),
("Inquinamento plastiche",2),("EARTHQUAKE",2),("Terremoto",2),("Ercolano",2),
("Eruzione",2),("Tsunami",2),("Formazione della Terra",2),
("How the Earth was Formed",2);

SELECT 'INSERIMENTO DEGLI ARGOMENTI COMPLETATO' as '';

INSERT INTO ArgomentoVideo(video, argomento) VALUES (1,1), (1,2), (1,3), (1,4), 
(1,5), (1,6), (2,1), (2,2), (3,1), (3,2), (4,1), (4,2), (5,1), (5,2), (6,7), 
(6,8), (7,1), (7,2), (8,9), (8,10), (8,11), (8,12), (9,13), (10,14), (10,15), 
(11,16), (11,17), (12,18), (12,19), (13,20), (13,21), (14,22), (15,23), (15, 24);

SELECT 'ASSOCIAZIONE DEGLI ARGOMENTI AI VIDEO COMPLETATO' as '';

