<?php

require_once 'Test.php';
require_once 'Truc.php';
require_once 'TrucDAO.php';
require_once 'DAL.php';

$dal = new DAL();

/**
 * DAL non connecté
 */

Test::assert('DAL non connecté', $dal->isConnected() === false);

/**
 * Connexion DAL
 */

Test::assert('Connexion DAL', $dal->connect());

/**
 * DAL connecté
 */

Test::assert('DAL connecté', $dal->isConnected());

/**
 * DAL deconnecté
 */

Test::assert('DAL déconnecté', $dal->disconnect() && $dal->isConnected() === false);

/**
 * DAL requete sans param
 */

$dal->connect();
$sql = 'SELECT * FROM Truc';
Test::assert('Requête sans paramètre', (bool)$dal->execute($sql, []));

/**
 * DAL requete avec param
 */

$dal->connect();
$sql = 'SELECT * FROM Truc where name = :nom';
Test::assert('Requête avec paramètre', (bool)$dal->execute($sql, ['nom' => 'Pierre']));

/**
 * Create Truc
 */

$dao = new TrucDAO($dal);

$truc = new Truc();
$truc->setName('Paul');
Test::assert('Insertion d\'un truc 1/2', $dao->add($truc) === true);
Test::assert('Insertion d\'un truc 1/2', $truc->getId() > 0);
$id = $truc->getId();


/**
 * Get one truc (previously created)
 */
$truc2 = $dao->get($id);
Test::assert('Get one truc by id 1/2', $truc instanceof Truc);
Test::assert('Get one truc by id 1/2', $truc == $truc2);


/**
 * Update one truc (previously created)
 */
$truc->setName('Henri');
Test::assert('Modification du dernier truc ajouté 1/2', $dao->update($truc));
$truc2 = $dao->get($id);
Test::assert('Modification du dernier truc ajouté 2/2', $truc == $truc2);


/**
 * Delete one truc (previously created)
 */
Test::assert('Delete one truc', $dao->delete($truc));


/**
 * Search by name
 */
$trucsList = $dao->searchByName($truc->getName());
Test::assert('Search one truc by name 1/2', count($trucsList) >= 1);
Test::assert('Search one truc by name 1/2', $truc->getName() == $trucsList[0]['name']);
