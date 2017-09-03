# staff

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Employees/workforce management for scools.

## Dependencies

This Scool module depends (or have strong relations with) on:

- Foundation package
- Curriculum package
- Lesson package

## Notes

Apartats:
- Dashboard: Apartat principal per rol admin i gestors/equip directiu. Dades stuff i wizard gestor model 1. Activity feed staff
  - Que mostrar al dashboard:
    - Nombre total professors
    - Subtotals per cos, especialitat, etc
    - Dades històriques altres anys
    - Taula de substitucions actives, amb opció mostrar totes les de l'any. Link a gestió substitucions o a step wizard adequat per cada cas
    - NOmbre de càrrecs llista de càrrecs
    - Alertes: mostrar incoherències, temes pendets, profes a mig assignar, faltes de dades
- Teachers:
  - Wizards (es mostraran més o menys )
    - Tots els wizards (vegeu més abaix)
- Altres empleats:
    - Assignació de rols conserges i secretaries a certs usuaris
    - TODO: taules específiques, cal info extra? PREGUNTAR PER FITXES DE SECRE/CONSERGE?? crec no cal
    - Afegir personal manteniment? Almenys becaris ok per surtin a certes llistes i tenir en compte. NO assignarà cap privilegi extra
- Informes:
  - Llista de professors i treballadors en diferents formats (PDF, web, sheet)
- Manteniments: 
  - Gestió de rols: ja estaran fets per defecte amb seeds però cal mostrar-los i permetre edicions valors secundaris (no esborrables els crítics com teacher o cap departament!)
  - Permetre crear rols/càrrecs secundaris? ok i assignar a usuaris. No pot ser problema pq no faran res especial fins no s'utilitzin a codi però ja tindrem relació!
  - CRUDS de tots els models
  - Gestió de camps oberts: permetre afegir camps lliures a la info específica de professors sense programar.
  
Rutes:
- CRUDDY BY DESIGN: https://www.youtube.com/watch?v=MF0jFKvS4SI

Types of employees/staff:
- Teachers
- Conserges
- Secretarias

Security/Authorization/Roles
- Users are responsible of security!! Not this package. So we use permissions and authorizations -> Do not reinvent the wheel

How a user become a teacher:
- First as said we have to have a user-> we can create a new one or assign and existing one
- Assign Role (teacher) and permissions through role. So a teacher is and user with role at least role teacher
- Teachers could have more roles (cargos) and then more permissions

Model
- teachers table
- teacher_id: tema dels substituts
  - Cal UTILITZAR-LO. Vull dir a la taula sí però com a clau externa a altres taules? Millor no posar l'user... no podem assignar directament user_id?
- Mandatory(not null) fields:
  - user_id
  - state: Explicats més abaix permetria tenir professors a mig crear, indicar estan substituits o que són subtituts
  - teacher_code

Més dades de professorat:
- Cos: tant el cos com la especialitat estarn donats d'alta a taules curriculum. Es pot assignar a un user via taula pivotant. Currículum!
- Especialitat: tant el cos com la especialitat estarn donats d'alta a taules curriculum. Es pot assignar a un user via taula pivotant. Curriculum!
- Funcionari, no funcionari, en practiques: estats  

Migracions
- Taules especificades a relacions + dependencies (curriculum i lesson)

Seeds:
- Alta de roles:
  - Teacher
  - DepartmentHead
  - Tutor


Relació amb currículum:
- Taules de currículum no tinguin teacher_id ni user_id. En tot cas taules pivotants
- És a dir relacions n a n. UFs/Submodules pot impartir múltiples profes (Mòdul no fer assignacions treballem a nivell ufs)
- Grup de classe: 1 o diversos tutors. No utilitzar teacher id sinó users. Taula tutories siguin taula pivotant relaciona profes i grups de classe
- Departaments: cap de departament: relació n a n múltiples caps de departament? Altres càrrecs com cap de seminari?
  - NO teacher id! user_id!
  - Tenim un problema duplicitat/sincronització amb rols i càrrecs a més relacionats amb múltiples taules
  - GEstió de l'staff i càrrecs depèn d'altres mòduls
  - Exemples:
    - Teacher: depen del mòdul Lessons(timetables). Relació del rol teacher amb taula lesson, un professor és un usuari que fa almenys una llicó
      - Com aconseguim els professors: rol teachers, info extra taula teachers (state, codi profe, etc)
      - Com aconseguim el professor d'un grup de classe: això és el tutor
      - I els professors: mirant ufs imparteixen al grup, la uf té lesson_user els usuaris són el profes      
    - Cap de departament: un càrrec (descripcions, etc, info extra), un rol i també relació amb taula departament
    - Tutor: un càrrec (descripcions, etc, info extra), un rol i també relació amb taula grup de classe
    - Relació polimorfica amb rols? No cal taula càrrec sinó camps extras als rols (tipus etc) i només indicar foreign_key i tipus model
    - HasRoles: rolable_id, rolable_type -> Model rolable o que té rols relacionats -> Departament (cap departament, cap seminari), Tutor:
      - rolable_id  i rolable_type opcionals a la taula roles?
    - Com s'obtenen cap de departament: amb el id de departament buscant a rols el rol sigui tipus Departamen i amb el id donat, tenim el rol_id i partir d'aqí els users amb aquest rol!
    - NO hi ha camp cap de departament a taula departament!! perfecte! desacoplat! només cal crear rolse i relacionar-los amb el seu model i assignar rols a usuaris i 

user <-> teacher relació 1 a 1. 
- No confondre amb alguns usuaris tinguem potser múltiples usuaris o ens poguem amagar rols
- NO confondre amb els substituts, no fem finalment impersonation no?
- Per tant podem posar a totes les taules user_id en comptes de teacher_id i a partir del user_id ja obtindrem teacher_id si cal accedir a certa info especifica dthe teacher
  - Crec és millor així que al revés... Evitem que certes taules com: carrecs apuntin a teacher_id pq no sempre seran teachers
  - Quan està clar que la relació és amb un professor com relació grups de classe, profe (tutors, profes de grup) semantincament potser és millor però acaba sent un user no?
  

States:
- Active: but take into account no historical year info in database!
- Baixa laboral
- Active substituint algú
- Baixa lògica? not actiu en preparació

Wizard gestor (versió fa tota la feina):
- Pas 1: escollir un usuari (amb cercador) o crear-lo (enviaria al mòdul usuaris primer i després tornar aquí)
  - Pot ser un profe nou: des de la perspectiva de la planificació curricular no!! Pot no tenir dades personals però 
  el professor ja ha d'existir! De fet és l'usuari el que ha d'existir! Només el user_id (usuaris amb estat, provisionals) es dona d'alta a la planificació i després s'activa al setembre
- Pas 2: Estat: subtitut? actiu no actiu, etc
  - NOTA: Si s'ha seleccionat usuari ja és profe es mostren dades i s'entra en mode edició. També opció dessasignar rol professor (no continuem els passos)
- Pas 3: Fitxa de professor. Dades específiques:
  - NO dades personals això és fa a user
  - Dades professor: Cos, especialitat 
  - Taula teachers, mirar fitxa de professorat
- Pas 4: 
 - Assignació de roles: grups/tutories/càrrecs <- Cúrriculum . Podria ser al pas 3 també
 - Assignació codi de professor
- Pass 5: Mostra info relacionada del professor:
  - Horari: ja estarà fet (canvi perpectiva!! Ja no introduirem els horaris al setembre sinó al Juliol i no sabem tots els profes! per això usuaris amb id però sense més dades)
  - Imprimir full benvinguda/PDF personalitzat (opcional aquest full sempre el tindra via web en vista web o PDF i rep notificacions)
- Background: executar esdeveniments  
 
Wizard profe nou (semipublic accesible per email):
- Per accedir a este wizard cal saber una URL a mida (s'envia per correu)
- Pas 1 (o 1/2): usuari temporal (no taula users) omple tota la seva informació (pot deixar camps en blanc)
  - Omple dades personals i fitxa del professor (Potser 2 pasos)
- Pas 2: Indica d'una llista la plaça que cobreix 

Wizard gestor (amb ajuda professorat)
- Pas 1: Alta places pendents assignar (desplegable apareix pas 2 wizard profe nou)
- Pas 2: Assignar i enviar a un correu personal la plaça pendent. El professor rep email i segueix passos Wizard profe nou
- Pas 3: Validacions pendents: mostra quin ha omplert i qui no i permet validar
- Sempre pot passar a la versió control total

WEB PÚBLICA
- Document explicant procés amb un link de contacte per enviar un email: permetria començar al Juliol o quan es desitgi

Models

Teacher:
- As any other employee before they have to be users -> acacha/users package
- Custom employees INFO
  - Cargo/Càrrec: 
- Custom INFO (only teachers)
  - 
  - Table teacher_substitutions (model secundari): 
    - Professors als que substitueix. Podria ser directament de users_ids no teachers_ids
- Reports:
  - Lists of teachers diferent format and doc types (web, PDF, sheet, table)
  - PDF: sheet
  
TeacherSubstitution
- Taula pivotant per relacionar usuaris (professors) entre si

JobPosition (NO CAL LLEGIR EXPLICACIÖ!!)
- Assignació de càrrecs a usuaris. Normalment implica assignació de rols
- Cal? no serveix ja roles? Potser cal posar algún camp extra opcionals a rols per indicar que també és un carrèc (type o similar)
- Camps
  - id
  - user_id: OCO potser és rol_id!!!??? Un carrèc pot ser múltiples usuaris? Càrrecs unipersonals
  - En molts casos tenen una descripció diferent: cap estudis i cap estudis adjunt
  - Tutories: cada tutoria un càrrec? Més aviat aquesta info està a taula grups de classe o pivotant amb users
  - Titol del càrrec: podria estàr a rols o en una taula apart?
- Potser hi ha però rols que no tenen res a veure amb un càrrec

Conserges:
- Que podran fer a l'aplicació: operacions de lectura i accés a dades bàsicament
- Tenen info pròpia? Sinó no cal taula no?

Secretaries:
- Similar als conserges, però potser assumeixen més rols?

Employee (NO CAL, an employee  is an user with a rol):
- Una taula per tots? no crec no.. Tots són users això ok
  
### Subtitutes

Opció 1. Impersonation (DISCARDED BY SECURITY REASONS)
- Es crea un usuari nou i s'assigna rol de professor
- No es modifica cap registre de base de dades, és a dir el teacher_id del substitut no apareixerà a cap altre taula
  - Una possible excepció és al activity feed on estaria bé saber que ho ha fet el profe substituit però a través del substitut
- Té codi de professor, apareix a la llista de professors (opció llista amb substituts i substituits, sense substituts, mostrant subtituts en moment actual en comptes de substituits, etc)
- Els usuaris marcats amb el rol substituts poden accedir a una impersonation limitada
  - A diferència d'un admin la llista de possibles usuaris a impersonalitzar és limitada. Taula teacher_subtitutions indica a qui pot subtituir (pot ser ún o més d'un)
- Seguretat:
  - Oco amb substituir usuaris admin -> escalada de privilegis! També és un problema amb caps de departament i altres càrrecs
  - Normalment es substitueix el professor però no el càrrec i no han de tenir aquells rols
  - Problema greu que descarta aquesta solució?
  
Opció 2. Tenir-ho en compte al codi
- És a dir certes operacions han d'estar protegides (ja es fa sempre) però ser més flexibles. Exemple passar faltes:
  - El professor que imparteix l'assignatura pot passar falta.
  - El seu substitut també -> cal doncs comprovar-ho en la habilitat
  - De fet ja passarà quelcom similar amb rols superiors, per exemple un tutor també pot i un cap de departament també!
- Cal tenir en compte altres operacions:
  - Si els subtituts només passar faltes ok! A mesura facin més coses és complica codi
  - Tenir una impersonalització general d'usuari permetria deixar ser qui calgui durant un temps i dona flexibilitat
  
  

### Events && Event handlers

Event: New Teacher created
Handlers:
- Common Activity Feed
- Add teacher to Gmail groups (claustre o similar)
- Moodle: a través de Ldap ja serà usuari. Alguna cosa més?

## Structure

If any of the following are applicable to your project, then the directory structure should follow industry best practises by being named the following.

```
bin/        
config/
src/
tests/
vendor/
```


## Install

Via Composer

``` bash
$ composer require acacha-scool/staff
```

## Usage

``` php
$skeleton = new acacha-scool\staff();
echo $skeleton->echoPhrase('Hello, League!');
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email sergiturbadenas@gmail.com instead of using the issue tracker.

## Credits

- [Sergi Tur Badenas][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/acacha-scool/staff.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/acacha-scool/staff/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/acacha-scool/staff.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/acacha-scool/staff.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/acacha-scool/staff.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/acacha-scool/staff
[link-travis]: https://travis-ci.org/acacha-scool/staff
[link-scrutinizer]: https://scrutinizer-ci.com/g/acacha-scool/staff/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/acacha-scool/staff
[link-downloads]: https://packagist.org/packages/acacha-scool/staff
[link-author]: https://github.com/acacha
[link-contributors]: ../../contributors
