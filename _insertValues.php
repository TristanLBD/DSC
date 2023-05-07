<?php
    include_once("./includes/connection.inc.php");
    $insertPompier = [    
        ["Matricule" => 111111,"NomPompier" => "Leblond","PrenomPompier" => "Tristan","DateNaissPompier" => "2003-01-15","TellPompier" => "0674985719","SexePompier" => "masculin","idGrade" => 13],
        ["Matricule" => 222222,"NomPompier" => "Dupont","PrenomPompier" => "Marie","DateNaissPompier" => "2001-07-20","TellPompier" => "0645678912","SexePompier" => "féminin","idGrade" => 5],
        ["Matricule" => 333333,"NomPompier" => "Gagnon","PrenomPompier" => "Jean","DateNaissPompier" => "1998-12-01","TellPompier" => "0601020304","SexePompier" => "masculin","idGrade" => 9],
        ["Matricule" => 444444,"NomPompier" => "Lavoie","PrenomPompier" => "Sophie","DateNaissPompier" => "2002-03-12","TellPompier" => "0612345678","SexePompier" => "féminin","idGrade" => 2],
        ["Matricule" => 555555,"NomPompier" => "Bélanger","PrenomPompier" => "Éric","DateNaissPompier" => "1999-05-04","TellPompier" => "0687654321","SexePompier" => "masculin","idGrade" => 7],
        ["Matricule" => 666666,"NomPompier" => "Tremblay","PrenomPompier" => "Julie","DateNaissPompier" => "2000-11-28","TellPompier" => "0698765432","SexePompier" => "féminin","idGrade" => 4],
        ["Matricule" => 777777,"NomPompier" => "Desjardins","PrenomPompier" => "David","DateNaissPompier" => "1997-08-15","TellPompier" => "0611223344","SexePompier" => "masculin","idGrade" => 11],
        ["Matricule" => 888888,"NomPompier" => "Bergeron","PrenomPompier" => "Catherine","DateNaissPompier" => "2004-02-29","TellPompier" => "0677889900","SexePompier" => "féminin","idGrade" => 6],
        ["Matricule" => 999999,"NomPompier" => "Leclerc","PrenomPompier" => "Nicolas","DateNaissPompier" => "1995-09-03","TellPompier" => "0654321098","SexePompier" => "masculin","idGrade" => 8],
        ["Matricule" => 101010,"NomPompier" => "Lévesque","PrenomPompier" => "Amélie","DateNaissPompier" => "2005-06-17","TellPompier" => "0634567890","SexePompier" => "féminin","idGrade" => 3],
        ["Matricule" => 121212,"NomPompier" => "Roy","PrenomPompier" => "Vincent","DateNaissPompier" => "1996-04-23","TellPompier" => "0678901234","SexePompier" => "masculin","idGrade" => 12],
        ["Matricule" => 131313,"NomPompier" => "Lapierre","PrenomPompier" => "Stéphanie","DateNaissPompier" => "2006-09-08","TellPompier" => "0689012345","SexePompier" => "féminin","idGrade" => 1],
        ["Matricule" => 141414,"NomPompier" => "Côté","PrenomPompier" => "Gabriel","DateNaissPompier" => "1994-12-11","TellPompier" => "0645678901","SexePompier" => "masculin","idGrade" => 10],
        ["Matricule" => 151515,"NomPompier" => "Bouchard","PrenomPompier" => "Sophie","DateNaissPompier" => "2003-07-05","TellPompier" => "0607080910","SexePompier" => "féminin","idGrade" => 8],
        ["Matricule" => 161616,"NomPompier" => "Gagnon","PrenomPompier" => "Mélanie","DateNaissPompier" => "1999-11-22","TellPompier" => "0678912345","SexePompier" => "féminin","idGrade" => 7],
        ["Matricule" => 171717,"NomPompier" => "Tremblay","PrenomPompier" => "Simon","DateNaissPompier" => "1992-03-12","TellPompier" => "0643219876","SexePompier" => "masculin","idGrade" => 5],
        ["Matricule" => 181818,"NomPompier" => "Bélanger","PrenomPompier" => "Julie","DateNaissPompier" => "2004-02-19","TellPompier" => "0654321987","SexePompier" => "féminin","idGrade" => 11],
        ["Matricule" => 191919,"NomPompier" => "Morin","PrenomPompier" => "Alexandre","DateNaissPompier" => "1997-09-30","TellPompier" => "0612345678","SexePompier" => "masculin","idGrade" => 6],
        ["Matricule" => 202020,"NomPompier" => "Poirier","PrenomPompier" => "Émilie","DateNaissPompier" => "2002-08-08","TellPompier" => "0623456789","SexePompier" => "féminin","idGrade" => 9],
        ["Matricule" => 212121,"NomPompier" => "Beaulieu","PrenomPompier" => "Samuel","DateNaissPompier" => "1995-05-25","TellPompier" => "0676543210","SexePompier" => "masculin","idGrade" => 2],
        ["Matricule" => 232323,"NomPompier" => "Boucher","PrenomPompier" => "Louis","DateNaissPompier" => "1993-12-07","TellPompier" => "0656789123","SexePompier" => "masculin","idGrade" => 1],
        ["Matricule" => 242424,"NomPompier" => "Girard","PrenomPompier" => "Audrey","DateNaissPompier" => "2005-07-16","TellPompier" => "0645678912","SexePompier" => "féminin","idGrade" => 12],
        ["Matricule" => 252525,"NomPompier" => "Bergeron","PrenomPompier" => "François","DateNaissPompier" => "1998-04-23","TellPompier" => "0689123456","SexePompier" => "masculin","idGrade" => 3],
        ["Matricule" => 262626,"NomPompier" => "Roy","PrenomPompier" => "Sophie","DateNaissPompier" => "2000-02-12","TellPompier" => "0678912345","SexePompier" => "féminin","idGrade" => 8],
        ["Matricule" => 272727,"NomPompier" => "Lavoie","PrenomPompier" => "Alexandra","DateNaissPompier" => "1996-11-18","TellPompier" => "0643219876","SexePompier" => "féminin","idGrade" => 10],
        ["Matricule" => 282828,"NomPompier" => "Gauthier","PrenomPompier" => "David","DateNaissPompier" => "1994-08-07","TellPompier" => "0654321987","SexePompier" => "masculin","idGrade" => 2],
        ["Matricule" => 292929,"NomPompier" => "Simard","PrenomPompier" => "Isabelle","DateNaissPompier" => "2003-06-24","TellPompier" => "0612345678","SexePompier" => "féminin","idGrade" => 11],
        ["Matricule" => 303030,"NomPompier" => "Fournier","PrenomPompier" => "Antoine","DateNaissPompier" => "1997-03-09","TellPompier" => "0623456789","SexePompier" => "masculin","idGrade" => 6],
        ["Matricule" => 313131,"NomPompier" => "Tremblay","PrenomPompier" => "Sarah","DateNaissPompier" => "1999-09-30","TellPompier" => "0678901234","SexePompier" => "féminin","idGrade" => 5],
        ["Matricule" => 323232,"NomPompier" => "Lapointe","PrenomPompier" => "Maxime","DateNaissPompier" => "1995-02-25","TellPompier" => "0645678901","SexePompier" => "masculin","idGrade" => 7],
        ["Matricule" => 345678,"NomPompier" => "Pelletier","PrenomPompier" => "Marie","DateNaissPompier" => "2001-11-12","TellPompier" => "0612345678","SexePompier" => "féminin","idGrade" => 9],
        ["Matricule" => 343434,"NomPompier" => "Dubois","PrenomPompier" => "Simon","DateNaissPompier" => "1998-08-29","TellPompier" => "0678912345","SexePompier" => "masculin","idGrade" => 4],
        ["Matricule" => 353535,"NomPompier" => "Lévesque","PrenomPompier" => "Audrey","DateNaissPompier" => "1997-05-06","TellPompier" => "0689123456","SexePompier" => "féminin","idGrade" => 12],
        ["Matricule" => 363636,"NomPompier" => "Boivin","PrenomPompier" => "Philippe","DateNaissPompier" => "2002-03-18","TellPompier" => "0643219876","SexePompier" => "masculin","idGrade" => 3],
        ["Matricule" => 373737,"NomPompier" => "Lacroix","PrenomPompier" => "Stéphanie","DateNaissPompier" => "1994-12-23","TellPompier" => "0656789123","SexePompier" => "féminin","idGrade" => 8]
    ];
    
    //! Insert pompier
    // $req = $db->prepare('INSERT INTO Pompier (Matricule, NomPompier, PrenomPompier, DateNaissPompier, TelPompier, SexePompier, idGrade) VALUES (:mMatricule, :mNomPompier, :mPrenomPompier, :mDateNaissPompier, :mTelPompier, :mSexePompier, :midGrade )');
    // foreach($insertPompier as $row) {
    //     try {
    //         $req->execute(array(
    //             ':mMatricule' => $row['Matricule'],           
    //             ':mNomPompier' => $row['NomPompier'],
    //             ':mPrenomPompier' => $row['PrenomPompier'],
    //             ':mDateNaissPompier' => $row['DateNaissPompier'],
    //             ':mTelPompier' => $row['TellPompier'],
    //             ':mSexePompier' => $row['SexePompier'],
    //             ':midGrade' => $row['idGrade']
    //         ));
    //     } catch(PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }
    

    // ! Affectation
    // $insertAffectation = [];
    // foreach ($insertPompier as $matricule) {
    //     $random_date = date('Y-m-d', strtotime("2020-03-13 + " .rand(-30, 30).' days'));
    //     $idCaserne = rand(1, 13);
    //     $insertAffectation[] = [
    //         "Matricule" => $matricule['Matricule'],
    //         "Date" => $random_date,
    //         "idCaserne" => $idCaserne
    //     ];
    // }

    // $req = $db->prepare('INSERT INTO affectation (Matricule,Date,idCaserne) VALUES (:mMatricule,:date,:idCaserne)');
    // foreach($insertAffectation as $row) {
    //     try {
    //         $req->execute(array(
    //             ':mMatricule' => $row['Matricule'],           
    //             ':date' => $row['Date'],           
    //             ':idCaserne' => $row['idCaserne']
    //         ));
    //     } catch(PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }

    //! Pro ou Volontaire
    // $insertProfessionnel = [];
    // $insertVolontaire = [];

    // foreach ($insertPompier as $matricule) {
    //     $typePompier = rand(0, 1); // 0 pour volontaire, 1 pour professionnel
    //     if ($typePompier === 1) {
    //         $matPro = [
    //             "Matricule" => $matricule['Matricule'],
    //             "DateEmbauche" => "2023-04-24",
    //             "Indice" => rand(500, 999)
    //         ];
    //         array_push($insertProfessionnel, $matPro);
    //     } else {
    //         $volontaire = [
    //             "Matricule" => $matricule['Matricule'],
    //             "Bip" => strval(rand(100, 999)),
    //             "IdEmployeur" => rand(1, 3)
    //         ];
    //         array_push($insertVolontaire, $volontaire);
    //     }
    // }
    // //! Insertion des pro
    // $req = $db->prepare('INSERT INTO professionnel (MatPro,DateEmbauche,Indice) VALUES (:MatPro,:DateEmbauche,:Indice)');
    // foreach($insertProfessionnel as $row) {
    //     try {
    //         $req->execute(array(
    //             ':MatPro' => $row['Matricule'],           
    //             ':DateEmbauche' => $row['DateEmbauche'],           
    //             ':Indice' => $row['Indice']
    //         ));
    //     } catch(PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }
    // //! Insertion des volontaire
    // $req = $db->prepare('INSERT INTO volontaire (MatVolontaire,Bip,IdEmployeur) VALUES (:MatVolontaire,:Bip,:IdEmployeur)');
    // foreach($insertVolontaire as $row) {
    //     try {
    //         $req->execute(array(
    //             ':MatVolontaire' => $row['Matricule'],           
    //             ':Bip' => $row['Bip'],           
    //             ':IdEmployeur' => $row['IdEmployeur']
    //         ));
    //     } catch(PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }


    //! Ajout de véhicules de base
    // $reqAjoutEngin = $db->prepare('INSERT INTO engin (Numéro,idCaserne,IdTypeEngin) VALUES (:num,:idcaserne,:idtypeengin)');

    // $reqAjoutMaintenance = $db->prepare('INSERT INTO maintenance VALUES (:idCaserne,:num,:idtypeengin,:idGarage,:raison,:datedeb,:datefin)');

    // for ($i=1; $i < 13; $i++) {
    //     $reqAjoutEngin->execute(array(
    //         ':num' => 1,           
    //         ':idcaserne' => $i,           
    //         ':idtypeengin' => "CCF"
    //     ));

    //     $reqAjoutEngin->execute(array(
    //         ':num' => 1,           
    //         ':idcaserne' => $i,           
    //         ':idtypeengin' => "VSAV"
    //     ));

    //     $reqAjoutEngin->execute(array(
    //         ':num' => 1,           
    //         ':idcaserne' => $i,           
    //         ':idtypeengin' => "VSS"
    //     ));

    //     $random_date1 = date('Y-m-d', strtotime("2020-03-13 + " .rand(-30, 30).' days'));
    //     $reqAjoutMaintenance->execute(array(
    //         ':idCaserne' => $i,           
    //         ':num' => 1,           
    //         ':idtypeengin' => "CCF",
    //         ':idGarage' => 1,
    //         ':raison' => "Acquisition.",
    //         ':datedeb' => 1,
    //         ':datefin' => 1
    //     ));

    //     $random_date2 = date('Y-m-d', strtotime("2020-03-13 + " .rand(-30, 30).' days'));
    //     $reqAjoutMaintenance->execute(array(
    //         ':idCaserne' => $i,           
    //         ':num' => 1,           
    //         ':idtypeengin' => "VSAV",
    //         ':idGarage' => 1,
    //         ':raison' => "Acquisition.",
    //         ':datedeb' => 1,
    //         ':datefin' => 1
    //     ));

    //     $random_date3 = date('Y-m-d', strtotime("2020-03-13 + " .rand(-30, 30).' days'));
    //     $reqAjoutMaintenance->execute(array(
    //         ':idCaserne' => $i,           
    //         ':num' => 1,           
    //         ':idtypeengin' => "VSS",
    //         ':idGarage' => 1,
    //         ':raison' => "Acquisition.",
    //         ':datedeb' => 1,
    //         ':datefin' => 1
    //     ));

    // }
?>