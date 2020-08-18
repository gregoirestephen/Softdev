<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Welcome@index');

route::get('/exit','HomeController@logout')->name('exit');

Auth::routes();

//route vers home
Route::get('/tklinic-woezon', 'HomeController@index')->name('home');

//utilisateurs /
route::get('/users','UserController@index')->name('users.index');
route::get('/users/index','UserController@show')->name('users.show');
route::get('/users/{user}','UserController@getUtilisateur')->name('users.get');
route::post('/users','UserController@store')->name('users.store');
route::put('/users/{user}','UserController@update')->name('users.update');
route::delete('/users/{user}','UserController@destroy')->name('users.destroy');


// profils /
route::get('/profils','ProfilController@index')->name('profil.index');
route::get('/profils/test','ProfilController@test')->name('profil.test');
route::get('/profils/index','ProfilController@show')->name('profil.show');
route::get('/profils/{profil}','ProfilController@getProfil')->name('profil.get');
route::post('/profils','ProfilController@store')->name('profil.store');
route::put('/profils/{profil}','ProfilController@update')->name('profil.update');
route::delete('/profils/{profil}','ProfilController@destroy')->name('profil.destroy');

//patients /
route::get('/patients','PatientController@index')->name('patients.index');
route::get('/patients/index','PatientController@show')->name('patients.show');
route::get('/patients/search','PatientController@search')->name('patients.search');
route::get('/patients/{patient}','PatientController@getPatient')->name('patients.get');
route::get('/patient/info/{patient}','PatientController@infoPatient')->name('patients.info');
route::get('/patients/profession/{profession}','PatientController@getProfession')->name('patients.getProfession');
route::get('/patients/assurance/{assurance}','PatientController@getAssurance')->name('patients.getAssurance');
route::get('/fiches','PatientController@fiche')->name('patients.fiche');
route::post('/patients','PatientController@store')->name('patients.store');
route::put('/patients/{patient}','PatientController@update')->name('patients.update');
route::get('/patients/verification/{id}','PatientController@verification')->name('patients.verif');
route::delete('/patients/{patient}','PatientController@destroy')->name('patients.destroy');

//Consultations /
route::get('/consultations','ConsultationController@index')->name('consultations.index');
route::get('/consultations-facture','ConsultationController@getSearch')->name('consultations.getSearch');
route::get('/consultations-facture/resultats','ConsultationController@search')->name('consultations.search');
route::get('/consultations/annuler/{consultation}','ConsultationController@annuler')->name('consultations.annuler');
route::get('/consultations/create','ConsultationController@create')->name('consultations.create');
route::get('/consultations/index','ConsultationController@show')->name('consultations.show');
route::get('/consultations/{consultation}','ConsultationController@getConsultation')->name('consultations.get');
route::post('/consultations','ConsultationController@store')->name('consultations.store');
route::put('/consultations/{consultation}','ConsultationController@update')->name('consultations.update');
route::get('/consultations/verification/{id}','ConsultationController@verification')->name('consultations.verif');
route::delete('/consultations/{consultation}','ConsultationController@destroy')->name('consultations.destroy');

//rdvs /
route::get('/rdv','RdvController@index')->name('rdv.index');
route::get('/rdv/liste','RdvController@listeRdv')->name('rdv.liste');
route::get('/rdv/index','RdvController@show')->name('rdv.show');
route::get('/rdv/todo/{rdv}/{tache}','RdvController@todoRdv')->name('rdv.todoRdv');
route::get('/rdv/{rdv}','RdvController@getRdv')->name('rdv.get');
route::post('/rdv','RdvController@store')->name('rdv.store');
route::put('/rdv/{rdv}','RdvController@update')->name('rdv.update');
route::delete('/rdv/{rdv}','RdvController@destroy')->name('rdv.destroy');

//antecedents /
route::get('/antecedents','AntecedentController@index')->name('antecedents.index');
route::get('/antecedents/index','AntecedentController@show')->name('antecedents.show');
route::get('/antecedents/{antecedent}','AntecedentController@getAntecedent')->name('antecedents.get');
route::post('/antecedents','AntecedentController@store')->name('antecedents.store');
route::put('/antecedents/{antecedent}','AntecedentController@update')->name('antecedents.update');
route::delete('/antecedents/{antecedent}','AntecedentController@destroy')->name('antecedents.destroy');

//assurance /
route::get('/assurances','AssuranceController@index')->name('assurances.index');
route::get('/assurances/index','AssuranceController@show')->name('assurances.show');
route::get('/assurances/{id}','AssuranceController@getAssurance')->name('assurance.get');
route::post('/assurances','AssuranceController@store')->name('assurances.store');
route::put('/assurances/{assurance}','AssuranceController@update')->name('assurances.update');
route::get('/assurances/verification/{id}','AssuranceController@verification')->name('assurances.verif');
route::delete('/assurances/{assurance}','AssuranceController@destroy')->name('assurances.destroy');

//Ordonnances /
route::get('/ordonnances','OrdonnanceController@index')->name('ordonnances.index');
route::get('/ordonnances/index','OrdonnanceController@show')->name('ordonnances.show');
route::get('/ordonnances/annuler/{ordonnance}','OrdonnanceController@annulerMe')->name('reglements.annulerMe');
route::get('/ordonnances/{ordonnance}','OrdonnanceController@getOrdonnance')->name('ordonnances.get');
route::get('/ordonnances/ligne-medicaments/{ordonnance}','OrdonnanceController@getLigne')->name('ordonnances.getLigne');
route::post('/ordonnances','OrdonnanceController@store')->name('ordonnances.store');
route::put('/ordonnances/{ordonnance}','OrdonnanceController@update')->name('ordonnances.update');
route::delete('/ordonnances/{ordonnance}','OrdonnanceController@destroy')->name('ordonnances.destroy');

//Medications /
route::get('/medications','MedicationController@index')->name('medications.index');
route::get('/medications/index','MedicationController@show')->name('medications.show');
route::get('/medications/{medication}','MedicationController@getMedication')->name('medications.get');
route::post('/medications','MedicationController@store')->name('medications.store');
route::put('/medications/{medication}','MedicationController@update')->name('medications.update');
route::delete('/medications/{medication}','MedicationController@destroy')->name('medications.destroy');

//Professions /
route::get('/professions','ProfessionController@index')->name('professions.index');
route::get('/professions/index','ProfessionController@show')->name('professions.show');
route::get('/professions/{profession}','ProfessionController@getProfession')->name('professions.get');
route::post('/professions','ProfessionController@store')->name('professions.store');
route::put('/professions/{profession}','ProfessionController@update')->name('professions.update');
route::get('/professions/verification/{id}','ProfessionController@verification')->name('professions.verif');
route::delete('/professions/{profession}','ProfessionController@destroy')->name('professions.destroy');


//actes /
route::get('/actes','ActeController@index')->name('actes.index');
route::get('/actes/index','ActeController@show')->name('actes.show');
route::get('/actes/{acte}','ActeController@getActe')->name('actes.get');
route::post('/actes','ActeController@store')->name('actes.store');
route::put('/actes/{acte}','ActeController@update')->name('actes.update');
route::delete('/actes/{acte}','ActeController@destroy')->name('actes.destroy');

//dents /
route::get('/dents','DentController@index')->name('dents.index');
route::get('/dents/index','DentController@show')->name('dents.show');
route::get('/dents/{dent}','DentController@getDent')->name('dents.get');
route::post('/dents','DentController@store')->name('dents.store');
route::put('/dents/{dent}','DentController@update')->name('dents.update');
route::delete('/dents/{dent}','DentController@destroy')->name('dents.destroy');

//medicaments /
route::get('/medicaments','MedicamentController@index')->name('medicaments.index');
route::get('/medicaments/index','MedicamentController@show')->name('medicaments.show');
route::get('/medicaments/{medicament}','MedicamentController@getMedicament')->name('medications.get');
route::post('/medicaments','MedicamentController@store')->name('medications.store');
route::put('/medicaments/{medicament}','MedicamentController@update')->name('medications.update');
route::delete('/medicaments/{medicament}','MedicamentController@destroy')->name('medications.destroy');

//factures /
route::get('/facture-fiche','FactureController@consultMe')->name('factures.consultation');
route::get('/facture-fiche/resultat','FactureController@resultat')->name('factures.resultat');
route::get('/factures/annuler/{facture}','FactureController@annuler')->name('factures.annuler');
route::get('/factures','FactureController@index')->name('factures.index');
route::get('/factures/index','FactureController@show')->name('factures.show');
route::get('/factures/{facture}','FactureController@getFacture')->name('factures.get');
route::get('/factures/verification/{id}','FactureController@verification')->name('factures.verif');
route::get('/factures/ligne-actes/{facture}','FactureController@getLigne')->name('factures.getLigne');
route::get('/factures/acte/{acte}','FactureController@getActe')->name('factures.getActe');
route::get('/factures/patient/{patient}','FactureController@getPatient')->name('factures.getPatient');
route::post('/factures','FactureController@store')->name('factures.store');
route::put('/factures/{facture}','FactureController@update')->name('factures.update');
route::delete('/factures/{facture}','FactureController@destroy')->name('factures.destroy');

//Impression
route::get('/reglement/consultation/{reglement}','PdfController@regler')->name('impression.reglement');
route::get('/fact/consultation/{facture}','PdfController@index')->name('impression.fact');

//reglements /
route::get('/reglements','ReglementController@index')->name('reglements.index');
route::get('/reglements/index','ReglementController@show')->name('reglements.show');
route::get('/reglements-fiche','ReglementController@getSearch')->name('reglements.getSearch');
route::get('/reglements-fiche/resultat','ReglementController@search')->name('reglements.search');
route::get('/reglements/annuler/{reglement}/{facture}','ReglementController@annuler')->name('reglements.annuler');
route::get('/reg/{facture}','ReglementController@factureMe')->name('reglements.fact');
route::get('/fact/{patient}','ReglementController@factureShow')->name('reglements.factureShow');
route::get('/reglements/{reglement}','ReglementController@getReglement')->name('reglements.get');
route::get('/reglement/facture/{facture}/{somme}','ReglementController@resteF')->name('reglements.resteF');
route::post('/reglements','ReglementController@store')->name('reglements.store');
route::put('/reglements/{reglement}','ReglementController@update')->name('reglements.update');
route::delete('/reglements/{reglement}','ReglementController@destroy')->name('reglements.destroy');

//ligne Antecedents /
route::get('/ligne-antecedents','LigneAntecedentController@index')->name('Lantecedents.index');
route::get('/ligne-antecedents/index','LigneAntecedentController@show')->name('Lantecedents.show');
route::get('/ligne-antecedents/{antecedent}','LigneAntecedentController@getAntecedent')->name('Lantecedents.get');
route::post('/ligne-antecedents','LigneAntecedentController@store')->name('Lantecedents.store');
route::put('/ligne-antecedents/{antecedent}','LigneAntecedentController@update')->name('Lantecedents.update');
route::delete('/ligne-antecedents/{antecedent}','LigneAntecedentController@destroy')->name('Lantecedents.destroy');

//ligne Medications /
route::get('/ligne-medications','LigneMedicationController@index')->name('Lmedications.index');
route::get('/ligne-medications/index','LigneMedicationController@show')->name('Lmedications.show');
route::get('/ligne-medications/{medication}','LigneMedicationController@getLigne')->name('Lmedications.get');
route::post('/ligne-medications','LigneMedicationController@store')->name('Lmedications.store');
route::put('/ligne-medications/{medication}','LigneMedicationController@update')->name('Lmedications.update');
route::delete('/ligne-medications/{medication}','LigneMedicationController@destroy')->name('Lmedications.destroy');

//ligne Medicaments /
route::get('/ligne-medicament','LigneMedicamentController@index')->name('Lmedicaments.index');
route::get('/ligne-medicament/index','LigneMedicamentController@show')->name('Lmedicaments.show');
route::get('/ligne-medicament/{medicament}','LigneMedicamentController@getMedicament')->name('Lmedicaments.get');
route::post('/ligne-medicament','LigneMedicamentController@store')->name('Lmedicaments.store');
route::put('/ligne-medicament/{medicament}','LigneMedicamentController@update')->name('Lmedicaments.update');
route::delete('/ligne-medicament/{medicament}','LigneMedicamentController@destroy')->name('Lmedicaments.destroy');

//ligne Actes /
route::get('/ligne-acte','LigneActeController@index')->name('Lactes.index');
route::get('/ligne-acte/index','LigneActeController@show')->name('Lactes.show');
route::get('/ligne-acte/{acte}','LigneActeController@getActe')->name('Lactes.get');
route::post('/ligne-acte','LigneActeController@store')->name('Lactes.store');
route::put('/ligne-acte/{acte}','LigneActeController@update')->name('Lactes.update');
route::delete('/ligne-acte/{acte}','LigneActeController@destroy')->name('Lactes.destroy');

//Traitements /
route::get('/traitement','TraitementController@index')->name('traitements.index');
route::get('/traitement/index/{patient}','TraitementController@show')->name('traitements.show');
route::get('/traitement/{traitement}','TraitementController@getTraitement')->name('traitements.get');
route::get('/traitement/lActe/{patient}','TraitementController@getTacte')->name('traitements.getTacte');
route::get('/traitement/actes/{patient}','TraitementController@getActe')->name('traitements.getActe');
route::get('/traitement/etat/{acte}/{etat}','TraitementController@modifLigne')->name('traitements.modifLigne');
route::post('/traitement','TraitementController@store')->name('traitements.store');
route::put('/traitement/{traitement}','TraitementController@update')->name('traitements.update');
route::delete('/traitement/{traitement}','TraitementController@destroy')->name('traitements.destroy');

//Historique
route::get('/historique','HistoriquePatient@getSearch')->name('historique.getsearch');
route::get('/historique/resultat','HistoriquePatient@search')->name('historique.search');





