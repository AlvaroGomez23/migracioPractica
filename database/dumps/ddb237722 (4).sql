-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2025 a las 17:35:10
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ddb237722`
--
CREATE DATABASE IF NOT EXISTS `ddb237722` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ddb237722`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `descripcio` varchar(10000) NOT NULL,
  `id_usuari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `nom`, `descripcio`, `id_usuari`) VALUES
(1, 'Lleó', 'El lleó és conegut com el rei de la selva. És un depredador ferotge que viu a les sabanes africanes.', 1),
(2, 'Tigre', 'El tigre és el felí més gran del món, famós per les seves ratlles i la seva força.', 2),
(3, 'Elefant', 'L\'elefant és l\'animal terrestre més gran del planeta, conegut per la seva trompa i grans orelles.', 3),
(4, 'Àguila', 'L\'àguila és un ocell rapinyaire, famosa per la seva visió aguda i la seva capacitat per volar llargues distàncies.', 4),
(6, 'Cocodril', 'El cocodril és un rèptil aquàtic temut per la seva poderosa mossegada i la seva habilitat per esperar les preses.', 1),
(7, 'Girafa', 'La girafa és l\'animal més alt del món, coneguda pel seu llarg coll i la seva capacitat per menjar fulles dels arbres més alts.', 2),
(8, 'Pingüí', 'El pingüí és un ocell que no vola, però és un excel·lent nedador. Viu en regions fredes com l\'Antàrtida.', 3),
(9, 'Rinoceront', 'El rinoceront és un animal robust, conegut pel seu gran tamany i el seu banya al nas.', 4),
(10, 'Cangur', 'El cangur és un marsupial originari d\'Austràlia, famós per la seva gran habilitat per saltar.', 5),
(13, 'Dofí', 'Lo cambio porque el creador de ChatGPT se ha quejado (Santi)', 5),
(14, 'max', 'a', 3),
(17, 'Esto no iba', 'xd', 5),
(18, 'SIIIIIIIIIIIIIIIIIIIIIIIII', '', 10),
(19, 'GRAF', 'Un graf consta de dos conjunts:\r\n• Un conjunt V de punts anomenats nusos, nodes o vèrtexs.\r\n• Un conjunt E de línies que uneixen parelles de nusos i reben el nom d’arestes (si no són\r\ndirigides) o arcs (si són dirigides).\r\nFigura 1: Exemple de graf dirigit\r\n2.4.TERMINOLOGIA\r\nUn graf és no dirigit o simètric si les línies que uneixen parelles de nusos no tenen direcció, mentre\r\nque és dirigit o digraf si les línies tenen una direcció definida.\r\nSuccessors d’un vèrtex són tots aquells vèrtexs als quals es pot accedir a través d’una aresta o d’un\r\narc.\r\nA\r\nC\r\nD\r\nB\r\nE\r\nF\r\nEstructures de dades i algorítmica\r\n- 8 -\r\nAntecessors d’un vèrtex són tots aquells vèrtexs que poden accedir al node en qüestió a través d’una\r\naresta o d’un arc.\r\nEn grafs no dirigits s’utilitza el terme adjacents o veïns ja que no hi ha distinció entre antecessors i\r\nsuccessors.\r\nRep el nom de grau d’un nus, g(v), el nombre d’arestes que el contenen. Si el grau és 0 llavors es\r\ndiu que el nus és aïllat.\r\nReben el nom d’extrems d’una aresta e=[u, v] els nusos u i v.\r\nUn llaç és una aresta o un arc que comença i acaba en el mateix node.\r\nSi un graf no té llaços rep el nom de graf simple. En alguna bibliografia s’anomenen pseudo-grafs\r\nals grafs que contenen llaços.\r\nUn camí P = (v0\r\n,v1\r\n,v2\r\n,.......vn\r\n) és una seqüència de vèrtexs que es troben enllaçats per arcs. En grafs\r\nno dirigits es parlarà de cadenes.\r\nLongitud o cardinalitat d’un camí o d’una cadena és el nombre d’arcs o arestes que el formen. Un\r\ncamí de longitud n tindrà n+1 nusos.\r\nUn circuït és un camí tancat. En grafs no dirigits és parla de cicles.\r\nUn camí és simple si no repeteix arcs.\r\nUn camí és elemental si no repeteix vèrtexs.\r\nUn circuït és hamiltonià si passa un i només un cop per tots els vèrtexs del graf.\r\nUn circuït és eulerià si passa un i només un cop per tots els arcs del graf.\r\nUn graf és connex si existeix un camí entre qualsevol parella dels seus nusos.\r\nEn els grafs, la informació es guarda normalment en els vèrtexs, mentre que les arestes representen\r\nrelacions entre nusos. Si en un graf també es guarda informació en les arestes, llavors es diu que el\r\ngraf està etiquetat, en cas contrari es diu que el graf no està etiquetat.', 18),
(20, 'SAQUENME DE EDA', 'no puedo ams con la practica voy a dejar la carrera ayudaaaaaaa', 18),
(22, 'EXPONIENDO A ALVARITO', 'No respeta la propiedad privada de los artículos. Usen el formato físico, no confíen en el digital', 18),
(23, 'Hola max', 'Fasil', 18),
(24, 'Hola', 'Bones', 5),
(25, 'El admin es dios', 'No hay discusion', 13),
(26, 'BON DIA', 'Odio C++', 18),
(27, 'Estoy cansado jefe', 'No puedo mas con el proyecto de php :((((8', 10),
(28, 'addaad', 'dddd', 13),
(29, 'Probant la bd', 'AAA', 6),
(30, '2nd articl', 'asdadsadasdasdasd', 6),
(31, 'Don quijote', 'En un lugar de la Mancha2, de cuyo nombre no quiero acordarme3, no ha mucho tiempo que vivía un hidalgo de los de lanza en astillero, adarga antigua, rocín flaco y galgo corredor4. Una olla de algo más vaca que carnero, salpicón las más noches5, duelos y quebrantos los sábados6, lantejas los viernes7, algún palomino de añadidura los domingos8, consumían las tres partes de su hacienda9. El resto della concluían sayo de velarte10, calzas de velludo para las fiestas, con sus pantuflos de lo mesmo11, y los días de entresemana se honraba con su vellorí de lo más fino12. Tenía en su casa una ama que pasaba de los cuarenta y una sobrina que no llegaba a los veinte, y un mozo de campo y plaza que así ensillaba el rocín como tomaba la podadera13. Frisaba la edad de nuestro hidalgo con los cincuenta años14. Era de complexión recia, seco de carnes, enjuto de rostro15, gran madrugador y amigo de la caza. Quieren decir que tenía el sobrenombre de «Quijada», o «Quesada», que en esto hay alguna diferencia en los autores que deste caso escriben, aunque por conjeturas verisímilesII se deja entender que se llamaba «Quijana»III, 16. Pero esto importa poco a nuestro cuento: basta que en la narración dél no se salga un punto de la verdad.\r\n\r\nEs, pues, de saber que este sobredicho hidalgo, los ratos que estaba ocioso —que eran los más del año—, se daba a leer libros de caballerías, con tanta afición y gusto, que olvidó casi de todo punto el ejercicio de la caza y aun la administración de su hacienda; y llegó a tanto su curiosidad y desatino en esto17, que vendió muchas hanegas de tierra de sembradura para comprar libros de caballerías en queIV leer18, y, así, llevó a su casa todos cuantos pudo haber dellos; y, de todos, ningunos le parecían tan bienV como los que compuso el famoso Feliciano de Silva19, porque la claridad de su prosa y aquellas entricadas razones suyas le parecían de perlas, y más cuando llegaba a leer aquellos requiebros y cartas de desafíos20, donde en muchas partes hallaba escrito: «La razón de la sinrazón que a mi razón se hace, de tal manera mi razón enflaquece, que con razón me quejo de la vuestra fermosura»21. Y también cuando leía: «Los altos cielos que de vuestra divinidad divinamente con las estrellas os fortifican y os hacen merecedora del merecimiento que merece la vuestra grandeza...»22\r\n\r\nCon estas razones perdía el pobre caballero el juicio, y desvelábase por entenderlas y desentrañarles el sentido, que no se lo sacara ni las entendiera el mesmo Aristóteles, si resucitara para solo ello. No estaba muy bien con las heridas que don Belianís daba y recebía, porque se imaginaba que, por grandes maestros que le hubiesen curado, no dejaría de tener el rostro y todo el cuerpo lleno de cicatrices y señales23. Pero, con todo, alababa en su autor aquel acabar su libro con la promesa de aquella inacabable aventura, y muchas veces le vino deseo de tomar la pluma y dalle fin al pie de la letra como allí se promete24; y sin duda alguna lo hiciera, y aun saliera con ello25, si otros mayores y continuos pensamientos no se lo estorbaran. Tuvo muchas veces competencia con el cura de su lugar —que era hombre docto, graduado en Cigüenza—26 sobre cuál había sido mejor caballero: Palmerín de Ingalaterra o Amadís de Gaula27; mas maese Nicolás, barbero del mesmo pueblo28, decía que ninguno llegaba al Caballero del Febo, y que si alguno se le podía comparar era don Galaor, hermano de Amadís de Gaula, porque tenía muy acomodada condición para todo, que no era caballero melindroso, ni tan llorón como su hermano, y que en lo de la valentía no le iba en zaga29.', 6),
(32, 'probar con el admin', 'abhdsidefs', 13),
(33, 'primer articulo de caveman', 'si', 13),
(34, 'Caveman ha vuelto', 'Siu', 33),
(35, 'Hola primer articulo clonado', 'Bonesfvdhsaifgdwsqiòdfhnt34rg', 6),
(36, 'Article de prova', 'Lorem ipsum dolor sit amet consectetur adipiscing elit felis, iaculis tincidunt per natoque laoreet pharetra facilisis, donec lacinia massa non sagittis erat at. Netus nascetur taciti natoque donec phasellus tempus mauris, consequat nullam sagittis etiam eleifend accumsan molestie morbi, dictum dignissim eget urna inceptos fames. Conubia pretium maecenas etiam massa id egestas in commodo netus torquent enim pellentesque, tortor metus venenatis morbi lacus sociosqu convallis nibh sollicitudin porta.', 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilles`
--

CREATE TABLE `plantilles` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `descripcio` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `plantilles`
--

INSERT INTO `plantilles` (`id`, `nom`, `descripcio`) VALUES
(1, 'Gat', 'Animal petit i domèstic amb bigotis i habilitats per caçar ratolins.'),
(2, 'Gos', 'Fidel company de les persones, conegut per la seva lleialtat.'),
(3, 'Lleó', 'Gran felí salvatge conegut com el rei de la selva.'),
(4, 'Tigre', 'Felí gran i poderós amb ratlles negres i taronges.'),
(5, 'Elefant', 'El mamífer terrestre més gran amb una trompa llarga.'),
(6, 'Dofí', 'Mamífer marí intel·ligent conegut pel seu comportament juganer.'),
(7, 'Àguila', 'Ocell rapinyaire amb una vista excepcional i ales poderoses.'),
(8, 'Guineu', 'Animal astut amb una cua llarga i pelatge vermellós.'),
(9, 'Pingüí', 'Ocell que no vola, conegut pel seu caminar graciós i hàbitat fred.'),
(10, 'Ós bru', 'Gran mamífer amb un pelatge espès, sovint trobat als boscos.'),
(11, 'Cérvol', 'Animal herbívor amb banyes, sovint vist en zones boscoses.'),
(12, 'Serp', 'Rèptil lliscant sense potes que pot ser tòxic.'),
(13, 'Cavall', 'Animal elegant conegut per la seva velocitat i ús en transport.'),
(14, 'Gallina', 'Ocell domèstic que posa ous, present a moltes granges.'),
(15, 'Tortuga', 'Rèptil amb una closca dura que pot viure molts anys.'),
(16, 'Panda vermell', 'El panda roig, també conegut com a panda menor o panda de foc, és un mamífero originari de les zones muntanyoses de l\'Himàlaia i el sud-oest de la Xina. Té un pelatge d\'un color vermellós-taronja, amb una cua llarga i anellada.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `contrasenya` varchar(300) NOT NULL,
  `token` varchar(200) NOT NULL,
  `tokenExpire` varchar(2000) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `oauth` varchar(1000) NOT NULL,
  `jwt` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `nom`, `email`, `contrasenya`, `token`, `tokenExpire`, `foto`, `oauth`, `jwt`) VALUES
(1, 'Pedro', 'pedro@sapalomera.cat', '$2y$10$0GNNB4srFuQzTXEAzPGDR.qgOqVU31LESN9XBz3mhZPF.edWTJhP.', '', '', '', '', ''),
(2, 'Antonio', 'antonio@sapalomera.cat', '$2y$10$.IsNFUOWoFep.Lj6aMabq.IkrOxkRJddC/MiR900G095/iWoW.9oy', 'e866a5b927ae46f736327a6e6282510b', '2024-11-15 19:01:00', '', '', ''),
(3, 'Jose', 'jose@sapalomera.cat', '$2y$10$.pSySRuQhN8QQRU2OwoODuAAVb7HrgXxEkB2NdfCswAiWJeSRaGnK', '', '', '', '', ''),
(4, 'Marta', 'marta@saplomera.cat', '$2y$10$H4aLCdxdR4Krk52zHGKPlOV7uhzUc7oEYg.LEEjBzon8.4nsh7meq', '', '', '', '', ''),
(5, 'Xavi', 'xavi@sapalomera.cat', '$2y$10$IEpImQ5X37WMud2G5z1lqe9Gw2ahTQpjgt6FF6bZXWsLmwPToqSh6', '0ab433285c620a884e12ed35a30a657b', '2024-11-15 20:21:44', 'foto.jpg', '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzg3ODI2NTEsImV4cCI6MTczODc4NjI1MSwidXNlcklkIjo1fQ.tuPAvfJVChYbEBqCyfrFkL-8z2x6En1WwQF8ETsqp94'),
(6, 'Alvaro', 'a.gomez9@sapalomera.cat', '$2y$10$n/TRIGkBqD86ZOb3LvEOCe05slM7FFA0f4z5gSyorSmVbzgKHok9y', '19789e9464010822a54444437f42c05a', '2025-01-17 11:47:58', 'fotos/perfil_678e607511e5b8.71330441.jpg', '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDAzOTIwNjAsImV4cCI6MTc0MDM5NTY2MCwidXNlcklkIjo2fQ.RLa8YNvsH7uM4mMqKD2n9pah43pH3yl3neavsw_J8MM'),
(7, 'Prova1', 'e@e.com', '$2y$10$EDQQNYChipAIRgCnePXUTunqCnWBoT5IfEuJ2fx5.shH7mjVS.Sv2', '', '', '', '', ''),
(8, 'Carlos', 'carlos@sapalomera.cat', '$2y$10$j/EHpsVAvZUGPxOJIEnuNebFbIIm.z98MSjEmbszrz3tHHTPBUqxW', '', '', '', '', ''),
(9, 'Alvaro', 'caballo@max.com', '$2y$10$jHHE1mGbzGlT2V64pvbxr.WwG5841kEAm4GO63s3dbKr1uqNX7Ije', '', '', '', '', ''),
(10, 'Jose', 'j.gomez4@sapalomera.cat', '$2y$10$a8vSxa49cr9E587ApM4u4e/gVhFz03PdPMPr/CPFV3mzq8iSn3HNa', '', '', '', '', ''),
(12, 'Guyot', 'lavern_stanton@moneysquad.org', '$2y$10$201oJvmCoRfi9XyPrEhKZeYsxtApToPkLrhrWE/p35yukGCId2sPq', '', '', '', '', ''),
(13, 'admin', 'admin@alvarogomez.cat', '$2y$10$513brwbOATnwJBU99PdDUOCahSPl1SAkH9Jw0GaCFk7Qqh3P4v2t.', '', '', 'fotos/perfil_678e8d06da3722.87443845.svg', '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3NDAzOTEzMTksImV4cCI6MTc0MDM5NDkxOSwidXNlcklkIjoxM30.4wevCdTkaCQ_6OCnXpbfOUkA4O8yf197bBQRYm9gRNg'),
(14, 'Albondiga', 'albondigaRegordita@hotmail.com', '$2y$10$XGrBMyPdU9IDImjEGVMXmeDya7mtHI3G4tBcq3Kvmi0Lh6SFNIWTG', '', '', '', '', ''),
(18, 'maxsalvil', 'maxsalvil25@gmail.com', '', '', '', 'https://avatars.githubusercontent.com/u/190351119?v=4', 'GitHub', ''),
(24, 'RaviOli2621', 'ravirubio2621@gmail.com', '', '', '', 'https://avatars.githubusercontent.com/u/147045307?v=4', 'GitHub', ''),
(27, 'Álvaro Gómez Moreno', 'alvarogomezmoreno23@gmail.com', '', '', '', '?PNG\r\n\Z\n\0\0\0\rIHDR\0\0?\0\0?\0\0\0???|\0\0\0sRGB\0???\0\0\0gAMA\0\0???a\0\0\0	pHYs\0\0t\0\0t?fx\0\0?fIDATx^?????', 'GitHub', ''),
(33, 'Caveman', 'caveman@piedra.com', '$2y$10$LoynZd/wtFIJOoYSUansl.t93f/btR87pRR2O6QzEd8ZzzGol6pFu', '', '', 'fotos/perfil_6793c83c41c3d2.96152782.jpg', '', ''),
(41, 'barbaro', 'barbarian@b.com', '$2y$10$Cn6NK999uyQJfkt1cgD6fu8P17ct0DFd/bmQCN1oRzlc2En9xEqkO', '', '', 'fotos/perfil_6797ca452843c2.69376698.png', '', ''),
(42, 'interficies', 'interficies@sapalomera.cat', '$2y$10$h9ZG4/SFBI9ImdICZ2e.u..ECVYb95JykP2.KjnqUudVOh5DhhxCa', '', '', '', '', ''),
(43, 'admin', 'admin@interficies.cat', '$2y$10$QZP5BW9UsHGllG30n5F/8.ivIjNURLpEiNZNOlZt9MpbDbxLRAVhi', '', '', '', '', ''),
(45, 'admin', 'xavi@alvarogomez.cat', '$2y$10$dCDR0mKERhigSRftQtwZyu/S7/XlCKc9XP0PjgSiKM5Ff8gvXQ.y.', '', '', '', '', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE3Mzg3ODEyNzAsImV4cCI6MTczODc4NDg3MCwidXNlcklkIjo0NX0.l7VZ6x88_dgcZ2Z-p2e_7hJVK9biGScJ9F8v09LaUhg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indices de la tabla `plantilles`
--
ALTER TABLE `plantilles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `plantilles`
--
ALTER TABLE `plantilles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
