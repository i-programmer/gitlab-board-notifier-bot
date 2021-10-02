[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.0-8892BF.svg)](https://php.net/)
[![Code Quality](https://img.shields.io/scrutinizer/g/i-programmer/gitlab-board-notifier-bot/master.svg?style=flat)](https://scrutinizer-ci.com/g/i-programmer/gitlab-board-notifier-bot/?branch=master)
[![Donate](https://img.shields.io/badge/%F0%9F%92%99-Donate-blue)](http://iprogrammer.pro/donate/)

Небольшое приложение, которое уведомляет о действиях, которые происходят на доске в GitLab. Уведомления могут отсылаться в любой мессенджер. На данные момент реализованы уведомления в бот телеграм.


Установка:

- установить webhooks в gitlab
- php init
- composer install
- заполнить конфигурационный файл `config/Config.php`
- все свойства `$labelName` в классах, наследованные от `ProcessMessage` должны содержать такие же имена, что и на доске (TODO, CodeReview и т.д.). Для не процессных меток (открыт, переоткрыт, закрыт) может быть любой текст. Но дополнительно переопределён метод `formingIsAcceptable`
- Имя `assignee` должно быть в формате "Имя Фамилия", например "Владимир Петров", "Сергей Волков", "Aleister Black" или метод `ProcessMessage::getUserFullNameWithShortedName`  должен быть переписан.

**NOTICE**: На данный момент сообщения отсылаются от "процессных" столбцов только в случае добавления исполнителя. В ином случае это ведёт к замусориванию сообщениями

**NOTICE 2**: Если в проект надо добавить ещё один процессную колонку или использовать не все, что указаны в текущем коде - необходимо добавить/удалить новый класс  в `/app/process_message/`

---


A little app of notifying of operations on a GitLab board. Notifications can be send to any messenger. At the moment notifications to a telegram bot are implemented.

Installing:

- set gitlab webhooks first
- php init
- composer install
- write data into the `config/Config.php`
- all properties `$labelName` of `ProcessMessage` inheritors must set the same names as on a board (TODO, CodeReview etc.). For none process labels ("Open", "Reopen", "Close") can be any text. But `formingIsAcceptable` method must be overwritten
- The format of `assignee` must be as "Name Surname", e.g. "Владимир Петров", "Сергей Волков", "Aleister Black"  or `ProcessMessage::getUserFullNameWithShortedName` method must be rewritten

**NOTICE**: At the moment, messages will be sent from "process" columns only if assignee will be added. Or trash messages will be sent

**NOTICE 2**: if you add another process column in GitLab or do not want to use those processes that specified in the project, than you have to add new/remove class inside `/app/process_message/` folder
