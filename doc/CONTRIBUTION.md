# Contribution Guide

## Workflow

#### Build application

Specific information about building the application is available [here](INSTALLATION.md).

#### Translations

Translation files are localized in `app/locales` for frontend and `app/Resources/translations` for backend.
You can add new language just by creating new language files according to existing files.

File names should follow [ISO 639-1](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) standarized nomenclature, for example:
```
app/locales/en.json
app/Resources/translations/emails.pl.yml
app/Resources/translations/messages.pl.yml
```
New language will appear automatically in application. Just remember to rebuild frontend in order to choose new language from list in account settings.

If you want to make translation for plugin, you should create language file in `Resources/locales` subdirectory of plugin bundle the same way.

#### Pull requests

Include a reference to your ticket in commit messages (e.g. `TM-XXX Reset password`) and branches name (e.g. `feature/TM-XXX-reset-password`).

All new features need to be tested. All fixes need to provide updates in mocks and e2e tests. 

#### Code review

Process of code review covers not only the quality of code, but also impact on whole application.
Reviewer is obligated to check the result of CI tests which includes unit, e2e tests and coding standards.

#### Add a new tag template
Documentation about how to [add a new tag template](/doc/TAG_TEMPLATE.md) 

#### Add a new custom variable type
If you want to add a new variable you should read this [document](/doc/VARIABLE.md)

## Special thanks

7tag is mostly developed by Clearcode developers, but we strongly encourage you to contribute to 7tag applications.

Team:
- [Maciej Zawadziński](https://github.com/zawadzinski)
- [Piotr Szostak](https://github.com/pszostak)
- [Damian Zientalak](https://github.com/zientalak)
- [Marcin Nitschke](https://github.com/marnits)
- [Marek Wilczyński](https://github.com/emwil)
- [Marcin Matuszczyk](https://github.com/MarcinMat)
- [Michał Sikora](https://github.com/michalsikora)
- [Mateusz Frąckowiak](https://github.com/bua89)
- [Arek Zając](https://github.com/ArekZc)

Contributors:
- [Konrad Pawlikowski](https://github.com/preclowski)
- [Paweł Szczepański](https://github.com/psoders)
- [Patryk Kala](https://github.com/kallosz)
