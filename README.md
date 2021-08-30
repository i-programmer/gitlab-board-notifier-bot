Небольшое приложение, которое уведомляет о действиях, которые происходят на доске в GitLab. Уведомления могут отсылаться в любой мессенджер. На данные момент реализованы уведомления в бот телеграм.


Установка:

- установить webhooks в gitlab
- php init
- composer install
- заполнить конфигурационный файл `config/Config.php`
- все свойства `$labelName` в классах, наследованные от `ProcessMessage` должны содержать такие же имена, что и на доске (TODO, CodeReview и т.д.). Для не процессных меток (открыт, переоткрыт, закрыт) может быть любой текст. Но дополнительно переопределён метод `formingIsAcceptable`
- Имя `assignee` должно быть в формате "Имя Фамилия", например "Владимир Петров", "Сергей Волков", "Aleister Black" или метод `ProcessMessage::getUserFullNameWithShortedName`  должен быть переписан.

**NOTICE**: На данный момент сообщения отсылаются от "процессных" столбцов только в случае добавления исполнителя. В ином случае это ведёт к замусориванию сообщениями


---


A little app of notifying of operations on a GitLab board. Notifications can be send to any messenger. At the moment notifications to a telegram bot are implemented.

Installing:

- set gitlab webhooks first
- php init
- composer install
- write data into the `config/Config.php`
- all properties `$labelName` of `ProcessMessage` inheritorы must set the same names as on a board (TODO, CodeReview etc.). For none process labels ("Open", "Reopen", "Close") can be any text. But `formingIsAcceptable` method must be overwritten
- The format of `assignee` must be as "Name Surname", e.g. "Владимир Петров", "Сергей Волков", "Aleister Black"  or `ProcessMessage::getUserFullNameWithShortedName` method must be rewritten

**NOTICE**: At the moment, messages will be sent from "process" columns only if assignee will be added. Or trash messages will be sent
