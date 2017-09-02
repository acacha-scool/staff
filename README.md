# staff

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Employees/workforce management for scools.

## Notes

Types of employees:
- Teachers
- Conserges
- Secretarias

Security/Authorization/Roles
- Users are responsible of that not this package. So we use permissions and authorizations -> Do not reinvent the wheel

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
      - Com aconseguim els professors: rol teachers
      - Com aconseguim el professor d'un grup de classe: això és el tutor
      - I els professors: mirant ufs imparteixen al grup
      - Llicòns tenen relació amb uf i tenen teacher id
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

Wizard:
- Pas 1: escollir un usuari o crear-lo (enviaria al mòdul usuaris primer i després tornar aquí)
- Pas 2: Fitxa de professor. Hi ha dades específiques
  - OCO! Dades personals són associades a un usuari i per tant no posar aquí!
- Pas 3: Substitucions
- Pas 4: assignacions de grups/tutories <- Cúrriculum


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
- Taula pivotant per relacionar professors entre si

JobPosition
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

Employee:
- Una taula per tots? no crec no.. Tots són users això ok
  
### Subtitutes

Opció 1. Impersonation
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
